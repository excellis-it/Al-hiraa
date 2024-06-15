@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Jobs
@endsection
@push('styles')
@endpush
@section('content')
    @php
        use App\Helpers\Helper;
        use App\Constants\Position;
    @endphp

    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading row align-items-center">

                {{-- edit candidates --}}
                <div id="job-edit" class="jobs_canvas">
                    @include('jobs.edit')
                </div>
                {{-- end edit candidates --}}
                <div class="col-xl-8 col-lg-6 col-md-6 mb-3 mb-md-0">
                    <div class="d-flex w-100">
                        <form class="search-form d-flex w-100" id="search-form">
                            <button class="btn" type="submit" role="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="text" class="form-control" placeholder="Search.." name="query" id="query">
                            <div class="btn-group">
                                <button type="submit" class="btn advance_search_btn"
                                    style="border-right: none;">Search</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="d-flex justify-content-center justify-content-md-start">
                        
                       
                    </div>
                </div>

            </div>
            <section class="food-box-sec">
                <div class="food_box_slid">
                    <div class="food_box_padding">
                        <div class="food-box">
                            <div class="food-box-img">
                                <img src="{{asset('assets/images/Burger.png')}}" alt="">
                            </div>
                            <div class="food-box-head">
                                <h3>Burger King</h3>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Location:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Kolkata</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Status:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Ongoing</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Job Campaigns:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>----</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Date:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>23.04.2023</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Position:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Chef, Floor M
                                        <span class="info_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                                viewBox="0 0 11 11">
                                                <g id="info" transform="translate(-5 -29)" opacity="0.5">
                                                    <g id="Group_11" data-name="Group 11" transform="translate(5 29)">
                                                        <g id="Group_10" data-name="Group 10">
                                                            <path id="Path_93" data-name="Path 93"
                                                                d="M199.8,216.819a.535.535,0,0,1-.322-.073.335.335,0,0,1-.092-.275,1.428,1.428,0,0,1,.03-.25,2.754,2.754,0,0,1,.065-.28l.295-1.015a1.537,1.537,0,0,0,.06-.308c0-.112.015-.19.015-.235a.658.658,0,0,0-.232-.523.977.977,0,0,0-.66-.2,1.713,1.713,0,0,0-.5.083q-.265.082-.557.2l-.085.33c.057-.02.128-.042.207-.068a.85.85,0,0,1,.235-.035.48.48,0,0,1,.317.077.363.363,0,0,1,.083.273,1.186,1.186,0,0,1-.028.25q-.026.131-.067.277l-.3,1.02a2.913,2.913,0,0,0-.057.288,1.786,1.786,0,0,0-.018.25.652.652,0,0,0,.25.518,1,1,0,0,0,.67.205,1.542,1.542,0,0,0,.5-.073q.212-.073.568-.208l.08-.315a1.38,1.38,0,0,1-.2.065A.949.949,0,0,1,199.8,216.819Z"
                                                                transform="translate(-193.568 -209.069)" />
                                                            <path id="Path_94" data-name="Path 94"
                                                                d="M249.768,128.177a.76.76,0,0,0-1,0,.6.6,0,0,0,0,.9.75.75,0,0,0,1,0,.6.6,0,0,0,0-.9Z"
                                                                transform="translate(-243.22 -125.24)" />
                                                            <path id="Path_95" data-name="Path 95"
                                                                d="M5.5,0A5.5,5.5,0,1,0,11,5.5,5.5,5.5,0,0,0,5.5,0Zm0,10.5a5,5,0,1,1,5-5A5,5,0,0,1,5.5,10.5Z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <div class="">
                                <a href="" class="btn-1">See More<img src="{{asset('assets/images/arrow.png')}}"></a>
                            </div>
                        </div>
                    </div>
                    <div class="food_box_padding">
                        <div class="food-box">
                            <div class="food-box-img">
                                <img src="{{asset('assets/images/Burger.png')}}" alt="">
                            </div>
                            <div class="food-box-head">
                                <h3>Burger King</h3>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Location:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Kolkata</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Status:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Ongoing</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Job Campaigns:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>----</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Date:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>23.04.2023</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Position:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Chef, Floor M
                                        <span class="info_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                                viewBox="0 0 11 11">
                                                <g id="info" transform="translate(-5 -29)" opacity="0.5">
                                                    <g id="Group_11" data-name="Group 11" transform="translate(5 29)">
                                                        <g id="Group_10" data-name="Group 10">
                                                            <path id="Path_93" data-name="Path 93"
                                                                d="M199.8,216.819a.535.535,0,0,1-.322-.073.335.335,0,0,1-.092-.275,1.428,1.428,0,0,1,.03-.25,2.754,2.754,0,0,1,.065-.28l.295-1.015a1.537,1.537,0,0,0,.06-.308c0-.112.015-.19.015-.235a.658.658,0,0,0-.232-.523.977.977,0,0,0-.66-.2,1.713,1.713,0,0,0-.5.083q-.265.082-.557.2l-.085.33c.057-.02.128-.042.207-.068a.85.85,0,0,1,.235-.035.48.48,0,0,1,.317.077.363.363,0,0,1,.083.273,1.186,1.186,0,0,1-.028.25q-.026.131-.067.277l-.3,1.02a2.913,2.913,0,0,0-.057.288,1.786,1.786,0,0,0-.018.25.652.652,0,0,0,.25.518,1,1,0,0,0,.67.205,1.542,1.542,0,0,0,.5-.073q.212-.073.568-.208l.08-.315a1.38,1.38,0,0,1-.2.065A.949.949,0,0,1,199.8,216.819Z"
                                                                transform="translate(-193.568 -209.069)" />
                                                            <path id="Path_94" data-name="Path 94"
                                                                d="M249.768,128.177a.76.76,0,0,0-1,0,.6.6,0,0,0,0,.9.75.75,0,0,0,1,0,.6.6,0,0,0,0-.9Z"
                                                                transform="translate(-243.22 -125.24)" />
                                                            <path id="Path_95" data-name="Path 95"
                                                                d="M5.5,0A5.5,5.5,0,1,0,11,5.5,5.5,5.5,0,0,0,5.5,0Zm0,10.5a5,5,0,1,1,5-5A5,5,0,0,1,5.5,10.5Z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <div class="">
                                <a href="" class="btn-1">See More<img src="{{asset('assets/images/arrow.png')}}"></a>
                            </div>
                        </div>
                    </div>
                    <div class="food_box_padding">
                        <div class="food-box">
                            <div class="food-box-img">
                                <img src="assets/images/Burger.png" alt="">
                            </div>
                            <div class="food-box-head">
                                <h3>Burger King</h3>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Location:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Kolkata</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Status:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Ongoing</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Job Campaigns:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>----</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Date:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>23.04.2023</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Position:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Chef, Floor M
                                        <span class="info_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                                viewBox="0 0 11 11">
                                                <g id="info" transform="translate(-5 -29)" opacity="0.5">
                                                    <g id="Group_11" data-name="Group 11" transform="translate(5 29)">
                                                        <g id="Group_10" data-name="Group 10">
                                                            <path id="Path_93" data-name="Path 93"
                                                                d="M199.8,216.819a.535.535,0,0,1-.322-.073.335.335,0,0,1-.092-.275,1.428,1.428,0,0,1,.03-.25,2.754,2.754,0,0,1,.065-.28l.295-1.015a1.537,1.537,0,0,0,.06-.308c0-.112.015-.19.015-.235a.658.658,0,0,0-.232-.523.977.977,0,0,0-.66-.2,1.713,1.713,0,0,0-.5.083q-.265.082-.557.2l-.085.33c.057-.02.128-.042.207-.068a.85.85,0,0,1,.235-.035.48.48,0,0,1,.317.077.363.363,0,0,1,.083.273,1.186,1.186,0,0,1-.028.25q-.026.131-.067.277l-.3,1.02a2.913,2.913,0,0,0-.057.288,1.786,1.786,0,0,0-.018.25.652.652,0,0,0,.25.518,1,1,0,0,0,.67.205,1.542,1.542,0,0,0,.5-.073q.212-.073.568-.208l.08-.315a1.38,1.38,0,0,1-.2.065A.949.949,0,0,1,199.8,216.819Z"
                                                                transform="translate(-193.568 -209.069)" />
                                                            <path id="Path_94" data-name="Path 94"
                                                                d="M249.768,128.177a.76.76,0,0,0-1,0,.6.6,0,0,0,0,.9.75.75,0,0,0,1,0,.6.6,0,0,0,0-.9Z"
                                                                transform="translate(-243.22 -125.24)" />
                                                            <path id="Path_95" data-name="Path 95"
                                                                d="M5.5,0A5.5,5.5,0,1,0,11,5.5,5.5,5.5,0,0,0,5.5,0Zm0,10.5a5,5,0,1,1,5-5A5,5,0,0,1,5.5,10.5Z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <div class="">
                                <a href="" class="btn-1">See More<img src="{{asset('assets/images/arrow.png')}}"></a>
                            </div>
                        </div>
                    </div>
                    <div class="food_box_padding">
                        <div class="food-box">
                            <div class="food-box-img">
                                <img src="{{asset('assets/images/Burger.png')}}" alt="">
                            </div>
                            <div class="food-box-head">
                                <h3>Burger King</h3>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Location:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Kolkata</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Status:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Ongoing</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Job Campaigns:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>----</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Date:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>23.04.2023</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Position:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Chef, Floor M
                                        <span class="info_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                                viewBox="0 0 11 11">
                                                <g id="info" transform="translate(-5 -29)" opacity="0.5">
                                                    <g id="Group_11" data-name="Group 11" transform="translate(5 29)">
                                                        <g id="Group_10" data-name="Group 10">
                                                            <path id="Path_93" data-name="Path 93"
                                                                d="M199.8,216.819a.535.535,0,0,1-.322-.073.335.335,0,0,1-.092-.275,1.428,1.428,0,0,1,.03-.25,2.754,2.754,0,0,1,.065-.28l.295-1.015a1.537,1.537,0,0,0,.06-.308c0-.112.015-.19.015-.235a.658.658,0,0,0-.232-.523.977.977,0,0,0-.66-.2,1.713,1.713,0,0,0-.5.083q-.265.082-.557.2l-.085.33c.057-.02.128-.042.207-.068a.85.85,0,0,1,.235-.035.48.48,0,0,1,.317.077.363.363,0,0,1,.083.273,1.186,1.186,0,0,1-.028.25q-.026.131-.067.277l-.3,1.02a2.913,2.913,0,0,0-.057.288,1.786,1.786,0,0,0-.018.25.652.652,0,0,0,.25.518,1,1,0,0,0,.67.205,1.542,1.542,0,0,0,.5-.073q.212-.073.568-.208l.08-.315a1.38,1.38,0,0,1-.2.065A.949.949,0,0,1,199.8,216.819Z"
                                                                transform="translate(-193.568 -209.069)" />
                                                            <path id="Path_94" data-name="Path 94"
                                                                d="M249.768,128.177a.76.76,0,0,0-1,0,.6.6,0,0,0,0,.9.75.75,0,0,0,1,0,.6.6,0,0,0,0-.9Z"
                                                                transform="translate(-243.22 -125.24)" />
                                                            <path id="Path_95" data-name="Path 95"
                                                                d="M5.5,0A5.5,5.5,0,1,0,11,5.5,5.5,5.5,0,0,0,5.5,0Zm0,10.5a5,5,0,1,1,5-5A5,5,0,0,1,5.5,10.5Z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <div class="">
                                <a href="" class="btn-1">See More<img src="{{asset('assets/images/arrow.png')}}"></a>
                            </div>
                        </div>
                    </div>
                    <div class="food_box_padding">
                        <div class="food-box">
                            <div class="food-box-img">
                                <img src="{{asset('assets/images/Burger.png')}}" alt="">
                            </div>
                            <div class="food-box-head">
                                <h3>Burger King</h3>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Location:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Kolkata</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Status:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Ongoing</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Job Campaigns:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>----</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Date:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>23.04.2023</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Position:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Chef, Floor M
                                        <span class="info_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                                viewBox="0 0 11 11">
                                                <g id="info" transform="translate(-5 -29)" opacity="0.5">
                                                    <g id="Group_11" data-name="Group 11" transform="translate(5 29)">
                                                        <g id="Group_10" data-name="Group 10">
                                                            <path id="Path_93" data-name="Path 93"
                                                                d="M199.8,216.819a.535.535,0,0,1-.322-.073.335.335,0,0,1-.092-.275,1.428,1.428,0,0,1,.03-.25,2.754,2.754,0,0,1,.065-.28l.295-1.015a1.537,1.537,0,0,0,.06-.308c0-.112.015-.19.015-.235a.658.658,0,0,0-.232-.523.977.977,0,0,0-.66-.2,1.713,1.713,0,0,0-.5.083q-.265.082-.557.2l-.085.33c.057-.02.128-.042.207-.068a.85.85,0,0,1,.235-.035.48.48,0,0,1,.317.077.363.363,0,0,1,.083.273,1.186,1.186,0,0,1-.028.25q-.026.131-.067.277l-.3,1.02a2.913,2.913,0,0,0-.057.288,1.786,1.786,0,0,0-.018.25.652.652,0,0,0,.25.518,1,1,0,0,0,.67.205,1.542,1.542,0,0,0,.5-.073q.212-.073.568-.208l.08-.315a1.38,1.38,0,0,1-.2.065A.949.949,0,0,1,199.8,216.819Z"
                                                                transform="translate(-193.568 -209.069)" />
                                                            <path id="Path_94" data-name="Path 94"
                                                                d="M249.768,128.177a.76.76,0,0,0-1,0,.6.6,0,0,0,0,.9.75.75,0,0,0,1,0,.6.6,0,0,0,0-.9Z"
                                                                transform="translate(-243.22 -125.24)" />
                                                            <path id="Path_95" data-name="Path 95"
                                                                d="M5.5,0A5.5,5.5,0,1,0,11,5.5,5.5,5.5,0,0,0,5.5,0Zm0,10.5a5,5,0,1,1,5-5A5,5,0,0,1,5.5,10.5Z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <div class="">
                                <a href="" class="btn-1">See More<img src="{{asset('assets/images/arrow.png')}}"></a>
                            </div>
                        </div>
                    </div>
                    <div class="food_box_padding">
                        <div class="food-box">
                            <div class="food-box-img">
                                <img src="assets/images/Burger.png" alt="">
                            </div>
                            <div class="food-box-head">
                                <h3>Burger King</h3>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Location:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Kolkata</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Status:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Ongoing</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Job Campaigns:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>----</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Date:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>23.04.2023</h4>
                                </div>
                            </div>
                            <div class="food-status">
                                <div class="food-status-1">
                                    <h4>Position:</h4>
                                </div>
                                <div class="food-status-2">
                                    <h4>Chef, Floor M
                                        <span class="info_img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                                viewBox="0 0 11 11">
                                                <g id="info" transform="translate(-5 -29)" opacity="0.5">
                                                    <g id="Group_11" data-name="Group 11" transform="translate(5 29)">
                                                        <g id="Group_10" data-name="Group 10">
                                                            <path id="Path_93" data-name="Path 93"
                                                                d="M199.8,216.819a.535.535,0,0,1-.322-.073.335.335,0,0,1-.092-.275,1.428,1.428,0,0,1,.03-.25,2.754,2.754,0,0,1,.065-.28l.295-1.015a1.537,1.537,0,0,0,.06-.308c0-.112.015-.19.015-.235a.658.658,0,0,0-.232-.523.977.977,0,0,0-.66-.2,1.713,1.713,0,0,0-.5.083q-.265.082-.557.2l-.085.33c.057-.02.128-.042.207-.068a.85.85,0,0,1,.235-.035.48.48,0,0,1,.317.077.363.363,0,0,1,.083.273,1.186,1.186,0,0,1-.028.25q-.026.131-.067.277l-.3,1.02a2.913,2.913,0,0,0-.057.288,1.786,1.786,0,0,0-.018.25.652.652,0,0,0,.25.518,1,1,0,0,0,.67.205,1.542,1.542,0,0,0,.5-.073q.212-.073.568-.208l.08-.315a1.38,1.38,0,0,1-.2.065A.949.949,0,0,1,199.8,216.819Z"
                                                                transform="translate(-193.568 -209.069)" />
                                                            <path id="Path_94" data-name="Path 94"
                                                                d="M249.768,128.177a.76.76,0,0,0-1,0,.6.6,0,0,0,0,.9.75.75,0,0,0,1,0,.6.6,0,0,0,0-.9Z"
                                                                transform="translate(-243.22 -125.24)" />
                                                            <path id="Path_95" data-name="Path 95"
                                                                d="M5.5,0A5.5,5.5,0,1,0,11,5.5,5.5,5.5,0,0,0,5.5,0Zm0,10.5a5,5,0,1,1,5-5A5,5,0,0,1,5.5,10.5Z" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <div class="">
                                <a href="" class="btn-1">See More<img src="{{asset('assets/images/arrow.png')}}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="interview-sec">
                <div class="interview-head">
                    <h4>Interview Pipeline</h4>
                </div>
                <div class="interview-box-sec">
                    <div class="interview-slide">
                        <div class="interview-slide-wrap">
                            <div class="interview-box">
                                <div class="interview-box-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                        viewBox="0 0 35 35">
                                        <g id="job-interview" transform="translate(0)">
                                            <path id="Path_74" data-name="Path 74"
                                                d="M338.693,36.4a4.266,4.266,0,1,1-4.266-4.266A4.266,4.266,0,0,1,338.693,36.4Zm0,0"
                                                transform="translate(-307.591 -29.936)" />
                                            <path id="Path_75" data-name="Path 75"
                                                d="M19.451,11.989,17.426,8.952V3.771A3.768,3.768,0,0,0,13.656,0H3.771A3.769,3.769,0,0,0,0,3.771v6.04a3.768,3.768,0,0,0,3.771,3.771H18.6a1.026,1.026,0,0,0,.853-1.594ZM8.685,9.739H5.447a1.044,1.044,0,0,1-1.053-.977A1.025,1.025,0,0,1,5.419,7.688h3.3A1.025,1.025,0,0,1,9.738,8.762,1.044,1.044,0,0,1,8.685,9.739Zm3.324-3.844H5.448A1.044,1.044,0,0,1,4.395,4.92,1.025,1.025,0,0,1,5.419,3.844h6.561a1.044,1.044,0,0,1,1.053.977,1.025,1.025,0,0,1-1.024,1.074Zm0,0"
                                                transform="translate(0 0)" />
                                            <path id="Path_76" data-name="Path 76"
                                                d="M7.963,372.151A8.047,8.047,0,0,0,0,380.228v.225a1.257,1.257,0,0,0,1.257,1.257H14.724a1.257,1.257,0,0,0,1.257-1.257v-.312A7.991,7.991,0,0,0,7.963,372.151Zm0,0"
                                                transform="translate(0 -346.711)" />
                                            <path id="Path_77" data-name="Path 77"
                                                d="M53.353,229.965a5.032,5.032,0,1,1-5.032-5.032A5.032,5.032,0,0,1,53.353,229.965Zm0,0"
                                                transform="translate(-40.33 -209.557)" />
                                            <path id="Path_78" data-name="Path 78"
                                                d="M310.84,162.695H297.9a6.517,6.517,0,0,1,12.942,0Zm0,0"
                                                transform="translate(-277.534 -146.22)" />
                                            <path id="Path_79" data-name="Path 79"
                                                d="M216.6,272a1.025,1.025,0,0,1,1.025,1.025v12.159a1.025,1.025,0,0,1-1.075,1.024,1.045,1.045,0,0,1-.975-1.053v-1.142H200.258a10.085,10.085,0,0,0-4.227-5.632A7.073,7.073,0,0,0,197.469,272Zm0,0"
                                                transform="translate(-182.631 -253.406)" />
                                        </g>
                                    </svg>

                                </div>
                                <div class="interview-text">
                                    <h4>Interviews</h4>
                                    <h3>4.5k</h3>
                                </div>
                            </div>
                        </div>
                        <div class="interview-slide-wrap">
                            <div class="interview-box">
                                <div class="interview-box-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32.694" height="29.756"
                                        viewBox="0 0 32.694 29.756">
                                        <g id="selection_1_" data-name="selection (1)" transform="translate(0 -23)">
                                            <circle id="Ellipse_39" data-name="Ellipse 39" cx="3.815" cy="3.815"
                                                r="3.815" transform="translate(1.868 34.59)" />
                                            <circle id="Ellipse_40" data-name="Ellipse 40" cx="3.815" cy="3.815"
                                                r="3.815" transform="translate(23.067 34.59)" />
                                            <path id="Path_98" data-name="Path 98"
                                                d="M382.4,324.528a9.522,9.522,0,0,1,1.507,5.153v3.831h5.811a.958.958,0,0,0,.958-.958v-2.873A5.746,5.746,0,0,0,382.4,324.528Z"
                                                transform="translate(-357.978 -281.713)" />
                                            <path id="Path_99" data-name="Path 99"
                                                d="M0,329.745v2.8a.958.958,0,0,0,.958.958H6.769v-3.831a9.522,9.522,0,0,1,1.511-5.158A5.765,5.765,0,0,0,0,329.745Z"
                                                transform="translate(0 -281.705)" />
                                            <path id="Path_100" data-name="Path 100"
                                                d="M143.663,294A7.663,7.663,0,0,0,136,301.663v3.831a.958.958,0,0,0,.958.958h13.409a.958.958,0,0,0,.958-.958v-3.831A7.663,7.663,0,0,0,143.663,294Z"
                                                transform="translate(-127.316 -253.695)" />
                                            <path id="Path_101" data-name="Path 101"
                                                d="M197.76,28.467a.958.958,0,0,0,1.355,0l3.831-3.831a.958.958,0,0,0-1.355-1.355l-3.154,3.154-1.3-1.3a.958.958,0,0,0-1.355,1.355Z"
                                                transform="translate(-183.016)" />
                                            <circle id="Ellipse_41" data-name="Ellipse 41" cx="4.723" cy="4.723"
                                                r="4.723" transform="translate(11.624 30.794)" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="interview-text">
                                    <h4>Selection</h4>
                                    <h3>4.2k</h3>
                                </div>
                            </div>
                        </div>
                        <div class="interview-slide-wrap">
                            <div class="interview-box">
                                <div class="interview-box-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36.847" height="36.288"
                                        viewBox="0 0 36.847 36.288">
                                        <g id="check-up" transform="translate(-1 -1.5)">
                                            <path id="Path_80" data-name="Path 80"
                                                d="M41.846,31.94l-.231-.231a1.943,1.943,0,0,0-.33-2.3,1.993,1.993,0,0,0-2.763,0,1.947,1.947,0,0,0,2.3,3.09l.232.232a1.717,1.717,0,0,1,.5,1.285,1.654,1.654,0,0,1-.593,1.209c-5.149,4.31-10.881,5.712-13.332,3.26s-1.054-8.191,3.26-13.338a1.646,1.646,0,0,1,1.205-.589,1.712,1.712,0,0,1,1.283.5l.233.233a1.924,1.924,0,0,0-.244.923,1.947,1.947,0,0,0,.575,1.385,1.956,1.956,0,0,0,2.769-2.764.005.005,0,0,1-.006-.006,1.958,1.958,0,0,0-2.3-.324l-.236-.236a2.839,2.839,0,0,0-2.121-.823,2.79,2.79,0,0,0-2.012.987c-3.911,4.666-5.512,9.7-4.35,12.974L24.66,38.429a2.128,2.128,0,0,0-.344,2.557,11.043,11.043,0,0,1-5.37,2.873,5.067,5.067,0,0,1-4.65-1.12c-1.729-1.729-1.653-4.857.147-7.885a4.1,4.1,0,1,0-.825-.791c-2.2,3.542-2.254,7.322-.111,9.465a5.667,5.667,0,0,0,4.108,1.56,11.406,11.406,0,0,0,7.478-3.307,2.142,2.142,0,0,0,2.588-.326l1.028-1.023a6.9,6.9,0,0,0,2.313.37c3.088,0,6.99-1.649,10.662-4.723a2.8,2.8,0,0,0,.991-2.016,2.836,2.836,0,0,0-.827-2.123ZM15.472,30.161a1.935,1.935,0,1,1,0,2.74A1.94,1.94,0,0,1,15.472,30.161Z"
                                                transform="translate(-4.829 -9.691)" />
                                            <path id="Path_81" data-name="Path 81"
                                                d="M24.079,36.08a.6.6,0,0,1-.592.592H2.708a.6.6,0,0,1-.592-.592V6.709a.6.6,0,0,1,.592-.592H7.4v.207A1.034,1.034,0,0,0,8.43,7.356h9.334a1.029,1.029,0,0,0,1.027-1.033V6.117h4.7a.6.6,0,0,1,.592.592v7.648c.089-.112.179-.223.274-.335a3.825,3.825,0,0,1,.843-.748V6.709A1.708,1.708,0,0,0,23.487,5h-4.7V4.8a1.029,1.029,0,0,0-1.027-1.033H15.359a2.264,2.264,0,1,0-4.528,0H8.43A1.034,1.034,0,0,0,7.4,4.8V5H2.708A1.708,1.708,0,0,0,1,6.709V36.08a1.708,1.708,0,0,0,1.708,1.708H23.487A1.708,1.708,0,0,0,25.2,36.08V32.172a7.9,7.9,0,0,1-1.117-.2Z" />
                                            <path id="Path_82" data-name="Path 82"
                                                d="M6.956,17.5h8.525a.558.558,0,1,0,0-1.117H6.956a.558.558,0,1,0,0,1.117Z"
                                                transform="translate(-2.384 -6.574)" />
                                            <path id="Path_83" data-name="Path 83"
                                                d="M24.006,20.855H6.956a.558.558,0,1,0,0,1.117h17.05a.558.558,0,1,0,0-1.117Z"
                                                transform="translate(-2.384 -8.549)" />
                                            <path id="Path_84" data-name="Path 84"
                                                d="M24.006,25.325H6.956a.558.558,0,1,0,0,1.117h17.05a.558.558,0,1,0,0-1.117Z"
                                                transform="translate(-2.384 -10.524)" />
                                        </g>
                                    </svg>

                                </div>
                                <div class="interview-text">
                                    <h4>Medical</h4>
                                    <h3>3.7k</h3>
                                </div>
                            </div>
                        </div>
                        <div class="interview-slide-wrap">
                            <div class="interview-box">
                                <div class="interview-box-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23.83" height="31.285"
                                        viewBox="0 0 23.83 31.285">
                                        <g id="google-docs" transform="translate(-61)">
                                            <path id="Path_103" data-name="Path 103"
                                                d="M63.75,31.285H82.08a2.753,2.753,0,0,0,2.75-2.75V9.165H78.414a2.753,2.753,0,0,1-2.75-2.75V0H63.75A2.753,2.753,0,0,0,61,2.75V28.535A2.753,2.753,0,0,0,63.75,31.285Zm3.666-18.392h11a.917.917,0,0,1,0,1.833h-11a.917.917,0,1,1,0-1.833Zm0,3.666h11a.917.917,0,0,1,0,1.833h-11a.917.917,0,1,1,0-1.833Zm0,3.666h11a.917.917,0,0,1,0,1.833h-11a.917.917,0,1,1,0-1.833Zm0,3.666h7.332a.917.917,0,0,1,0,1.833H67.416a.917.917,0,1,1,0-1.833Z" />
                                            <path id="Path_104" data-name="Path 104"
                                                d="M331.917,15.584H337.8l-6.8-6.8v5.879A.917.917,0,0,0,331.917,15.584Z"
                                                transform="translate(-253.502 -8.252)" />
                                        </g>
                                    </svg>

                                </div>
                                <div class="interview-text">
                                    <h4>Documentation</h4>
                                    <h3>3.5k</h3>
                                </div>
                            </div>
                        </div>
                        <div class="interview-slide-wrap">
                            <div class="interview-box">
                                <div class="interview-box-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.309" height="31.285"
                                        viewBox="0 0 31.309 31.285">
                                        <g id="hand" transform="translate(0 -0.5)">
                                            <path id="Path_105" data-name="Path 105"
                                                d="M344.181,225.684a3.371,3.371,0,0,0-6.642.812v2.924l2.495-2.183A6.28,6.28,0,0,1,344.181,225.684Zm0,0"
                                                transform="translate(-316.898 -209.012)" />
                                            <path id="Path_106" data-name="Path 106"
                                                d="M91.109,230.822h0a4.481,4.481,0,0,0-6.1-.2l-5.093,4.457H74.365a3.01,3.01,0,0,1-3.009-3.01V229.12a3.866,3.866,0,0,0-3.862-3.862,2.88,2.88,0,0,0-2.88,2.88v13.744a.917.917,0,0,0,.917.917H79.959a6.8,6.8,0,0,0,4.554-1.747l6.481-5.832a2.96,2.96,0,0,0,.978-2.2,3.073,3.073,0,0,0-.863-2.2Zm0,0"
                                                transform="translate(-60.663 -211.014)" />
                                            <path id="Path_107" data-name="Path 107"
                                                d="M1.059,332.234A1.059,1.059,0,0,0,0,333.293v8.881a1.059,1.059,0,0,0,2.118,0v-8.881A1.059,1.059,0,0,0,1.059,332.234Zm0,0"
                                                transform="translate(0 -311.448)" />
                                            <path id="Path_108" data-name="Path 108"
                                                d="M178.568,3.642h6.545a1.571,1.571,0,0,0,0-3.142h-6.545a1.571,1.571,0,1,0,0,3.142Zm0,0"
                                                transform="translate(-166.173 0)" />
                                            <path id="Path_109" data-name="Path 109"
                                                d="M178.568,89.263h6.545a1.571,1.571,0,0,0,0-3.142h-6.545a1.571,1.571,0,1,0,0,3.142Zm0,0"
                                                transform="translate(-166.173 -80.385)" />
                                            <path id="Path_110" data-name="Path 110"
                                                d="M178.568,174.884h6.545a1.571,1.571,0,0,0,0-3.142h-6.545a1.571,1.571,0,1,0,0,3.142Zm0,0"
                                                transform="translate(-166.173 -160.771)" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="interview-text">
                                    <h4>Collection</h4>
                                    <h3>3.3k</h3>
                                </div>
                            </div>
                        </div>
                        <div class="interview-slide-wrap">
                            <div class="interview-box">
                                <div class="interview-box-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22.98" height="28"
                                        viewBox="0 0 22.98 28">
                                        <g id="contact" transform="translate(-4.5 -2)">
                                            <path id="Path_111" data-name="Path 111"
                                                d="M4.554,23.764a1,1,0,0,0,.163.946A14.36,14.36,0,0,0,15.99,30a14.36,14.36,0,0,0,11.273-5.29,1,1,0,0,0,.163-.946A11.955,11.955,0,0,0,15.99,16,11.955,11.955,0,0,0,4.554,23.764Z"
                                                fill-rule="evenodd" />
                                            <circle id="Ellipse_42" data-name="Ellipse 42" cx="6" cy="6"
                                                r="6" transform="translate(9.99 2)" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="interview-text">
                                    <h4>Deployment
                                    </h4>
                                    <h3>3.2k</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <div class="container-fluid page__container">
            <div class="row">

                <div class="col-lg-6 col-6 mb-2">
                    @if (Auth::user()->hasRole('ADMIN'))
                        <div class="action_btn">
                            <div class="dropdown">
                                <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Action
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void();" data-bs-toggle="modal"
                                            data-bs-target="#bulk_status">Changing status</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Modal of bulk changing status -->
                        <div class="modal fade" id="bulk_status" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change status in bulk</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('jobs.bulk.status.update') }}" id="change_status">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Status</label>
                                                    <select name="change_status" class="form-select" id="change_status_id">
                                                        <option value="">Select A Status</option>
                                                        <option value="">Select A Status</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn save-btn">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    @endif
                </div>

                <div class="col-lg-6 col-6 mb-2" style="display: flex;justify-content: end;">
                    <div class="action_btn">
                        <div class="dropdown">
                            <a class="btn reset-btn" href="{{ route('jobs.index') }}"><i
                                    class="fas fa-redo-alt"></i> Reset</a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 col-md-12">
                    <div class="table-wrapper table-responsive border-bottom" data-toggle="lists">
                        <table class="table mb-0 table-bordered" id="candidate_body12">
                            <thead class="candy-p">
                                <tr>
                                    {{-- @if (Auth::user()->hasRole('ADMIN'))
                                        <th>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox"
                                                    class="custom-control-input js-check-selected-row checkAll"
                                                    name="checkAll">
                                            </div>
                                        </th>
                                    @endif --}}

                                    @can('View Job')
                                        <th class="stick">
                                            View
                                        </th>
                                    @endcan
                                    

                                    <th>
                                        Interview Status
                                    </th>
                                    <th class="can_full">Full Name</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>WhatsApp No.</th>
                                    <th>Alternate Cont. No.</th>
                                    <th>Assign by</th>
                                    <th>Date of Interview</th>
                                    <th>Date of Selection</th>
                                    <th>Mofa no</th>
                                    <th>Med. Application Date</th>
                                    <th>Med. Completion Date</th>
                                    <th>Med. Status</th>
                                    <th>1st Installment</th>
                                    <th>1st Installment date</th>
                                    <th>2nd Installment</th>
                                    <th>2nd Installment date</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="list" id="candidate_job_body">

                                @include('jobs.filter')
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            

            function fetch_data(page, query, full_name, gender) {

                var query = $('#query').val();
                var page = $('#hidden_page').val();
                var full_name = $('#full_name').val();
                var gender = $('#gender').val();

                $.ajax({
                    url: "{{ route('candidates-jobs.filter') }}",
                    data: {
                        page: page,
                        search: query,
                        full_name: full_name,
                        gender: gender,
                    
                    },
                    success: function(data) {
                        // console.log(data.view);
                        $('#candidate_job_body').html(data.view);
                    }
                });
            }

            $(document).on('submit', '.search-form', function(e) {
                e.preventDefault();
                var query = $('#query').val();
                console.log(query);
                var page = $('#hidden_page').val();
                var full_name = $('#full_name').val();
                var gender = $('#gender').val();

                fetch_data(page, query, full_name, gender);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#query').val();

                var full_name = $('#full_name').val();
                var gender = $('#gender_filter').val();
                
                fetch_data(page, query, full_name, gender);
            });


        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-route', function() {
                var route = $(this).data('route');
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
                $.ajax({
                    url: route,
                    type: 'GET',
                    success: function(response) {
                        if (response.status == 'error') {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            toastr.error(response.message);
                            return false;
                        } else {
                            $('#job-edit').html(response.view);
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            $('#offcanvasEdit').offcanvas('show');
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        console.log(xhr);
                    }
                });
            });
            
          
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-close', function() {
                $('.text-danger').html('');
            });

            $(document).on('submit', '#candidate-form-import', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        //windows load with toastr message
                        window.location.reload();

                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        //clear any old errors
                        $('.text-danger').html('');
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            // console.log(key);
                            // Assuming you have a div with class "text-danger" next to each input
                            $('[name="file"]').next('.text-danger').html(value[
                                0]);
                        });
                    }
                });
            });

            $(document).on('click', '.view-details-btn', function(e) {
                e.preventDefault();
                var route = $(this).data('route');
                // load data from remote url
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: route,
                    success: function(resp) {
                        // console.log(resp);
                        //  open modal
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');

                        var candidate_activities = resp.candidate_activities;
                        // console.log(candidate_activities);
                        if (candidate_activities.length == 0) {
                            $('#show-details').html(
                                '<div class="testimonial-box"><div class="box-top"><div class="profile"><div class="name-user"><strong class="date">No Activity Found...</strong></div></div></div></div>'
                            );
                            return false;
                        }
                        var html = '';
                        $.each(candidate_activities, function(key, value) {
                            var date = new Date(value.created_at);
                            var formattedDate = date.getDate().toString().padStart(2,
                                '0') + ' ' + date.toLocaleString('default', {
                                month: 'short'
                            }) + ', ' + date.getFullYear();
                            var call_status = value.call_status == null ? 'N/A' : value
                                .call_status;
                            html += '<div class="activity_box">';
                            html += '<div class="activity_box_dd">';
                            html += '<div class="activity_box_ff">';
                            html += '<div class="active-user">';
                            html += value.user.first_name + ' ' + value.user.last_name;
                            html += '</div>';
                            html += '<div class="all_ansered">Call Status: <span>' +
                                call_status +
                                '</span></div>';
                            html += '</div>';
                            html += '<div class="date">' + formattedDate + '</div>';
                            html += '</div>';
                            html += '<div class="active-comment">';
                            html += '<p>' + value.remarks + '</p>';
                            html += '</div>';
                            html += '</div>';

                        });

                        $('#show-details').html(html);
                    }
                });
            });
        });
    </script> --}}
    {{-- <script>
        $(document).ready(function() {
            // Check-all functionality
            $(document).on('change', '.checkAll', function() {
                $(".checkd-row").prop('checked', $(this).prop('checked'));
            });

            // Individual checkbox change
            $(document).on('change', '.checkd-row', function() {
                if (!$(this).prop("checked")) {
                    $(".checkAll").prop("checked", false);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#change_status', function(e) {
                e.preventDefault();
                var status_id = $('#change_status_id').val();
                //  get the candidate id which checkbox is checked
                var candidate_ids = [];
                $('.checkd-row:checked').each(function() {
                    candidate_ids.push($(this).data('id'));
                });
                // are you sure you want to change status
                if (candidate_ids.length == 0) {
                    toastr.error('Please select atleast one candidate');
                    return false;
                }
                if (status_id == '') {
                    toastr.error('Please select status');
                    return false;
                }

                // are you sure confirm msg show
                swal({
                        title: 'Are you sure?',
                        text: "You want to change status of selected candidates!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!'
                    })
                    .then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: $(this).attr('action'),
                                type: $(this).attr('method'),
                                data: {
                                    status_id: status_id,
                                    candidate_ids: candidate_ids,
                                },
                                success: function(response) {
                                    //windows load with toastr message
                                    window.location.reload();
                                },
                                error: function(xhr) {
                                    var errors = xhr.responseJSON.errors;
                                    $.each(errors, function(key, value) {
                                        toastr.error(value[0]);
                                    });
                                }
                            });
                        } else {
                            toastr.error('You have cancelled!');
                        }
                    });
            });
        });
    </script>


    <script>
        $('.status_select').select2({
            closeOnSelect: false,
            placeholder: "Status",
            allowClear: false,
            tags: true
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Status'); // Set placeholder text manually
            }
        });



        // gender multi select
        $(".gender_select").select2({
            closeOnSelect: false,
            placeholder: "Gender",
            allowClear: false,
            tags: true
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Gender'); // Set placeholder text manually
            }
        });
        //education multi select
        $(".education_select").select2({
            closeOnSelect: false,
            placeholder: "Education",
            allowClear: false,
            tags: true
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Education'); // Set placeholder text manually
            }
        });
        //position1 multi select
        $(".position1_select").select2({
            closeOnSelect: false,
            placeholder: "Position Applied For(1)",
            allowClear: false,
            tags: true
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Position Applied For(1)'); // Set placeholder text manually
            }
        });
        //position2 multi select
        $(".position2_select").select2({
            closeOnSelect: false,
            placeholder: "Position Applied For(2)",
            allowClear: false,
            tags: true
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Position Applied For(2)'); // Set placeholder text manually
            }
        });
        //position2 multi select
        $(".position3_select").select2({
            closeOnSelect: false,
            placeholder: "Position Applied For(3)",
            allowClear: false,
            tags: true
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Position Applied For(3)'); // Set placeholder text manually
            }
        });

        //Last call status select
        $(".last_call_status").select2({
            placeholder: "Last call Status",
            allowClear: true,
        });

        //mode registration status select
        $(".mode_registration_select").select2({
            placeholder: "Mode of Registration",
            allowClear: true,
        });

        //source status select
        $(".source_status").select2({
            placeholder: "Source",
            allowClear: true,
        });

        //city select
        $(".city_select").select2({
            placeholder: "City",
            allowClear: true,
        });

        //english speak select
        $(".eng_spk_select").select2({
            placeholder: "English Speak",
            allowClear: true,
        })

        // arbic speak select
        $(".arbic_select").select2({
            placeholder: "Arabic Speak",
            allowClear: true,
        })

        //ecr type select
        $(".ecr_select").select2({
            placeholder: "ECR Type",
            allowClear: true,
        })
    </script>
    <script>
        $('#query').tagator({
            autocomplete: [
                @foreach (Position::getPosition() as $item)
                    '{{ $item }}',
                @endforeach
            ],
            useDimmer: true
        });
    </script> --}}
@endpush
