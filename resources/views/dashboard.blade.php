@extends('layouts.master')
@section('title')
{{ env('APP_NAME') }} - Dashboard
@endsection
@push('styles')
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<style>
    /* thead capital letter */
    .table thead th {
        text-transform: uppercase;
    }
</style>
@endpush
@section('content')
@php
use App\Helpers\Helper;
@endphp
<div class="mdk-drawer-layout__content page">
    <div class="container-fluid page__container">
        <div class="page__heading">
            <div class="row">
                <div class="col-xl-9 col-lg-8 col-md-7 ">
                    <div class="">
                        {{-- <form class="search-form d-flex" action="index.html">
                            <button class="btn" type="submit" role="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                            <input type="text" class="form-control" placeholder="Advance Search..">
                        </form> --}}
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 col-xl-3  text-end">
                    <a href="{{ route('candidates.create') }}" class="support_btn">
                        <span>Add Candidate</span>
                        <span>
                            <i class="fas fa-plus"></i>

                        </span>
                    </a>
                </div>
            </div>
        </div>
        @if (Auth::user()->hasRole('ADMIN') ||
        Auth::user()->hasRole('OPERATION MANAGER') ||
        Auth::user()->hasRole('DATA ENTRY OPERATOR') ||
        Auth::user()->hasRole('PROCESS MANAGER'))
        <div class="row  staye">
            @foreach ($statusCounts as $status)
            <div class="col-md-2">
                <a href="{{ route('candidates.index', ['candidate_status' => $status['name']]) }}">
                    <div class="border_left_hh">
                        <div class="card-header__title mb-2">{{ $status['name'] }} Candidate</div>
                        <div class="text-amount">{{ $status['count'] }}</div>
                        <div class="text-stats">Candidate Entry</div>
                    </div>
                </a>
            </div>
            @endforeach

            <div class="col-md-2">
                <a href="{{ route('candidates.index', ['candidate_entry' => 'monthly']) }}">
                    <div class="border_left_hh">
                        <div class="card-header__title mb-2">Monthly Stats</div>
                        <div class="text-amount">{{ $count['monthly_candidate_entry'] }} </div>
                        <div class="text-stats">Candidate Entry</div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('candidates.index', ['candidate_entry' => 'daily']) }}">
                    <div class="border_left_hh">
                        <div class="card-header__title mb-2">Today Stats</div>
                        <div class="text-amount">{{ $count['today_candidate_entry'] }} </div>
                        <div class="text-stats">Candidate Entry</div>
                    </div>
                </a>
            </div>

            @can('Manage Lineup')
            <div class="col-md-2">
                <a href="{{ route('lineups.index') }}">
                    <div class="border_left_hh">
                        <div class="card-header__title mb-2">Total Interview Schedule</div>
                        <div class="text-amount">{{ $count['interview_schedule'] }} </div>
                    </div>
                </a>
            </div>
            @endcan


        </div>
        @endif
        @if (Auth::user()->hasRole('RECRUITER'))
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 staye">
            @foreach ($statusCounts as $status)
            <div class="col">
                <a href="{{ route('candidates.index', ['candidate_status' => $status['name']]) }}">
                    <div class="border_left_hh">
                        <div class="card-header__title mb-2">{{ $status['name'] }} Candidate</div>
                        <div class="text-amount">{{ $status['count'] }}</div>
                        <div class="text-stats">Candidate Entry</div>
                    </div>
                </a>
            </div>
            @endforeach
            <div class="col">
                <a href="{{ route('candidates.index', ['call_status' => 'CALL BACK']) }}">
                    <div class="border_left_hh">
                        <div class="card-header__title mb-2">Total Call Back</div>
                        <div class="text-amount">{{ $count['call_back'] }} </div>
                    </div>
                </a>
            </div>
            @can('Manage Lineup')
            <div class="col">
                <a href="{{ route('lineups.index') }}">
                    <div class="border_left_hh">
                        <div class="card-header__title mb-2">Total Interview Schedule</div>
                        <div class="text-amount">{{ $count['interview_schedule'] }} </div>
                    </div>
                </a>
            </div>
            @endcan


            <div class="col">
                <a href="{{ route('candidates.index', ['call_status' => 'INTERESTED']) }}">
                    <div class="border_left_hh">
                        <div class="card-header__title mb-2">Total Interested Candidate</div>
                        <div class="text-amount">{{ $count['selection'] }}</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table_right">
                    <div class="py-3">
                        <h4 class="card-header__title">New Job Opening</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Job ID</th>
                                    <th>Company Name</th>
                                    <th>Interview Date</th>
                                    <th>Job Title</th>
                                    <th>Salary</th>
                                    <th>People Required</th>
                                    <th>Job Postion</th>
                                    <th>Job Location </th>
                                    <th>Interview Location </th>
                                    <th>Benifits</th>

                                    <th>RC Interested</th>
                                    <th>Doc.View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($new_jobs_openings) > 0)
                                @foreach ($new_jobs_openings as $new_jobs_opening)
                                <tr>
                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->job_id : '' }}
                                    </td>
                                    <td>{{ $new_jobs_opening->company ? $new_jobs_opening->company->company_name : '' }}
                                    </td>
                                    <td>
                                        {{ isset($new_jobs_opening['interview_start_date']) ? date('d/m/Y', strtotime($new_jobs_opening['interview_start_date'])) : '' }}
                                        @if (isset($new_jobs_opening['interview_start_date']) &&
                                        isset($new_jobs_opening['interview_end_date']) &&
                                        $new_jobs_opening['interview_start_date'] != $new_jobs_opening['interview_end_date']
                                        )
                                        -
                                        {{ date('d/m/Y', strtotime($new_jobs_opening['interview_end_date'])) }}
                                        @endif
                                    </td>
                                    {{-- @dd($new_jobs_opening->job->candidate_position_id) --}}
                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->job_name : '' }}
                                    </td>
                                    <td>
                                        {{ $new_jobs_opening->job && $new_jobs_opening->job->salary ? '' . $new_jobs_opening->job->salary : '' }}
                                    </td>
                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->quantity_of_people_required : '' }}
                                    </td>
                                    <td>
                                        @if (isset($new_jobs_opening->job->candidatePosition))
                                        <a
                                            href="{{ route('candidates.index', ['position_id' => $new_jobs_opening->job->candidate_position_id]) }}">
                                            {{ isset($new_jobs_opening->job->candidatePosition) ? $new_jobs_opening->job->candidatePosition->name : '' }}
                                        </a>
                                        @else
                                        N/A
                                        @endif

                                    </td>
                                    <td>
                                        <span
                                            title="{{ $new_jobs_opening->job ? $new_jobs_opening->job->address : '' }}"
                                            style="cursor: pointer">
                                            {{ Str::limit($new_jobs_opening->job ? $new_jobs_opening->job->address : '', 20, '...') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span title="{{ $new_jobs_opening->interview_location ?? '' }}"
                                            style="cursor: pointer">
                                            {{ Str::limit($new_jobs_opening->interview_location ? $new_jobs_opening->interview_location : '', 20, '...') }}
                                        </span>
                                    </td>
                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->benifits : '' }}
                                    </td>


                                    <td>
                                        <a
                                            href="{{ route('lineups.index', ['interested_type' => 'self', 'get_interview_id' => $new_jobs_opening->id]) }}">
                                            {{ Helper::getRcInterestedCount($new_jobs_opening->id) }}
                                        </a>
                                    </td>
                                  
                                    <td>
                                        @if (isset($new_jobs_opening->job->document) && $new_jobs_opening->job->document)
                                        <a href="{{ Storage::url($new_jobs_opening->job->document) }}"
                                            target="_blank">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @else
                                        No Document
                                        @endif

                                    </td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="12" class="text-left">
                                        <div class="d-flex justify-content-between">
                                            <div>{!! $new_jobs_openings->links() !!}</div>
                                            <div class="">
                                                (Showing {{ $new_jobs_openings->firstItem() }} –
                                                {{ $new_jobs_openings->lastItem() }} users of
                                                {{ $new_jobs_openings->total() }} users)
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="12" class="text-center">No data found</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if (Auth::user()->hasRole('ADMIN') ||
        Auth::user()->hasRole('OPERATION MANAGER') ||
        Auth::user()->hasRole('PROCESS MANAGER'))
        {{-- chart --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="table_right">
                    <div class="py-3">
                        <h4 class="card-header__title">New Job Opening</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Job ID</th>
                                    <th>Company Name</th>
                                    <th>Interview Date</th>
                                    <th>Job Title</th>
                                    <th>Salary</th>
                                    <th>People Required</th>
                                    <th>Job Postion</th>
                                    <th>Job Location </th>
                                    <th>Interview Location </th>
                                    <th>Benifits</th>
                                    @unless (Auth::user()->hasRole('PROCESS MANAGER'))
                                    <th>Team Interested</th>
                                    @endunless
                                    <th>Doc.View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($new_jobs_openings) > 0)
                                @foreach ($new_jobs_openings as $new_jobs_opening)
                                <tr>
                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->job_id : '' }}
                                    </td>
                                    <td>{{ $new_jobs_opening->company ? $new_jobs_opening->company->company_name : '' }}
                                    </td>
                                    <td>
                                        {{ isset($new_jobs_opening['interview_start_date']) ? date('d/m/Y', strtotime($new_jobs_opening['interview_start_date'])) : '' }}
                                        @if (isset($new_jobs_opening['interview_start_date']) &&
                                        isset($new_jobs_opening['interview_end_date']) &&
                                        $new_jobs_opening['interview_start_date'] != $new_jobs_opening['interview_end_date']
                                        )
                                        -
                                        {{ date('d/m/Y', strtotime($new_jobs_opening['interview_end_date'])) }}
                                        @endif
                                    </td>
                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->job_name : '' }}
                                    </td>
                                    <td>
                                        {{ $new_jobs_opening->job && $new_jobs_opening->job->salary ? '' . $new_jobs_opening->job->salary : '' }}
                                    </td>
                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->quantity_of_people_required : '' }}
                                    </td>
                                    <td>
                                        @if (isset($new_jobs_opening->job->candidatePosition))
                                        <a
                                            href="{{ route('candidates.index', ['position_id' => $new_jobs_opening->job->candidate_position_id]) }}">
                                            {{ isset($new_jobs_opening->job->candidatePosition) ? $new_jobs_opening->job->candidatePosition->name : '' }}
                                        </a>
                                        @else
                                        N/A
                                        @endif

                                    </td>
                                    <td>
                                        <span
                                            title="{{ $new_jobs_opening->job ? $new_jobs_opening->job->address : '' }}"
                                            style="cursor: pointer">
                                            {{ Str::limit($new_jobs_opening->job ? $new_jobs_opening->job->address : '', 20, '...') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span title="{{ $new_jobs_opening->interview_location ?? '' }}"
                                            style="cursor: pointer">
                                            {{ Str::limit($new_jobs_opening->interview_location ? $new_jobs_opening->interview_location : '', 20, '...') }}
                                        </span>
                                    </td>
                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->benifits : '' }}
                                    </td>
                                    @unless (Auth::user()->hasRole('PROCESS MANAGER'))
                                    <td>
                                        <a href="{{ route('lineups.index', ['get_interview_id' => $new_jobs_opening->id]) }}">
                                            {{ Helper::getAllRcInterestedCount($new_jobs_opening->id) }}
                                        </a>
                                    </td>
                                    @endunless

                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="11" class="text-left">
                                        <div class="d-flex justify-content-between">

                                            <div>{!! $new_jobs_openings->links() !!}</div>
                                            <div class="">
                                                (Showing {{ $new_jobs_openings->firstItem() }} –
                                                {{ $new_jobs_openings->lastItem() }} users of
                                                {{ $new_jobs_openings->total() }} users)
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if (isset($new_jobs_opening->job->document) && $new_jobs_opening->job->document)
                                        <a href="{{ Storage::url($new_jobs_opening->job->document) }}"
                                            target="_blank">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @else
                                        No Document
                                        @endif

                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="11" class="text-center">No data found</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                {{-- @php
                        $year = 2023;
                    @endphp
                    <div class="dashboard_graph">
                        <select id="interview-line-chart-yearly" class="form-select">
                            @for ($i = $year; $i <= date('Y'); $i++)
                                <option value="{{ $year }}" @if ($year == date('Y')) selected="" @endif>
                {{ $year }}</option>
                @php $year++ @endphp
                @endfor
                </select>
            </div> --}}

            <div class="dashboard_graph" id="dashboard-interview-chart">
                @include('dashboard-interview-chart')
            </div>
        </div>
    </div>
    @if (Auth::user()->hasRole('ADMIN') || Auth::user()->hasRole('OPERATION MANAGER'))
    <div class="row">
        <div class="col-lg-6">
            <div class="table_right">
                <div class="py-3">
                    <h4 class="card-header__title">Current Users</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 thead-border-top-0">
                        <thead>
                            <tr>
                                <th>Team Member</th>
                                <th>Candidate Added</th>
                                <th>Interview Schedule</th>
                                {{-- <th>Appear</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @include('dashboard-users-table')

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- rc report --}}
        <div class="col-lg-6">
            <div class="table_right">
                <div class="py-3">
                    <h4 class="card-header__title">RC Report</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 thead-border-top-0">
                        <thead>
                            <tr>
                                <th>Recruiter</th>
                                <th>Candidate Added</th>
                                <th>Viewed</th>
                                <th>Interested</th>
                                <th>Selected</th>
                                {{-- <th>Back Out</th> --}}
                                <th>Deployed</th>

                            </tr>
                        </thead>
                        <tbody>
                            @include('dashboard-rc-report-table')

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @endif
    @if (Auth::user()->hasRole('ADMIN') ||
    Auth::user()->hasRole('OPERATION MANAGER') ||
    Auth::user()->hasRole('PROCESS MANAGER'))
    <div class="row">
        <div class="col-lg-12">
            <div class="table_right">
                <div class="py-3">
                    <h4 class="card-header__title">Job Interview Report</h4>
                </div>
                <div class="justify-content-end mb-2 d-flex">
                    @php
                    $year = date('Y');
                    $months = [
                    '01' => 'January',
                    '02' => 'February',
                    '03' => 'March',
                    '04' => 'April',
                    '05' => 'May',
                    '06' => 'June',
                    '07' => 'July',
                    '08' => 'August',
                    '09' => 'September',
                    '10' => 'October',
                    '11' => 'November',
                    '12' => 'December',
                    ];
                    @endphp
                    <div class="dashboard_graph" style="margin-right: 5px;">
                        <select id="company-filter" class="form-select" style="width: 300px;">
                            <option value="" selected>Select Company</option>
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="dashboard_graph" style="margin-right: 5px;">
                        <select id="interview-monthly" class="form-select" style="width: 150px;">
                            @foreach ($months as $key => $month)
                            <option value="{{ $key }}"
                                @if ($key==date('m')) selected @endif>{{ $month }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="dashboard_graph" style="margin-right: 5px;">
                        <select id="interview-yearly" class="form-select" style="width: 150px;">
                            @for ($i = 2023; $i <= date('Y'); $i++)
                                <option value="{{ $i }}"
                                @if ($i==$year) selected @endif>{{ $i }}
                                </option>
                                @endfor
                        </select>
                    </div>
                    <div>
                        <a href="{{ route('report.job-interview.export', ['year' => request('year', date('Y')), 'month' => request('month', date('m')), 'company_id' => request('company_id')]) }}"
                            class="support_btn text-end" id="export-button">
                            <span><i class="fas fa-file-excel"></i> Submit </span>
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered mb-0 thead-border-top-0">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                {{-- <th>Candidate Interested In Interviews</th> --}}
                                <th>Candidate In Selection</th>
                                <th>Candidate In Medical</th>
                                <th>Candidate In Documentation</th>
                                <th>Candidate In Deployment</th>
                                <th>Total Service Charge</th>
                                <th>Total Collection</th>
                                <th>Vendor Service Charge</th>
                                <th>Pending Collection</th>
                            </tr>
                        </thead>
                        <tbody id="dashboard-job-interview-report-table">
                            @include('dashboard-job-interview-report-table')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- MEDICAL REPORT --}}
        <div class="col-lg-12">
            <div class="table_right">
                <div class="py-3">
                    <h4 class="card-header__title">Medical Report</h4>
                </div>
                <div class="justify-content-end mb-2 d-flex">
                    @php
                    $year = date('Y');
                    $months = [
                    '01' => 'January',
                    '02' => 'February',
                    '03' => 'March',
                    '04' => 'April',
                    '05' => 'May',
                    '06' => 'June',
                    '07' => 'July',
                    '08' => 'August',
                    '09' => 'September',
                    '10' => 'October',
                    '11' => 'November',
                    '12' => 'December',
                    ];
                    @endphp

                    <div class="dashboard_graph" style="margin-right: 5px;">
                        <select id="filter-month" class="form-select" style="width: 150px;">
                            <option value="" selected>Select Month</option>
                            @foreach ($months as $key => $month)
                            <option value="{{ $key }}">{{ $month }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="dashboard_graph" style="margin-right: 5px;">
                        <select id="filter-year" class="form-select" style="width: 150px;">
                            <option value="" selected>Select Year</option>
                            @for ($i = 2023; $i <= date('Y'); $i++)
                                <option value="{{ $i }}">{{ $i }}
                                </option>
                                @endfor
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 thead-border-top-0">
                        <thead>
                            <tr>
                                <th>COMPANY NAME</th>
                                <th>MEDICAL FIT</th>
                                <th>MEDICAL UNFIT</th>
                                <th>MEDICAL BACKOUT</th>
                                <th>MEDICAL REPEAT</th>
                                <th>MEDICAL PENDING</th>
                            </tr>
                        </thead>
                        <tbody id="dashboard-job-medical-report-table">
                            @include('dashboard-job-medical-report-table')

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- <div class="row">
                    <div class="col-lg-4">

                        <div class="calendar-container wrapper">
                            <div class="calendar-header header">
                                <button id="prev" class="icon">&lt;</button>
                                <h2 id="month-year" class="current-date">Month Year</h2>
                                <button id="next" class="icon">&gt;</button>
                            </div>
                            <div class="calendar-body calendar">
                                <div class="weekdays">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <ul class="days" id="dates-container">

                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="interview-card">
                            @include('dashboard-interview-card')
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="dashboard_graph">
                            <input type="text" class="form-control new_date" id="date-range">
                        </div>
                        <div class="dashboard_graph" id="installment-pie-chart">
                            @include('installment-pie-chart')
                        </div>
                    </div>

                </div> --}}

    {{-- chart end --}}
    @endif
