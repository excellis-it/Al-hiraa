@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Dashboard
@endsection
@push('styles')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endpush
@section('content')
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
            @if (Auth::user()->hasRole('ADMIN'))
                <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 staye">
                    <div class="col">
                        <div class="border_left_hh">
                            <div class="card-header__title mb-2">All Time Stats</div>
                            <div class="text-amount">{{ $count['total_candidate_entry'] }} </div>
                            <div class="text-stats">Candidate Entry</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border_left_hh">
                            <div class="card-header__title mb-2">Monthly Stats</div>
                            <div class="text-amount">{{ $count['monthly_candidate_entry'] }} </div>
                            <div class="text-stats">Candidate Entry</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border_left_hh">
                            <div class="card-header__title mb-2">Today Stats</div>
                            <div class="text-amount">{{ $count['today_candidate_entry'] }} </div>
                            <div class="text-stats">Candidate Entry</div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="border_left_hh">
                            <div class="card-header__title mb-2">Last Month</div>
                            <div class="text-amount">{{ $count['last_month_candidate_entry'] }}</div>
                            <div class="text-stats">Candidate Entry</div>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->hasRole('RECRUITER'))
                <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 staye">
                    <div class="col">
                        <div class="border_left_hh">
                            <div class="card-header__title mb-2">Daily Entry</div>
                            <div class="text-amount">{{ $count['daily_entry'] }} </div>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ route('candidates.index', ['call_status' => 'Call Back']) }}">
                            <div class="border_left_hh">
                                <div class="card-header__title mb-2">Call Back</div>
                                <div class="text-amount">{{ $count['call_back'] }} </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <div class="border_left_hh">
                            <div class="card-header__title mb-2">Interview Schedule</div>
                            <div class="text-amount">{{ $count['interview_schedule'] }} </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="border_left_hh">
                            <div class="card-header__title mb-2">Selection</div>
                            <div class="text-amount">{{ $count['selection'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="table_right">
                            <div class="py-3">
                                <h4 class="card-header__title">New Job Opening</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 thead-border-top-0">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Job Title</th>
                                            <th>Job Postion</th>
                                            <th>Job Location </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($new_jobs_openings) > 0)
                                            @foreach ($new_jobs_openings as $new_jobs_opening)
                                                <tr>
                                                    <td>{{ $new_jobs_opening->company ? $new_jobs_opening->company->company_name : '' }}
                                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->job_name : '' }}</td>
                                                    <td>{{  isset($new_jobs_opening->job->candidatePosition) ? $new_jobs_opening->job->candidatePosition->name : '' }} </td>
                                                    <td>{{ $new_jobs_opening->job ? $new_jobs_opening->job->address : '' }}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td colspan="4" class="text-left">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="">
                                                            (Showing {{ $new_jobs_openings->firstItem() }} –
                                                            {{ $new_jobs_openings->lastItem() }} users of
                                                            {{ $new_jobs_openings->total() }} users)
                                                        </div>
                                                        <div>{!! $new_jobs_openings->links() !!}</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No data found</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->hasRole('ADMIN'))
                {{-- chart --}}
                <div class="row">
                    <div class="col-lg-6">
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
                                            <th>Appear</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('dashboard-users-table')

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="row">
                    <div class="col-lg-4">

=======
            </div>
            <div class="row">
                <div class="col-lg-4">
                    
>>>>>>> shreeja
                        <div class="calendar-container wrapper">
                            <div class="calendar-header header">
                                <button id="prev" class="icon">&lt;</button>
                                <h2 id="month-year" class="current-date">Month Year</h2>
                                <button id="next" class="icon">&gt;</button>
                                {{-- <div class="icons">
                                    <span class="icon">Icon 1</span>
                                    <span class="icon">Icon 2</span>
                                </div> --}}
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
                        {{-- <div class="">
                        <button class="btn btn-info">>> next</button>
                    </div> --}}
                    </div>
                    <div class="col-lg-4">
                        {{--  --}}
                        <div class="dashboard_graph">
                            <input type="text" class="form-control new_date" id="date-range">
                        </div>
                        <div class="dashboard_graph" id="installment-pie-chart">
                            @include('installment-pie-chart')

                        </div>
                    </div>

                </div>

                {{-- chart end --}}
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
                    url: '{{ route('interview.chart-yearly') }}',
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
