@if (count($companies) > 0)
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-5">
    @foreach ($companies as $company)
        <div class="col mb-4">
            <div class="food-box">
                <div class="food-box-img">
                    @if ($company->company_logo)
                        <img src="{{ Storage::url($company->company_logo) }}" alt="">
                    @else
                        <img src="{{ asset('assets/images/company.png') }}" alt="">
                    @endif

                </div>
                <div class="food-box-head">
                    <h3>{{ $company->company_name ?? 'N/A' }}</h3>
                </div>
                <div class="food-status">
                    <div class="food-status-1">
                        <h4>Address:</h4>
                    </div>
                    <div class="food-status-2 company_address">
                        <h4>{{ $company->company_address ?? 'N/A' }}</h4>
                    </div>
                </div>
                <div class="food-status">
                    <div class="food-status-1">
                        <h4>Industry:</h4>
                    </div>
                    <div class="food-status-2">
                        <h4>{{ $company->company_industry ?? 'N/A' }}</h4>
                    </div>
                </div>
                <div class="food-status">
                    <div class="food-status-1">
                        <h4>Company Website:</h4>
                    </div>
                    <div class="food-status-2 companey_wesi">
                        <h4>{{ $company->company_website ?? 'N/A' }}</h4>
                    </div>
                </div>
                {{-- <div class="food-status">
                    <div class="food-status-1">
                        <h4>Position:</h4>
                    </div>
                    <div class="food-status-2">
                        <h4>Chef, Floor M
                            <span class="info_img">
                                <svg xmlns="http://www.w3.org/2000/svg" width="11"
                                    height="11" viewBox="0 0 11 11">
                                    <g id="info" transform="translate(-5 -29)"
                                        opacity="0.5">
                                        <g id="Group_11" data-name="Group 11"
                                            transform="translate(5 29)">
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
                <div class="food-status">
                    <div class="food-status-1">
                        <h4>Prev Year Selection:</h4>
                    </div>
                    <div class="food-status-2">
                        <h4>8.5k</h4>
                    </div>
                </div>
                <div class="food-status">
                    <div class="food-status-1">
                        <h4>Collection: </h4>
                    </div>
                    <div class="food-status-2">
                        <h4>50 Lac</h4>
                    </div>
                </div> --}}
                <div class="">
                    <a href="{{route('companies.show', Crypt::encrypt($company->id))}}" class="btn-2">See Open Jobs</a>
                </div>
            </div>
        </div>
    @endforeach
    {{-- pagination --}}
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-center">
            {{ $companies->links() }}
        </div>
    </div>
</div>
@else
{{-- no data found --}}
<div class="row">
    <div class="col-xl-12">
        <div class="d-flex justify-content-center">
            <h3>No Data Found</h3>
        </div>
    </div>
</div>
@endif
