@extends('layouts.master')
@section('title')
    {{env('APP_NAME')}} - Dashboard
@endsection
@push('styles')
@endpush
@section('content')
<div class="mdk-drawer-layout__content page">
    <div class="container-fluid page__container">
        <div class="page__heading">
            <div class="row">
                <div class="col-xl-10 col-lg-8 col-md-7 col-6">
                    <div class="">
                        {{-- <form class="search-form d-flex" action="index.html">
                            <button class="btn" type="submit" role="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                            <input type="text" class="form-control" placeholder="Advance Search..">
                        </form> --}}
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 col-xl-2 col-6">
                    <a href="{{route('candidates.create')}}" class="support_btn">
                        <span>Add Candidate</span>
                        <span>
                            <i class="fas fa-plus"></i>

                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 staye">
            <div class="col">
                <div class="border_left_hh">
                    <div class="card-header__title mb-2">All Time Stats</div>
                    <div class="text-amount">{{ $count['total_candidate_entry']}} </div>
                    <div class="text-stats">Candidate Entry</div>
                </div>
            </div>
            <div class="col">
                <div class="border_left_hh">
                    <div class="card-header__title mb-2">Monthly Stats</div>
                    <div class="text-amount">{{ $count['monthly_candidate_entry']}} </div>
                    <div class="text-stats">Candidate Entry</div>
                </div>
            </div>
            <div class="col">
                <div class="border_left_hh">
                    <div class="card-header__title mb-2">Today Stats</div>
                    <div class="text-amount">{{ $count['today_candidate_entry']}} </div>
                    <div class="text-stats">Candidate Entry</div>
                </div>
            </div>


            <div class="col">
                <div class="border_left_hh">
                    <div class="card-header__title mb-2">Stats</div>
                    <div class="text-amount">10,549</div>
                    <div class="text-stats">Compare to last month</div>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- <div class="col-lg-6">
                <div class="dashboard_graph">
                    <img src="{{asset('assets/images/sidebar-icon/graph.png')}}"/>
                </div>
            </div> --}}
            {{-- <div class="col-lg-6">
                <div class="table_right">
                    <div class="py-3">
                        <h4 class="card-header__title">Last 5 Candidate Entry</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Enter By</th>
                                    <th>Status</th>
                                    <th>Mode of Registration</th>
                                    <th>Source</th>
                                    <th>Last Update Date</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>Age</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($candidates) > 0)
                                @foreach ($candidates as $item)
                                <tr>
                                    <td>{{ $item->enterBy->full_name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="round_staus active">
                                            {{ $item->candidateStatus->name ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td>{{ $item->mode_of_registration ?? 'N/A' }}</td>
                                    <td>
                                        {{ $item->source ?? 'N/A' }}
                                    </td>
                                    <td>{{ $item->last_update_date != null ? date('d.m.Y', strtotime($item->last_update_date)) : 'N/A' }}</td>
                                    <td>{{ $item->full_name ?? 'N/A' }}</td>
                                    <td>{{ $item->gender ?? 'N/A' }}</td>
                                    <td>{{ $item->date_of_birth != null ? date('d.m.Y', strtotime($item->date_of_birth)) : 'N/A' }}</td>
                                    <td>{{  $item->date_of_birth != null ? \Carbon\Carbon::parse($item->date_of_birth)->age : 'N/A' }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9" class="text-center">No Data Found</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-lg-6">
                <div class="table_right">
                    <div class="py-3">
                        <h4 class="card-header__title">Current Users</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 thead-border-top-0">
                            <thead>
                                <tr>
                                    <th>Team Member</th>
                                    <th>Data Added</th>
                                    <th>Interview Schedule</th>
                                    <th>Appear</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1306 -464)">
                                                  <g id="Ellipse_124" data-name="Ellipse 124" transform="translate(1306 464)" fill="#fff" stroke="#d9d9d9" stroke-width="1">
                                                    <ellipse cx="12.5" cy="12" rx="12.5" ry="12" stroke="none"/>
                                                    <ellipse cx="12.5" cy="12" rx="12" ry="11.5" fill="none"/>
                                                  </g>
                                                  <g id="user" transform="translate(1314.853 470.551)">
                                                    <ellipse id="Ellipse_12" data-name="Ellipse 12" cx="2.588" cy="2.588" rx="2.588" ry="2.588" transform="translate(1.122 0)" fill="#6a6a6a"/>
                                                    <path id="Path_28" data-name="Path 28" d="M67.882,298.667A3.887,3.887,0,0,0,64,302.549a.431.431,0,0,0,.431.431h6.9a.431.431,0,0,0,.431-.431A3.887,3.887,0,0,0,67.882,298.667Z" transform="translate(-64 -292.628)" fill="#6a6a6a"/>
                                                  </g>
                                                </g>
                                            </svg>
                                            <span class="">John Doe, <small>Agent, Manager</small></span>
                                        </div>
                                    </td>
                                    <td>650</td>
                                    <td>500</td>
                                    <td>463</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1306 -464)">
                                                  <g id="Ellipse_124" data-name="Ellipse 124" transform="translate(1306 464)" fill="#fff" stroke="#d9d9d9" stroke-width="1">
                                                    <ellipse cx="12.5" cy="12" rx="12.5" ry="12" stroke="none"/>
                                                    <ellipse cx="12.5" cy="12" rx="12" ry="11.5" fill="none"/>
                                                  </g>
                                                  <g id="user" transform="translate(1314.853 470.551)">
                                                    <ellipse id="Ellipse_12" data-name="Ellipse 12" cx="2.588" cy="2.588" rx="2.588" ry="2.588" transform="translate(1.122 0)" fill="#6a6a6a"/>
                                                    <path id="Path_28" data-name="Path 28" d="M67.882,298.667A3.887,3.887,0,0,0,64,302.549a.431.431,0,0,0,.431.431h6.9a.431.431,0,0,0,.431-.431A3.887,3.887,0,0,0,67.882,298.667Z" transform="translate(-64 -292.628)" fill="#6a6a6a"/>
                                                  </g>
                                                </g>
                                            </svg>
                                            <span class="">John Doe, <small>Agent, Manager</small></span>
                                        </div>
                                    </td>
                                    <td>650</td>
                                    <td>500</td>
                                    <td>463</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1306 -464)">
                                                  <g id="Ellipse_124" data-name="Ellipse 124" transform="translate(1306 464)" fill="#fff" stroke="#d9d9d9" stroke-width="1">
                                                    <ellipse cx="12.5" cy="12" rx="12.5" ry="12" stroke="none"/>
                                                    <ellipse cx="12.5" cy="12" rx="12" ry="11.5" fill="none"/>
                                                  </g>
                                                  <g id="user" transform="translate(1314.853 470.551)">
                                                    <ellipse id="Ellipse_12" data-name="Ellipse 12" cx="2.588" cy="2.588" rx="2.588" ry="2.588" transform="translate(1.122 0)" fill="#6a6a6a"/>
                                                    <path id="Path_28" data-name="Path 28" d="M67.882,298.667A3.887,3.887,0,0,0,64,302.549a.431.431,0,0,0,.431.431h6.9a.431.431,0,0,0,.431-.431A3.887,3.887,0,0,0,67.882,298.667Z" transform="translate(-64 -292.628)" fill="#6a6a6a"/>
                                                  </g>
                                                </g>
                                            </svg>
                                            <span class="">John Doe, <small>Agent, Manager</small></span>
                                        </div>
                                    </td>
                                    <td>650</td>
                                    <td>500</td>
                                    <td>463</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1306 -464)">
                                                  <g id="Ellipse_124" data-name="Ellipse 124" transform="translate(1306 464)" fill="#fff" stroke="#d9d9d9" stroke-width="1">
                                                    <ellipse cx="12.5" cy="12" rx="12.5" ry="12" stroke="none"/>
                                                    <ellipse cx="12.5" cy="12" rx="12" ry="11.5" fill="none"/>
                                                  </g>
                                                  <g id="user" transform="translate(1314.853 470.551)">
                                                    <ellipse id="Ellipse_12" data-name="Ellipse 12" cx="2.588" cy="2.588" rx="2.588" ry="2.588" transform="translate(1.122 0)" fill="#6a6a6a"/>
                                                    <path id="Path_28" data-name="Path 28" d="M67.882,298.667A3.887,3.887,0,0,0,64,302.549a.431.431,0,0,0,.431.431h6.9a.431.431,0,0,0,.431-.431A3.887,3.887,0,0,0,67.882,298.667Z" transform="translate(-64 -292.628)" fill="#6a6a6a"/>
                                                  </g>
                                                </g>
                                            </svg>
                                            <span class="">John Doe, <small>Agent, Manager</small></span>
                                        </div>
                                    </td>
                                    <td>650</td>
                                    <td>500</td>
                                    <td>463</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1306 -464)">
                                                  <g id="Ellipse_124" data-name="Ellipse 124" transform="translate(1306 464)" fill="#fff" stroke="#d9d9d9" stroke-width="1">
                                                    <ellipse cx="12.5" cy="12" rx="12.5" ry="12" stroke="none"/>
                                                    <ellipse cx="12.5" cy="12" rx="12" ry="11.5" fill="none"/>
                                                  </g>
                                                  <g id="user" transform="translate(1314.853 470.551)">
                                                    <ellipse id="Ellipse_12" data-name="Ellipse 12" cx="2.588" cy="2.588" rx="2.588" ry="2.588" transform="translate(1.122 0)" fill="#6a6a6a"/>
                                                    <path id="Path_28" data-name="Path 28" d="M67.882,298.667A3.887,3.887,0,0,0,64,302.549a.431.431,0,0,0,.431.431h6.9a.431.431,0,0,0,.431-.431A3.887,3.887,0,0,0,67.882,298.667Z" transform="translate(-64 -292.628)" fill="#6a6a6a"/>
                                                  </g>
                                                </g>
                                            </svg>
                                            <span class="">John Doe, <small>Agent, Manager</small></span>
                                        </div>
                                    </td>
                                    <td>650</td>
                                    <td>500</td>
                                    <td>463</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
        {{-- <div class="row">
            <div class="col-lg-4">
                <div class="dashboard_graph">
                    <img src="{{asset('assets/images/sidebar-icon/calennder_icon.png')}}"/>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="food-box border_radius_0">
                    <div class="food-box-img">
                        <img src="{{asset('assets/images/Burger.png')}}" alt="">
                    </div>
                    <div class="food-box-head">
                        <h3>Burger King Interview</h3>
                    </div>
                    <div class="food-status">
                        <div class="food-status-1">
                            <h4>Interview Venue:</h4>
                        </div>
                        <div class="food-status-2">
                            <h4>Kolkata</h4>
                        </div>
                    </div>
                    <div class="food-status">
                        <div class="food-status-1">
                            <h4>Positions:</h4>
                        </div>
                        <div class="food-status-2">
                            <h4>Electricians</h4>
                        </div>
                    </div>
                    <div class="food-status">
                        <div class="food-status-1">
                            <h4>Interview Assigned:</h4>
                        </div>
                        <div class="food-status-2">
                            <h4>09/07/2023</h4>
                        </div>
                    </div>
                    <div class="food-status">
                        <div class="food-status-1">
                            <h4>Interview Venue:</h4>
                        </div>
                        <div class="food-status-2">
                            <h4>Kolkata</h4>
                        </div>
                    </div>
                    <div class="food-status">
                        <div class="food-status-1">
                            <h4>Positions:</h4>
                        </div>
                        <div class="food-status-2">
                            <h4>Electricians</h4>
                        </div>
                    </div>
                    <div class="food-status">
                        <div class="food-status-1">
                            <h4>Interview Assigned:</h4>
                        </div>
                        <div class="food-status-2">
                            <h4>09/07/2023</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dashboard_graph">
                    <img src="{{asset('assets/images/sidebar-icon/coll.png')}}"/>
                </div>
            </div>

        </div> --}}

    </div>
</div>
@endsection

@push('scripts')

@endpush
