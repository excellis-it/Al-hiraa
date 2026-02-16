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
                            <div class="company-card">
                                <div class="company-card-left">
                                    <div class="company-card-header">
                                        <div class="company-card-logo">
                                            @if ($company->company_logo)
                                                <img src="{{ Storage::url($company->company_logo) }}" alt="">
                                            @else
                                                <img src="{{ asset('assets/images/company.png') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="company-card-title">
                                            <h3>{{ $company->company_name ?? 'N/A' }}</h3>
                                            <div class="company-toggle">
                                                <input type="checkbox" id="switch-{{ $company['id'] }}" class="switch toggle-class"
                                                    data-id="{{ $company['id'] }}" {{ $company['status'] ? 'checked' : '' }} />
                                                <label for="switch-{{ $company['id'] }}" class="lbl-off"></label>
                                                <label for="switch-{{ $company['id'] }}" class="lbl-on"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="company-card-info">
                                        <div class="company-info-item">
                                            <span class="info-label">Address:</span>
                                            <span class="info-value">{{ Str::limit($company->company_address, 15) ?? 'N/A' }}</span>
                                        </div>
                                        <div class="company-info-item">
                                            <span class="info-label">Industry:</span>
                                            <span class="info-value">{{ Str::limit($company->company_industry, 20) ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="company-card-right">
                                    <div class="company-jobs-badge">
                                        <div class="jobs-count">{{ $company->jobs ? $company->jobs()->where('status', 'Ongoing')->count() : '0' }}</div>
                                        <div class="jobs-label">Active Jobs</div>
                                    </div>
                                    <a href="{{ route('companies.show', Crypt::encrypt($company->id)) }}" class="company-btn-primary">View Details</a>
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
                            <div class="company-card">
                                <div class="company-card-left">
                                    <div class="company-card-header">
                                        <div class="company-card-logo">
                                            @if ($company->company_logo)
                                                <img src="{{ Storage::url($company->company_logo) }}" alt="">
                                            @else
                                                <img src="{{ asset('assets/images/company.png') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="company-card-title">
                                            <h3>{{ $company->company_name ?? 'N/A' }}</h3>
                                            <div class="company-toggle">
                                                <input type="checkbox" id="switch-inactive-{{ $company['id'] }}" class="switch toggle-class"
                                                    data-id="{{ $company['id'] }}" {{ $company['status'] ? 'checked' : '' }} />
                                                <label for="switch-inactive-{{ $company['id'] }}" class="lbl-off"></label>
                                                <label for="switch-inactive-{{ $company['id'] }}" class="lbl-on"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="company-card-info">
                                        <div class="company-info-item">
                                            <span class="info-label">Address:</span>
                                            <span class="info-value">{{ Str::limit($company->company_address, 15) ?? 'N/A' }}</span>
                                        </div>
                                        <div class="company-info-item">
                                            <span class="info-label">Industry:</span>
                                            <span class="info-value">{{ Str::limit($company->company_industry, 20) ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="company-card-right">
                                    <div class="company-jobs-badge">
                                        <div class="jobs-count">{{ $company->jobs ? $company->jobs()->where('status', 'Ongoing')->count() : '0' }}</div>
                                        <div class="jobs-label">Active Jobs</div>
                                    </div>
                                    <a href="{{ route('companies.show', Crypt::encrypt($company->id)) }}" class="company-btn-primary">View Details</a>
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
