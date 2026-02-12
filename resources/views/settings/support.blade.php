@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Support
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <!-- page-contain-start  -->
            <div class="support-div">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-9">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-4 col-lg-6">
                                <div class="support-box">
                                    <div class="support-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="42.474" height="42.553"
                                            viewBox="0 0 42.474 42.553">
                                            <path id="phone-call_1_" data-name="phone-call (1)"
                                                d="M40.744,19.5a1.773,1.773,0,0,1-1.773-1.773A14.2,14.2,0,0,0,24.79,3.547,1.773,1.773,0,1,1,24.79,0,17.746,17.746,0,0,1,42.516,17.728,1.773,1.773,0,0,1,40.744,19.5Zm-5.318-1.773A10.636,10.636,0,0,0,24.79,7.092a1.773,1.773,0,1,0,0,3.545,7.091,7.091,0,0,1,7.091,7.091,1.773,1.773,0,1,0,3.545,0ZM39.3,39.29l1.613-1.859a5.5,5.5,0,0,0,0-7.759c-.055-.055-4.32-3.336-4.32-3.336A5.5,5.5,0,0,0,29,26.346l-3.379,2.847A22.661,22.661,0,0,1,13.333,16.884l2.836-3.368a5.5,5.5,0,0,0,.012-7.59s-3.285-4.26-3.34-4.315a5.463,5.463,0,0,0-7.668-.082L3.135,3.3C-2.9,10.3.6,20.254,7.583,28.591c6.608,7.893,16.674,14.184,23.876,13.954A10.911,10.911,0,0,0,39.3,39.29Z"
                                                transform="translate(-0.043 0.002)" />
                                        </svg>
                                    </div>
                                    <div class="support-text">
                                        <h3>Call us at</h3>
                                        <h4><a href="tel:(+91 ) 01234 - 56789">(+91 ) 01234 - 56789</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                                <div class="support-box">
                                    <div class="support-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="45.002" height="45.002"
                                            viewBox="0 0 45.002 45.002">
                                            <path id="envelope-dot"
                                                d="M37.5,15A7.5,7.5,0,1,1,45,7.5,7.5,7.5,0,0,1,37.5,15Zm-15,13.913a5.547,5.547,0,0,0,3.975-1.65l8.757-8.757A11.265,11.265,0,0,1,26.251,7.482a12.446,12.446,0,0,1,.169-1.875H9.375a9.349,9.349,0,0,0-7.988,4.519L18.526,27.282a5.624,5.624,0,0,0,3.975,1.65ZM40.8,18.244,29.12,29.926a9.416,9.416,0,0,1-13.275,0L.094,14.138C.075,14.419,0,14.7,0,15V35.626A9.379,9.379,0,0,0,9.375,45H35.626A9.379,9.379,0,0,0,45,35.626l-.038-19.744A11.335,11.335,0,0,1,40.8,18.244Z" />
                                        </svg>
                                    </div>
                                    <div class="support-text">
                                        <h3>Mail us</h3>
                                        <h4><a href="mailto:jhondoe@123.com">jhondoe@123.com</a></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                                <div class="support-box">
                                    <div class="support-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36.902" height="44.078"
                                            viewBox="0 0 36.902 44.078">
                                            <g id="marker_2_" data-name="marker (2)" transform="translate(-2)">
                                                <path id="Path_232" data-name="Path 232"
                                                    d="M20.451,0A18.472,18.472,0,0,0,2,18.451C2,28.2,17.5,41.576,19.259,43.071l1.192,1.007,1.192-1.007C23.4,41.576,38.9,28.2,38.9,18.451A18.472,18.472,0,0,0,20.451,0Zm0,27.677a9.226,9.226,0,1,1,9.226-9.226,9.226,9.226,0,0,1-9.226,9.226Z"
                                                    transform="translate(0)" />
                                                <circle id="Ellipse_262" data-name="Ellipse 262" cx="5.535"
                                                    cy="5.535" r="5.535" transform="translate(14.916 12.916)" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="support-text">
                                        <h3>Locate us</h3>
                                        <h4>PS Srijan Corporate Park
                                            12th Floor</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                                <div class="support-box">
                                    <div class="support-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45"
                                            viewBox="0 0 45 45">
                                            <path id="building"
                                                d="M20.625,0h-15A5.625,5.625,0,0,0,0,5.625V45H26.25V5.625A5.625,5.625,0,0,0,20.625,0ZM11.25,35.625H5.625v-3.75H11.25Zm0-7.5H5.625v-3.75H11.25Zm0-7.5H5.625v-3.75H11.25Zm0-7.5H5.625V9.375H11.25Zm9.375,22.5H15v-3.75h5.625Zm0-7.5H15v-3.75h5.625Zm0-7.5H15v-3.75h5.625Zm0-7.5H15V9.375h5.625Zm18.75-3.75H30V45H45V15A5.625,5.625,0,0,0,39.375,9.375Zm0,26.25h-3.75v-3.75h3.75Zm0-7.5h-3.75v-3.75h3.75Zm0-7.5h-3.75v-3.75h3.75Z" />
                                        </svg>
                                    </div>
                                    <div class="support-text">
                                        <h3>Enterprises</h3>
                                        <h5>Submit your inquiry for your Enterprise</h5>
                                        <div class="support-btn">
                                            <a href="">Contact<span><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="11" height="8.333" viewBox="0 0 11 8.333">
                                                        <g id="Group_86" data-name="Group 86"
                                                            transform="translate(-1549 -789.834)">
                                                            <path id="Down_Arrow_3_"
                                                                d="M23.666,44a.332.332,0,0,1-.236-.1L20.1,40.569a.333.333,0,0,1,.471-.471l3.1,3.1,3.1-3.1a.333.333,0,1,1,.471.471L23.9,43.9A.332.332,0,0,1,23.666,44Z"
                                                                transform="translate(1509.5 817.667) rotate(-90)"
                                                                fill="#04589a" stroke="#04589a" stroke-width="1" />
                                                            <path id="Down_Arrow_3_2" data-name="Down_Arrow_3_"
                                                                d="M23.666,44a.332.332,0,0,1-.236-.1L20.1,40.569a.333.333,0,0,1,.471-.471l3.1,3.1,3.1-3.1a.333.333,0,1,1,.471.471L23.9,43.9A.332.332,0,0,1,23.666,44Z"
                                                                transform="translate(1515.5 817.667) rotate(-90)"
                                                                fill="#04589a" stroke="#04589a" stroke-width="1" />
                                                        </g>
                                                    </svg>

                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                                <div class="support-box">
                                    <div class="support-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36.939" height="46.691"
                                            viewBox="0 0 36.939 46.691">
                                            <path id="user-headset"
                                                d="M38.478,41.828v4.864H3.46V41.828a8.765,8.765,0,0,1,8.755-8.755H29.723A8.765,8.765,0,0,1,38.478,41.828ZM10.992,7.834A14.539,14.539,0,0,1,21.945,3.922c7.634.494,13.616,7.138,13.616,15.124a6.249,6.249,0,0,1-6.243,6.243H24.638a3.881,3.881,0,1,0-1.023,3.891h5.7A10.146,10.146,0,0,0,39.453,19.046C39.451,9.015,31.871.665,22.194.041A18.306,18.306,0,0,0,8.331,5,18.55,18.55,0,0,0,2.514,17.511h3.9a14.435,14.435,0,0,1,4.582-9.675ZM27,21.4h2.661a1.94,1.94,0,0,0,1.94-1.685,10.984,10.984,0,0,0-.177-3.562A10.7,10.7,0,1,0,13.23,25.859h0A7.729,7.729,0,0,1,27,21.4Z"
                                                transform="translate(-2.514 0)" />
                                        </svg>

                                    </div>
                                    <div class="support-text">
                                        <h3>Help & Support</h3>
                                        <h5>Submit your inquiry for your Enterprise</h5>
                                        <div class="support-btn">
                                            <a href="">Contact<span><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="11" height="8.333" viewBox="0 0 11 8.333">
                                                        <g id="Group_86" data-name="Group 86"
                                                            transform="translate(-1549 -789.834)">
                                                            <path id="Down_Arrow_3_"
                                                                d="M23.666,44a.332.332,0,0,1-.236-.1L20.1,40.569a.333.333,0,0,1,.471-.471l3.1,3.1,3.1-3.1a.333.333,0,1,1,.471.471L23.9,43.9A.332.332,0,0,1,23.666,44Z"
                                                                transform="translate(1509.5 817.667) rotate(-90)"
                                                                fill="#04589a" stroke="#04589a" stroke-width="1" />
                                                            <path id="Down_Arrow_3_2" data-name="Down_Arrow_3_"
                                                                d="M23.666,44a.332.332,0,0,1-.236-.1L20.1,40.569a.333.333,0,0,1,.471-.471l3.1,3.1,3.1-3.1a.333.333,0,1,1,.471.471L23.9,43.9A.332.332,0,0,1,23.666,44Z"
                                                                transform="translate(1515.5 817.667) rotate(-90)"
                                                                fill="#04589a" stroke="#04589a" stroke-width="1" />
                                                        </g>
                                                    </svg>
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6">
                                <div class="support-box">
                                    <div class="support-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="39.43" height="44.691"
                                            viewBox="0 0 39.43 44.691">
                                            <g id="megaphone" transform="translate(-30.136)">
                                                <g id="Group_54" data-name="Group 54"
                                                    transform="translate(46.374 0.358)">
                                                    <g id="Group_53" data-name="Group 53">
                                                        <path id="Path_233" data-name="Path 233"
                                                            d="M238.064,22.3,220.634,4.865a2.62,2.62,0,1,0-3.705,3.7L234.361,26a2.618,2.618,0,1,0,3.7-3.7Z"
                                                            transform="translate(-216.163 -4.1)" />
                                                    </g>
                                                </g>
                                                <g id="Group_56" data-name="Group 56"
                                                    transform="translate(39.507 7.237)">
                                                    <g id="Group_55" data-name="Group 55">
                                                        <path id="Path_234" data-name="Path 234"
                                                            d="M143.833,82.9l-.131.658a28.147,28.147,0,0,1-6.208,12.573l9.484,9.484a28.053,28.053,0,0,1,12.513-6.269l.659-.131Z"
                                                            transform="translate(-137.494 -82.905)" />
                                                    </g>
                                                </g>
                                                <g id="Group_58" data-name="Group 58"
                                                    transform="translate(30.136 22.432)">
                                                    <g id="Group_57" data-name="Group 57" transform="translate(0)">
                                                        <path id="Path_235" data-name="Path 235"
                                                            d="M37.768,256.989l-6.481,6.48a3.927,3.927,0,0,0,0,5.556l3.7,3.7a3.928,3.928,0,0,0,5.556,0l6.481-6.481Zm.926,10.184a1.309,1.309,0,0,1-1.851-1.851l1.851-1.851a1.309,1.309,0,1,1,1.851,1.851Z"
                                                            transform="translate(-30.136 -256.989)" />
                                                    </g>
                                                </g>
                                                <g id="Group_60" data-name="Group 60"
                                                    transform="translate(44.248 30.208)">
                                                    <g id="Group_59" data-name="Group 59" transform="translate(0)">
                                                        <path id="Path_236" data-name="Path 236"
                                                            d="M200.058,354.734l1.781-1.781a3.925,3.925,0,0,0,0-5.554l-1.323-1.324a24.791,24.791,0,0,0-2.108,1.594l1.58,1.582a1.306,1.306,0,0,1,0,1.85l-1.811,1.811-2.661-2.578-3.7,3.7,5.941,5.756a2.619,2.619,0,0,0,3.7-3.706Z"
                                                            transform="translate(-191.813 -346.075)" />
                                                    </g>
                                                </g>
                                                <g id="Group_62" data-name="Group 62" transform="translate(56.473)">
                                                    <g id="Group_61" data-name="Group 61">
                                                        <path id="Path_237" data-name="Path 237"
                                                            d="M333.173,0a1.309,1.309,0,0,0-1.309,1.309V3.928a1.309,1.309,0,0,0,2.619,0V1.309A1.309,1.309,0,0,0,333.173,0Z"
                                                            transform="translate(-331.864)" />
                                                    </g>
                                                </g>
                                                <g id="Group_64" data-name="Group 64"
                                                    transform="translate(64.329 10.475)">
                                                    <g id="Group_63" data-name="Group 63" transform="translate(0)">
                                                        <path id="Path_238" data-name="Path 238"
                                                            d="M425.792,120h-2.619a1.309,1.309,0,1,0,0,2.619h2.619a1.309,1.309,0,0,0,0-2.619Z"
                                                            transform="translate(-421.864 -120)" />
                                                    </g>
                                                </g>
                                                <g id="Group_66" data-name="Group 66"
                                                    transform="translate(61.71 2.619)">
                                                    <g id="Group_65" data-name="Group 65">
                                                        <path id="Path_239" data-name="Path 239"
                                                            d="M396.717,30.383a1.309,1.309,0,0,0-1.851,0L392.247,33a1.309,1.309,0,0,0,1.851,1.851l2.619-2.619A1.309,1.309,0,0,0,396.717,30.383Z"
                                                            transform="translate(-391.864 -30)" />
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="support-text">
                                        <h3>Media & Press</h3>
                                        <h5>Submit your inquiry for your Enterprise</h5>
                                        <div class="support-btn">
                                            <a href="">Contact<span><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="11" height="8.333" viewBox="0 0 11 8.333">
                                                        <g id="Group_86" data-name="Group 86"
                                                            transform="translate(-1549 -789.834)">
                                                            <path id="Down_Arrow_3_"
                                                                d="M23.666,44a.332.332,0,0,1-.236-.1L20.1,40.569a.333.333,0,0,1,.471-.471l3.1,3.1,3.1-3.1a.333.333,0,1,1,.471.471L23.9,43.9A.332.332,0,0,1,23.666,44Z"
                                                                transform="translate(1509.5 817.667) rotate(-90)"
                                                                fill="#04589a" stroke="#04589a" stroke-width="1" />
                                                            <path id="Down_Arrow_3_2" data-name="Down_Arrow_3_"
                                                                d="M23.666,44a.332.332,0,0,1-.236-.1L20.1,40.569a.333.333,0,0,1,.471-.471l3.1,3.1,3.1-3.1a.333.333,0,1,1,.471.471L23.9,43.9A.332.332,0,0,1,23.666,44Z"
                                                                transform="translate(1515.5 817.667) rotate(-90)"
                                                                fill="#04589a" stroke="#04589a" stroke-width="1" />
                                                        </g>
                                                    </svg>
                                                </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-contain-end  -->
        </div>
    </div>
@endsection

@push('scripts')
@endpush
