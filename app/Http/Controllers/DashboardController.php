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
            // last month entry
            $count['last_month_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();

            $candidates = Candidate::where('enter_by', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);
        } else {
            $count['total_candidate_entry'] = Candidate::count();
            $count['today_candidate_entry'] = Candidate::whereDate('created_at', date('Y-m-d'))->count();
            $count['monthly_candidate_entry'] = Candidate::whereMonth('created_at', date('m'))->count();
            // last month entry
            $count['last_month_candidate_entry'] = Candidate::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
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

        $interview_list = CandidateJob::where('date_of_interview', date('d-m-Y'))->orderBy('id', 'desc')->paginate(1);

        // Assuming you have a method to get month-wise counts for each status
        $intv['total_interviews'] = CandidateJob::orderBy('id', 'desc')->count();
        $intv['total_selection'] = CandidateJob::where('job_interview_status', 'Selected')->count();
        $intv['total_medical'] = CandidateJob::where('medical_status', '!=', null)->count();
        $intv['total_doc'] = CandidateJob::where('visa_receiving_date', '!=', null)->count();
        $intv['total_collection'] = CandidateJob::where('total_amount', '!=', null)->count();
        $intv['total_deployment'] =  CandidateJob::where('deployment_date', '!=', null)->count();

        $thisYear = date('Y');
        $totalMonths = 12;

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data = [
            'Deployment' => [],
            'Medical' => [],
            'Selection' => [],

            'Interview' => [],
        ];

        for ($i = 1; $i <= $totalMonths; $i++) {
            $month = Carbon::createFromDate($thisYear, $i, 1)->format('m');
            $data['Interview'][] = CandidateJob::whereMonth('created_at', $month)->whereYear('created_at', $thisYear)->count();
            $data['Selection'][] = CandidateJob::where('job_interview_status', 'Selected')->whereMonth('created_at', $month)->whereYear('created_at', $thisYear)->count();
            $data['Medical'][] = CandidateJob::where('medical_status', '!=', null)->whereMonth('created_at', $month)->whereYear('created_at', $thisYear)->count();

            $data['Deployment'][] = CandidateJob::where('deployment_date', '!=', null)->whereMonth('created_at', $month)->whereYear('created_at', $thisYear)->count();

        }

        // Prepare data in a JSON format
        $chartData = [
            'labels' => $labels,
            'datasets' => []
        ];

        foreach ($data as $label => $values) {
            if ($label == 'Interview') {
                $color = 'rgba(75, 192, 192, 0.2)';

            } elseif ($label == 'Selection') {
                $color = '#a8d8ff';
            } elseif ($label == 'Medical') {
                $color = '#0059a2';
            } elseif ($label == 'Deployment') {
                $color = '#008bff';
                // $color = 'rgba(75, 192, 192, 0.2)';

            }
            $chartData['datasets'][] = [
                'label' => $label,
                'data' => $values,
                'backgroundColor' => $color, // Add your colors here if needed
                'borderColor' => $color, // Add your border colors here if needed
                'borderWidth' => 1,
                'borderRadius' => 10,
            ];
        }
        $chartDataJSON = json_encode($chartData);

        return view('dashboard')->with(compact('count', 'candidates', 'most_candidates', 'interview_list', 'chartDataJSON'));
    }

    public function getInterviewList(Request $request)
    {

        $date = str_replace('/', '-', $request->date);
        $dateFormatted = DateTime::createFromFormat('d-m-Y', $date)->format('d-m-Y');
        $interview_list = CandidateJob::where('date_of_interview', $dateFormatted)->orderBy('id', 'desc')->paginate(1);


        return response()->json(['view' => view('dashboard-interview-card', compact('interview_list'))->render()]);
    }

    public function interviewChart(Request $request)
    {
        if ($request->ajax()) {
            $year = $request->year;

            $totalMonths = 12;

            $labels = [];
            $data = [
                'Deployment' => [],
                'Medical' => [],
                'Selection' => [],

                'Interview' => [],
            ];

            for ($i = 1; $i <= $totalMonths; $i++) {
                $month = Carbon::createFromDate($year, $i, 1)->format('m');
                $labels[] = Carbon::createFromDate($year, $i, 1)->format('F');
                $data['Interview'][] = CandidateJob::whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
                $data['Selection'][] = CandidateJob::where('job_interview_status', 'Selected')->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
                $data['Medical'][] = CandidateJob::where('medical_status', '!=', null)->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();

                $data['Deployment'][] = CandidateJob::where('deployment_date', '!=', null)->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
            }

            // Prepare data in a JSON format

            $chartData = [
                'labels' => $labels,
                'datasets' => []
            ];

            foreach ($data as $label => $values) {
                $chartData['datasets'][] = [
                    'label' => $label,
                    'data' => $values,
                    'backgroundColor' => '', // Add your colors here if needed
                    'borderColor' => '', // Add your border colors here if needed
                    'borderWidth' => 1
                ];
            }

            $chartDataJSON = json_encode($chartData);
            return response()->json(['view' => view('dashboard-interview-chart', compact('chartDataJSON'))->render()]);
        }
    }
}
