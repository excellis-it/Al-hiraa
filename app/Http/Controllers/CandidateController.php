<?php

namespace App\Http\Controllers;

use App\Exports\CandidateExport;
use App\Imports\CandidateImport;
use App\Models\Candidate;
use App\Models\CandidatePosition;
use App\Models\CandidateStatus;
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
            $candidates = Candidate::paginate(15);
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
        $request->validate([
            'contact_no' => 'required|digits:10',
            'full_name' => 'required',
            'dob' => 'required',
            'cnadidate_status_id' => 'required',
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
        $candidate->age = $request->age;
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
        $candidate->return = $request->return;
        $candidate->position = $request->position;
        $candidate->indian_exp = $request->indian_exp;
        $candidate->abroad_exp = $request->abroad_exp;
        $candidate->remarks = $request->remark;
        $candidate->save();

        if ($request->position_applied_for) {
            $candidatePosition = new CandidatePosition();
            $candidatePosition->candidate_id = $candidate->id;
            $candidatePosition->name = $request->position_applied_for;
            $candidatePosition->save();
        }

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
        ],[
            'cnadidate_status_id.required' => 'The status field is required.'
        ]);

        $candidate = Candidate::findOrFail($id);

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
        $candidate->age = $request->age;
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
        $candidate->position = $request->position;
        $candidate->indian_exp = $request->indian_exp;
        $candidate->abroad_exp = $request->abroad_exp;
        $candidate->remarks = $request->remark;
        $candidate->save();

        if ($request->position_applied_for) {
            $candidate_position_applied = $candidate->candidatePositions->name;
            if ($request->position_applied_for !=  $candidate_position_applied) {
                $candidatePosition = new CandidatePosition();
                $candidatePosition->candidate_id = $candidate->id;
                $candidatePosition->name = $request->position_applied_for;
                $candidatePosition->save();
            }
        }
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
                // enter by
                ->orWhereHas('enterBy', function ($query) use ($request) {
                    $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE '%" . $request->search . "%'");
                })
                ->orWhere('remarks', 'LIKE', '%' . $request->search . '%')
                // date of birth 09.01.2021 format search
                ->orWhereRaw("DATE_FORMAT(date_of_birth, '%d.%m.%Y') LIKE '%" . $request->search . "%'")
                ->orWhereRaw("DATE_FORMAT(last_update_date, '%d.%m.%Y') LIKE '%" . $request->search . "%'");
        }
        $candidates = $candidates->paginate(15);

        return response()->json(['view' => view('candidates.filter', compact('candidates'))->render()]);
    }

    public function export(Request $request)
    {
        try {
            return Excel::download(new CandidateExport(), 'candidate-export.xlsx');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
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
