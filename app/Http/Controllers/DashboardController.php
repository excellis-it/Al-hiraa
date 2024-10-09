<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\CandidateJob;
use App\Models\CandidateActivity;
use App\Models\Interview;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->hasRole('DATA ENTRY OPERATOR')) {
            $count['total_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->count() ?? 0;
            $count['today_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereDate('created_at', date('Y-m-d'))->count() ?? 0;
            $count['monthly_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereMonth('created_at', date('m'))->count() ?? 0;
            // last month entry
            $count['last_month_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count() ?? 0;

            $candidates = Candidate::where('enter_by', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);
            $recruiters = [];
        } else if (Auth::user()->hasRole('RECRUITER')) {
            $count['daily_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereDate('created_at', date('Y-m-d'))->count() ?? 0;
            $count['call_back'] = CandidateActivity::where('user_id', Auth::user()->id)->where('call_status', 'Call Back')->count() ?? 0;

            // last month entry
            $candidates = Candidate::where('enter_by', Auth::user()->id)->get();
            $recruiters = [];
            $interviewSchedule = 0;
            $selection = 0;
            foreach ($candidates as $candidate) {
                // Count how many times the candidate has a job_interview_status of 'interested'
                $interviewSchedule += CandidateJob::where('candidate_id', $candidate->id)
                    ->where('job_interview_status', 'Interested')
                    ->count() ?? 0;

                $selection += CandidateJob::where('candidate_id', $candidate->id)
                    ->where('job_interview_status', 'Selected')
                    ->count() ?? 0;
            }

            // Store the result in the $count array
            $count['interview_schedule'] = $interviewSchedule;
            $count['selection'] = $selection;
        } else {
            $count['total_candidate_entry'] = Candidate::count() ?? 0;
            $count['today_candidate_entry'] = Candidate::whereDate('created_at', date('Y-m-d'))->count() ?? 0;
            $count['monthly_candidate_entry'] = Candidate::whereMonth('created_at', date('m'))->count() ?? 0;
            // last month entry
            $count['last_month_candidate_entry'] = Candidate::whereMonth('created_at', Carbon::now()->subMonth()->month)->count() ?? 0;
            $candidates = Candidate::orderBy('id', 'desc')->paginate(10);
    
            // Fetch recruiters with custom pagination key
            $recruiters = User::where('role_type', 'RECRUITER')->paginate(10);
            // Loop through each recruiter to count their candidates' statuses
            foreach ($recruiters as $recruiter) {
                $candidateIds = Candidate::where('enter_by', $recruiter->id)
                    ->pluck('id')->toArray();

                $recruiter->selected_job_count = CandidateJob::where('assign_by_id', $recruiter->id)
                    ->where('job_interview_status', 'Selected') // Adjust this string based on your actual status value
                    ->count();
        
                
                $recruiter->interested_job_count = CandidateJob::where('assign_by_id', $recruiter->id)
                    ->where('job_interview_status', 'Interested') // Adjust this string based on your actual status value
                    ->count();

                

                    $recruiter->deployed_job_count = CandidateJob::where('assign_by_id', $recruiter->id)
                    ->where('deployment_date', '!=', null) // Adjust this string based on your actual status value
                    ->count();

                $recruiter->candidate_added_count = Candidate::where('enter_by', $recruiter->id)
                    ->count(); 
            }
        }


        //how to find list which enter_by in candidates table has most of the candidates in descending order
        // $most_candidates = DB::table('candidates')
        //     ->join('users', 'candidates.enter_by', '=', 'users.id')
        //     ->leftJoin(DB::raw('(SELECT assign_by_id, COUNT(*) as total_schedules FROM candidate_jobs WHERE date_of_interview IS NOT NULL GROUP BY assign_by_id) as schedule_counts'), 'users.id', '=', 'schedule_counts.assign_by_id')
        //     ->leftJoin(DB::raw('(SELECT assign_by_id, COUNT(*) as total_appears FROM candidate_jobs WHERE deployment_date IS NOT NULL GROUP BY assign_by_id) as appear_counts'), 'users.id', '=', 'appear_counts.assign_by_id')
        //     ->select(
        //         'users.id as user_id',
        //         DB::raw("CONCAT(users.first_name, ' ', users.last_name) as enter_by_name"),
        //         DB::raw('count(candidates.id) as total'),
        //         DB::raw('COALESCE(total_schedules, 0) as total_schedules'),
        //         DB::raw('COALESCE(total_appears, 0) as total_appears')
        //     )
        //     ->groupBy('users.id', 'users.first_name', 'users.last_name', 'total_schedules', 'total_appears')
        //     ->orderByRaw('total_schedules DESC, total_appears DESC, total DESC')
        //     ->paginate(5);

        $most_candidates = DB::table('candidates')
            ->join('users', 'candidates.enter_by', '=', 'users.id')
            ->leftJoin(DB::raw('
                (SELECT assign_by_id, COUNT(*) as total_schedules
                FROM candidate_jobs
                WHERE date_of_interview IS NOT NULL
                GROUP BY assign_by_id) as schedule_counts
            '), 'users.id', '=', 'schedule_counts.assign_by_id')
            ->leftJoin(DB::raw('
                (SELECT assign_by_id, COUNT(*) as total_appears
                FROM candidate_jobs
                WHERE deployment_date IS NOT NULL
                GROUP BY assign_by_id) as appear_counts
            '), 'users.id', '=', 'appear_counts.assign_by_id')
            ->select(
                'users.id as user_id',
                DB::raw("CONCAT(users.first_name, ' ', users.last_name) as enter_by_name"),
                DB::raw('COUNT(candidates.id) as total'),
                DB::raw('COALESCE(total_schedules, 0) as total_schedules'),
                DB::raw('COALESCE(total_appears, 0) as total_appears'),
                DB::raw('
                    CASE WHEN COUNT(candidates.id) = 0 THEN 0
                    ELSE COALESCE(total_appears, 0) / COUNT(candidates.id)
                    END as appear_ratio
                ')
            )
            ->where('users.role_type', '!=', 'ADMIN')
            // deleted at users not shown
            ->whereNull('users.deleted_at')
            ->where('users.is_active', 1)
            ->groupBy('users.id', 'users.first_name', 'users.last_name', 'total_schedules', 'total_appears')
            ->orderByRaw('appear_ratio DESC, total_schedules DESC, total_appears DESC, total DESC')
            ->paginate(5);

        // dd($most_candidates);

        $interview_list = CandidateJob::where('date_of_interview', date('d-m-Y'))->orderBy('id', 'desc')->paginate(1);

        // Assuming you have a method to get month-wise counts for each status
        $intv['total_interviews'] = CandidateJob::orderBy('id', 'desc')->count();
        $intv['total_selection'] = CandidateJob::where('job_interview_status', 'Interested')->count();
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
            $data['Selection'][] = CandidateJob::where('job_interview_status', 'Interested')->whereMonth('created_at', $month)->whereYear('created_at', $thisYear)->count();
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


        $today = Carbon::today();
        $last30Days = Carbon::today()->subDays(30);

        $candidate_jobs = CandidateJob::whereBetween('created_at', [$last30Days, $today])->get();

        $total_installments = 0;
        $total_service_fee = 0;

        foreach ($candidate_jobs as $candidate_job) {
            $first_installment = !is_numeric($candidate_job->fst_installment_amount) ? 0 : (float)$candidate_job->fst_installment_amount;
            $second_installment = !is_numeric($candidate_job->secnd_installment_amount) ? 0 : (float)$candidate_job->secnd_installment_amount;
            $third_installment = !is_numeric($candidate_job->third_installment_amount) ? 0 : (float)$candidate_job->third_installment_amount;
            $fourth_installment = !is_numeric($candidate_job->fourth_installment_amount) ? 0 : (float)$candidate_job->fourth_installment_amount;

            $total_installments += $first_installment + $second_installment + $third_installment + $fourth_installment;

            $service_fee = (isset($candidate_job->jobTitle->service_charge) && is_numeric($candidate_job->jobTitle->service_charge)) ? (float)$candidate_job->jobTitle->service_charge : 0;
            $total_service_fee += $service_fee;
        }

        $payment_due = $total_installments - $total_service_fee;
        $new_jobs_openings = Interview::whereBetween('interview_start_date', [date('d-m-Y'), date('d-m-Y', strtotime('+1 week'))])->paginate(5);

        return view('dashboard')->with(compact('count', 'candidates', 'most_candidates', 'interview_list', 'chartDataJSON', 'total_installments', 'total_service_fee', 'intv', 'payment_due', 'new_jobs_openings','recruiters'));
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
                $data['Selection'][] = CandidateJob::where('job_interview_status', 'Interested')->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
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

    public function installmentChart(Request $request)
    {
        if ($request->ajax()) {
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
            // return $start_date . ' ' . $end_date;
            $candidate_jobs = CandidateJob::whereBetween('created_at', [$start_date, $end_date])->get();

            $total_installments = 0;
            $total_service_fee = 0;

            foreach ($candidate_jobs as $candidate_job) {
                $first_installment = !is_numeric($candidate_job->fst_installment_amount) ? 0 : (float)$candidate_job->fst_installment_amount;
                $second_installment = !is_numeric($candidate_job->secnd_installment_amount) ? 0 : (float)$candidate_job->secnd_installment_amount;
                $third_installment = !is_numeric($candidate_job->third_installment_amount) ? 0 : (float)$candidate_job->third_installment_amount;
                $fourth_installment = !is_numeric($candidate_job->fourth_installment_amount) ? 0 : (float)$candidate_job->fourth_installment_amount;

                $total_installments += $first_installment + $second_installment + $third_installment + $fourth_installment;

                $service_fee = (isset($candidate_job->jobTitle->service_charge) && is_numeric($candidate_job->jobTitle->service_charge)) ? (float)$candidate_job->jobTitle->service_charge : 0;
                $total_service_fee += $service_fee;
            }

            $total_installments . ' ' . $total_service_fee;
            $payment_due = $total_installments - $total_service_fee;

            return response()->json(['view' => view('installment-pie-chart', compact('total_installments', 'total_service_fee', 'payment_due'))->render()]);
        }
    }
}
