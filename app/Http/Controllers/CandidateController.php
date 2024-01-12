<?php

namespace App\Http\Controllers;

use App\Exports\CandidateExport;
use App\Imports\CandidateImport;
use App\Models\Candidate;
use App\Models\CandidateFieldUpdate;
use App\Models\CandidateStatus;
use App\Models\CandidateUpdated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('Manage Candidate')) {
            if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
                $candidates = Candidate::orderBy('id', 'desc')->where('enter_by', Auth::user()->id)->paginate(15);
            } else {
                $candidates = Candidate::orderBy('id', 'desc')->paginate(15);
            }

            return view('candidates.list')->with(compact('candidates'));
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
            return view('candidates.create')->with(compact('candidate_statuses', 'associates'));
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
            'email' => 'required|email',
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

        $candidate->last_update_date = $request->last_update_date;
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
        $candidate->indian_driving_license = $request->indian_driving_license;
        $candidate->international_driving_license = $request->international_driving_license;
        $candidate->english_speak = $request->english_speak;
        $candidate->arabic_speak = $request->arabic_speak;
        $candidate->return = ($request->return != null) ? $request->return : 0;
        $candidate->position_applied_for_1 = $request->position_applied_for_1;
        $candidate->position_applied_for_2 = $request->position_applied_for_2;
        $candidate->position_applied_for_3 = $request->position_applied_for_3;
        $candidate->indian_exp = $request->indian_exp;
        $candidate->abroad_exp = $request->abroad_exp;
        $candidate->remarks = $request->remark;
        $candidate->save();

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
        $edit = true;
        if (!Auth::user()->hasRole('ADMIN')) {
            $candidate_update = new CandidateUpdated();
            $candidate_update->user_id = Auth::user()->id;
            $candidate_update->candidate_id = $candidate->id;
            $candidate_update->save();
        }

        return response()->json(['view' => view('candidates.edit', compact('candidate', 'edit', 'candidate_statuses'))->render(), 'status' => 'success']);
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
            'email' => 'required|email',
        ], [
            'cnadidate_status_id.required' => 'The status field is required.'
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

        $candidate->last_update_date = $request->last_update_date;
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
        $candidate->indian_driving_license = $request->indian_driving_license;
        $candidate->international_driving_license = $request->international_driving_license;
        $candidate->english_speak = $request->english_speak;
        $candidate->arabic_speak = $request->arabic_speak;
        $candidate->return = $request->return;
        $candidate->position_applied_for_1 = $request->position_applied_for_1;
        $candidate->position_applied_for_2 = $request->position_applied_for_2;
        $candidate->position_applied_for_3 = $request->position_applied_for_3;
        $candidate->indian_exp = $request->indian_exp;
        $candidate->abroad_exp = $request->abroad_exp;
        $candidate->remarks = $request->remark;
        $candidate->save();


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
            $candidate_statuses = CandidateStatus::all();
            $associates = User::role('ASSOCIATE')->get();
            return response()->json(['view' => view('candidates.auto-fill', compact('candidate', 'candidate_statuses', 'associates'))->render(), 'status' => 'success']);
        } else {
            $candidate_statuses = CandidateStatus::all();
            $associates = User::role('ASSOCIATE')->get();
            $autofill = true;
            return response()->json(['view' => view('candidates.auto-fill', compact('candidate', 'autofill', 'candidate_statuses', 'associates'))->render(), 'status' => 'success']);
        }
    }

    public function candidateFilter(Request $request)
    {
        // return $request->all();
        $candidates = Candidate::query();
        if ($request->search) {
            $candidates->where('full_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('gender', 'LIKE', '%' . $request->search . '%')
                ->orWhere('age', 'LIKE', '%' . $request->search . '%')
                ->orWhere('education', 'LIKE', '%' . $request->search . '%')
                ->orWhere('position_applied_for_1', 'LIKE', '%' . $request->search . '%')
                ->orWhere('position_applied_for_2', 'LIKE', '%' . $request->search . '%')
                ->orWhere('position_applied_for_3', 'LIKE', '%' . $request->search . '%')

                // enter by
                ->orWhereHas('enterBy', function ($query) use ($request) {
                    $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE '%" . $request->search . "%'");
                })
                ->orWhere('remarks', 'LIKE', '%' . $request->search . '%')
                // date of birth 09.01.2021 format search
                ->orWhereRaw("DATE_FORMAT(date_of_birth, '%d.%m.%Y') LIKE '%" . $request->search . "%'")
                ->orWhereRaw("DATE_FORMAT(last_update_date, '%d.%m.%Y') LIKE '%" . $request->search . "%'");
        }
        if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            $candidates->where('enter_by', Auth::user()->id);
        }

        $candidates = $candidates->orderBy('id', 'desc')->paginate(15);

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
}
