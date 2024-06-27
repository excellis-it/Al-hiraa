<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;


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
        $most_candidates = DB::table('candidates')
            ->join('users', 'candidates.enter_by', '=', 'users.id')
            ->leftJoin(DB::raw('(SELECT assign_by_id, COUNT(*) as total_schedules FROM candidate_jobs WHERE date_of_interview IS NOT NULL GROUP BY assign_by_id) as schedule_counts'), 'users.id', '=', 'schedule_counts.assign_by_id')
            ->leftJoin(DB::raw('(SELECT assign_by_id, COUNT(*) as total_appears FROM candidate_jobs WHERE deployment_date IS NOT NULL GROUP BY assign_by_id) as appear_counts'), 'users.id', '=', 'appear_counts.assign_by_id')
            ->select(
                'users.id as user_id',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) as enter_by_name"),
                DB::raw('count(candidates.id) as total'),
                DB::raw('COALESCE(total_schedules, 0) as total_schedules'),
                DB::raw('COALESCE(total_appears, 0) as total_appears')
            )
            ->groupBy('users.id', 'users.first_name', 'users.last_name', 'total_schedules', 'total_appears')
            ->orderByRaw('total_schedules DESC, total_appears DESC, total DESC')
            ->paginate(5);
        
        $interview_list = CandidateJob::whereDate('date_of_interview', date('d-m-Y'))->orderBy('id', 'desc')->paginate(1);

        return view('dashboard')->with(compact('count', 'candidates','most_candidates','interview_list'));
    }

    public function getInterviewList(Request $request)
    {
        
        $date = str_replace('/', '-', $request->date);
        $dateFormatted = DateTime::createFromFormat('d-m-Y', $date)->format('d-m-Y');
        $interview_list = CandidateJob::where('date_of_interview', $dateFormatted)->orderBy('id', 'desc')->paginate(1);


        return response()->json(['view' => view('dashboard-interview-card', compact('interview_list'))->render()]);
    }
}
