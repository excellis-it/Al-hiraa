@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Company View
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <section class="companey_details">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="compan_img">
                                    @if ($company->company_logo)
                                        <img src="{{Storage::url($company->company_logo)}}" alt="">
                                    @else
                                        <img src="{{ asset('assets/images/Burger.png') }}" alt="">
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="compan_text">
                                    <h4>{{ $company->company_name ?? 'N/A' }}</h4>
                                    <p><svg xmlns="http://www.w3.org/2000/svg" width="12" height="14.427"
                                            viewBox="0 0 12 14.427">
                                            <path id="marker"
                                                d="M8.019.042a6.006,6.006,0,0,0-6,6c0,1.545,1.2,3.963,3.556,7.186a3.026,3.026,0,0,0,4.888,0C12.822,10,14.019,7.586,14.019,6.041a6.006,6.006,0,0,0-6-6Zm0,8.39a2.4,2.4,0,1,1,2.4-2.4A2.4,2.4,0,0,1,8.019,8.432Z"
                                                transform="translate(-2.019 -0.042)" fill="#6a6a6a" />
                                        </svg>
                                        {{ $company->company_address ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-end">
                            <a href="" class="company_details_edt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 54 54">
                                    <g id="Group_87" data-name="Group 87" transform="translate(-1762 -102)">
                                        <g id="Ellipse_44" data-name="Ellipse 44" transform="translate(1762 102)"
                                            fill="#fff" stroke="#dedede" stroke-width="2">
                                            <circle cx="27" cy="27" r="27" stroke="none" />
                                            <circle cx="27" cy="27" r="26" fill="none" />
                                        </g>
                                        <g id="pencil" transform="translate(1778.999 119)">
                                            <path id="Path_125" data-name="Path 125"
                                                d="M12.17,5.687,0,17.857v3.092H3.092l12.17-12.17Z"
                                                transform="translate(0 -0.948)" fill="#6a6a6a" />
                                            <path id="Path_126" data-name="Path 126"
                                                d="M22.031.64a2.187,2.187,0,0,0-3.092,0L16.022,3.561l3.091,3.091L22.03,3.735a2.187,2.187,0,0,0,0-3.1Z"
                                                transform="translate(-2.67)" fill="#6a6a6a" />
                                        </g>
                                    </g>
                                </svg>
                            </a>
                            <a href="" class="company_details_edt">
                                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 54 54">
                                    <g id="Group_88" data-name="Group 88" transform="translate(-1836 -102)">
                                        <circle id="Ellipse_45" data-name="Ellipse 45" cx="27" cy="27" r="27"
                                            transform="translate(1836 102)" fill="#f2f2f2" />
                                        <path id="Path_127" data-name="Path 127"
                                            d="M2.171,0A2.171,2.171,0,1,1,0,2.171,2.171,2.171,0,0,1,2.171,0Z"
                                            transform="translate(1861 120)" fill="#989898" />
                                        <circle id="Ellipse_51" data-name="Ellipse 51" cx="2" cy="2" r="2"
                                            transform="translate(1861 128)" fill="#989898" />
                                        <circle id="Ellipse_52" data-name="Ellipse 52" cx="2" cy="2" r="2"
                                            transform="translate(1861 135)" fill="#989898" />
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            {{-- <section class="companey_details">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="d-flex align-items-center">
                            <div class="compan_text">
                                <h4>CONTACTS</h4>
                            </div>
                            <div>
                                <div class="name_text">
                                    <span>MS</span>
                                </div>
                            </div>
                            <div class="plus_tt">
                                <a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.333" height="15.333"
                                        viewBox="0 0 15.333 15.333">
                                        <path id="plus-small"
                                            d="M20.056,12.389H14.944V7.278A1.278,1.278,0,0,0,13.667,6h0a1.278,1.278,0,0,0-1.278,1.278v5.111H7.278A1.278,1.278,0,0,0,6,13.667H6a1.278,1.278,0,0,0,1.278,1.278h5.111v5.111a1.278,1.278,0,0,0,1.278,1.278h0a1.278,1.278,0,0,0,1.278-1.278V14.944h5.111a1.278,1.278,0,0,0,1.278-1.278h0A1.278,1.278,0,0,0,20.056,12.389Z"
                                            transform="translate(-6 -6)" />
                                    </svg>
                                </a>
                            </div>
                            <div class="view_all_contacts">
                                <a href="">View All Contacts</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="me-4 name_jjj">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24.502" height="24.502"
                                    viewBox="0 0 24.502 24.502">
                                    <g id="user_2_" data-name="user (2)" transform="translate(0.25 0.25)">
                                        <g id="Group_12" data-name="Group 12">
                                            <path id="Path_124" data-name="Path 124"
                                                d="M21.648,19.14a12.011,12.011,0,1,0-.846,1.02A12.081,12.081,0,0,0,21.648,19.14ZM20.983,18A10.8,10.8,0,1,0,3.019,18,10.818,10.818,0,0,1,9.27,13.549a4.8,4.8,0,1,1,5.462,0A10.818,10.818,0,0,1,20.983,18ZM20.21,19.02a9.6,9.6,0,0,0-16.418,0,10.8,10.8,0,0,0,16.418,0ZM12,13.2A3.6,3.6,0,1,0,8.4,9.6,3.6,3.6,0,0,0,12,13.2Z"
                                                fill="#6a6a6a" stroke="#707070" stroke-width="0.5"
                                                fill-rule="evenodd" />
                                        </g>
                                    </g>
                                </svg>
                                <span>{{ substr($company->user->first_name, 0, 1) ?? 'N/A' }} {{ substr($company->user->last_name, 0, 1) ?? '' }}</span>
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20.002" height="20.001"
                                        viewBox="0 0 20.002 20.001">
                                        <g id="pencil" transform="translate(0 0)">
                                            <path id="Path_125" data-name="Path 125"
                                                d="M12.17,5.687,0,17.857v3.092H3.092l12.17-12.17Z"
                                                transform="translate(0 -0.948)" fill="#6a6a6a" />
                                            <path id="Path_126" data-name="Path 126"
                                                d="M22.031.64a2.187,2.187,0,0,0-3.092,0L16.022,3.561l3.091,3.091L22.03,3.735a2.187,2.187,0,0,0,0-3.1Z"
                                                transform="translate(-2.67)" fill="#6a6a6a" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                            <div class="text-end">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.989" height="22.002"
                                    viewBox="0 0 23.989 24.002">
                                    <g id="time-forward" transform="translate(-0.011)">
                                        <path id="Path_122" data-name="Path 122"
                                            d="M23,11a1,1,0,0,0-1,1,10.034,10.034,0,1,1-2.9-7.021A.862.862,0,0,1,19,5H16a1,1,0,0,0,0,2h3a3,3,0,0,0,3-3V1a1,1,0,0,0-2,0V3.065A11.994,11.994,0,1,0,24,12,1,1,0,0,0,23,11Z"
                                            fill="#6a6a6a" />
                                        <path id="Path_123" data-name="Path 123"
                                            d="M12,6a1,1,0,0,0-1,1v5a1,1,0,0,0,.293.707l3,3a1,1,0,1,0,1.414-1.414L13,11.586V7a1,1,0,0,0-1-1Z"
                                            fill="#6a6a6a" />
                                    </g>
                                </svg>
                                 {{ $company->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
            <section class="company_deii">
                <div class="mb-4">
                    <h4>Company Details:</h4>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <h4>Description:</h4>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <h4><span>{{ $company->company_description ?? 'N/A' }}</span></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <h4>Address:</h4>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <h4><span>{{ $company->company_address ?? 'N/A' }}</span></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <h4>Industry:</h4>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <h4><span>{{ $company->company_industry ?? 'N/A' }}</span></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <h4>Website:</h4>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <h4><span>{{ $company->company_website ?? 'N/A' }}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="container-fluid page__container">
            <div class="row">
                <div class="col-lg-12 col-md-12 text_left_td_th">
                    <ul class="nav nav-tabs open_jobs_tab" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="openjob-tab" data-bs-toggle="tab"
                                data-bs-target="#openjob" type="button" role="tab" aria-controls="openjob"
                                aria-selected="true">Open Jobs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="closejob-tab" data-bs-toggle="tab" data-bs-target="#closejob"
                                type="button" role="tab" aria-controls="closejob"
                                aria-selected="false">Closed/Other Jobs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="stats-tab" data-bs-toggle="tab" data-bs-target="#stats"
                                type="button" role="tab" aria-controls="stats" aria-selected="false">Stats</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="openjob" role="tabpanel"
                            aria-labelledby="openjob-tab">
                            <div class="table-responsive border-bottom" data-toggle="lists">
                                <table class="table mb-0 table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:5px;">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </th>
                                            <th>Job</th>
                                            <th>Date</th>
                                            <th>Interview</th>
                                            <th>Selected</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="user_tbody">
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </td>
                                            <td>Active</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </td>
                                            <td>Active</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </td>
                                            <td>Active</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xxl-2 col-xl-3 col-md-6">
                                    <a href="" class="btn-2">See Pipeline</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="closejob" role="tabpanel" aria-labelledby="closejob-tab">
                            <div class="table-responsive border-bottom" data-toggle="lists">
                                <table class="table mb-0 table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </th>
                                            <th>Job</th>
                                            <th>Date</th>
                                            <th>Interview</th>
                                            <th>Selected</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="user_tbody">
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </td>
                                            <td>Active</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </td>
                                            <td>Active</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </td>
                                            <td>Active</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xxl-2 col-xl-3 col-md-6">
                                    <a href="" class="btn-2">See Pipeline</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                            <div class="table-responsive border-bottom" data-toggle="lists">
                                <table class="table mb-0 table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </th>
                                            <th>Job</th>
                                            <th>Date</th>
                                            <th>Interview</th>
                                            <th>Selected</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="user_tbody">
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </td>
                                            <td>Active</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </td>
                                            <td>Active</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input js-check-selected-row">
                                                </div>
                                            </td>
                                            <td>Active</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                            <td>Jhon Doe</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xxl-2 col-xl-3 col-md-6">
                                    <a href="" class="btn-2">See Pipeline</a>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
