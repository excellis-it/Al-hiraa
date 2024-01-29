<?php

namespace App\Http\Controllers;

use App\Events\CallCandidateEndEvent;
use App\Events\CallCandidateEvent;
use App\Exports\CandidateExport;
use App\Imports\CandidateImport;
use App\Models\Candidate;
use App\Models\CandidateActivity;
use App\Models\CandidateFieldUpdate;
use App\Models\CandidateLicence;
use App\Models\CandidatePosition;
use App\Models\CandidateStatus;
use App\Models\CandidateUpdated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('Manage Candidate')) {
            $candidate_statuses = CandidateStatus::all();
            $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
            if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {

                $candidates = Candidate::orderBy('id', 'desc')->where('enter_by', Auth::user()->id)->paginate(20);
            } else {
                $candidates = Candidate::orderBy('id', 'desc')->paginate(20);
            }
            // session()->forget('candidate_id');
            return view('candidates.list')->with(compact('candidates', 'candidate_statuses', 'candidate_positions'));
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
            $candidate_statuses = CandidateStatus::all();
            $associates = User::role('ASSOCIATE')->get();
            $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
            return view('candidates.create')->with(compact('candidate_statuses', 'associates', 'candidate_positions'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'contact_no' => 'required|digits:10',
            'full_name' => 'required',
            'dob' => 'required',
            'cnadidate_status_id' => 'required',
            'email' => 'nullable|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'position_applied_for_1' => 'required',
            'alternate_contact_no' => 'nullable|digits:10',
            'whatapp_no' => 'nullable|regex:/^\+91\d{10}$/',
            'passport_number' => 'nullable|regex:/^[A-Za-z]\d{7}$/',
            'indian_exp' => 'nullable|max:40',
            'abroad_exp' => 'nullable|max:40',
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
        $candidate->cnadidate_status_id = $request->cnadidate_status_id;
        $candidate->mode_of_registration = $request->mode_of_registration;
        $candidate->source = $request->source;
        if ($request->referred_by_id) {
            $candidate->referred_by_id = $request->referred_by_id;
        } else {
            $candidate->referred_by = $request->referred_by;
        }
        $candidate->passport_number = $request->passport_number;
        $candidate->full_name = $request->full_name;
        $candidate->gender = $request->gender;
        $candidate->date_of_birth = $request->dob;
        // age calculation from date of birth
        $candidate->age = date_diff(date_create($request->dob), date_create('today'))->y;
        $candidate->education = $request->education;
        $candidate->other_education = $request->other_education;
        $candidate->contact_no = $request->contact_no;
        $candidate->alternate_contact_no = $request->alternate_contact_no;
        $candidate->email = $request->email;
        $candidate->whatapp_no = $request->whatapp_no;
        $candidate->city = $request->city;
        $candidate->religion = $request->religion;
        $candidate->ecr_type = $request->ecr_type;
        $candidate->english_speak = $request->english_speak;
        $candidate->arabic_speak = $request->arabic_speak;
        $candidate->return = ($request->return != null) ? $request->return : 0;

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
            CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'gulf')->delete();

            foreach ($request->international_driving_license as $key => $value) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'gulf';
                $candidate_licence->licence_name = $value;
                $candidate_licence->save();
            }
        }

        if ($request->indian_driving_license) {
            // delete old licence
            CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'indian')->delete();

            foreach ($request->indian_driving_license as $key => $value) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'indian';
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
        $indian_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'indian')->pluck('licence_name')->toArray();
        $gulf_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'gulf')->pluck('licence_name')->toArray();
        $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
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
                event(new CallCandidateEvent($candidate->id));
            }
        }

        return response()->json(['view' => view('candidates.edit', compact('candidate', 'candidate_positions', 'edit', 'candidate_statuses', 'indian_driving_license', 'gulf_driving_license'))->render(), 'status' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name' => 'required',
            'dob' => 'required',
            'cnadidate_status_id' => 'required',
            'email' => 'nullable|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:candidates,email,' . $id,
            'position_applied_for_1' => 'required',
            'alternate_contact_no' => 'nullable|digits:10',
            'whatapp_no' => 'nullable|regex:/^\+91\d{10}$/',
            'passport_number' => 'nullable|regex:/^[A-Za-z]\d{7}$/',
            // 'remark' => 'required',
            'call_status' => 'required',
            // indian_exp word limit validation
            'indian_exp' => 'nullable|max:40',
            'abroad_exp' => 'nullable|max:40',
        ], [
            'cnadidate_status_id.required' => 'The status field is required.',
            'position_applied_for_1.required' => 'The position applied for field is required.',
            'dob.required' => 'The date of birth field is required.',
            'full_name.required' => 'The full name field is required.',
            'alternate_contact_no.digits' => 'The alternate contact no must be 10 digits.',
            'whatapp_no.regex' => 'The whatapp no must be +91xxxxxxxxxx format.',
        ]);

        $candidate = Candidate::findOrFail($id);

        if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            $candidate->cnadidate_status_id = $request->cnadidate_status_id;
        }
        $candidate->mode_of_registration = $request->mode_of_registration;
        $candidate->source = $request->source;
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
        $candidate->city = $request->city;
        $candidate->religion = $request->religion;
        $candidate->ecr_type = $request->ecr_type;
        $candidate->english_speak = $request->english_speak;
        $candidate->arabic_speak = $request->arabic_speak;
        $candidate->return = $request->return;
        // check position
        $position_1_count = CandidatePosition::where('id', $request->position_applied_for_1)->count();
        $position_2_count = CandidatePosition::where('id', $request->position_applied_for_2)->count();
        $position_3_count = CandidatePosition::where('id', $request->position_applied_for_3)->count();

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
            CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'gulf')->delete();

            foreach ($request->international_driving_license as $key => $value) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'gulf';
                $candidate_licence->licence_name = $value;
                $candidate_licence->save();
            }
        }

        if ($request->indian_driving_license) {
            // delete old licence
            CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'indian')->delete();

            foreach ($request->indian_driving_license as $key => $value) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'indian';
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
        if (!Auth::user()->hasRole('ADMIN') && !Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            event(new CallCandidateEndEvent($candidate->id));
        }
        Session::forget('candidate_id');
        session()->flash('message', 'Candidate updated successfully');
        return response()->json(['message' => __('Candidate updated successfully.'), 'status' => 'success']);
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
        $candidate = Candidate::where('contact_no', $request->contact_no)->first();
        if (!$candidate) {
            $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
            $candidate_statuses = CandidateStatus::all();
            $associates = User::role('ASSOCIATE')->get();
            return response()->json(['view' => view('candidates.auto-fill', compact('candidate', 'candidate_statuses', 'associates', 'candidate_positions'))->render(), 'status' => 'error']);
        } else {
            $candidate_positions = CandidatePosition::orderBy('name', 'asc')->where('is_active', 1)->get();
            $candidate_statuses = CandidateStatus::all();
            $associates = User::role('ASSOCIATE')->get();
            $indian_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'indian')->pluck('licence_name')->toArray();
            $gulf_driving_license = CandidateLicence::where('candidate_id', $candidate->id)->where('licence_type', 'gulf')->pluck('licence_name')->toArray();
            $autofill = true;
            return response()->json(['view' => view('candidates.auto-fill', compact('candidate', 'autofill', 'candidate_statuses', 'associates', 'indian_driving_license', 'candidate_positions', 'gulf_driving_license'))->render(), 'status' => 'success']);
        }
    }

    public function candidateFilter(Request $request)
    {
       
        $candidates = Candidate::query();
        if ($request->search) {
            $candidates->where('full_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('gender', 'LIKE', '%' . $request->search . '%')
                ->orWhere('age', 'LIKE', '%' . $request->search . '%')
                ->orWhere('education', 'LIKE', '%' . $request->search . '%')
                ->orWhere('position_applied_for_1', 'LIKE', '%' . $request->search . '%')
                ->orWhere('position_applied_for_2', 'LIKE', '%' . $request->search . '%')
                ->orWhere('position_applied_for_3', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('city', 'LIKE', '%' . $request->search . '%')
                ->orWhere('religion', 'LIKE', '%' . $request->search . '%')
                ->orWhere('ecr_type', 'LIKE', '%' . $request->search . '%')
                ->orWhere('english_speak', 'LIKE', '%' . $request->search . '%')
                ->orWhere('arabic_speak', 'LIKE', '%' . $request->search . '%')
                // enter by
                ->orWhereHas('enterBy', function ($query) use ($request) {
                    $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE '%" . $request->search . "%'");
                })
                // date of birth 09.01.2021 format search
                ->orWhereRaw("DATE_FORMAT(date_of_birth, '%d.%m.%Y') LIKE '%" . $request->search . "%'")
                ->orWhereRaw("DATE_FORMAT(updated_at, '%d.%m.%Y') LIKE '%" . $request->search . "%'");
        }


        if ($request->cnadidate_status_id) {
            $candidates->where('cnadidate_status_id', $request->cnadidate_status_id);
        }

        if ($request->source) {
            $candidates->where('source', $request->source);
        }

        if ($request->gender) {
            $candidates->where('gender', $request->gender);
        }
        $positions = ['position_applied_for_1', 'position_applied_for_2', 'position_applied_for_3'];

        $candidates->where(function ($query) use ($positions, $request) {
            foreach ($positions as $position) {
                $query->orWhereIn($position, $request->position_applied_for ?? [])
                      ->orWhereIn($position, $request->position_applied_for_2 ?? [])
                      ->orWhereIn($position, $request->position_applied_for_3 ?? []);
            }
        });
        
     
        

        

        if ($request->english_speak) {
            $candidates->where('english_speak', $request->english_speak);
        }

        if ($request->arabic_speak) {
            $candidates->where('arabic_speak', $request->arabic_speak);
        }

        if ($request->ecr_type) {
            $candidates->where('ecr_type', $request->ecr_type);
        }

        if ($request->education) {
            $candidates->where('education', $request->education);
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

        if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            $candidates->where('enter_by', Auth::user()->id);
        }

        $candidates = $candidates->orderBy('id', 'desc')->paginate(20);

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

        return redirect()->back()->with('message', 'Permission granted successfully');
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
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => true]);
        }
    }
}
