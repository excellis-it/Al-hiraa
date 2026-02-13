<?php

namespace App\Http\Controllers;

use App\Exports\JobInterviewReport;
use App\Models\Candidate;
use App\Models\CandidateJob;
use App\Models\CandidateActivity;
use App\Models\CandidateDailyViewReport;
use App\Models\CandidateStatus;
use App\Models\Company;
use App\Models\Interview;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->hasRole('DATA ENTRY OPERATOR')) {
            // Get first 3 statuses from candidate_statuses table
            $statuses = CandidateStatus::take(3)->get();

            // Build counts dynamically
            $statusCounts = [];
            foreach ($statuses as $status) {
                $statusCounts[] = [
                    'name' => $status->name, // e.g. Active, Passive, Blacklisted
                    'count' => Candidate::where('enter_by', Auth::id())
                        ->where('cnadidate_status_id', $status->id)
                        ->count(),
                ];
            }


            $count['today_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereDate('created_at', date('Y-m-d'))->count() ?? 0;
            $count['monthly_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereMonth('created_at', date('m'))->count() ?? 0;
            // last month entry
            $count['last_month_candidate_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereMonth('created_at', Carbon::now()->subMonth()->month)->count() ?? 0;
            $count['interview_schedule'] = \App\Models\Lineup::where('assign_by_id', Auth::id())->count() ?? 0;
            $candidates = Candidate::where('enter_by', Auth::user()->id)->orderBy('id', 'desc')->paginate(5);
            $recruiters = [];
        } else if ($user->hasRole('RECRUITER')) {
            $count['daily_entry'] = Candidate::where('enter_by', Auth::user()->id)->whereDate('created_at', date('Y-m-d'))->count() ?? 0;
            $count['call_back'] = CandidateActivity::where('user_id', Auth::user()->id)->where('call_status', 'CALL BACK')->count() ?? 0;
            $count['interview_schedule'] = \App\Models\Lineup::where('assign_by_id', Auth::user()->id)->count() ?? 0;
            $count['selection'] = \App\Models\Lineup::where('assign_by_id', Auth::user()->id)->where('interview_status', 'Interested')->count() ?? 0;
            // last month entry
            $candidates = Candidate::where('enter_by', Auth::user()->id)->get();
            $recruiters = [];
            $statuses = CandidateStatus::take(3)->get();

            // Build counts dynamically
            $statusCounts = [];
            foreach ($statuses as $status) {
                $statusCounts[] = [
                    'name' => $status->name, // e.g. Active, Passive, Blacklisted
                    'count' => Candidate::where('cnadidate_status_id', $status->id)
                        ->count(),
                ];
            }
        } else {
            $statuses = CandidateStatus::take(3)->get();

            // Build counts dynamically
            $statusCounts = [];
            foreach ($statuses as $status) {
                $statusCounts[] = [
                    'name' => $status->name, // e.g. Active, Passive, Blacklisted
                    'count' => Candidate::where('cnadidate_status_id', $status->id)
                        ->count(),
                ];
            }

            $count['today_candidate_entry'] = Candidate::whereDate('created_at', date('Y-m-d'))->count() ?? 0;
            $count['monthly_candidate_entry'] = Candidate::whereMonth('created_at', date('m'))->count() ?? 0;
            // last month entry
            $count['interview_schedule'] = \App\Models\Lineup::count() ?? 0;
            $candidates = Candidate::orderBy('id', 'desc')->paginate(10);

            // Fetch recruiters with custom pagination key
            $recruiters = User::Role('RECRUITER')->paginate(10, ['*'], 'recruiters_page');
            // Loop through each recruiter to count their candidates' statuses
            foreach ($recruiters as $recruiter) {
                $candidateIds = Candidate::where('enter_by', $recruiter->id)
                    ->pluck('id')->toArray();

                $recruiter->selected_job_count = CandidateJob::where('assign_by_id', $recruiter->id)
                    ->where('job_interview_status', 'Selected') // Adjust this string based on your actual status value
                    ->count();


                $recruiter->interested_job_count = \App\Models\Lineup::where('assign_by_id', $recruiter->id)
                    ->where('interview_status', 'Interested') // Using Lineup status
                    ->count();



                $recruiter->deployed_job_count = CandidateJob::where('assign_by_id', $recruiter->id)
                    ->where('deployment_date', '!=', null) // Adjust this string based on your actual status value
                    ->count();

                $recruiter->candidate_added_count = Candidate::where('enter_by', $recruiter->id)
                    ->count();
                $recruiter->candidate_data_view_count = CandidateDailyViewReport::where('user_id', $recruiter->id)
                    ->count();
            }
        }

        $most_candidates = DB::table('candidates')
            ->join('users', 'candidates.enter_by', '=', 'users.id')
            ->leftJoin(DB::raw('
                (SELECT assign_by_id, COUNT(*) as total_schedules
                FROM lineups
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
            ->paginate(10);

        // dd($most_candidates);

        $interview_list = \App\Models\Lineup::where('date_of_interview', date('d-m-Y'))->orderBy('id', 'desc')->paginate(1);

        // Assuming you have a method to get month-wise counts for each status
        $intv['total_interviews'] = \App\Models\Lineup::orderBy('id', 'desc')->count();
        $intv['total_selection'] = \App\Models\Lineup::where('interview_status', 'Interested')->count();
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
            // 'Interview' => [],
        ];

        for ($i = 1; $i <= $totalMonths; $i++) {
            $month = Carbon::createFromDate($thisYear, $i, 1)->format('m');
            // $data['Interview'][] = CandidateJob::whereMonth('created_at', $month)->whereYear('created_at', $thisYear)->count();
            $data['Selection'][] = \App\Models\Lineup::where('interview_status', 'Interested')->whereMonth('created_at', $month)->whereYear('created_at', $thisYear)->count();
            $data['Medical'][] = CandidateJob::where('medical_status', '!=', null)->whereMonth('created_at', $month)->whereYear('created_at', $thisYear)->count();

            $data['Deployment'][] = CandidateJob::where('deployment_date', '!=', null)->whereMonth('created_at', $month)->whereYear('created_at', $thisYear)->count();
        }

        // Prepare data in a JSON format
        $chartData = [
            'labels' => $labels,
            'datasets' => []
        ];

        foreach ($data as $label => $values) {
            /*if ($label == 'Interview') {
                $color = 'rgba(75, 192, 192, 0.2)';
            } else*/
            if ($label == 'Selection') {
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

        $today = date('Y-m-d'); // Format current date for comparison

        $new_jobs_openings = Interview::where(function ($query) use ($today) {
            $query->whereRaw('STR_TO_DATE(interview_end_date, "%d-%m-%Y") >= ?', [$today]);
        })
            ->whereHas('job', function ($query) {
                $query->where('status', 'Ongoing');
            })
            ->paginate(10);



        $companies = Company::where('status', 1)->orderBy('company_name', 'asc')->get();
        $new_month = date('m');
        $new_year = date('Y');

        return view('dashboard')->with(compact('companies', 'statusCounts', 'new_month', 'new_year', 'count', 'candidates', 'most_candidates', 'interview_list', 'chartDataJSON', 'total_installments', 'total_service_fee', 'intv', 'payment_due', 'new_jobs_openings', 'recruiters'));
    }

    public function getInterviewList(Request $request)
    {

        $date = str_replace('/', '-', $request->date);
        $dateFormatted = DateTime::createFromFormat('d-m-Y', $date)->format('d-m-Y');
        $interview_list = \App\Models\Lineup::where('date_of_interview', $dateFormatted)->orderBy('id', 'desc')->paginate(1);


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
                $data['Selection'][] = \App\Models\Lineup::where('interview_status', 'Interested')->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
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

    public function reportJobInterview(Request $request)
    {
        try {
            $year = $request->input('year');
            $month = $request->input('month');
            $company_id = $request->input('company_id') ?? null;
            // dd($month);
            return Excel::download(new JobInterviewReport($year, $month, $company_id), 'job_interview_report_' . $year . '_' . $month . '.xlsx');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function getInterviewReportData(Request $request)
    {
        $new_year = $request->input('year');
        $new_month = $request->input('month');
        $companyId = $request->input('company_id'); // Get the selected company ID

        // Filter companies based on the selected company if provided
        if ($companyId) {
            $companies = Company::where('status', 1)->where('id', $companyId)->orderBy('company_name', 'asc')->get();
        } else {
            $companies = Company::where('status', 1)->orderBy('company_name', 'asc')->get();
        }

        return view('dashboard-job-interview-report-table', compact('companies', 'new_year', 'new_month'));
    }

    public function filterMedicalReport(Request $request)
    {
        $medical_month = $request->month;
        $medical_year = $request->year;

        $companies = Company::where('status', 1)->orderBy('company_name', 'asc')->get();

        $html = view('dashboard-job-medical-report-table', compact('companies', 'medical_month', 'medical_year'))->render();

        return response()->json(['html' => $html]);
    }
}
