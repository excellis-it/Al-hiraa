@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Schedule Interview
@endsection
@push('styles')
    <style>
        ::placeholder {
            color: #999 !important;
            opacity: 1;
            /* important for Firefox */
        }

        /* Premium UI Enhancements */
        .offcanvas,
        .modal-content {
            border-radius: 12px !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #014d8f;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }

        .input-group-text {
            background-color: #f8f9fa;
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .select2-container--default .select2-selection--single,
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            height: 38px;
            padding-top: 2px;
        }

        .select2-container--default .select2-selection--multiple {
            height: auto;
            min-height: 38px;
        }
    </style>
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            @can('Create Schedule')
                {{-- add task  --}}
                <div id="add-task">
                    @include('schedule.add-task')
                </div>

                {{-- end add task --}}
                {{-- offcanvas start --}}
                <div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel" aria-hidden="true" style="width: 500px;">
                    <div class="offcanvas-header bg-gradient border-0" style="background: #014d8f;">
                        <h5 class="offcanvas-title text-white fw-bold" id="offcanvasRightLabel">
                            <i class="fas fa-calendar-plus me-2"></i>Create an Interview
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-4">
                        <form action="{{ route('schedule-to-do.store') }}" method="POST" enctype="multipart/form-data"
                            id="schedule-to-do-form-create">
                            @csrf
                            <div class="row g-4">
                                <div class="col-xl-12">
                                    <div class="form-group mb-0">
                                        <label class="form-label fw-semibold text-dark mb-2">
                                            <i class="fas fa-building text-primary me-2"></i>Company Name<span
                                                class="text-danger ms-1">*</span>
                                        </label>
                                        <div class="input-group">
                                            <select name="company_id" id="company_id" class="form-select select2">
                                                <option value="">Choose Company</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">
                                                        {{ $company->company_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-outline-primary shadow-sm"
                                                data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                        <span class="text-danger small" id="company_id_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group mb-0">
                                        <label class="form-label fw-semibold text-dark mb-2">
                                            <i class="fas fa-briefcase text-success me-2"></i>Job <span
                                                class="text-danger ms-1">*</span>
                                        </label>
                                        <div class="input-group">
                                            <select name="job_id[]" id="job_id" class="form-select select2" multiple>
                                                <option value="">Choose Job</option>
                                            </select>
                                            <button type="button" class="btn btn-outline-primary shadow-sm" id="add-job-btn">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                        <span class="text-danger small" id="job_id_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group ">
                                        <label class="form-label fw-semibold text-dark mb-2">
                                            <i class="fas fa-calendar-alt text-info me-2"></i>Interview Date<span
                                                class="text-danger ms-1">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-calendar-day text-muted"></i>
                                            </span>
                                            <input type="text" class="form-control datepicker border-start-0 ps-0"
                                                id="interview_date" value="{{ date('d-m-Y') }}" name="interview_date">
                                        </div>
                                        <span class="text-danger small" id="interview_date_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group mb-0">
                                        <label class="form-label fw-semibold text-dark mb-2">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>Interview Location<span
                                                class="text-danger ms-1">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-location-arrow text-muted"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0 ps-0"
                                                id="interview_location" value="" name="interview_location"
                                                placeholder="Enter location">
                                        </div>
                                        <span class="text-danger small" id="interview_location_msg"></span>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <button type="submit"
                                            class="btn text-white px-4 fw-semibold shadow-sm flex-grow-1 py-2"
                                            style="background: #014d8f;">
                                            <i class="fa-solid fa-check me-2"></i>Submit
                                        </button>
                                        <button type="button"
                                            class="btn btn-light px-4 fw-semibold shadow-sm flex-grow-1 py-2 close-btn"
                                            style="border: 1px solid #ddd;">
                                            <i class="fa-solid fa-xmark me-2"></i>Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- offcanvas end --}}
            @endcan
            @can('Edit Schedule')
                <div id="edit-schedule">
                    @include('schedule.edit')
                </div>
            @endcan
            <section class="todo_sec text_left_td_th">

                <div class="row page__heading mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Schedule Interview</h4>
                            @can('Create Schedule')
                                <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight" style="background: #014d8f;"
                                    class="btn text-white px-4 py-2 fw-semibold shadow-sm">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    Add Interview
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div id="schedule-filter">
                    @include('schedule.filter')
                </div>
            </section>

        </div>
    </div>

        <!-- Add Company Modal -->
        <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; ">
                    <form id="schedule-add-company-form" action="{{ route('companies.store') }}" method="POST">
                        @csrf
                        <div class="modal-header border-0 bg-gradient py-3 px-4" style="background: #014d8f;">
                            <h5 class="modal-title text-white fw-bold" id="addCompanyModalLabel">
                                <i class="fas fa-building me-2"></i>Add New Company
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark mb-2">Company Name<span
                                        class="text-danger ms-1">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="fas fa-heading text-muted"></i></span>
                                    <input type="text" name="company_name" class="form-control border-start-0 ps-0"
                                        placeholder="Enter company name">
                                </div>
                                <span class="text-danger small" id="company_name_msg_add"></span>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark mb-2">Company Address<span
                                        class="text-danger ms-1">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="fas fa-map-marked-alt text-muted"></i></span>
                                    <input type="text" name="company_address" class="form-control border-start-0 ps-0"
                                        placeholder="Enter full address">
                                </div>
                                <span class="text-danger small" id="company_address_msg_add"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark mb-2">Company Industry<span
                                        class="text-danger ms-1">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="fas fa-industry text-muted"></i></span>
                                    <input type="text" name="company_industry"
                                        class="form-control border-start-0 ps-0" placeholder="e.g. Technology, Education">
                                </div>
                                <span class="text-danger small" id="company_industry_msg_add"></span>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-light p-3">
                            <button type="button" class="btn btn-light px-4 fw-semibold" data-bs-dismiss="modal"
                                style="border: 1px solid #ddd;">Cancel</button>
                            <button type="submit" class="btn text-white px-4 fw-semibold shadow-sm"
                                style="background: #014d8f;">
                                Save Company
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            $('#interview_date').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy',
            });
        </script>
        <script>
            $(document).ready(function() {
                // Initialize Select2 for company and job dropdowns
                $('.select2').select2({
                    dropdownParent: $('#offcanvasRight')
                });

                $('#company_id').change(function() {
                    var company_id = $(this).val();
                    if (company_id) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('get-job-list') }}",
                            data: {
                                company_id: company_id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                if (res) {
                                    $("#job_id").empty();
                                    $.each(res, function(key, value) {
                                        $("#job_id").append('<option value="' + value.id +
                                            '">' + value.job_name + ' (' + value
                                            .job_id +
                                            ')</option>');
                                    });
                                    $('#job_id').trigger('change');
                                } else {
                                    $("#job_id").empty();
                                }
                            }
                        });
                    } else {
                        $("#job_id").empty();
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.close-btn', function() {
                    $('.text-danger').html('');
                    $('#offcanvasRight').offcanvas('hide');
                });

                $(document).on('submit', '#schedule-to-do-form-create', function(e) {
                    e.preventDefault();

                    var formData = new FormData($(this)[0]);
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('.text-danger').html('');
                            if (response.status == true) {
                                // Hide offcanvas
                                var offEl = document.getElementById('offcanvasRight');
                                var off = bootstrap.Offcanvas.getInstance(offEl);
                                if (off) off.hide();

                                $('#loading').removeClass('loading');
                                $('#loading-content').removeClass('loading-content');

                                toastr.success(response.message);

                                // Reset form
                                $('#schedule-to-do-form-create')[0].reset();
                                $('#company_id').val('').trigger('change');

                                // Refresh table data
                                fetch_data('', '', '', 1);
                            } else {
                                $('#loading').removeClass('loading');
                                $('#loading-content').removeClass('loading-content');
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            $('.text-danger').html('');
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + '_msg').html(value[0]);
                            });
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.close-btn-edit', function() {
                    $('.text-danger').html('');
                    $('#offcanvasEdit').offcanvas('hide');
                });

                $(document).on('click', '.edit-route', function() {
                    var route = $(this).data('route');
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');
                    $.ajax({
                        url: route,
                        type: 'GET',
                        success: function(response) {
                            $('#edit-schedule').html(response.view);
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            $('#offcanvasEdit').offcanvas('show');
                        },
                        error: function(xhr) {
                            // Handle errors
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            console.log(xhr);
                        }
                    });
                });

                // Handle the form submission
                $(document).on('submit', '#schedule-edit-form', function(e) {


                    e.preventDefault();

                    var formData = new FormData($(this)[0]);

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // window.location.reload();
                            // toastr.success('Members details updated successfully');
                            if (response.status == true) {
                                // window.location.reload();
                                $('#offcanvasEdit').offcanvas('hide');
                                toastr.success(response.message);
                                $('#single-row-update-' + response.interview.id).html(response
                                    .view);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            $('.text-danger').html('');
                            // Handle errors (e.g., display validation errors)
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                // Assuming you have a span with class "text-danger" next to each input
                                $('#' + key + '_msg_error').html(value[0]);
                            });
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.close-btn-add-job', function() {
                    $('.text-danger').html('');
                    var offEl = document.getElementById('offcanvasRightJob');
                    var off = bootstrap.Offcanvas.getInstance(offEl);
                    if (off) off.hide();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Initialize datepicker for date filter
                var dateFilter = $('#date-filter').datepicker({
                    uiLibrary: 'bootstrap5',
                    format: 'dd-mm-yyyy',
                    change: function(e) {
                        // Trigger filter when date is selected
                        var date = e.target.value;
                        var company = $('#company-filter').val();
                        var search = $('#search-filter').val();
                        fetch_data(search, company, date, 1);
                    }
                });

                function fetch_data(search = '', company = '', date = '', page = 1, showLoader = true) {
                    if (showLoader) {
                        $('#loading').addClass('loading');
                        $('#loading-content').addClass('loading-content');
                    }

                    $.ajax({
                        url: "{{ route('schedule-to-do.filter') }}",
                        type: 'GET',
                        data: {
                            search: search,
                            company_id: company,
                            date: date,
                            page: page,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#schedule-filter').html(data.view);

                            if (showLoader) {
                                $('#loading').removeClass('loading');
                                $('#loading-content').removeClass('loading-content');
                            }

                            // Re-initialize datepicker after AJAX load
                            $('#date-filter').datepicker({
                                uiLibrary: 'bootstrap5',
                                format: 'dd-mm-yyyy',
                                change: function(e) {
                                    var date = e.target.value;
                                    var company = $('#company-filter').val();
                                    var search = $('#search-filter').val();
                                    fetch_data(search, company, date, 1);
                                }
                            });

                            // Scroll to top of table only if showing loader (indicates major change)
                            if (showLoader && $("#schedule-filter").length) {
                                $('html, body').animate({
                                    scrollTop: $("#schedule-filter").offset().top - 100
                                }, 500);
                            }
                        },
                        error: function(xhr, status, error) {
                            if (showLoader) {
                                $('#loading').removeClass('loading');
                                $('#loading-content').removeClass('loading-content');
                            }
                            console.error('AJAX Error:', error);
                            toastr.error('Error loading data. Please try again.');
                        }
                    });
                }

                // Company filter
                $(document).on('change', '#company-filter', function() {
                    var company = $(this).val();
                    var search = $('#search-filter').val();
                    var date = $('#date-filter').val();
                    fetch_data(search, company, date, 1);
                });

                // Search filter in table with debounce
                var searchTimer;
                $(document).on('keyup', '#search-filter', function() {
                    var search = $(this).val();
                    var company = $('#company-filter').val();
                    var date = $('#date-filter').val();

                    clearTimeout(searchTimer);
                    searchTimer = setTimeout(function() {
                        fetch_data(search, company, date, 1, false);
                    }, 500);
                });

                // Clear filters
                $(document).on('click', '#clear-filters', function() {
                    $('#company-filter').val('');
                    $('#date-filter').val('');
                    $('#search-filter').val('');
                    fetch_data('', '', '', 1);
                });

                // Pagination links
                $(document).on('click', '.pagination-link', function(e) {
                    e.preventDefault();
                    var page = $(this).data('page');
                    var search = $('#search-filter').val();
                    var company = $('#company-filter').val();
                    var date = $('#date-filter').val();
                    fetch_data(search, company, date, page);
                });

                // Handle Add Company
                $(document).on('submit', '#schedule-add-company-form', function(e) {
                    e.preventDefault();
                    $('.text-danger').html('');
                    var formData = new FormData(this);
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            if (res.status) {
                                toastr.success(res.message);
                                $('#addCompanyModal').modal('hide');
                                var newOption = new Option(res.company_name, res.company_id, true,
                                    true);
                                $('#company_id').append(newOption).trigger('change');
                                $('#schedule-add-company-form')[0].reset();
                            } else {
                                toastr.error(res.error || 'Failed to add company');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + '_msg_add').html(value[0]);
                                });
                            } else {
                                toastr.error('An error occurred while creating the company');
                            }
                        }
                    });
                });

                $(document).on('click', '.close-btn', function() {
                    var myOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById(
                        'offcanvasRight'));
                    if (myOffcanvas) myOffcanvas.hide();
                });

                // Handle Add Job Button Click
                $(document).on('click', '#add-job-btn', function() {
                    var company_id = $('#company_id').val();
                    if (!company_id) {
                        toastr.warning('Please select a company first');
                        return;
                    }

                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');

                    $.ajax({
                        url: '/get-job-create-url/' + company_id,
                        type: 'GET',
                        success: function(urlResponse) {
                            $.ajax({
                                url: urlResponse.url,
                                type: 'GET',
                                success: function(response) {
                                    $('#add-task').html(response.view);
                                    $('#loading').removeClass('loading');
                                    $('#loading-content').removeClass(
                                        'loading-content');

                                    var currentOffcanvas = bootstrap.Offcanvas
                                        .getInstance(document.getElementById(
                                            'offcanvasRight'));
                                    if (currentOffcanvas) currentOffcanvas.hide();

                                    setTimeout(function() {
                                        var jobOffcanvasElement = document
                                            .getElementById(
                                                'offcanvasRightJob');
                                        if (jobOffcanvasElement) {
                                            var jobOffcanvas = new bootstrap
                                                .Offcanvas(jobOffcanvasElement);
                                            jobOffcanvas.show();
                                        }
                                    }, 400);
                                },
                                error: function() {
                                    $('#loading').removeClass('loading');
                                    $('#loading-content').removeClass(
                                        'loading-content');
                                    toastr.error('Failed to load job creation form');
                                }
                            });
                        },
                        error: function() {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            toastr.error('Failed to get encrypted URL');
                        }
                    });
                });

                // Top-level delegated handler for company job form
                $(document).on('submit', '#company-job-form-create', function(e) {
                    e.preventDefault();
                    $('.text-danger').html('');
                    var jobFormData = new FormData(this);

                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');

                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: jobFormData,
                        processData: false,
                        contentType: false,
                        success: function(jobRes) {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');

                            if (jobRes.status) {
                                toastr.success(jobRes.message);
                                var offEl = document.getElementById('offcanvasRightJob');
                                var jobOff = bootstrap.Offcanvas.getInstance(offEl);
                                if (jobOff) jobOff.hide();

                                $('#company_id').trigger('change');

                                setTimeout(function() {
                                    var interviewOff = new bootstrap.Offcanvas(document
                                        .getElementById('offcanvasRight'));
                                    interviewOff.show();
                                }, 500);
                            } else {
                                toastr.error(jobRes.message);
                            }
                        },
                        error: function(xhr) {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + '_msg_create').html(value[0]);
                            });
                        }
                    });
                });

                // Initialize select2 for multiple selection
                $('.select2').each(function() {
                    $(this).select2({
                        dropdownParent: $(this).closest('.offcanvas-body')
                    });
                });
            });
        </script>
    @endpush
