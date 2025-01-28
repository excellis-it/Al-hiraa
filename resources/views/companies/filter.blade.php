<div class="tabs">
    <ul class="nav nav-tabs" id="companyTabs">
        <li class="nav-item">
            <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active-companies">Active Company</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inactive-tab" data-bs-toggle="tab" href="#inactive-companies">Inactive Company</a>
        </li>
    </ul>
    <div class="tab-content" id="companyTabContent">
        <!-- Active Companies Tab -->
        <div class="tab-pane fade show active" id="active-companies">
            @if (count($companies) > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-5">
                    @foreach ($companies as $company)
                        <div class="col mb-4">
                            <div class="food-box">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="food-box-img">
                                        @if ($company->company_logo)
                                            <img src="{{ Storage::url($company->company_logo) }}" alt="">
                                        @else
                                            <img src="{{ asset('assets/images/company.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="button-switch">
                                        <input type="checkbox" id="switch-orange" class="switch toggle-class"
                                            data-id="{{ $company['id'] }}" {{ $company['status'] ? 'checked' : '' }} />
                                        <label for="switch-orange" class="lbl-off"></label>
                                        <label for="switch-orange" class="lbl-on"></label>
                                    </div>
                                </div>
                                <div class="food-box-head">
                                    <h3>{{ $company->company_name ?? 'N/A' }}</h3>
                                </div>
                                <div class="food-status">
                                    <div class="food-status-1">
                                        <h4>Address:</h4>
                                    </div>
                                    <div class="food-status-2 company_address">
                                        <h4>{{ Str::limit($company->company_address, 10) ?? 'N/A' }}</h4>
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
                                        <h4>Active Job Opening:</h4>
                                    </div>
                                    <div class="food-status-2 companey_wesi">
                                        <a href="{{ route('companies.show', Crypt::encrypt($company->id)) }}">
                                            <h4>{{ $company->jobs ? $company->jobs()->where('status', 'Ongoing')->count() : 'N/A' }}</h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="">
                                    <a href="{{ route('companies.show', Crypt::encrypt($company->id)) }}" class="btn-2">See Open Jobs</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-xl-12">
                        <div class="d-flex justify-content-center">
                            <h6>No Active Companies Found</h6>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Inactive Companies Tab -->
        <div class="tab-pane fade" id="inactive-companies">
            @if (count($inactiveCompanies) > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-5">
                    @foreach ($inactiveCompanies as $company)
                        <div class="col mb-4">
                            <div class="food-box">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="food-box-img">
                                        @if ($company->company_logo)
                                            <img src="{{ Storage::url($company->company_logo) }}" alt="">
                                        @else
                                            <img src="{{ asset('assets/images/company.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="button-switch">
                                        <input type="checkbox" id="switch-orange" class="switch toggle-class"
                                            data-id="{{ $company['id'] }}" {{ $company['status'] ? 'checked' : '' }} />
                                        <label for="switch-orange" class="lbl-off"></label>
                                        <label for="switch-orange" class="lbl-on"></label>
                                    </div>
                                </div>
                                <div class="food-box-head">
                                    <h3>{{ $company->company_name ?? 'N/A' }}</h3>
                                </div>
                                <div class="food-status">
                                    <div class="food-status-1">
                                        <h4>Address:</h4>
                                    </div>
                                    <div class="food-status-2 company_address">
                                        <h4>{{ Str::limit($company->company_address, 10) ?? 'N/A' }}</h4>
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
                                        <h4>Active Job Opening:</h4>
                                    </div>
                                    <div class="food-status-2 companey_wesi">
                                        <a href="{{ route('companies.show', Crypt::encrypt($company->id)) }}">
                                            <h4>{{ $company->jobs ? $company->jobs()->where('status', 'Ongoing')->count() : 'N/A' }}</h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="">
                                    <a href="{{ route('companies.show', Crypt::encrypt($company->id)) }}" class="btn-2">See Open Jobs</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-xl-12">
                        <div class="d-flex justify-content-center">
                            <h3>No Inactive Companies Found</h3>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
