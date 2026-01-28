@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Schedule & To-Do
@endsection
@push('styles')
    <style>
        ::placeholder {
            color: #161616 !important;
            opacity: 1;
            /* important for Firefox */
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
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                    aria-hidden="true">
                    <div class="offcanvas-body">
                        <div class="user-acces-table">
                            <form action="{{ route('schedule-to-do.store') }}" method="POST" enctype="multipart/form-data"
                                id="schedule-to-do-form-create">
                                @csrf
                                <div class="frm-head">
                                    <h2>Create an Interview</h2>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="add-mem-form">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Company Name<span>*</span></label>
                                                        <select name="company_id" id="company_id" class="form-select">
                                                            <option value="">Choose Company</option>
                                                            @foreach ($companies as $company)
                                                                <option value="{{ $company->id }}">
                                                                    {{ $company->company_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Job <span>*</span></label>
                                                        <select name="job_id" id="job_id" class="form-select">
                                                            <option value="">Choose Job</option>
                                                        </select>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Start Date </label>
                                                        <input type="text" class="form-control datepicker" id="strt_date"
                                                            value="{{ date('d-m-Y') }}" name="interview_start_date"
                                                            placeholder="">
                                                        <span class="text-danger" id="interview_start_date_msg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">End Date<span>*</span></label>
                                                        <input type="text" class="form-control datepicker" id="end1_date"
                                                            value="" name="interview_end_date" placeholder="">
                                                        <span class="text-danger" id="interview_end_date_msg"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label for="">Interview Location<span>*</span></label>
                                                        <input type="text" class="form-control" id="interview_location"
                                                            value="" name="interview_location" placeholder="">
                                                        <span class="text-danger" id="interview_location_msg"></span>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label for="">Status <span>*</span></label>
                                                        <select name="interview_status" class="form-select" id="">
                                                            <option value="">Select a status</option>
                                                            <option value="Working">Working</option>
                                                            <option value="Transferred">Transferred</option>
                                                            <option value="Completed">Completed</option>
                                                        </select>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div> --}}
                                                <div class="col-lg-12 mt-3">
                                                    <div class="save-btn-div d-flex align-items-center">
                                                        <button type="submit" class="btn save-btn"><span><i
                                                                    class="fa-solid fa-check"></i></span>
                                                            Submit</button>
                                                        <button type="button"
                                                            class="btn save-btn save-btn-1 close-btn"><span><i
                                                                    class="fa-solid fa-xmark"></i></span>Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                            <h4 class="mb-0">Schedule & To-Do</h4>
                            @can('Create Schedule')
                                <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight" class="btn btn-primary">
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
@endsection

@push('scripts')
    <script>
        $('#strt_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            // minDate: new Date(),

        });
        $('#end1_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            // minDate: new Date()
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#company_id').change(function() {
                var company_id = $(this).val();
                if (company_id) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('get-job-list') }}",
                        data: {
                            company_id: company_id
                        },
                        success: function(res) {
                            if (res) {
                                $("#job_id").empty();
                                $("#job_id").append('<option value="">Choose Job</option>');
                                $.each(res, function(key, value) {
                                    console.log(key, value);
                                    $("#job_id").append('<option value="' + value.id +
                                        '">' + value.job_name + '(' + value.job_id +
                                        ')</option>');
                                });
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
                            window.location.reload();
                        } else {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        // Handle errors (e.g., display validation errors)
                        $('.text-danger').html('');
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('[name="' + key + '"]').next('.text-danger').html(value[
                                0]);
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
                $('#offcanvasRightJob').offcanvas('hide');
            });

            $(document).on('click', '.add_task', function() {
                var route = $(this).data('route');
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
                $.ajax({
                    url: route,
                    type: 'GET',
                    success: function(response) {
                        $('#add-task').html(response.view);
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        $('#offcanvasRightJob').offcanvas('show');
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
            $(document).on('submit', '#company-job-form-create', function(e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == true) {
                            window.location.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        $('.text-danger').html('');
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            // Assuming you have a span with class "text-danger" next to each input
                            $('#' + key + '_msg_create').html(value[0]);
                        });
                    }
                });
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
                    // Disable loader for search to avoid intrusive UI while typing
                    fetch_data(search, company, date, 1, false);
                }, 500); // Wait for 500ms after user stops typing
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
        });
    </script>
@endpush