</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $('#filter-month, #filter-year').on('change', function() {
        let month = $('#filter-month').val();
        let year = $('#filter-year').val();

        $.ajax({
            url: "{{ route('dashboard.job.medical.report.filter') }}",
            method: "GET",
            data: {
                month: month,
                year: year
            },
            success: function(response) {
                $('#dashboard-job-medical-report-table').html(response.html);
            },
            error: function() {
                alert('Something went wrong while filtering.');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('change', '#company-filter, #interview-yearly, #interview-monthly', function() {
            let companyId = $('#company-filter').val();
            let year = $('#interview-yearly').val();
            let month = $('#interview-monthly').val();

            $.ajax({
                url: "{{ route('report.job-interview.ajax') }}",
                method: "GET",
                data: {
                    year: year,
                    month: month,
                    company_id: companyId
                },
                success: function(response) {
                    $('#dashboard-job-interview-report-table').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<script>
    document.getElementById('interview-yearly').addEventListener('change', updateExportLink);
    document.getElementById('interview-monthly').addEventListener('change', updateExportLink);
    document.getElementById('company-filter').addEventListener('change', updateExportLink);

    function updateExportLink() {
        const year = document.getElementById('interview-yearly').value;
        const month = document.getElementById('interview-monthly').value;
        const exportButton = document.getElementById('export-button');
        const companyId = document.getElementById('company-filter').value;

        const baseUrl = "{{ route('report.job-interview.export') }}";
        exportButton.href = `${baseUrl}?year=${year}&month=${month}&company_id=${companyId}`;
    }
</script>
<script>
    $('.new_date').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
            // select start date and end date today to last 30 days
            startDate: moment().subtract(30, 'days'),
            endDate: moment(),
        },
        function(start, end, label) {
            var start_date = start.format('DD-MM-YYYY');
            var end_date = end.format('DD-MM-YYYY');
            var installmentPieChartUrl = "{{ route('installment.pie-chart') }}";
            $.ajax({
                url: installmentPieChartUrl,
                type: 'POST', // or 'GET', depending on your endpoint's requirements
                dataType: 'json', // Expecting JSON data in response
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    start_date: start_date,
                    end_date: end_date
                }), // Send the selected date as JSON
                contentType: 'application/json', // Setting the content type of the request
                success: function(response) {
                    // Update the chart container with the new view content
                    $('#installment-pie-chart').html(response.view);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
</script>
<script>
    const daysTag = document.querySelector(".days");
    const currentDate = document.querySelector(".current-date");
    const prevNextIcon = document.querySelectorAll('.icon');

    let date = new Date();
    let currYear = date.getFullYear();
    let currMonth = date.getMonth();

    const months = ["January", "February", "March", "April", "May", "June", "July",
        "August", "September", "October", "November", "December"
    ];

    const renderCalendar = () => {
        let firstDayOfMonth = new Date(currYear, currMonth, 1).getDay();
        let lastDateOfMonth = new Date(currYear, currMonth + 1, 0).getDate();
        let lastDayOfMonth = new Date(currYear, currMonth, lastDateOfMonth).getDay();
        let lastDateOfLastMonth = new Date(currYear, currMonth, 0).getDate();
        let liTag = "";

        for (let i = firstDayOfMonth; i > 0; i--) {
            liTag += `<li class="inactive">${lastDateOfLastMonth - i + 1}</li>`;
        }

        for (let i = 1; i <= lastDateOfMonth; i++) {
            let isToday = i === date.getDate() && currMonth === date.getMonth() && currYear === date.getFullYear() ?
                "active" : "";
            liTag += `<li class="date ${isToday}" data-date="${i}">${i}</li>`;
        }

        for (let i = lastDayOfMonth; i < 6; i++) {
            liTag += `<li class="inactive">${i - lastDayOfMonth + 1}</li>`;
        }

        currentDate.innerText = `${months[currMonth]} ${currYear}`;
        daysTag.innerHTML = liTag;

        // Add event listeners to all date elements
        const dateElements = document.querySelectorAll('.date');
        dateElements.forEach(dateElement => {
            dateElement.addEventListener('click', () => {
                var selectedDate =
                    `${String(dateElement.dataset.date).padStart(2, '0')}/${String(currMonth + 1).padStart(2, '0')}/${currYear}`;
                var interviewListUrl = "{{ route('interview.list') }}";
                $.ajax({
                    url: interviewListUrl,
                    type: 'POST', // or 'GET', depending on your endpoint's requirements
                    dataType: 'json', // Expecting JSON data in response
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        date: selectedDate
                    }), // Send the selected date as JSON
                    contentType: 'application/json', // Setting the content type of the request
                    success: function(response) {
                        //response view
                        $('.interview-card').html(response.view);
                        dateElements.forEach(el => el.classList.remove('active'));
                        dateElement.classList.add('active');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    }

    renderCalendar();

    prevNextIcon.forEach(icon => {
        icon.addEventListener("click", () => {
            currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

            if (currMonth < 0 || currMonth > 11) {
                date = new Date(currYear, currMonth, new Date().getDate());
                currYear = date.getFullYear();
                currMonth = date.getMonth();
            } else {
                date = new Date();
            }

            renderCalendar();
        });
    });
</script>

<script>
    // Function to initialize the Chart
    function initializeChart(chartData) {
        new Chart(document.getElementById('myChart'), {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true
                    }
                }
            }
        });
    }

    // Ajax request on change
    $(document).ready(function() {
        $(document).on('change', '#interview-line-chart-yearly', function() {
            var year = $(this).val();
            $.ajax({
                url: "{{ route('interview.chart-yearly') }}",
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    year: year
                }),
                contentType: 'application/json',
                success: function(response) {
                    // Update the chart container with the new view content
                    $('#dashboard-interview-chart').html(response.view);

                    // If the chartData is included in the response, reinitialize the chart
                    if (response.chartData) {
                        initializeChart(response.chartDataJSON);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        // Initial chart initialization
        initializeChart(<?php echo $chartDataJSON; ?>);
    });
</script>
@endpush