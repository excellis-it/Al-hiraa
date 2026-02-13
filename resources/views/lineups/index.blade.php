@extends('layouts.master')

@section('title')
{{ env('APP_NAME') }} - Lineup Management
@endsection

@push('styles')
<style>
    .filter-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 24px;
        margin-bottom: 24px;
        border: none;
    }

    .filter-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        margin-bottom: 8px;
        display: block;
    }

    .premium-table-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: none;
        overflow: hidden;
    }

    .premium-table thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 16px;
        border-bottom: 2px solid #e2e8f0;
    }

    .premium-table tbody td {
        padding: 16px;
        vertical-align: middle;
        color: #1e293b;
        font-size: 0.875rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    .status-interested {
        background: #e6fffa;
        color: #2c7a7b;
        border: 1px solid #b2f5ea;
    }

    .status-not-interested {
        background: #fff5f5;
        color: #c53030;
        border: 1px solid #fed7d7;
    }

    .status-pending {
        background: #fffaf0;
        color: #9c4221;
        border: 1px solid #feebc8;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 100;
        backdrop-filter: blur(2px);
    }

    /* Premium Modal Styling */
    .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background: #f8fafc;
        border-bottom: 1px solid #edf2f7;
        padding: 20px 24px;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .modal-title {
        font-size: 1.15rem;
        color: #1e293b;
    }

    .modal-body {
        padding: 24px;
    }

    .modal-footer {
        background: #f8fafc;
        border-top: 1px solid #edf2f7;
        padding: 16px 24px;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    /* Custom scrollbar for history table */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
        width: 6px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 10px;
    }
</style>
@endpush

@section('content')
<div class="mdk-drawer-layout__content page">
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center justify-content-between">
            <h1 class="m-0">Lineup Management</h1>
            {{-- edit candidates --}}
            <div id="candidate-edit" class="jobs_canvas">
            </div>
            {{-- end edit candidates --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lineup Management</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid page__container">
        <!-- Filters -->
        <div class="filter-card">
            <form action="{{ route('lineups.index') }}" method="GET" id="filter-form">
                <input type="hidden" name="get_interview_id" value="{{ request()->get('get_interview_id') }}">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="filter-label">Search</label>
                        <input type="text" name="search" id="search_input" class="form-control"
                            placeholder="Name, Passport, Contact..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="filter-label">Company</label>
                        <select name="company_id" id="company_filter" class="form-select select2">
                            <option value="">All Companies</option>
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ $selectedCompany == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="filter-label">Job Title</label>
                        <select name="job_id" id="job_filter" class="form-select select2">
                            <option value="">All Jobs</option>
                            @foreach ($jobs as $job)
                            <option value="{{ $job->id }}" {{ $selectedJob == $job->id ? 'selected' : '' }}>
                                {{ $job->job_name }} ({{ $job->job_id }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="filter-label">Interview Date</label>
                        <select name="interview_id" id="interview_filter" class="form-select select2">
                            <option value="">All Dates</option>
                            @foreach ($interviews as $interview)
                            <option value="{{ $interview->id }}"
                                {{ $selectedInterview == $interview->id ? 'selected' : '' }}>
                                {{ $interview->interview_start_date }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="filter-label">Status</label>
                        <select name="interview_status" class="form-select select2">
                            <option value="">All Status</option>
                            <option value="Pending" {{ request('interview_status') == 'Pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="Interested"
                                {{ request('interview_status') == 'Interested' ? 'selected' : '' }}>Interested</option>
                            <option value="Not-Interested"
                                {{ request('interview_status') == 'Not-Interested' ? 'selected' : '' }}>Not-Interested
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="filter-label">Show</label>
                        <select name="per_page" id="per_page_filter" class="form-select select2">
                            <option value="20" {{ request('per_page') == '20' ? 'selected' : '' }}>20 per page
                            </option>
                            <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50 per page
                            </option>
                            <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100 per page
                            </option>
                            <option value="200" {{ request('per_page') == '200' ? 'selected' : '' }}>200 per page
                            </option>
                            <option value="500" {{ request('per_page') == '500' ? 'selected' : '' }}>500 per page
                            </option>
                        </select>
                    </div>
                    <div class="col-md-1 d-flex align-items-end gap-1">
                        <button type="submit" class="btn btn-primary px-3" title="Filter"><i
                                class="fa fa-filter"></i></button>
                        <button type="button" id="reset-filter-btn" class="btn btn-secondary px-3" title="Reset"><i
                                class="fa fa-sync"></i></button>
                    </div>
                    @can('Export Lineup')
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" id="export-btn" class="btn btn-success w-100" title="Export to Excel">
                            <i class="fa fa-file-excel"></i>
                        </button>
                    </div>
                    @endcan
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="premium-table-card position-relative">
            <div class="loading-overlay" id="table-loading">
                <div class="spinner-border text-primary" role="status"></div>
            </div>
            <div class="table-responsive">
                <table class="table premium-table mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="50">
                                <input type="checkbox" class="form-check-input" id="select-all-lineups">
                            </th>
                            <th>Candidate Name</th>
                            <th>Contact</th>
                            <th>Company</th>
                            <th>Job Title</th>
                            <th>Interview Date</th>
                            <th>Status</th>
                            <th>Assigned By</th>
                            @canany(['View Lineup', 'Edit Lineup'])
                            <th class="text-end">Action</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody id="lineup-table-body">
                        @include('lineups.table')
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="lineupViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold"><i class="fa fa-info-circle me-2"></i>Lineup Detailed Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="lineup-details-content">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusUpdateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="status-update-form">
                @csrf
                <input type="hidden" name="lineup_id" id="update_lineup_id">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Update Interview Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Select Status</label>
                        <select name="interview_status" id="update_interview_status" class="form-select" required>
                            <option value="Pending">Pending</option>
                            <option value="Interested">Interested</option>
                            <option value="Not-Interested">Not-Interested</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Remarks</label>
                        <textarea name="status_remarks" id="update_status_remarks" class="form-control" rows="3"
                            placeholder="Enter remarks..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="save-status-btn">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Helper function for AJAX filtering
        function fetchFilteredData() {
            $('#table-loading').css('display', 'flex');
            var formData = $('#filter-form').serialize();
            var get_interview_id = "{{ request()->get('get_interview_id') }}";
            // alert(get_interview_id);
            formData += '&get_interview_id=' + get_interview_id;
            $.ajax({
                url: "{{ route('lineups.index') }}",
                type: 'GET',
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        $('#lineup-table-body').html(response.html);
                    }
                    $('#table-loading').css('display', 'none');
                },
                error: function() {
                    $('#table-loading').css('display', 'none');
                    toastr.error('Error fetching data');
                }
            });
        }

        // Trigger filter update on change of any select
        $(document).on('change', '#filter-form select', function() {
            fetchFilteredData();
        });

        // Open Status Update Modal
        $(document).on('click', '.edit-status-btn', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            var remarks = $(this).data('remarks');

            $('#update_lineup_id').val(id);
            $('#update_interview_status').val(status || 'Pending');
            $('#update_status_remarks').val(remarks || '');
            $('#statusUpdateModal').modal('show');
        });

        // Handle Status Update Submit
        $('#status-update-form').on('submit', function(e) {
            e.preventDefault();
            var id = $('#update_lineup_id').val();
            var btn = $('#save-status-btn');
            btn.prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm me-1"></span>Updating...');

            $.ajax({
                url: "{{ url('lineups') }}/" + id + "/update-status",
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message);
                        $('#statusUpdateModal').modal('hide');
                        fetchFilteredData();
                    }
                    btn.prop('disabled', false).text('Update Status');
                },
                error: function() {
                    toastr.error('Error updating status');
                    btn.prop('disabled', false).text('Update Status');
                }
            });
        });

        // Search input with debounce
        var searchTimer;
        $(document).on('keyup', '#search_input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() {
                fetchFilteredData();
            }, 500);
        });

        // Cascading Dropdown: Company → Job Title → Interview Date
        $(document).on('change', '#company_filter', function() {
            var companyId = $(this).val();
            var $jobSelect = $('#job_filter');
            var $interviewSelect = $('#interview_filter');

            $jobSelect.html('<option value="">All Jobs</option>');
            $interviewSelect.html('<option value="">All Dates</option>');

            if (companyId) {
                $.ajax({
                    url: "{{ route('lineups.get-jobs-by-company') }}",
                    type: 'GET',
                    data: {
                        company_id: companyId
                    },
                    success: function(response) {
                        if (response.status == 'success' && response.jobs.length > 0) {
                            var options = '<option value="">All Jobs</option>';
                            $.each(response.jobs, function(index, job) {
                                options += '<option value="' + job.id + '">' +
                                    job.job_name + ' (' + job.job_id + ')</option>';
                            });
                            $jobSelect.html(options);
                        }
                    }
                });
            }
        });

        $(document).on('change', '#job_filter', function() {
            var jobId = $(this).val();
            var $interviewSelect = $('#interview_filter');

            $interviewSelect.html('<option value="">All Dates</option>');

            if (jobId) {
                $.ajax({
                    url: "{{ route('lineups.get-interviews-by-job') }}",
                    type: 'GET',
                    data: {
                        job_id: jobId
                    },
                    success: function(response) {
                        if (response.status == 'success' && response.interviews.length >
                            0) {
                            var options = '<option value="">All Dates</option>';
                            $.each(response.interviews, function(index, interview) {
                                options += '<option value="' + interview.id + '">' +
                                    interview.interview_start_date + '</option>';
                            });
                            $interviewSelect.html(options);
                        }
                    }
                });
            }
        });


        // Reset Filter Button
        $(document).on('click', '#reset-filter-btn', function() {
            $('#filter-form')[0].reset();
            $('#filter-form select').val('').trigger('change.select2');
            $('#search_input').val('');

            // Manually clear cascading selects that might have been populated
            $('#job_filter').html('<option value="">All Jobs</option>');
            $('#interview_filter').html('<option value="">All Dates</option>');

            fetchFilteredData();
        });

        // Select All Checkboxes
        $(document).on('change', '#select-all-lineups', function() {
            $('.select-lineup').prop('checked', $(this).prop('checked'));
        });

        // Export Button Functionality
        $(document).on('click', '#export-btn', function() {
            var selectedIds = [];
            $('.select-lineup:checked').each(function() {
                selectedIds.push($(this).val());
            });

            var baseUrl = "{{ route('lineups.export') }}";
            var formData = $('#filter-form').serializeArray();

            // Add select2 values specifically if needed (serialize usually handles them)
            var queryParams = $.param(formData);

            if (selectedIds.length > 0) {
                queryParams += '&ids=' + selectedIds.join(',');
            }

            window.location.href = baseUrl + '?' + queryParams;
        });

        // View Details Modal Trigger
        $(document).on('click', '.view-lineup-btn', function() {
            var id = $(this).data('id');
            $('#lineup-details-content').html(
                '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>'
            );
            $('#lineupViewModal').modal('show');

            $.ajax({
                url: "{{ url('lineups') }}/" + id,
                type: 'GET',
                success: function(response) {
                    if (response.status == 'success') {
                        $('#lineup-details-content').html(response.html);
                    }
                },
                error: function() {
                    $('#lineup-details-content').html(
                        '<div class="alert alert-danger">Error loading details.</div>');
                }
            });
        });

        // Pagination Click
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var formData = $('#filter-form').serialize() + '&page=' + page;

            $('#table-loading').css('display', 'flex');
            $.ajax({
                url: "{{ route('lineups.index') }}",
                type: 'GET',
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        $('#lineup-table-body').html(response.html);
                    }
                    $('#table-loading').css('display', 'none');
                }
            });
        });

        // Edit Candidate Offcanvas
        $(document).on('click', '.edit-route', function() {
            var route = $(this).data('route');
            $('#table-loading').css('display', 'flex');

            $.ajax({
                url: route,
                type: 'GET',
                success: function(response) {
                    $('#table-loading').css('display', 'none');

                    if (response.status === 'error') {
                        toastr.error(response.message);
                        return;
                    }

                    $('#candidate-edit').html(response.view);
                    var offcanvasElement = document.getElementById('offcanvasEdit');
                    var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                    offcanvas.show();
                },
                error: function(xhr) {
                    $('#table-loading').css('display', 'none');
                    toastr.error('Error loading candidate details');
                    console.log(xhr);
                }
            });
        });

        // Compatibility for candidate edit form submission (from list.blade.php logic)
        window.last_data = function() {
            fetchFilteredData();
        };
        window.fetch_data = function() {
            fetchFilteredData();
        };

        // Handle loading overlay used in edit.blade.php
        $(document).on('ajaxStart', function() {
            // If it's the candidate edit form submit, use the loading section from master
            if ($('#candidate-edit-form-submit').length) {
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
            }
        }).on('ajaxComplete', function() {
            $('#loading').removeClass('loading');
            $('#loading-content').removeClass('loading-content');
        });
    });
</script>
@endpush