<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    use ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->can('Manage Company')) {
            if (Auth::user()->hasRole('ADMIN')) {
                $companies = Company::orderBy('id', 'DESC')->paginate(15);
            } else {
                $companies = Company::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(15);
            }
            return view('companies.list')->with(compact('companies'));
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
            'company_website' => 'nullable|url',
            'company_industry' => 'required',
            'company_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'company_description' => 'nullable',
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
        Session::flash('message', 'Company created successfully');
        return response()->json(['message' => __('Company created successfully.'), 'status' => true]);
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
                $ongoing_jobs = Job::where(['status' => 'Ongoing', 'company_id' => $id])->orderBy('id','desc')->paginate(10);
                $closed_jobs = Job::where(['status' => 'Closed', 'company_id' => $id])->orderBy('id','desc')->paginate(10);
                return view('companies.view')->with(compact('company', 'ongoing_jobs', 'closed_jobs'));
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
        $companies = $companies->orderBy('id', 'DESC')->paginate(15);

        return response()->json(['view' => view('companies.filter', compact('companies'))->render()]);
    }

    public function companyJobStore(Request $request)
    {
        $request->validate([
            'job_name' => 'required',
            'form_date' => 'nullable|required_with:to_date|date',
            // to_date greater than form_date validation and to_date required if form_date is set
            'to_date' => 'nullable|after:form_date',
            'status' => 'required',
            'contract' => 'nullable|numeric'
        ],[
            'form_date.required_with' => 'The form date field is required when to date is present.',
            'to_date.after' => 'The to date must be a date after form date.' ,
            'status.required' => 'The status field is required.'
        ]);

        $job = new Job();
        $job->company_id = $request->company_id;
        $job->job_name = $request->job_name;
        $job->duty_hours = $request->duty_hours;
        $job->contract = $request->contract;
        $job->benifits = $request->benifits;
        $job->form_date = $request->form_date;
        $job->to_date = $request->to_date;
        $job->job_description = $request->job_description;
        $job->status = $request->status;
        $job->save();
        Session::flash('message', 'Job created successfully');
        return response()->json(['message' => __('Job created successfully.'), 'status' => true]);
    }

    public function companyJobEdit(string $id)
    {
        $job = Job::findOrFail($id);
        $edit = true;
        return response()->json(['view' => view('companies.edit-job', compact('job', 'edit'))->render(), 'status' => 'success']);
    }

    public function companyJobUpdate(Request $request, string $id)
    {
        $request->validate([
            'job_name' => 'required',
            'form_date' => 'nullable|required_with:to_date|date',
            // to_date greater than form_date validation and to_date required if form_date is set
            'to_date' => 'nullable|after:form_date',
            'status' => 'required',
            // contract was number or float
            'contract' => 'nullable|numeric'
        ],[
            'form_date.required_with' => 'The form date field is required when to date is present.',
            'to_date.after' => 'The to date must be a date after form date.' ,
            'status.required' => 'The status field is required.'
        ]);

        $job = Job::findOrFail(Crypt::decrypt($id));
        $job->job_name = $request->job_name;
        $job->duty_hours = $request->duty_hours;
        $job->contract = $request->contract;
        $job->benifits = $request->benifits;
        $job->form_date = $request->form_date;
        $job->to_date = $request->to_date;
        $job->job_description = $request->job_description;
        $job->status = $request->status;
        $job->save();
        Session::flash('message', 'Job Updated successfully');
        return response()->json(['message' => __('Job Updated successfully.'), 'status' => true]);
    }

    public function closeJobFilter(Request $request)
    {
        // return $request->all();
        $closed_jobs = Job::where(['status' => 'Closed', 'company_id' => $request->company_id])->orderBy('id','desc')->paginate(10);
        return response()->json(['view' => view('companies.close-job-filter', compact('closed_jobs'))->render()]);
    }

    public function openJobFilter(Request $request)
    {
        // return $request;
         $ongoing_jobs = Job::where(['status' => 'Ongoing', 'company_id' => $request->company_id])->orderBy('id','desc')->paginate(10);
        return response()->json(['view' => view('companies.open-job-filter', compact('ongoing_jobs'))->render()]);
    }
}
