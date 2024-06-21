<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Candidate;
use App\Models\CandidateJob;
use App\Models\AssignJob;
use App\Models\Interview;
use App\Models\Job;
use App\Models\CandidateLicence;
use App\Models\CandJobLicence;
use Illuminate\Support\Facades\Auth;


class CandidateJobController extends Controller
{
    //

    public function candidateJobApply(Request $request)
    {

        try{
            $validator = Validator::make($request->all(), [
                'job_id' => 'required|exists:jobs,id',
                'candidate_id' => 'required|exists:candidates,id',
                'interview_id' => 'required|exists:interviews,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
            }

            $count = AssignJob::where('candidate_id', $request->candidate_id)->where('interview_id', $request->interview_id)->count();
            if ($count > 0) {
                return response()->json(['status' => false, 'message' => 'Job already assigned to this candidate.']);
            } else {
                $job_id = Interview::where('id', $request->interview_id)->first()->job_id;
                $assign_job = new AssignJob();
                $assign_job->candidate_id = $request->candidate_id;
                $assign_job->job_id = $request->job_id;
                $assign_job->company_id = $request->company_id;
                $assign_job->interview_id = $request->interview_id;
                $assign_job->user_id = Auth::user()->id;
                $assign_job->interview_status = $request->interview_status;
                $assign_job->save();

                //candidate job details add
                $candidate_details = Candidate::findOrFail($request->candidate_id);
                $job_details = Job::findOrfail($request->job_id) ?? null;

                $candidate_job = new CandidateJob();
                $candidate_job->candidate_id = $request->candidate_id;
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
                $candidate_job->assign_by_id = Auth::user()->id ?? null;
                $candidate_job->job_id = $job_details->id ?? null;
                $candidate_job->job_position = $job_details->candidate_position_id ?? null;
                $candidate_job->job_location = $job_details->address ?? null;
                $candidate_job->company_id = $job_details->company_id ?? null;
                $candidate_job->salary = $job_details->salary ?? null;
                $candidate_job->job_interview_status = $request->interview_status ?? null;
                $candidate_job->save();

                //candidate licence details add
                $indian_driving_licenses = CandidateLicence::where('candidate_id', $candidate_id)->where('licence_type', 'INDIAN')->pluck('licence_name')->toArray() ?? null;
                $gulf_driving_licenses = CandidateLicence::where('candidate_id', $candidate_id)->where('licence_type', 'GULF')->pluck('licence_name')->toArray() ?? null;
                
                foreach ($indian_driving_licenses as $key => $value) {
                    if($value != null){
                        $candidate_ind_licence = new CandJobLicence();
                        $candidate_ind_licence->candidate_job_id = $candidate_job->id;
                        $candidate_ind_licence->candidate_id = $candidate_id;
                        $candidate_ind_licence->licence_type = 'INDIAN';
                        $candidate_ind_licence->licence_name = $value;
                        $candidate_ind_licence->save();
                    }
                    
                }
                
                foreach($gulf_driving_licenses as $key => $value){
                    if($value != null){
                        $candidate_gulf_licence = new CandJobLicence();
                        $candidate_gulf_licence->candidate_job_id = $candidate_job->id;
                        $candidate_gulf_licence->candidate_id = $candidate_id;
                        $candidate_gulf_licence->licence_type = 'GULF';
                        $candidate_gulf_licence->licence_name = $value;
                        $candidate_gulf_licence->save();
                    }
                }
            }
                

        }catch(\Throwable $th){
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }


    public function candidateJobList()
    {
        try {
            $jobs = CandidateJob::where('candidate_id', auth()->user()->id)->get();
            return response()->json(['message' => 'Jobs listed successfully.', 'status' => true, 'data' => $jobs], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }
}
