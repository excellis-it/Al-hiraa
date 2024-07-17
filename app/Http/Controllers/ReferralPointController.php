<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferralPoint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ReferralPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $referral_points = ReferralPoint::orderBy('id', 'desc')->paginate(10);
            return view('settings.referral-points.list', compact('referral_points'));
        } else {
           return redirect()->back()->with('message', 'Permission denied.');
        }
    }

    public function referralPointFilter(Request $request)
    {
        $search = $request->search;
        $referral_points = ReferralPoint::where('name', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(10);
        return view('settings.referral-points.list', compact('referral_points'));
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
        //validation
        $request->validate([
            'amount' => 'required',
            'point' => 'required',
        ]);

        $referral_point = new ReferralPoint();
        $referral_point->amount = $request->amount;
        $referral_point->point = $request->point;
        $referral_point->save();


        Session::flash('message', 'Referral Point created successfully');
        return response()->json(['message' => __('Referral Point created successfully.'), 'status' => true]);
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
        $referral_point = ReferralPoint::find($id);
        $edit = true;
        return response()->json(['view' => view('settings.referral-points.edit', compact('referral_point','edit'))->render()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'amount' => 'required',
            'point' => 'required',
        ]);

        $referral_point = ReferralPoint::find($id);
        $referral_point->amount = $request->amount;
        $referral_point->point = $request->point;
        $referral_point->update();

        Session::flash('message', 'Referral Point updated successfully');
        return response()->json(['message' => __('Referral Point updated successfully.'), 'status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function referralPointDelete(string $id)
    {
        $referral_point = ReferralPoint::find($id);
        $referral_point->delete();
        return redirect()->route('referral-points.index')->with('error', 'Referral Point deleted successfully');
    }
}
