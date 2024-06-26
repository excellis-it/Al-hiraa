<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            $count['total_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->count();
            $count['today_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereDate('created_at', date('Y-m-d'))->count();
            $count['monthly_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereMonth('created_at', date('m'))->count();
            $candidates = Candidate::where('enter_by', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);
        } else {
            $count['total_candidate_entry'] = Candidate::count();
            $count['today_candidate_entry'] = Candidate::whereDate('created_at', date('Y-m-d'))->count();
            $count['monthly_candidate_entry'] = Candidate::whereMonth('created_at', date('m'))->count();
            $candidates = Candidate::orderBy('id', 'desc')->paginate(5);
        }


        //how to find list which enter_by in candidates table has most of the candidates in descending order
      return  $most_candidates = DB::table('candidates')
            ->select('enter_by', DB::raw('count(*) as total'))
            ->groupBy('enter_by')
            ->orderBy('total', 'desc')
            ->get();
        return view('dashboard')->with(compact('count', 'candidates'));
    }
}
