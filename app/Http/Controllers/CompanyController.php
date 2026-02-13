<?php

namespace App\Http\Controllers;

use App\Imports\InterviewJobImport;
use App\Constants\Position;
use App\Models\CandidatePosition;
use App\Models\Company;
use App\Models\Interview;
use App\Models\Job;
use App\Models\State;
use App\Models\User;
use App\Models\ReferralPoint;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('Manage Company')) {
            $companies = Company::orderBy('id', 'DESC')->where('status', 1)->get();
            $inactiveCompanies = Company::orderBy('id', 'DESC')->where('status', 0)->get(); // Assuming 0 means inactive

            $referral_points = ReferralPoint::orderBy('id', 'DESC')->get();
            $vendors = User::role('VENDOR')->orderBy('first_name', 'ASC')->get();
            $positions = CandidatePosition::where('is_active', 1)->orderBy('name', 'ASC')->get();
            return view('companies.list')->with(compact('companies', 'referral_points', 'vendors', 'positions', 'inactiveCompanies'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_address' => 'required',
            'company_website' => 'nullable',
            'company_industry' => 'required',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'company_description' => 'nullable',
            // 'interview_start_date' => 'nullable|date',
            // 'interview_end_date' => 'required|date|after_or_equal:interview_start_date',
            // 'interview_location' => 'required',
            // 'benifits' => 'nullable|numeric',
        ]);

        $count = Company::where(['company_name' => $request->company_name, 'company_address' => $request->company_address])->count();
        if ($count > 0) {
            return response()->json(['error' => __('Company already exists.'), 'status' => false]);
        }

        $company = new Company();
        $company->user_id = Auth::user()->id;
        $company->company_name = $request->company_name;
        $company->company_address = $request->company_address;
        $company->company_website = $request->company_website;
        $company->company_industry = $request->company_industry;
        $company->company_description = $request->company_description;
        $company->company_logo = $this->imageUpload($request->file('company_logo'), 'company');
        $company->save();

        // $job = new Job();
        // $job->candidate_position_id = $request->candidate_position_id;
        // $job->vendor_id = $request->vendor_id;
        // $job->service_charge = $request->service_charge;
        // $job->salary = $request->salary;
        // $job->company_id = $company->id;
        // $job->job_name = $request->job_name;
        // $job->duty_hours = $request->duty_hours;
        // $job->contract = $request->contract;
        // $job->benifits = $request->benifits;
        // $job->quantity_of_people_required = $request->quantity_of_people_required;
        // $job->address = $request->address;
        // $job->job_description = $request->job_description;
        // if ($request->hasFile('document')) {
        //     if ($job->document) {
        //         $currentImageFilename = $job->document; // get current image name
        //         Storage::delete('app/' . $currentImageFilename);
        //     }
        //     $job->document = $this->imageUpload($request->file('document'), 'job');
        // }
        // $job->status = "Ongoing";
        // $job->referral_point_id = $request->referral_point_id;
        // $job->save();

        // $interview = new Interview();
        // $interview->user_id = Auth::user()->id;
        // $interview->company_id = $company->id;
        // $interview->job_id = $job->id;
        // $interview->interview_start_date = $request->interview_start_date;
        // $interview->interview_end_date = $request->interview_end_date;
        // $interview->interview_location = $request->interview_location;

        // $interview->interview_status = "Working";
        // $interview->save();

        $companies = Company::orderBy('id', 'DESC')->get();
        $inactiveCompanies = Company::orderBy('id', 'DESC')->where('status', 0)->get(); // Assuming 0 means inactive
        // Session::flash('message', 'Company created successfully');
        return response()->json([
            'message' => __('Company created successfully.'),
            'status' => true,
            'view' => view('companies.filter', compact('companies', 'inactiveCompanies'))->render(),
            'company_id' => $company->id,
            'company_name' => $company->company_name
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->can('View Company')) {
            $id = Crypt::decrypt($id);
            $company = Company::find($id);
            if ($company) {
                $ongoing_jobs = Job::where(['status' => 'Ongoing', 'company_id' => $id])->orderBy('id', 'desc')->paginate(10);
                $closed_jobs = Job::where(['status' => 'Closed', 'company_id' => $id])->orderBy('id', 'desc')->paginate(10);
                $positions = CandidatePosition::where('is_active', 1)->orderBy('name', 'ASC')->get();
                $states = State::orderBy('name', 'ASC')->get();
                $vendors = User::role('VENDOR')->orderBy('first_name', 'ASC')->get();
                $referral_points = ReferralPoint::orderBy('id', 'DESC')->get();
                return view('companies.view')->with(compact('company', 'ongoing_jobs', 'states', 'closed_jobs', 'positions', 'vendors', 'referral_points'));
            } else {
                return redirect()->back()->with('error', __('Company not found.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        $edit = true;
        return response()->json(['view' => view('companies.edit', compact('company', 'edit'))->render(), 'status' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request->all();
        $request->validate([
            'company_name' => 'required',
            'company_address' => 'required',
            'company_website' => 'nullable|url',
            'company_industry' => 'required',
            'company_description' => 'nullable',
        ]);

        $count = Company::where(['company_name' => $request->company_name, 'company_address' => $request->company_address])->where('id', '!=', Crypt::decrypt($id))->count();
        if ($count > 0) {
            return response()->json(['error' => __('Company already exists.'), 'status' => false]);
        }

        $company = Company::findOrFail(Crypt::decrypt($id));
        $company->company_name = $request->company_name;
        $company->company_address = $request->company_address;
        $company->company_website = $request->company_website;
        $company->company_industry = $request->company_industry;
        $company->company_description = $request->company_description;
        if ($request->hasFile('company_logo')) {
            if ($company->company_logo) {
                $currentImageFilename = $company->company_logo; // get current image name
                Storage::delete('app/' . $currentImageFilename);
            }
            $company->company_logo = $this->imageUpload($request->file('company_logo'), 'company');
        }
        $company->save();
        Session::flash('message', 'Company updated successfully');
        return response()->json(['message' => __('Company updated successfully.'), 'status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function companiesFilter(Request $request)
    {
        $companies = Company::query();

        if ($request->search) {
            $companies->where('company_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('company_address', 'LIKE', '%' . $request->search . '%')
                ->orWhere('company_website', 'LIKE', '%' . $request->search . '%')
                ->orWhere('company_industry', 'LIKE', '%' . $request->search . '%');
        }
        if (!Auth::user()->hasRole('ADMIN')) {
            $companies->where('user_id', Auth::user()->id);
        }
        $companies = $companies->orderBy('id', 'DESC')->paginate(20);
        $inactiveCompanies = Company::orderBy('id', 'DESC')->where('status', 0)->get(); // Assuming 0 means inactive
        return response()->json(['view' => view('companies.filter', compact('companies', 'inactiveCompanies'))->render()]);
    }

    public function companyJobStore(Request $request)
    {
        $request->validate([
            'candidate_position_id' => 'required',
            'vendor_id' => 'nullable',
            'service_charge' => 'required|numeric',
            'associate_charge' => 'required|numeric',
            'job_name' => 'required',
            'contract' => 'nullable|numeric',
            'address' => 'required',
            'salary' => 'required',
            'quantity_of_people_required' => 'required|numeric',
            'benifits' => 'nullable',
            'associate_charge' => 'nullable|numeric',
        ], [
            'vendor_id.required' => 'The vendor field is required.',
            'service_charge.required' => 'The service charge field is required.',
            'candidate_position_id.required' => 'The position field is required.',
            'to_date.required' => 'The end date field is required.',
            'contract.numeric' => 'The contract field must be a number.',
            'address.required' => 'The location field is required.',
            'salary.numeric' => 'Salary field must be a number',
        ]);

        $year = date('Y');

        // Get the last job for the current year
        $last_job_this_year = Job::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        // Check if a job exists for the current year and extract the entry number
        if ($last_job_this_year && $last_job_this_year->job_id) {
            // Extract the entry number from the job_id (e.g., 001 from 2025/001/5000)
            $last_entry_number = (int) explode('/', $last_job_this_year->job_id)[1] ?? 0;
        } else {
            // No jobs this year, start with 0
            $last_entry_number = 0;
        }

        // Increment the entry number for the new job
        $new_entry_number = str_pad($last_entry_number + 1, 3, '0', STR_PAD_LEFT); // Format as 3 digits (e.g., 001, 002)

        // Define the service charge (you can replace this with dynamic logic if needed)
        $service_charge = $request['service_charge'];

        // Generate the new job_id
        $new_job_id = "{$year}/{$new_entry_number}/{$service_charge}";
        // dd($new_job_id);
        $job = new Job();
        $job->job_id = $new_job_id;
        $job->candidate_position_id = $request->candidate_position_id;
        $job->vendor_id = $request->vendor_id;
        $job->service_charge = $request->service_charge;
        $job->associate_charge = $request->associate_charge;
        $job->salary = $request->salary;
        $job->company_id = $request->company_id;
        $job->job_name = $request->job_name;
        $job->quantity_of_people_required = $request->quantity_of_people_required;
        $job->duty_hours = $request->duty_hours;
        $job->contract = $request->contract;
        $job->benifits = $request->benifits;
        $job->address = $request->address;
        $job->job_description = $request->job_description;
        $job->status = "Ongoing";
        $job->referral_point_id = $request->referral_point_id;
        if ($request->hasFile('document')) {
            $job->document = $this->imageUpload($request->file('document'), 'job');
        }
        $job->save();
        $ongoing_jobs = Job::where(['status' => 'Ongoing', 'company_id' => $request->company_id])->orderBy('id', 'desc')->paginate(10);
        Session::flash('message', 'Job created successfully');
        return response()->json(['view' => view('companies.open-job-filter', compact('ongoing_jobs'))->render(), 'message' => __('Job created successfully.'), 'status' => true]);
    }

    public function companyJobEdit(string $id)
    {
        $job = Job::findOrFail($id);
        $positions = CandidatePosition::where('is_active', 1)->orderBy('name', 'ASC')->get();
        $states = State::orderBy('name', 'ASC')->get();
        $vendors = User::role('VENDOR')->orderBy('first_name', 'ASC')->get();
        $referral_points = ReferralPoint::orderBy('id', 'DESC')->get();
        $edit = true;
        return response()->json(['view' => view('companies.edit-job', compact('job', 'edit', 'positions', 'states', 'vendors', 'referral_points'))->render(), 'status' => 'success']);
    }

    public function companyJobUpdate(Request $request, string $id)
    {
        $request->validate([
            'candidate_position_id' => 'required', // candidate_position_id was missing in the validation
            // 'vendor_id' => 'required',
            'service_charge' => 'required|numeric',
            'associate_charge' => 'required|numeric',
            'job_name' => 'required',
            'status' => 'required',
            // contract was number or float
            'contract' => 'nullable|numeric',
            'address' => 'required',
            'salary' => 'required',
            'quantity_of_people_required' => 'required|numeric',
            'benifits' => 'nullable',
        ], [
            // 'vendor_id.required' => 'The vendor field is required.',
            'service_charge.required' => 'The service charge field is required.',
            'candidate_position_id.required' => 'The position field is required.',
            'to_date.required' => 'The end date field is required.',
            'status.required' => 'The status field is required.',
            'contract.numeric' => 'The contract field must be a number.',
            'address.required' => 'The location field is required.',
            'associate_charge.required' => 'The associate charge field is required.',
        ]);

        $job = Job::findOrFail(Crypt::decrypt($id));
        $job->candidate_position_id = $request->candidate_position_id;
        // $job->vendor_id = $request->vendor_id;
        $job->service_charge = $request->service_charge;
        $job->associate_charge = $request->associate_charge;
        $job->salary = $request->salary;
        $job->job_name = $request->job_name;
        $job->quantity_of_people_required = $request->quantity_of_people_required;
        $job->duty_hours = $request->duty_hours;
        $job->contract = $request->contract;
        $job->benifits = $request->benifits;
        $job->address = $request->address;
        $job->job_description = $request->job_description;
        $job->status = $request->status;
        $job->referral_point_id = $request->referral_point_id;
        if ($request->hasFile('document')) {
            if ($job->document) {
                $currentImageFilename = $job->document; // get current image name
                Storage::delete('app/' . $currentImageFilename);
            }
            $job->document = $this->imageUpload($request->file('document'), 'job');
        }
        $job->save();
        Session::flash('message', 'Job Updated successfully');
        return response()->json(['message' => __('Job Updated successfully.'), 'status' => true]);
    }

    public function closeJobFilter(Request $request)
    {
        // return $request->all();
        $closed_jobs = Job::where(['status' => 'Closed', 'company_id' => $request->company_id])->orderBy('id', 'desc')->paginate(10);
        return response()->json(['view' => view('companies.close-job-filter', compact('closed_jobs'))->render()]);
    }

    public function openJobFilter(Request $request)
    {
        // return $request;
        $ongoing_jobs = Job::where(['status' => 'Ongoing', 'company_id' => $request->company_id])->orderBy('id', 'desc')->paginate(10);
        return response()->json(['view' => view('companies.open-job-filter', compact('ongoing_jobs'))->render()]);
    }

    public function getCity(Request $request)
    {
        $cities = State::find($request->state_id)->cities;
        return response()->json(['cities' => $cities]);
    }


    public function validateStep(Request $request, $step)
    {
        $rules = [];

        switch ($step) {
            case 1:
                $rules = [
                    'company_name' => 'required',
                    'company_address' => 'required',
                    'company_website' => 'nullable',
                    'company_industry' => 'required',
                    'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                    'company_description' => 'nullable',
                ];
                break;

            case 2:
                $rules = [
                    'candidate_position_id' => 'required',
                    'vendor_id' => 'nullable',
                    'service_charge' => 'required|numeric',
                    'job_name' => 'required',
                    'contract' => 'nullable|numeric',
                    'address' => 'required',
                    'salary' => 'required|numeric',
                    'quantity_of_people_required' => 'required|numeric',
                    'associate_charge' => 'required|numeric',
                ];
                break;

            case 3:
                $rules = [
                    'interview_start_date' => 'nullable|date',
                    'interview_end_date' => 'required|date|after_or_equal:interview_start_date',
                    'interview_location' => 'required'
                ];
                break;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return response()->json(['success' => true]);
    }
    public function downloadSample()
    {
        // return "dsa";
        $pathToFile = public_path('sample_excel/job-and-interview.xlsx');
        return response()->download($pathToFile);
    }

    public function import(Request $request)
    {
        //dd($request->all());
        $company_id = $request->company_id;
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);
        Excel::import(new InterviewJobImport($company_id), $request->file('file')->store('temp'));

        $route = route('companies.show', Crypt::encrypt($company_id));
        session()->flash('message', 'Job imported successfully');
        return response()->json(['status' => true, 'route' => $route]);
    }


    public function changeStatus(Request $request)
    {
        $company = Company::find($request->company_id);
        $company->status = $request->status;
        $company->save();
        if ($request->status == 0) {
            $message = 'Status deactivated successfully.';
        } else {
            $message = 'Status activated successfully.';
        }
        session()->flash('message', $message);
        return response()->json(['success' => $message]);
    }
}
