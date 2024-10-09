<?php

namespace App\Http\Controllers;

use App\Events\CallCandidateEndEvent;
use App\Events\CallCandidateEvent;
use App\Exports\CandidateExport;
use App\Imports\CandidateImport;
use App\Models\AssignJob;
use App\Models\Candidate;
use App\Models\CandidateActivity;
use App\Models\CandidateFieldUpdate;
use App\Models\CandidateLicence;
use App\Models\CandidatePosition;
use App\Models\CandidateStatus;
use App\Models\CandidateUpdated;
use App\Models\Company;
use App\Models\Interview;
use App\Models\Job;
use App\Models\Source;
use App\Models\User;
use App\Models\CandidateJob;
use App\Models\CandJobLicence;
use App\Models\State;
use App\Models\City;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('Manage Candidate')) {
            $candidate_statuses = CandidateStatus::all();
            $sources = Source::orderBy('name', 'asc')->get();
            $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
            $cities = City::orderBy('name', 'asc')->get();
            $candidate_last_updates = CandidateUpdated::orderBy('id', 'desc')->get()->unique('user_id');
            if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
                $candidates = Candidate::orderBy('id', 'desc')->where('enter_by', Auth::user()->id)->paginate(50);
            } else {
                $candidates = Candidate::orderBy('id', 'desc');
                if ($request->has('call_status')) {
                    $candidates = $candidates->whereHas('candidateActivity', function ($query) use ($request) {
                        $query->where('call_status', $request->call_status)->where('user_id', Auth::user()->id);
                    });
                }

                $candidates = $candidates->paginate(50);
            }
            if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
                session()->forget('candidate_id');
            }
            // session()->forget('candidate_id');
            return view('candidates.list')->with(compact('candidates', 'sources', 'candidate_statuses', 'candidate_positions', 'cities', 'candidate_last_updates'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('Create Candidate')) {
            $sources = Source::orderBy('name', 'asc')->get();
            $candidate_statuses = CandidateStatus::all();
            $associates = User::role('ASSOCIATE')->get();
            $referrers = Candidate::orderBy('id', 'desc')->get();
            $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
            $states = State::orderBy('name', 'asc')->get();
            $cities = City::orderBy('name', 'asc')->get();
            return view('candidates.create')->with(compact('candidate_statuses', 'associates', 'candidate_positions', 'sources', 'states', 'cities', 'referrers'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contact_no' => 'required|digits:10',
            'full_name' => 'required',
            'dob' => 'required',
            'cnadidate_status_id' => 'required',
            'email' => 'nullable|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'position_applied_for_1' => 'required',
            'alternate_contact_no' => 'nullable|digits:10',
            'whatapp_no' => 'required|regex:/^\+91\d{10}$/',

            'passport_number' => 'nullable|regex:/^[A-Za-z]\d{7}$/',
        ], [
            'cnadidate_status_id.required' => 'The status field is required.',
            'position_applied_for_1.required' => 'The position applied for field is required.',
            'dob.required' => 'The date of birth field is required.',
            'full_name.required' => 'The full name field is required.',
            'alternate_contact_no.digits' => 'The alternate contact no must be 10 digits.',
            'whatapp_no.regex' => 'The whatapp no must be +91xxxxxxxxxx format.',
        ]);
        $count = Candidate::where('contact_no', $request->contact_no)->count();
        if ($count > 0) {
            $candidate = Candidate::where('contact_no', $request->contact_no)->first();
        } else {
            $candidate = new Candidate();
        }

        $candidate->enter_by = Auth::user()->id;
        $candidate->cnadidate_status_id = $request->cnadidate_status_id ?? null;
        $candidate->mode_of_registration = $request->mode_of_registration ?? null;
        $candidate->source = $request->source ?? null;
        // if ($request->referred_by_id) {
        $candidate->referred_by_id = $request->referred_by_id ?? null;
        // } else {
        //     $candidate->referred_by = $request->referred_by ?? null;
        // }
        $candidate->referred_by = $request->referred_by ?? null;
        $candidate->refer_name = $request->refer_name ?? null;
        $candidate->refer_phone = $request->refer_phone ?? null;
        $candidate->associate_id = $request->associate_id ?? null;
        $candidate->passport_number = $request->passport_number ?? null;
        $candidate->full_name = $request->full_name ?? null;
        $candidate->gender = $request->gender;
        $candidate->date_of_birth = $request->dob ?? null;
        // age calculation from date of birth
        $candidate->age = date_diff(date_create($request->dob), date_create('today'))->y;
        $candidate->education = $request->education ?? null;
        $candidate->other_education = $request->other_education ?? null;
        $candidate->contact_no = $request->contact_no ?? null;
        $candidate->alternate_contact_no = $request->alternate_contact_no ?? null;
        $candidate->email = $request->email ?? null;
        $candidate->whatapp_no = $request->whatapp_no ?? null;
        $candidate->state_id = $request->state_id ?? null;
        $candidate->city = $request->city_id ?? null;
        $candidate->religion = $request->religion ?? null;
        $candidate->ecr_type = $request->ecr_type ?? null;
        $candidate->english_speak = $request->english_speak ?? null;
        $candidate->arabic_speak = $request->arabic_speak ?? null;
        $candidate->return = ($request->return != null) ? $request->return : 0;
        if ($request->hasFile('cv')) {
            $request->validate([
                'cv' => 'mimes:pdf,doc,docx',
            ]);
            $candidate->cv = $this->imageUpload($request->file('cv'), 'cv', 'candidates');
        }

        // check position
        $position_1_count = CandidatePosition::where('id', $request->position_applied_for_1)->count();
        $position_2_count = CandidatePosition::where('id', $request->position_applied_for_2)->count();
        $position_3_count = CandidatePosition::where('id', $request->position_applied_for_3)->count();

        if ($request->position_applied_for_1) {
            if ($position_1_count > 0) {
                $candidate->position_applied_for_1 = $request->position_applied_for_1;
                $candidate->specialisation_1 = $request->specialisation_1;
            } else {
                $second_position_1_count = CandidatePosition::where('name', $request->position_applied_for_1)->count();
                if ($second_position_1_count > 0) {
                    $candidate->position_applied_for_1 = CandidatePosition::where('name', $request->position_applied_for_1)->first()->id;
                } else {
                    $candidate_position_1 = new CandidatePosition();
                    $candidate_position_1->user_id = Auth::user()->id;
                    $candidate_position_1->name = $request->position_applied_for_1;
                    $candidate_position_1->is_active = 0;
                    $candidate_position_1->save();
                    $candidate->position_applied_for_1 = $candidate_position_1->id;
                }
            }
        } else {
            $candidate->position_applied_for_1 = null;
        }

        if ($request->position_applied_for_2) {
            if ($position_2_count > 0) {
                $candidate->position_applied_for_2 = $request->position_applied_for_2;
                $candidate->specialisation_2 = $request->specialisation_2;
            } else {
                $second_position_2_count = CandidatePosition::where('name', $request->position_applied_for_2)->count();
                if ($second_position_2_count > 0) {
                    $candidate->position_applied_for_2 = CandidatePosition::where('name', $request->position_applied_for_2)->first()->id;
                } else {
                    $candidate_position_2 = new CandidatePosition();
                    $candidate_position_2->user_id = Auth::user()->id;
                    $candidate_position_2->name = $request->position_applied_for_2;
                    $candidate_position_2->is_active = 0;
                    $candidate_position_2->save();
                    $candidate->position_applied_for_2 = $candidate_position_2->id;
                }
            }
        } else {
            $candidate->position_applied_for_2 = null;
        }

        if ($request->position_applied_for_3) {
            if ($position_3_count > 0) {
                $candidate->position_applied_for_3 = $request->position_applied_for_3;
                $candidate->specialisation_3 = $request->specialisation_3;
            } else {
                $second_position_3_count = CandidatePosition::where('name', $request->position_applied_for_3)->count();
                if ($second_position_3_count > 0) {
                    $candidate->position_applied_for_3 = CandidatePosition::where('name', $request->position_applied_for_3)->first()->id;
                } else {
                    $candidate_position_3 = new CandidatePosition();
                    $candidate_position_3->user_id = Auth::user()->id;
                    $candidate_position_3->name = $request->position_applied_for_3;
                    $candidate_position_3->is_active = 0;
                    $candidate_position_3->save();
                    $candidate->position_applied_for_3 = $candidate_position_3->id;
                }
            }
        } else {
            $candidate->position_applied_for_3 = null;
        }


        $candidate->indian_exp = $request->indian_exp ?? null;
        $candidate->abroad_exp = $request->abroad_exp ?? null;
        $candidate->save();

        if ($request->remark) {
            $candidate_activity = new CandidateActivity();
            $candidate_activity->candidate_id = $candidate->id;
            $candidate_activity->user_id = Auth::user()->id;
            $candidate_activity->remarks = $request->remark ?? null;
            $candidate_activity->call_status = null;
            $candidate_activity->save();
        }

        if ($request->international_driving_license) {
            // delete old licence
            CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'GULF')->delete();

            foreach ($request->international_driving_license as $key => $value) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'GULF';
                $candidate_licence->licence_name = $value;
                $candidate_licence->save();
            }
        }

        if ($request->indian_driving_license) {
            // delete old licence
            CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'INDIAN')->delete();

            foreach ($request->indian_driving_license as $key => $value) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'INDIAN';
                $candidate_licence->licence_name = $value;
                $candidate_licence->save();
            }
        }

        if ($request->cnadidate_status_id) {
            $candidatePosition = new CandidateFieldUpdate();
            $candidatePosition->user_id = Auth::user()->id;
            $candidatePosition->candidate_id = $candidate->id;
            $candidatePosition->status = $request->cnadidate_status_id;
            $candidatePosition->save();
        }

        session()->flash('message', 'Candidate added successfully');
        return redirect()->route('candidates.index')->with('message', __('Candidate added successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate_statuses = CandidateStatus::all();
        $indian_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'INDIAN')->pluck('licence_name')->toArray();
        $gulf_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'GULF')->pluck('licence_name')->toArray();
        $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
        $sources = Source::orderBy('name', 'asc')->get();
        $assign_job = AssignJob::where('candidate_id', $candidate->id)->orderBy('id', 'desc')->first();
        $companies = Company::orderBy('company_name', 'asc')->get();
        // $cities = City::orderBy('name', 'asc')->get();
        $states = State::orderBy('name', 'asc')->get();
        $edit = true;
        if (!Auth::user()->hasRole('ADMIN') && !Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            if ($candidate->is_call_id != null && $candidate->is_call_id != Auth::user()->id) {
                return response()->json(['message' => __('Candidate already called.'), 'status' => 'error']);
            } else {
                $candidate_update = new CandidateUpdated();
                $candidate_update->user_id = Auth::user()->id;
                $candidate_update->candidate_id = $candidate->id;
                $candidate_update->save();
                session()->put('candidate_id', $candidate->id);
                $candidate->is_call_id = Auth::user()->id;
                $candidate->save();
                // event(new CallCandidateEvent($candidate->id));
            }
        }

        return response()->json(['view' => view('candidates.edit', compact('candidate', 'sources', 'companies', 'candidate_positions', 'assign_job', 'edit', 'candidate_statuses', 'indian_driving_license', 'gulf_driving_license', 'states'))->render(), 'status' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'full_name' => 'required',
            // 'dob' => 'required',
            'cnadidate_status_id' => 'required',
            'email' => 'nullable|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:candidates,email,' . $id,
            'position_applied_for_1' => 'required',
            'alternate_contact_no' => 'nullable|digits:10',
            'whatapp_no' => 'nullable|regex:/^\+91\d{10}$/',
            'passport_number' => 'nullable|regex:/^[A-Za-z]\d{7}$/',
            // 'remark' => 'required',
            'call_status' => 'required',
            'dob' => 'nullable|date_format:d-m-Y',
            // indian_exp word limit validation
            'remark' => 'nullable|required_if:call_status,REJECTED',
            'company_id' => 'nullable|required_if:call_status,INTERESTED',
            'interview_id' => 'nullable|required_with:company_id',
            // 'interview_status' => 'nullable|required_with:interview_id',
            // if call status is interested then interview status will be Interested

        ], [
            'cnadidate_status_id.required' => 'The status field is required.',
            'position_applied_for_1.required' => 'The position applied for field is required.',
            'dob.required' => 'The date of birth field is required.',
            'full_name.required' => 'The full name field is required.',
            'alternate_contact_no.digits' => 'The alternate contact no must be 10 digits.',
            'whatapp_no.regex' => 'The whatapp no must be +91xxxxxxxxxx format.',
            'company_id.required_if' => 'The company field is required.',
            'interview_id.required_with' => 'The job title field is required.',
            'interview_status.required_with' => 'The interview status field is required.',
        ]);


        $candidate = Candidate::findOrFail($id);

        if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            $candidate->cnadidate_status_id = $request->cnadidate_status_id;
        }
        $candidate->mode_of_registration = $request->mode_of_registration;
        $candidate->source = $request->source;
        if ($request->source == 'REFERENCE') {
            $candidate->refer_name = $request->refer_name;
            $candidate->refer_phone = $request->refer_phone;
        }
        if ($request->referred_by_id) {
            $candidate->referred_by_id = $request->referred_by_id;
        } else {
            $candidate->referred_by = $request->referred_by;
        }


        $candidate->full_name = $request->full_name;
        $candidate->gender = $request->gender;
        $candidate->date_of_birth = $request->dob;
        $candidate->age = date_diff(date_create($request->dob), date_create('today'))->y;
        $candidate->education = $request->education;
        $candidate->other_education = $request->other_education;
        $candidate->alternate_contact_no = $request->alternate_contact_no;
        $candidate->email = $request->email;
        $candidate->whatapp_no = $request->whatapp_no;
        $candidate->city = $request->city_id;
        $candidate->state_id = $request->state_id;
        $candidate->religion = $request->religion;
        $candidate->ecr_type = $request->ecr_type;
        $candidate->english_speak = $request->english_speak;
        $candidate->arabic_speak = $request->arabic_speak;
        $candidate->return = $request->return;

        // check position
        $position_1_count = CandidatePosition::where('id', $request->position_applied_for_1)->count();
        $position_2_count = CandidatePosition::where('id', $request->position_applied_for_2)->count();
        $position_3_count = CandidatePosition::where('id', $request->position_applied_for_3)->count();


        if ($request->position_applied_for_1) {
            if ($position_1_count > 0) {
                $candidate->position_applied_for_1 = $request->position_applied_for_1;
                $candidate->specialisation_1 = $request->specialisation_1;
            } else {
                $second_position_1_count = CandidatePosition::where('name', $request->position_applied_for_1)->count();
                if ($second_position_1_count > 0) {
                    $candidate->position_applied_for_1 = CandidatePosition::where('name', $request->position_applied_for_1)->first()->id;
                } else {
                    $candidate_position_1 = new CandidatePosition();
                    $candidate_position_1->user_id = Auth::user()->id;
                    $candidate_position_1->name = $request->position_applied_for_1;
                    $candidate_position_1->is_active = 0;
                    $candidate_position_1->save();
                    $candidate->position_applied_for_1 = $candidate_position_1->id;
                }
            }
        } else {
            $candidate->position_applied_for_1 = null;
        }

        if ($request->position_applied_for_2) {
            if ($position_2_count > 0) {
                $candidate->position_applied_for_2 = $request->position_applied_for_2;
                $candidate->specialisation_2 = $request->specialisation_2;
            } else {
                $second_position_2_count = CandidatePosition::where('name', $request->position_applied_for_2)->count();
                if ($second_position_2_count > 0) {
                    $candidate->position_applied_for_2 = CandidatePosition::where('name', $request->position_applied_for_2)->first()->id;
                } else {
                    $candidate_position_2 = new CandidatePosition();
                    $candidate_position_2->user_id = Auth::user()->id;
                    $candidate_position_2->name = $request->position_applied_for_2;
                    $candidate_position_2->is_active = 0;
                    $candidate_position_2->save();
                    $candidate->position_applied_for_2 = $candidate_position_2->id;
                }
            }
        } else {
            $candidate->position_applied_for_2 = null;
        }

        if ($request->position_applied_for_3) {
            if ($position_3_count > 0) {
                $candidate->position_applied_for_3 = $request->position_applied_for_3;
                $candidate->specialisation_3 = $request->specialisation_3;
            } else {
                $second_position_3_count = CandidatePosition::where('name', $request->position_applied_for_3)->count();
                if ($second_position_3_count > 0) {
                    $candidate->position_applied_for_3 = CandidatePosition::where('name', $request->position_applied_for_3)->first()->id;
                } else {
                    $candidate_position_3 = new CandidatePosition();
                    $candidate_position_3->user_id = Auth::user()->id;
                    $candidate_position_3->name = $request->position_applied_for_3;
                    $candidate_position_3->is_active = 0;
                    $candidate_position_3->save();
                    $candidate->position_applied_for_3 = $candidate_position_3->id;
                }
            }
        } else {
            $candidate->position_applied_for_3 = null;
        }


        $candidate->indian_exp = $request->indian_exp;
        $candidate->abroad_exp = $request->abroad_exp;
        $candidate->passport_number = $request->passport_number;
        $candidate->is_call_id = null;
        $candidate->save();

        if ($request->remark || $request->call_status) {
            $candidate_activity = new CandidateActivity();
            $candidate_activity->candidate_id = $candidate->id;
            $candidate_activity->user_id = Auth::user()->id;
            $candidate_activity->remarks = $request->remark ?? null;
            $candidate_activity->call_status = $request->call_status ?? null;
            $candidate_activity->save();
        }

        if ($request->international_driving_license) {
            // delete old licence
            CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'GULF')->delete();

            foreach ($request->international_driving_license as $key => $value) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'GULF';
                $candidate_licence->licence_name = $value;
                $candidate_licence->save();
            }
        }

        if ($request->indian_driving_license) {
            // delete old licence
            CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'INDIAN')->delete();

            foreach ($request->indian_driving_license as $key => $value) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'INDIAN';
                $candidate_licence->licence_name = $value;
                $candidate_licence->save();
            }
        }


        $candidate_position_applied = $candidate->candidateFieldUpdate->position ?? '';
        if ($request->position_applied_for !=  $candidate_position_applied || $request->cnadidate_status_id != $candidate->cnadidate_status_id) {
            $candidatePosition = new CandidateFieldUpdate();
            $candidatePosition->user_id = Auth::user()->id;
            $candidatePosition->candidate_id = $candidate->id;
            $candidatePosition->status = $request->cnadidate_status_id ?? '';
            if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
                $candidatePosition->is_granted = 1;
            } else {
                $candidatePosition->is_granted = 0;
            }

            $candidatePosition->save();
        }
        // if (!Auth::user()->hasRole('ADMIN') && !Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
        //     // event(new CallCandidateEndEvent($candidate->id));
        // }

        if ($request->interview_id) {
            $count = AssignJob::where('candidate_id', $id)->where('interview_id', $request->interview_id)->count();
            if ($count > 0) {
                return response()->json(['status' => false, 'message' => 'Job already assigned to this candidate.']);
            } else {
                $job_id = Interview::where('id', $request->interview_id)->first()->job_id;
                $assign_job = new AssignJob();
                $assign_job->candidate_id = $id;
                $assign_job->job_id = $job_id;
                $assign_job->company_id = $request->company_id;
                $assign_job->interview_id = $request->interview_id;
                $assign_job->user_id = Auth::user()->id;
                $assign_job->interview_status = $request->interview_status;
                $assign_job->save();

                $job_details = Job::findOrfail($job_id);

                $candidate_job = new CandidateJob();
                $candidate_job->candidate_id = $id;
                $candidate_job->interview_id = $request->interview_id;
                $candidate_job->assign_job_id = $assign_job->id;
                $candidate_job->full_name = $candidate->full_name ?? null;
                $candidate_job->email = $candidate->email ?? null;
                $candidate_job->gender = $candidate->gender ?? null;
                $candidate_job->date_of_birth = $candidate->date_of_birth ?? null;
                $candidate_job->whatapp_no = $candidate->whatapp_no ?? null;
                $candidate_job->alternate_contact_no = $candidate->alternate_contact_no ?? null;
                $candidate_job->religion = $candidate->religion ?? null;
                $candidate_job->city = $candidate->city ?? null;
                $candidate_job->address = null;
                $candidate_job->education = $candidate->education ?? null;
                $candidate_job->other_education = $candidate->other_education ?? null;
                $candidate_job->passport_number = $candidate->passport_number ?? null;
                $candidate_job->english_speak = $candidate->english_speak ?? null;
                $candidate_job->arabic_speak = $candidate->arabic_speak ?? null;
                $candidate_job->assign_by_id = Auth::user()->id ?? null;
                $candidate_job->job_id = $job_details->id ?? null;
                $candidate_job->job_position = $job_details->candidate_position_id ?? null;
                $candidate_job->job_location = $job_details->address ?? null;
                $candidate_job->company_id = $job_details->company_id ?? null;
                $candidate_job->salary = $job_details->salary ?? null;
                $candidate_job->job_interview_status = $request->interview_status ?? null;
                $candidate_job->save();

                //candidate licence details add
                $indian_driving_licenses = CandidateLicence::where('candidate_id', $id)->where('licence_type', 'INDIAN')->pluck('licence_name')->toArray() ?? null;
                $gulf_driving_licenses = CandidateLicence::where('candidate_id', $id)->where('licence_type', 'GULF')->pluck('licence_name')->toArray() ?? null;
                // dd($indian_driving_licenses);
                foreach ($indian_driving_licenses as $key => $value) {
                    if ($value != null) {
                        $candidate_ind_licence = new CandJobLicence();
                        $candidate_ind_licence->candidate_job_id = $candidate_job->id;
                        $candidate_ind_licence->candidate_id = $id;
                        $candidate_ind_licence->licence_type = 'INDIAN';
                        $candidate_ind_licence->licence_name = $value;
                        $candidate_ind_licence->save();
                    }
                }

                foreach ($gulf_driving_licenses as $key => $value) {
                    if ($value != null) {
                        $candidate_gulf_licence = new CandJobLicence();
                        $candidate_gulf_licence->candidate_job_id = $candidate_job->id;
                        $candidate_gulf_licence->candidate_id = $id;
                        $candidate_gulf_licence->licence_type = 'GULF';
                        $candidate_gulf_licence->licence_name = $value;
                        $candidate_gulf_licence->save();
                    }
                }
            }
        }



        Session::forget('candidate_id');
        return response()->json(['view' => view('candidates.update-single-data', compact('candidate'))->render(), 'status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function userAutoFill(Request $request)
    {

        $referrers = Candidate::orderBy('id', 'desc')->get();
        $states = State::orderBy('name', 'asc')->get();
        $cities = City::orderBy('name', 'asc')->get();
        $candidate = Candidate::where('contact_no', 'like', '%' . $request->contact_no . '%')->first();
        if (!$candidate) {
            $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
            $sources = Source::orderBy('name', 'asc')->get();
            $candidate_statuses = CandidateStatus::all();
            $associates = User::role('ASSOCIATE')->get();
            $states = State::orderBy('name', 'asc')->get();
            return response()->json(['view' => view('candidates.auto-fill', compact('candidate', 'sources', 'candidate_statuses', 'associates', 'candidate_positions', 'states', 'cities', 'referrers'))->render(), 'status' => 'error']);
        } else {
            $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
            $candidate_statuses = CandidateStatus::all();
            $associates = User::role('ASSOCIATE')->get();
            $indian_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'INDIAN')->pluck('licence_name')->toArray();
            $gulf_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'GULF')->pluck('licence_name')->toArray();
            $sources = Source::orderBy('name', 'asc')->get();
            $states = State::orderBy('name', 'asc')->get();
            $autofill = true;


            return response()->json(['view' => view('candidates.auto-fill', compact('candidate', 'sources', 'autofill', 'candidate_statuses', 'associates', 'states', 'cities', 'indian_driving_license', 'candidate_positions', 'gulf_driving_license', 'states', 'referrers'))->render(), 'status' => 'success']);
        }
    }

    public function candidateFilter(Request $request)
    {

        $candidates = Candidate::query();
        if ($request->has('search')) {
            // Split the search string into an array by commas and trim spaces
            $main_search_text_arr = array_map('trim', explode(',', $request->search));

            // Get the position IDs for the search terms if they match any position names
            $position_id = CandidatePosition::whereIn('name', $main_search_text_arr)->pluck('id')->toArray();

            // Build the query
            $candidates->where(function ($query) use ($main_search_text_arr, $position_id) {
                foreach ($main_search_text_arr as $term) {
                    $query->where('full_name', 'like', "%$term%")
                        ->orWhere('gender', 'like', "%$term%")
                        ->orWhere('age', $term)
                        ->orWhere('education', 'like', "%$term%")
                        ->orWhere('other_education', 'like', "%$term%")
                        ->orWhere('indian_exp', 'like', "%$term%")
                        ->orWhere('abroad_exp', 'like', "%$term%")
                        ->orWhere('email', 'like', "%$term%")
                        ->orWhere('contact_no', 'like', "%$term%")
                        ->orWhere('alternate_contact_no', 'like', "%$term%")
                        ->orWhere('whatapp_no', 'like', "%$term%")
                        ->orWhere('passport_number', 'like', "%$term%")
                        ->orWhere('city', 'like', "%$term%")
                        ->orWhere('religion', 'like', "%$term%")
                        ->orWhere('ecr_type', 'like', "%$term%")
                        ->orWhere('mode_of_registration', 'like', "%$term%")
                        ->orWhere('source', 'like', "%$term%")
                        ->orWhere('religion', 'like', "%$term%")
                        ->orWhere('english_speak', 'like', "%$term%")
                        ->orWhere('arabic_speak', 'like', "%$term%");
                }

                if (!empty($position_id)) {
                    $query->orWhereIn('position_applied_for_1', $position_id)
                        ->orWhereIn('position_applied_for_2', $position_id)
                        ->orWhereIn('position_applied_for_3', $position_id);
                }
            });
        }


        if ($request->has('cnadidate_status_id')) {
            if (is_array($request->cnadidate_status_id)) {
                $candidates->whereIn('cnadidate_status_id', $request->cnadidate_status_id);
            } else {
                $candidates->where('cnadidate_status_id', $request->cnadidate_status_id);
            }
        }


        if ($request->has('call_status') && $request->call_status) {
            $candidates->whereHas('candidateActivity', function ($query) use ($request) {
                $query->where('call_status', $request->call_status)->where('user_id', Auth::user()->id);
            });
        }


        if ($request->source) {
            $candidates->where('source', $request->source);
        }

        if ($request->has('gender')) {
            if (is_array($request->gender)) {
                $candidates->whereIn('gender', $request->gender);
            } else {
                $candidates->where('gender', $request->gender);
            }
        }

        if ($request->has('education')) {
            if (is_array($request->education)) {
                $candidates->whereIn('education', $request->education);
            } else {
                $candidates->where('education', $request->education);
            }
        }

        $positions = ['position_applied_for_1', 'position_applied_for_2', 'position_applied_for_3'];
        if ($request->position_applied_for || $request->position_applied_for_2 || $request->position_applied_for_3) {
            $candidates->where(function ($querys) use ($positions, $request) {
                foreach ($positions as $position) {
                    $querys->orWhereIn($position, $request->position_applied_for ?? [])
                        ->orWhereIn($position, $request->position_applied_for_2 ?? [])
                        ->orWhereIn($position, $request->position_applied_for_3 ?? []);
                }
            });
        }

        if ($request->english_speak) {
            $candidates->where('english_speak', $request->english_speak);
        }

        if ($request->arabic_speak) {
            $candidates->where('arabic_speak', $request->arabic_speak);
        }

        if ($request->ecr_type) {
            $candidates->where('ecr_type', $request->ecr_type);
        }



        if ($request->city) {
            $candidates->where('city', $request->city);
        }

        if ($request->mode_of_registration) {
            $candidates->where('mode_of_registration', $request->mode_of_registration);
        }

        if ($request->last_call_status) {
            $last_activity = CandidateActivity::orderBy('id', 'desc')->get()->groupBy('candidate_id');
            $last_activity = $last_activity->map(function ($item, $key) {
                return $item->first();
            });

            $candidates->whereHas('candidateActivity', function ($query) use ($request, $last_activity) {
                $query->where('call_status', $request->last_call_status)->whereIn('id', $last_activity->pluck('id')->toArray());
            });
        }



        if ($request->last_update_by) {
            $last_update_by_can = CandidateUpdated::where('user_id', $request->last_update_by)
                ->orderBy('id', 'desc')
                ->get()
                ->groupBy('candidate_id')
                ->map(function ($item) {
                    return $item->first();
                });

            $candidateIds = $last_update_by_can->pluck('candidate_id')->toArray(); // Convert to array

            // Apply the filter to the candidates query
            if (!empty($candidateIds)) {
                $candidates->whereIn('id', $candidateIds);
            } else {
                // Handle the case where no candidates are found for the user
                $candidates->whereIn('id', []); // Empty result set
            }
        }


        if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            $candidates->where('enter_by', Auth::user()->id);
        }



        $candidates = $candidates->orderBy('id', 'desc')->paginate(50);

        return response()->json(['view' => view('candidates.filter', compact('candidates'))->render()]);
    }

    public function export(Request $request)
    {
        if (Auth::user()->can('Export Candidate')) {
            try {
                return Excel::download(new CandidateExport(), 'candidate-export.xlsx');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);
        Excel::import(new CandidateImport, $request->file('file')->store('temp'));
        return redirect()->back()->with('message', 'Candidate imported successfully');
    }

    public function downloadSample()
    {
        // return "dsa";
        $pathToFile = public_path('sample_excel/candidate-example.xlsx');
        return response()->download($pathToFile);
    }

    public function candidatePermission($candidate_id, $candidate_field_update_id)
    {

        $candidate_field_update = CandidateFieldUpdate::findOrFail($candidate_field_update_id);
        $candidate_field_update->is_granted = 1;
        $candidate_field_update->save();

        $candidate = Candidate::findOrFail($candidate_id);
        $candidate->cnadidate_status_id = $candidate_field_update->status;
        $candidate->save();

        return response()->json(['view' => view('candidates.update-single-data', compact('candidate'))->render(), 'status' => 'success']);
    }

    public function candidatesActivity($id)
    {
        if (Auth::user()->can('Manage Candidate')) {

            $candidate_activities = CandidateActivity::with('user')->where('candidate_id', $id)->orderBy('id', 'desc')->get();

            return response()->json(['status' => true, 'candidate_activities' => $candidate_activities]);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function isCalled(Request $request)
    {
        $candidate = Candidate::where('is_call_id', $request->user_id)->pluck('id')->toArray();
        Candidate::where('is_call_id', $request->user_id)->update(['is_call_id' => null]);
        return response()->json(['status' => true, 'candidate' => $candidate, 'message' => 'Candidate called successfully']);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $phone = $request->input('phone');
        // Check if the email already exists in the database
        $exists = Candidate::where('email', $email)->get()->count();
        if ($exists > 0) {
            $checkphone = Candidate::where('email', $email)->where('contact_no', $phone)->get()->count();
            if ($checkphone > 0) {
                return response()->json(['status' => false]);
            } else {
                return response()->json(['status' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function checkPosition(Request $request)
    {
        $position = $request->input('position_applied_for_1')  ?? $request->input('position_applied_for_2') ?? $request->input('position_applied_for_3');
        $exists = CandidatePosition::where('name', $position)->where('is_active', 1)->get()->count();
        if ($exists > 0) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function bulkStatusUpdate(Request $request)
    {
        if ($request->ajax()) {
            Candidate::whereIn('id', $request->candidate_ids)->update(['cnadidate_status_id' => $request->status_id]);
            return response()->json(['status' => true, 'message' => 'Status update successfully.']);
        }
    }

    public function getJobs(Request $request)
    {
        if ($request->ajax()) {
            $interviews = Interview::where('company_id', $request->company_id)
                ->where(function ($query) {
                    $query->where('interview_start_date', '>=', date('d-m-Y'))
                        ->where('interview_end_date', '>=', date('d-m-Y'));
                })
                ->whereHas('job', function ($query) {
                    $query->where('status', 'Ongoing');
                })
                ->get();

            $html = '';
            $html .= '<option value="">Select Job</option>';
            foreach ($interviews as $interview) {
                $html .= '<option value="' . $interview->id . '">' . $interview->job->job_name . '</option>';
            }
            return response()->json(['status' => true, 'interviews' => $html]);
        }
    }

    public function assignJob(Request $request, $candidate_id)
    {

        $request->validate([
            'company_id' => 'required',
            'interview_id' => 'required',
            'interview_status' => 'required'
        ]);

        $count = AssignJob::where('candidate_id', $candidate_id)->where('interview_id', $request->interview_id)->count();
        if ($count > 0) {
            return response()->json(['status' => false, 'message' => 'Job already assigned to this candidate.']);
        } else {
            $job_id = Interview::where('id', $request->interview_id)->first()->job_id;
            $assign_job = new AssignJob();
            $assign_job->candidate_id = $candidate_id;
            $assign_job->job_id = $job_id;
            $assign_job->company_id = $request->company_id;
            $assign_job->interview_id = $request->interview_id;
            $assign_job->user_id = Auth::user()->id;
            $assign_job->interview_status = $request->interview_status;
            $assign_job->save();

            //candidate job details add
            $candidate_details = Candidate::findOrFail($candidate_id);
            $job_details = Job::findOrfail($job_id);

            $candidate_job = new CandidateJob();
            $candidate_job->candidate_id = $candidate_id;
            $candidate_job->interview_id = $request->interview_id;
            $candidate_job->assign_job_id = $assign_job->id;
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
            $candidate_job->assign_by_id = $candidate_details->enter_by ?? null;
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
                if ($value != null) {
                    $candidate_ind_licence = new CandJobLicence();
                    $candidate_ind_licence->candidate_job_id = $candidate_job->id;
                    $candidate_ind_licence->candidate_id = $candidate_id;
                    $candidate_ind_licence->licence_type = 'INDIAN';
                    $candidate_ind_licence->licence_name = $value;
                    $candidate_ind_licence->save();
                }
            }

            foreach ($gulf_driving_licenses as $key => $value) {
                if ($value != null) {
                    $candidate_gulf_licence = new CandJobLicence();
                    $candidate_gulf_licence->candidate_job_id = $candidate_job->id;
                    $candidate_gulf_licence->candidate_id = $candidate_id;
                    $candidate_gulf_licence->licence_type = 'GULF';
                    $candidate_gulf_licence->licence_name = $value;
                    $candidate_gulf_licence->save();
                }
            }

            $candidate = Candidate::findOrFail($candidate_id);

            return response()->json(['view' => view('candidates.update-single-data', compact('candidate'))->render(), 'status' => true]);

            // session()->flash('message', 'Job assigned successfully');
            // return response()->json(['status' => true, 'message' => 'Job assigned successfully.']);
        }
    }

    public function getCityName(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        $html = '';
        $html .= '<option value="">SELECT CITY</option>';
        foreach ($cities as $city) {
            if ($request->city_id) {
                if ($request->city_id == $city->id) {
                    $html .= '<option value="' . $city->id . '" selected>' . $city->name . '</option>';
                } else {
                    $html .= '<option value="' . $city->id . '">' . $city->name . '</option>';
                }
            } else {
                $html .= '<option value="' . $city->id . '">' . $city->name . '</option>';
            }
        }
        return response()->json(['status' => true, 'city' => $html]);
    }

    public function downloadCv($id)
    {
        $candidate = Candidate::findOrFail($id);
        $pathToFile = Storage::disk('public')->path($candidate->cv);
        return response()->download($pathToFile);
    }
}
