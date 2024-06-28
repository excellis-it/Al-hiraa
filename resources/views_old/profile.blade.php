@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Profile
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <!-- page-contain-start  -->
            <div class="integrations-div setting-profile-div">

                <div class="page__heading row align-items-center mb-0">
                    <div class="col-xl-12 mb-3 mb-md-0">
                        <div class="integrations-head">
                            <h2>Profile Settings</h2>
                        </div>
                    </div>
                </div>

                <div class="profile-div">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="profile-img-box">
                                    <div class="profile-img">
                                        @if (Auth::user()->profile_picture)
                                            <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt=""
                                                id="blah">
                                        @else
                                        <img src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                        id="blah">
                                        @endif
                                        <div class="pro-cam-img-1">
                                            <label for="file-input">
                                                <img
                                                    src="{{ asset('assets/images/cam-img.png') }}">
                                            </label>
                                            <input id="file-input" type="file" name="profile_picture"
                                                onchange="readURL(this);">
                                        </div>
                                    </div>
                                    <div class="profile-text">
                                        <h4>Profile Image</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="integrations-form profile-form">

                                    <div class="row g-2 justify-content-between">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">First Name<span>*</span></label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->first_name }}" name="first_name" placeholder="">
                                                @if ($errors->has('first_name'))
                                                    @foreach ($errors->get('first_name') as $error)
                                                        <span class="text-danger">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Last Name<span>*</span></label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->last_name }}" name="last_name" placeholder="">
                                                @if ($errors->has('last_name'))
                                                    @foreach ($errors->get('last_name') as $error)
                                                        <span class="text-danger">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Email<span>*</span></label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->email }}" name="email" placeholder="">
                                                @if ($errors->has('email'))
                                                    @foreach ($errors->get('email') as $error)
                                                        <span class="text-danger">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->phone }}" name="phone" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">City</label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->city ? Auth::user()->city : old('city') }}"
                                                    name="city" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">State</label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->state ? Auth::user()->state : old('state') }}"
                                                    name="state" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Country</label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->country ? Auth::user()->country : old('country') }}"
                                                    name="country" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Account</label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->account ? Auth::user()->account : old('account') }}"
                                                    name="account" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Role</label>
                                                <input type="text" class="form-control" id="" disabled
                                                    value="{{ Auth::user()->getRoleNames()->first() }}" name="role"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Timezone</label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->timezone ? Auth::user()->timezone : old('timezone') }}"
                                                    name="timezone" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Default Currency</label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->currency ? Auth::user()->currency : old('currency') }}"
                                                    name="currency" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Application Language</label>
                                                <input type="text" class="form-control" id=""
                                                    value="{{ Auth::user()->application_language ? Auth::user()->application_language : old('application_language') }}"
                                                    name="application_language" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="save-btn-div d-flex align-items-center">
                                                <button type="submit" class="btn save-btn">Update</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- page-contain-end  -->
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <!-- <div class="offcanvas-header">
                              <h5 id="offcanvasRightLabel">Offcanvas right</h5>
                              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div> -->
            <div class="offcanvas-body">
                <div class="row g-3">
                    <div class="col-lg-4">
                        <div class="name_box">
                            <div class="">
                                <div class="name_box_icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.706" height="22.275"
                                        viewBox="0 0 16.706 22.275">
                                        <g id="user_4_" data-name="user (4)" transform="translate(-64)">
                                            <circle id="Ellipse_323" data-name="Ellipse 323" cx="5.5"
                                                cy="5.5" r="5.5" transform="translate(67 0)" fill="#1492e6" />
                                            <path id="Path_330" data-name="Path 330"
                                                d="M72.353,298.667A8.363,8.363,0,0,0,64,307.02a.928.928,0,0,0,.928.928h14.85a.928.928,0,0,0,.928-.928A8.362,8.362,0,0,0,72.353,298.667Z"
                                                transform="translate(0 -285.673)" fill="#1492e6" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="">
                                <div class="name_box_text">
                                    <p>Name</p>
                                    <h4>Nicson Sarkar</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="name_box">
                            <div class="">
                                <div class="name_box_icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20.761" height="22.275"
                                        viewBox="0 0 20.761 22.275">
                                        <g id="phone-receiver-silhouette_2_" data-name="phone-receiver-silhouette (2)"
                                            transform="translate(-0.872 0)">
                                            <path id="Path_412" data-name="Path 412"
                                                d="M19.307,15.5c-1.346-1.151-2.711-1.848-4.04-.7l-.794.695c-.581.5-1.66,2.86-5.835-1.942S6.948,8.015,7.53,7.515l.8-.7c1.322-1.152.823-2.6-.13-4.094l-.575-.9C6.664.332,5.621-.646,4.3.5l-.716.626A6.724,6.724,0,0,0,.958,5.58C.48,8.742,1.988,12.364,5.444,16.337s6.83,5.972,10.031,5.937A6.742,6.742,0,0,0,20.243,20.3l.719-.627c1.322-1.149.5-2.319-.846-3.473Z"
                                                fill="#1492e6" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="">
                                <div class="name_box_text">
                                    <p>Contact No:</p>
                                    <h4>(+91) 01234 - 56789</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="name_box">
                            <div class="">
                                <div class="name_box_icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 22 22">
                                        <g id="activity" transform="translate(-2.25 -1.5)">
                                            <path id="Path_409" data-name="Path 409"
                                                d="M16.1,3.88a.815.815,0,1,0,0-1.63H12.793c-2,0-3.559,0-4.8.134A6.327,6.327,0,0,0,4.825,3.443,6.247,6.247,0,0,0,3.443,4.825,6.327,6.327,0,0,0,2.384,7.993c-.134,1.241-.134,2.8-.134,4.8v.1c0,2,0,3.559.134,4.8A6.327,6.327,0,0,0,3.443,20.86a6.246,6.246,0,0,0,1.382,1.382A6.326,6.326,0,0,0,7.993,23.3c1.241.134,2.8.134,4.8.134h.1c2,0,3.559,0,4.8-.134a6.326,6.326,0,0,0,3.168-1.059,6.246,6.246,0,0,0,1.382-1.382A6.326,6.326,0,0,0,23.3,17.692c.134-1.241.134-2.8.134-4.8V9.583a.815.815,0,1,0-1.63,0v3.259c0,2.055,0,3.531-.125,4.674a4.742,4.742,0,0,1-.757,2.386A4.615,4.615,0,0,1,19.9,20.924a4.742,4.742,0,0,1-2.386.757c-1.143.124-2.619.125-4.674.125s-3.531,0-4.674-.125a4.742,4.742,0,0,1-2.386-.757A4.616,4.616,0,0,1,4.761,19.9,4.742,4.742,0,0,1,4,17.516c-.124-1.143-.125-2.619-.125-4.674s0-3.531.125-4.674a4.742,4.742,0,0,1,.757-2.386A4.617,4.617,0,0,1,5.783,4.761,4.742,4.742,0,0,1,8.169,4c1.143-.124,2.619-.125,4.674-.125Z"
                                                transform="translate(0 0.065)" fill="#1492e6" />
                                            <path id="Path_410" data-name="Path 410"
                                                d="M6.333,15.057a.815.815,0,1,0,1.463.718L9.383,12.54a1.294,1.294,0,0,1,2.36.08,2.924,2.924,0,0,0,5.331.181l1.587-3.234A.815.815,0,0,0,17.2,8.849l-1.586,3.234a1.294,1.294,0,0,1-2.36-.08,2.924,2.924,0,0,0-5.331-.181Z"
                                                transform="translate(0.346 0.596)" fill="#1492e6" />
                                            <path id="Path_411" data-name="Path 411"
                                                d="M17.5,4.216A2.716,2.716,0,1,0,20.216,1.5,2.716,2.716,0,0,0,17.5,4.216Zm1.63,0A1.086,1.086,0,1,0,20.216,3.13,1.086,1.086,0,0,0,19.13,4.216Z"
                                                transform="translate(1.318 0)" fill="#1492e6" fill-rule="evenodd" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="">
                                <div class="name_box_text">
                                    <p>Status</p>
                                    <div class="round_staus active">
                                        Active
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="candidate_details">
                    <h4>Candidate Details</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Enter By</td>
                                    <td>Jhon Doe
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assigned By</td>
                                    <td>Jhon Doe
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mode of Registration</td>
                                    <td>Done
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Source</td>
                                    <td>01/07/2023
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Referred By</td>
                                    <td>01/07/2023
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <a href="" class="btn-1">See More<img src="assets/images/arrow.png"></a>
                    </div>
                </div>
                <div class="candidate_details">
                    <h4>Interview Details</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Enter By</td>
                                    <td>Jhon Doe
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assigned By</td>
                                    <td>Jhon Doe
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mode of Registration</td>
                                    <td>Done
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Source</td>
                                    <td>01/07/2023
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Referred By</td>
                                    <td>01/07/2023
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                viewBox="0 0 19 19">
                                                <g id="Group_86" data-name="Group 86" transform="translate(-1840 -383)">
                                                    <g id="Ellipse_374" data-name="Ellipse 374"
                                                        transform="translate(1840 383)" fill="#fff" stroke="#dedede"
                                                        stroke-width="0.8">
                                                        <circle cx="9.5" cy="9.5" r="9.5" stroke="none" />
                                                        <circle cx="9.5" cy="9.5" r="9.1" fill="none" />
                                                    </g>
                                                    <g id="pencil" transform="translate(1846 389)">
                                                        <path id="Path_125" data-name="Path 125"
                                                            d="M4.259,5.687,0,9.946v1.082H1.082L5.341,6.769Z"
                                                            transform="translate(0 -4.028)" />
                                                        <path id="Path_126" data-name="Path 126"
                                                            d="M18.125.224a.765.765,0,0,0-1.082,0L16.022,1.246,17.1,2.328l1.021-1.021a.765.765,0,0,0,0-1.083Z"
                                                            transform="translate(-11.349 0)" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <a href="" class="btn-1">See More<img src="assets/images/arrow.png"></a>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
