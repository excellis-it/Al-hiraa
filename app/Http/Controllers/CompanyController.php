<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
            return redirect()->back()->with('error', __('Company already exists.'));
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

        return response()->json(['message' => __('Company created successfully.')]);
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
                return view('companies.view')->with(compact('company'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
}
