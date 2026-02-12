@if (count($interviews) > 0 || request()->has('search') || request()->has('company_id') || request()->has('date'))
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <!-- Filters Section -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">Company</label>
                    <select class="form-select form-select-sm" id="company-filter">
                        <option value="">All Companies</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Date</label>
                    <input type="text" class="form-control form-control-sm" id="date-filter" placeholder="DD-MM-YYYY"
                        value="{{ request('date') }}" readonly>
                </div>
                <div class="col-md-5">
                    <label class="form-label small text-muted mb-1">Search</label>
                    <input type="text" class="form-control form-control-sm" id="search-filter" placeholder="Search"
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-2 d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary w-100" id="clear-filters">
                        <i class="fa-solid fa-rotate-right me-1"></i> Clear
                    </button>
                </div>
            </div>

            @if (count($interviews) > 0)
                <!-- Table Section -->
                <div class="table-wrapper table-responsive border-bottom">
                    <table class="table mb-0 table-bordered" id="schedule-table">
                        <thead class="candy-p">
                            <tr class="border-bottom">
                                <th class="">Company</th>
                                <th class="">Interview ID</th>
                                <th class="">Job Name</th>
                                <th class="">Assignee</th>
                                <th class="">Interview Date</th>
                                <th class="">Interview Location</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($interviews as $interview)
                                <tr id="single-row-update-{{ $interview['id'] }}" class="border-bottom"
                                    data-company-id="{{ $interview['company_id'] }}"
                                    data-company-name="{{ $interview['company']['company_name'] ?? '' }}"
                                    data-interview-date="{{ $interview['interview_start_date'] ?? '' }}">

                                    @include('schedule.single-row-update')
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                @if (isset($paginationHtml) && $paginationHtml)
                    <div class="mt-4">
                        {!! $paginationHtml !!}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fa-solid fa-calendar-xmark fa-4x text-muted opacity-25"></i>
                    </div>
                    <h6 class="text-muted mb-2">No Interviews Found</h6>
                    <p class="text-muted small mb-0">Try adjusting your filters or add a new interview.</p>
                </div>
            @endif
        </div>
    </div>
@else
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5">
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fa-solid fa-calendar-days fa-4x text-muted opacity-25"></i>
                </div>
                <h6 class="text-muted mb-2">No Interviews Scheduled</h6>
                <p class="text-muted small mb-0">Get started by adding your first interview.</p>
            </div>
        </div>
    </div>
@endif

<style>
    /* Enhanced Schedule Table Styles */
    .card {
        border-radius: 8px;
    }

    .form-select-sm,
    .form-control-sm {
        height: 38px;
        font-size: 14px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }

    .form-select-sm:focus,
    .form-control-sm:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .form-label.small {
        font-size: 12px;
        font-weight: 500;
    }

    #schedule-table {
        font-size: 14px;
    }

    #schedule-table thead th {
        background-color: transparent;
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-size: 11px;
        letter-spacing: 0.5px;
        padding: 12px 16px;
    }

    #schedule-table tbody td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }

    #schedule-table tbody tr:last-child td {
        border-bottom: none;
    }

    #schedule-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .name_textbg {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        font-size: 11px;
        margin-right: 10px;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .btn-outline-secondary {
        border-color: #dee2e6;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }

    .pagination {
        margin-bottom: 0;
    }

    .pagination .page-link {
        color: #495057;
        border: 1px solid #dee2e6;
        padding: 8px 12px;
        font-size: 14px;
        margin: 0 2px;
        border-radius: 4px;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .opacity-25 {
        opacity: 0.25 !important;
    }
</style>
