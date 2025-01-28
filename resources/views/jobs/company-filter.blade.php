<section class="interview-sec m-3">
    <div class="interview-head">
        <h4>Interview Pipeline</h4>
    </div>
    <div class="interview-box-sec">
        <div class="interview-slide">
            <div class="interview-slide-wrap">
                <div class="interview-box filter-select {{ isset($int_pipeline) && $int_pipeline == 'All' ? 'interview-active' : '' }}"
                    data-val="All">
                    <div class="interview-box-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35">
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
                        <h4>Interested In Interviews</h4>
                        <h3><span id="all">{{ $count['total_interviews'] }}</span></h3>
                    </div>
                </div>
            </div>
            <div class="interview-slide-wrap">
                <div class="interview-box filter-select {{ isset($int_pipeline) && $int_pipeline == 'Appeared' ? 'interview-active' : '' }}"
                    data-val="Appeared">
                    <div class="interview-box-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35"
                            style="fill: black;">
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
                        <h4>Appeared</h4>
                        <h3><span id="all">{{ $count['total_appeared'] }}</span></h3>
                    </div>
                </div>
            </div>
            <div class="interview-slide-wrap">
                <div class="interview-box filter-select {{ isset($int_pipeline) && $int_pipeline == 'Selection' ? 'interview-active' : '' }}"
                    data-val="Selection">

                    <div class="interview-box-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32.694" height="29.756"
                            viewBox="0 0 32.694 29.756">
                            <g id="selection_1_" data-name="selection (1)" transform="translate(0 -23)">
                                <circle id="Ellipse_39" data-name="Ellipse 39" cx="3.815" cy="3.815" r="3.815"
                                    transform="translate(1.868 34.59)" />
                                <circle id="Ellipse_40" data-name="Ellipse 40" cx="3.815" cy="3.815" r="3.815"
                                    transform="translate(23.067 34.59)" />
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
                                <circle id="Ellipse_41" data-name="Ellipse 41" cx="4.723" cy="4.723" r="4.723"
                                    transform="translate(11.624 30.794)" />
                            </g>
                        </svg>
                    </div>
                    <div class="interview-text">
                        <h4>Selection</h4>
                        <h3><span id="selection">{{ $count['total_selection'] }}</span></h3>
                    </div>
                </div>
            </div>
            <div class="interview-slide-wrap">
                <div class="interview-box filter-select {{ isset($int_pipeline) && $int_pipeline == 'Medical' ? 'interview-active' : '' }}"
                    data-val="Medical">
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
                        <h3><span id="medical">{{ $count['total_medical'] }}</span></h3>
                    </div>
                </div>
            </div>
            <div class="interview-slide-wrap">
                <div class="interview-box filter-select {{ isset($int_pipeline) && $int_pipeline == 'Document' ? 'interview-active' : '' }}"
                    data-val="Document">
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
                        <h4>Visa</h4>
                        <h3><span id="docu">{{ $count['total_doc'] }}</span></h3>
                    </div>
                </div>
            </div>
            <div class="interview-slide-wrap">
                <div class="interview-box filter-select {{ isset($int_pipeline) && $int_pipeline == 'Collection' ? 'interview-active' : '' }}"
                    data-val="Collection">
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
                        <h3><span id="collect">{{ $count['total_collection'] }}</span></h3>
                    </div>
                </div>
            </div>
            <div class="interview-slide-wrap">
                <div class="interview-box filter-select {{ isset($int_pipeline) && $int_pipeline == 'Deployment' ? 'interview-active' : '' }}"
                    data-val="Deployment">
                    <div class="interview-box-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.98" height="28"
                            viewBox="0 0 22.98 28">
                            <g id="contact" transform="translate(-4.5 -2)">
                                <path id="Path_111" data-name="Path 111"
                                    d="M4.554,23.764a1,1,0,0,0,.163.946A14.36,14.36,0,0,0,15.99,30a14.36,14.36,0,0,0,11.273-5.29,1,1,0,0,0,.163-.946A11.955,11.955,0,0,0,15.99,16,11.955,11.955,0,0,0,4.554,23.764Z"
                                    fill-rule="evenodd" />
                                <circle id="Ellipse_42" data-name="Ellipse 42" cx="6" cy="6" r="6"
                                    transform="translate(9.99 2)" />
                            </g>
                        </svg>
                    </div>
                    <div class="interview-text">
                        <h4>Deployment
                        </h4>
                        <h3><span id="deploy">{{ $count['total_deployment'] }}</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<div class="container-fluid page__container">
    <div class="row">

        <div class="col-lg-6 col-md-6 mb-2">
            <div class="all_filter_btn">
                <ul>
                    {{-- <li>
                        <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19.598" height="19.633" viewBox="0 0 19.598 19.633">
                        <path id="pen-clip" d="M16.557,6.5,5.055,18.088a2.478,2.478,0,0,1-2.822.474L1.4,19.4a.8.8,0,0,1-.581.237A.838.838,0,0,1,.237,19.4a.815.815,0,0,1,0-1.153l.834-.834a2.479,2.479,0,0,1,.474-2.831L11.772,4.3a2.523,2.523,0,0,0-2.683.515L6.61,7.3a.8.8,0,0,1-.581.237A.838.838,0,0,1,5.448,7.3a.815.815,0,0,1,0-1.153L7.927,3.665a4.071,4.071,0,0,1,2.9-1.194,4.03,4.03,0,0,1,2.61.965c.033,0,3.117,3.076,3.117,3.076ZM18.684.532a2.541,2.541,0,0,0-3.379.245L14.218,1.865l3.493,3.493L18.873,4.2A2.473,2.473,0,0,0,18.684.532Z" transform="translate(0.003 -0.001)"/>
                      </svg>
                       Assign Job</a>
                    </li>
                    <li>
                        <a href="" class="active_aa">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.546" height="20.546" viewBox="0 0 20.546 20.546">
                            <path id="id-badge" d="M16.265,3.424H12.841V2.568a2.568,2.568,0,1,0-5.136,0v.856H4.28A4.286,4.286,0,0,0,0,7.7v8.561a4.286,4.286,0,0,0,4.28,4.28H16.265a4.286,4.286,0,0,0,4.28-4.28V7.7a4.286,4.286,0,0,0-4.28-4.28Zm-7.7,11.985a.856.856,0,0,1-.856.856H3.424a.856.856,0,0,1-.856-.856V8.561A.856.856,0,0,1,3.424,7.7H7.7a.856.856,0,0,1,.856.856ZM10.273,5.136a.856.856,0,0,1-.856-.856V2.568a.856.856,0,0,1,1.712,0V4.28A.856.856,0,0,1,10.273,5.136Zm5.136,11.129H11.985a.856.856,0,1,1,0-1.712h3.424a.856.856,0,0,1,0,1.712Zm1.712-3.424H11.985a.856.856,0,0,1,0-1.712h5.136a.856.856,0,1,1,0,1.712Zm0-3.424H11.985a.856.856,0,0,1,0-1.712h5.136a.856.856,0,1,1,0,1.712Zm-12.841,0H6.849v5.136H4.28Z"/>
                        </svg>
                        Assign RC</a>
                    </li>
                    <li><a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.524" height="13.212" viewBox="0 0 20.524 13.212">
                            <g id="view" transform="translate(0 -82.176)">
                              <g id="Group_81" data-name="Group 81" transform="translate(6.959 85.479)">
                                <g id="Group_80" data-name="Group 80" transform="translate(0 0)">
                                  <path id="Path_357" data-name="Path 357" d="M159.719,156.416a3.3,3.3,0,1,0,3.3,3.3A3.305,3.305,0,0,0,159.719,156.416Zm-.251,2.323a.758.758,0,0,0-.752.752h-1.093a1.867,1.867,0,0,1,1.845-1.845Z" transform="translate(-156.416 -156.416)"/>
                                </g>
                              </g>
                              <g id="Group_83" data-name="Group 83" transform="translate(0 82.176)">
                                <g id="Group_82" data-name="Group 82" transform="translate(0 0)">
                                  <path id="Path_358" data-name="Path 358" d="M20.285,88.1c-1.116-1.39-5.1-5.923-10.023-5.923S1.355,86.709.239,88.1a1.1,1.1,0,0,0,0,1.367c1.116,1.39,5.1,5.923,10.023,5.923s8.907-4.533,10.023-5.923A1.1,1.1,0,0,0,20.285,88.1ZM10.262,93.566a4.784,4.784,0,1,1,4.784-4.784A4.783,4.783,0,0,1,10.262,93.566Z" transform="translate(0 -82.176)"/>
                                </g>
                              </g>
                            </g>
                          </svg>
                        View</a></li>
                    <li><a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19.139" height="13.397" viewBox="0 0 19.139 13.397">
                            <path id="growth-graph" d="M13.4,3V4.914h2.488L8.613,12.187,5.742,9.316,0,15.058,1.34,16.4l4.4-4.4,2.871,2.871,8.613-8.613V8.742h1.914V3Z" transform="translate(0 -3)"/>
                          </svg>
                        Status</a>
                    </li> --}}
                    <li><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#smsModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.091" height="19.088"
                                viewBox="0 0 19.091 19.088">
                                <path id="Path_359" data-name="Path 359"
                                    d="M15.655,4.157a2.53,2.53,0,1,1,2.53,2.53,2.53,2.53,0,0,1-2.53-2.53Zm4.37,4.735V13.32a4.591,4.591,0,0,1-4.591,4.591H14.045a.92.92,0,0,0-.735.366L11.929,20.11a1.311,1.311,0,0,1-2.208,0l-1.38-1.831a1.023,1.023,0,0,0-.736-.368H6.225a4.6,4.6,0,0,1-4.6-4.6V6.917a4.6,4.6,0,0,1,4.6-4.6h7.226a.917.917,0,0,1,.895,1.1,4.01,4.01,0,0,0,.026,1.617,3.885,3.885,0,0,0,2.934,2.934A4.01,4.01,0,0,0,18.923,8a.917.917,0,0,1,1.1.895ZM8.065,10.6a.92.92,0,1,0-.92.92A.92.92,0,0,0,8.065,10.6Zm3.68,0a.92.92,0,1,0-.92.92A.92.92,0,0,0,11.745,10.6Zm3.68,0a.92.92,0,1,0-.92.92A.92.92,0,0,0,15.425,10.6Z"
                                    transform="translate(-1.625 -1.627)" />
                            </svg>
                            SMS</a></li>
                    <li><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#whatsappModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.088" height="19.088"
                                viewBox="0 0 19.088 19.088">
                                <path id="_x30_8.Whatsapp"
                                    d="M19.544,10a9.552,9.552,0,0,0-7.73,15.151L10.5,28.61l3.794-1.1a9.442,9.442,0,0,0,5.249,1.575,9.544,9.544,0,0,0,0-19.088Zm5.082,13.5-1.026,1c-1.074,1.074-3.913-.1-6.418-2.625-2.505-2.505-3.627-5.345-2.625-6.394l1.026-1.026a1.038,1.038,0,0,1,1.432,0l1.5,1.5a.994.994,0,0,1-.382,1.646.966.966,0,0,0-.644,1.169,4.582,4.582,0,0,0,2.792,2.768,1,1,0,0,0,1.169-.644.994.994,0,0,1,1.646-.382l1.5,1.5A1.125,1.125,0,0,1,24.626,23.5Z"
                                    transform="translate(-10 -10)" />
                            </svg>
                            WhatsApp</a></li>
                    {{-- <li><a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20.072" height="20.072" viewBox="0 0 20.072 20.072">
                            <path id="envelope-download" d="M12.332,5.256a.836.836,0,0,1,1.183.013l1.539,1.573V.836a.836.836,0,1,1,1.673,0V6.842l1.539-1.573a.837.837,0,0,1,1.2,1.171l-2.1,2.149A2.072,2.072,0,0,1,15.9,9.2a.033.033,0,0,1-.016,0,2.054,2.054,0,0,1-1.455-.6L12.319,6.44a.836.836,0,0,1,.013-1.183Zm-2.3,7.642a2.509,2.509,0,0,0,1.775-.733l1.958-1.958a3.758,3.758,0,0,1-.523-.43L11.123,7.611a2.509,2.509,0,0,1,.038-3.548c.4-.388,1.209-1.1,1.735-1.554H4.182A4.17,4.17,0,0,0,.622,4.525l7.639,7.64a2.509,2.509,0,0,0,1.775.733Zm8.518-3.14a3.636,3.636,0,0,1-3.048,1.076l-2.513,2.513a4.188,4.188,0,0,1-5.915,0L.038,6.308C.027,6.44,0,6.559,0,6.691v9.2a4.187,4.187,0,0,0,4.182,4.182H15.89a4.187,4.187,0,0,0,4.182-4.182V8.206Z"/>
                          </svg>
                        Email</a></li> --}}
                </ul>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 mb-2" style="display: flex;justify-content: end;">
            <div class="d-flex">
                @if (Auth::user()->hasRole('ADMIN') ||
                        Auth::user()->hasRole('OPERATION MANAGER') ||
                        Auth::user()->hasRole('PROCESS MANAGER'))
                    <a class="dropdown-item me-2" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#exportModal"> <button type="button" class="btn advance_search_btn "
                            style="border-right: none;"> <i class="fas fa-file-excel"></i> Export CSV</button> </a>

                    <a class="dropdown-item me-2" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#importJobModel" data-bs-whatever="@fat"> <button type="button"
                            class="btn advance_search_btn " style="border-right: none;"> <i
                                class="fas fa-file-excel"></i> Import CSV</button> </a>
                                @endif
                    <div class="action_btn ">
                        <div class="dropdown">
                            <a class="btn reset-btn advance_search_btn" href="{{ route('jobs.index') }}"
                                style="min-width: 135px;"><i class="fas fa-redo-alt"></i>
                                Reset</a>
                        </div>
                    </div>

            </div>

        </div>

        <!-- Export Modal -->
        <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="exportForm" method="POST" action="{{ route('jobs.export') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exportModalLabel">Select Date Range for Export</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12">
            <div class="table-wrapper table-responsive border-bottom" data-toggle="lists">
                <table class="table mb-0 table-bordered" id="candidate_body12">
                    <thead class="candy-p">
                        <tr>
                            <th>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input js-check-selected-row checkAll"
                                        name="checkAll">
                                </div>
                            </th>

                            @can('View Job')
                                <th class="stick">
                                    View
                                </th>
                            @endcan

                            <th>
                                Current Status
                            </th>
                            <th class="can_full">Company Name</th>
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
{{-- Import Model  --}}
<div class="modal fade" id="importJobModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('jobs.import') }}" method="POST" id="candidate-job-form-import"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-6">
                                <label class="form-label">Download example Excel file</label>
                                <a href="{{ route('jobs.download.sample') }}" class="btn btn-sm btn-primary rounded">
                                    <i class="ti ti-download"></i> Download
                                </a>
                            </div>
                        </div>

                        <input type="file" class="form-control" id="file" name="file"
                            style="height: auto">
                        <span class="text-danger" id="file-err"></span>
                    </div>

                    <!-- Validation notes for users -->
                    <div class="mt-3">
                        <h6>Validation Notes:</h6>
                        <ul>
                            <li><strong>Contact Number:</strong> Must exist in the system and be numeric.</li>
                            <li><strong>Company Name & Location:</strong> Ensure that the company name and location
                                match existing records.</li>
                            <li><strong>Job Title:</strong> Must exist for the selected company and location.</li>
                            <li><strong>Interview Dates:</strong> Ensure that the interview start and end dates are
                                valid and that the end date is after or equal to the start date.</li>
                            <li><strong>Selection Date:</strong> Must be a date after or equal to the date of interview.
                            </li>
                            <li><strong>Salary:</strong> Must be numeric.</li>
                            <li><strong>Medical Dates:</strong> Medical dates (application, approval, etc.) must match
                                specific conditions, e.g., they must be provided together or with other relevant fields.
                            </li>
                            <li><strong>Installments:</strong> Ensure installment amounts are numeric and that dates are
                                valid.</li>
                            <li><strong>Mode of Selection:</strong> Must be one of the following: FULL TIME, PART TIME,
                                CONTRACT.</li>
                            <li><strong>Job Interview Status:</strong> Must be one of the following: SELECTED,
                                INTERESTED, NOT-INTERESTED.</li>
                            {{-- date format --}}
                            <li><strong>Date Format:</strong> Date format must be in the following format: dd-mm-yyyy.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(".interview-slide").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        speed: 300,
        centerPadding: "20px",
        infinite: true,
        autoplaySpeed: 5000,
        autoplay: false,
        prevArrow: '<div class="slick-nav prev-arrow"><i class="fa-solid fa-angle-left"></i></div>',
        nextArrow: '<div class="slick-nav next-arrow"><i class="fa-solid fa-angle-right"></i></div>',
        responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ],
    });
</script>
