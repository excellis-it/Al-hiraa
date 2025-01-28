@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Schedule & To-Do
@endsection
@push('styles')
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
                                                        <label for="">Task <span>*</span></label>
                                                        <select name="job_id" id="job_id" class="form-select">
                                                            <option value="">Choose Task</option>
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

                <div class="row page__heading">
                    <div class="col-xl-8 col-lg-7 col-md-6 mb-3 mb-md-0">
                        <div class="">
                            <form class="search-form d-flex" action="javascript:void(0);">
                                <button class="btn" type="submit" role="button"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                                <input type="text" class="form-control query" placeholder="Advance Search..">
                            </form>
                        </div>
                    </div>
                    @can('Create Schedule')
                        <div class="col-xl-4 col-lg-5 col-md-6">
                            <div class="d-flex justify-content-center justify-content-md-start">
                                <div class="btn-group me-4">
                                    <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                        aria-controls="offcanvasRight" class="add_interview mb-5"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="15.333" height="15.333"
                                            viewBox="0 0 15.333 15.333">
                                            <path id="plus-small"
                                                d="M20.056,12.389H14.944V7.278A1.278,1.278,0,0,0,13.667,6h0a1.278,1.278,0,0,0-1.278,1.278v5.111H7.278A1.278,1.278,0,0,0,6,13.667H6a1.278,1.278,0,0,0,1.278,1.278h5.111v5.111a1.278,1.278,0,0,0,1.278,1.278h0a1.278,1.278,0,0,0,1.278-1.278V14.944h5.111a1.278,1.278,0,0,0,1.278-1.278h0A1.278,1.278,0,0,0,20.056,12.389Z"
                                                transform="translate(-6 -6)" opacity="0.5" />
                                        </svg>
                                        Add Interview
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endcan
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
                                $("#job_id").append('<option value="">Choose Task</option>');
                                $.each(res, function(key, value) {
                                    console.log(key, value);
                                    $("#job_id").append('<option value="' + value.id +
                                        '">' + value.job_name +
                                        '</option>');
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
                            $('#single-row-update-' + response.interview.id).html(response.view);
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
            function fetch_data(query) {
                $.ajax({
                    url: "{{ route('schedule-to-do.filter') }}",
                    data: {
                        search: query
                    },
                    success: function(data) {
                        $('#schedule-filter').html(data.view);
                    }
                });
            }

            $(document).on('keyup', '.query', function(e) {
                e.preventDefault();
                var query = $(this).val();
                fetch_data(query);
            });
        });
    </script>
@endpush
