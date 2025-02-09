<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Candidate;
use App\Models\CandidateJob;
use App\Models\AssignJob;
use App\Models\Interview;
use App\Transformers\JobTransformer;
use App\Models\Job;
use App\Models\Notification;
use App\Models\CandidateLicence;
use App\Models\CandJobLicence;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * @group Candidate Job
 */

class CandidateJobController extends Controller
{
    /**
     * Candidate Job Apply
     *
     * This endpoint will be used to apply job for candidate.
     * @bodyParam job_id string required Job id of the user. Example: 100
     * @bodyParam candidate_id string required candidate id of the user. Example: 20
     * @bodyParam interview_id string required interview id of the user. Example:
        * @response {
        * "message": "Job applied successfully."
        * 'status': true
        * }
        * @response 201 {
        * "message": "The job id field is required."
        * 'status': false
        * }

        * @response 201 {
        * "message": "The candidate id must be an integer."
        * 'status': false
        * }

        * @response 201 {
        * "message": "The interview id must be an existing interviews."
        * 'status': false
        * }

     * */

    public function candidateJobApply(Request $request)
    {

        try{
            $validator = Validator::make($request->all(), [
                'job_id' => 'required|exists:jobs,id',
                'interview_id' => 'required|exists:interviews,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
            }

            $count = AssignJob::where('candidate_id', Auth::user()->id)->where('interview_id', $request->interview_id)->count();
            if ($count > 0) {
                return response()->json(['status' => false, 'message' => 'Job already assigned to this candidate.']);
            } else {

                $interview_details = Interview::findOrFail($request->interview_id);
                $assign_job = new AssignJob();
                $assign_job->candidate_id = Auth::user()->id ?? null;
                $assign_job->job_id = $request->job_id ?? null;
                $assign_job->company_id = $interview_details->company_id ?? null;
                $assign_job->interview_id = $request->interview_id ?? null;
                $assign_job->user_id = Auth::user()->id ?? null;
                $assign_job->interview_status = 'Interested';
                $assign_job->save();

                //candidate job details add
                $candidate_details = Candidate::findOrFail(Auth::user()->id);
                $job_details = Job::findOrfail($request->job_id) ?? null;

                if ($job_details->vendor_id) {
                    $vendor = User::where('id', $job_details->vendor_id)->first();
                  } else {
                      $vendor = null;
                  }

                $candidate_job = new CandidateJob();
                $candidate_job->candidate_id = Auth::user()->id;
                $candidate_job->interview_id = $request->interview_id;
                $candidate_job->assign_job_id = $assign_job->id;

                $candidate_job->vendor_id = $job_details->vendor_id ?? null;
                $candidate_job->vendor_service_charge = $vendor->vendor_service_charge ?? null;
                $candidate_job->job_id = $job_details->id ?? null;
                $candidate_job->job_position =  $job_details->candidate_position_id ?? null;
                $candidate_job->job_location = $job_details->address ?? null;
                $candidate_job->company_id = $interview_details->company_id ?? null;
                $candidate_job->due_amount = $job_details->service_charge ?? null;
                $candidate_job->job_service_charge = $job_details->service_charge ?? null;
                $candidate_job->food_allowance = $job_details->benifits ?? null;
                $candidate_job->contract_duration = $job_details->contract ?? null;
                $candidate_job->interview_location = $interview_details->interview_location ?? null;
                $candidate_job->salary = $job_details->salary ?? null;
                $candidate_job->date_of_interview = $interview_details->interview_start_date ?? null;

                $candidate_job->full_name = $candidate_details->full_name ?? null;
                $candidate_job->email = $candidate_details->email ?? null;
                $candidate_job->gender = $candidate_details->gender ?? null;
                $candidate_job->date_of_birth = $candidate_details->date_of_birth ?? null;
                $candidate_job->whatapp_no = $candidate_details->whatapp_no ?? null;
                $candidate_job->alternate_contact_no = $candidate_details->alternate_contact_no ?? null;
                $candidate_job->religion = $candidate_details->religion ?? null;
                $candidate_job->city = $candidate_details->city ?? null;
                $candidate_job->address = null;
                $candidate_job->education = $candidate_details->education ?? null;
                $candidate_job->other_education = $candidate_details->other_education ?? null;
                $candidate_job->passport_number = $candidate_details->passport_number ?? null;
                $candidate_job->english_speak = $candidate_details->english_speak ?? null;
                $candidate_job->arabic_speak = $candidate_details->arabic_speak ?? null;
                $candidate_job->assign_by_id = null;

                $candidate_job->job_status = 'Active';
                $candidate_job->job_interview_status = 'Interested';
                $candidate_job->save();

                //candidate licence details add
                $indian_driving_licenses = CandidateLicence::where('candidate_id', Auth::user()->id)->where('licence_type', 'indian')->pluck('licence_name')->toArray() ?? null;
                $gulf_driving_licenses = CandidateLicence::where('candidate_id', Auth::user()->id)->where('licence_type', 'gulf')->pluck('licence_name')->toArray() ?? null;

                foreach ($indian_driving_licenses as $key => $value) {
                    if($value != null){
                        $candidate_ind_licence = new CandJobLicence();
                        $candidate_ind_licence->candidate_job_id = $candidate_job->id;
                        $candidate_ind_licence->candidate_id = Auth::user()->id;
                        $candidate_ind_licence->licence_type = 'indian';
                        $candidate_ind_licence->licence_name = $value;
                        $candidate_ind_licence->save();
                    }

                }

                foreach($gulf_driving_licenses as $key => $value){
                    if($value != null){
                        $candidate_gulf_licence = new CandJobLicence();
                        $candidate_gulf_licence->candidate_job_id = $candidate_job->id;
                        $candidate_gulf_licence->candidate_id = Auth::user()->id;
                        $candidate_gulf_licence->licence_type = 'gulf';
                        $candidate_gulf_licence->licence_name = $value;
                        $candidate_gulf_licence->save();
                    }
                }
            }

            $notification = new Notification;
            $notification->candidate_id = Auth::user()->id;
            $notification->type = 'Job Apply';
            $notification->message = 'Congratulations on Applying for Your New Job!';
            $notification->save();

            return response()->json(['message' => 'Job applied successfully.', 'status' => true], 200);

        }catch(\Throwable $th){
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }

    /**
     * Candidate Job Detail
     * /**
        * Fetches candidate job details.
        *
        * @api {post} /endpoint Fetch Candidate Job Details
        * @apiName GetCandidateJobDetails
        * @apiGroup CandidateJob
        * @apiParam {Number} candidate_job_id Candidate Job ID.
        * @apiSuccess {String} message Success message.
        * @apiSuccess {Boolean} status True if successful.
        * @apiSuccess {Object} job_status Statuses: interview, selected, medical, document, collection, deployment.
        * @apiError {String} message Error message.
        * @apiError {Boolean} status False if error.
    */


    public function candidateJobDetail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'candidate_job_id' => 'required|exists:candidate_jobs,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
            }

            $candidate_job_details = CandidateJob::where('id', $request->candidate_job_id)->first();

            // $status['interview'] = ($candidate_job_details->job_interview_status == 'Interested' || $candidate_job_details->job_interview_status == 'Selected');
            // $status['selected'] = ($candidate_job_details->job_interview_status == 'Selected');
            // $status['medical'] = ($candidate_job_details->medical_status != null);
            // $status['document'] = ($candidate_job_details->visa_receiving_date != null);
            // $status['collection'] = ($candidate_job_details->total_amount != null);
            // $status['deployment'] = ($candidate_job_details->deployment_date != null);
            if ($candidate_job_details->job_interview_status == 'Interested' || $candidate_job_details->job_interview_status == 'Selected') {
                $status['interview'] = CandidateJob::where('id', $request->candidate_job_id)->select('date_of_interview')->first();
            } else {
                $status['interview'] = null;
            }

            if ($candidate_job_details->job_interview_status == 'Selected') {
                $status['selected'] = CandidateJob::where('id', $request->candidate_job_id)->select('date_of_selection')->first();
            } else {
                $status['selected'] = null;
            }

            if ($candidate_job_details->medical_status != null) {
                $status['medical'] = CandidateJob::where('id', $request->candidate_job_id)->select('medical_application_date','medical_completion_date', 'medical_status', 'medical_repeat_date')->first();
            } else {
                $status['medical'] = null;
            }

            if ($candidate_job_details->visa_receiving_date != null) {
                $status['document'] = CandidateJob::where('id', $request->candidate_job_id)->select('visa_receiving_date', 'visa_issue_date', 'visa_expiry_date', 'ticket_confirmation_date', 'ticket_booking_date')->first();
            } else {
                $status['document'] = null;
            }

            if ($candidate_job_details->total_amount != null) {
                $status['collection'] = CandidateJob::where('id', $request->candidate_job_id)->select('fst_installment_amount', 'fst_installment_date',  'secnd_installment_amount', 'secnd_installment_date', 'third_installment_amount', 'third_installment_date', 'fourth_installment_amount', 'fourth_installment_date', 'total_amount')->first();
            } else {
                $status['collection'] = null;
            }

            if ($candidate_job_details->deployment_date != null) {
                $status['deployment'] = CandidateJob::where('id', $request->candidate_job_id)->select('deployment_date')->first();
            } else {
                $status['deployment'] = null;
            }

           return response()->json(['message' => 'Candidates details listed successfully.', 'status' => true, 'job_status'=> $status], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }

    }

    /**
     * Candidate Job List
     *
     * This endpoint will be used to list all jobs for candidate.
     * @response {
     * "message": "Candidate Jobs listed successfully."
     * 'status': true
     * }
     * @response 201 {
     * "message": "The candidate id must be an integer."
     * 'status': false
     * }
     */


    public function candidateJobList(Request $request)
    {
        $limit = $request->limit ?? 10;
        $offset = $request->offset ?? 0;

        try {
            $candidate_jobs = CandidateJob::where('candidate_id', Auth::user()->id);

            // Apply search filter if present
            if ($request->search) {
                $search = $request->search;
                $candidate_jobs = $candidate_jobs->whereHas('jobTitle', function ($query) use ($search) {
                    $query->where('job_name', 'like', '%' . $search . '%');
                })->orWhereHas('company', function ($query) use ($search) {
                    $query->where('company_name', 'like', '%' . $search . '%')->where('status', 1);
                });
            }

            // Pagination
            $candidate_jobs = $candidate_jobs->with('jobTitle', 'company')
                                             ->offset($offset)
                                             ->limit($limit)
                                             ->get();

            return response()->json(['message' => 'Candidate Jobs listed successfully.', 'status' => true, 'data' => $candidate_jobs], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }


    }
}
