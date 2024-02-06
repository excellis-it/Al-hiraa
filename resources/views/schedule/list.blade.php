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
                                                                <option value="{{ $company->id }}">{{ $company->company_name }}
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
                                                        <input type="date" class="form-control" id=""
                                                            value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}"
                                                            name="interview_start_date" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">End Date<span>*</span></label>
                                                        <input type="date" class="form-control" id="" value=""
                                                            min="{{ date('Y-m-d') }}" name="interview_end_date" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
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
                                                </div>
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
            <section class="todo_sec text_left_td_th">
                <div class="text-end pt-3 pt-lg-4 mb-3 mb-md-0">
                    @can('Create Schedule')
                        <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                            aria-controls="offcanvasRight" class="add_interview"><svg xmlns="http://www.w3.org/2000/svg"
                                width="15.333" height="15.333" viewBox="0 0 15.333 15.333">
                                <path id="plus-small"
                                    d="M20.056,12.389H14.944V7.278A1.278,1.278,0,0,0,13.667,6h0a1.278,1.278,0,0,0-1.278,1.278v5.111H7.278A1.278,1.278,0,0,0,6,13.667H6a1.278,1.278,0,0,0,1.278,1.278h5.111v5.111a1.278,1.278,0,0,0,1.278,1.278h0a1.278,1.278,0,0,0,1.278-1.278V14.944h5.111a1.278,1.278,0,0,0,1.278-1.278h0A1.278,1.278,0,0,0,20.056,12.389Z"
                                    transform="translate(-6 -6)" opacity="0.5" />
                            </svg>
                            Add Interview
                        </a>
                    @endcan
                </div>
                @foreach ($interviews as $key => $items)
                    <div class="mb-3 ps-5 color_h4">
                        <h4>{{ $key }}</h4>
                    </div>
                    <div class="table-responsive" data-toggle="lists">
                        <table class="table mb-0 table-bordered">
                            <thead>
                                <tr>
                                    {{-- <th style="width: 50px;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input js-check-selected-row">
                                        </div>
                                    </th> --}}
                                    <th>Task Name</th>
                                    <th>Asignee</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="user_tbody">
                                @foreach ($items as $interview)
                                {{-- @dd($interviewjob) --}}
                                    <tr>
                                        {{-- <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input js-check-selected-row">
                                            </div>
                                        </td> --}}
                                        <td>{{ $interview['job']['job_name'] ?? 'N/A'}}</td>
                                        <td><span class="name_textbg">SP</span>{{ $interview['user']['first_name'] ?? '' }} {{ $interview['user']['last_name'] ?? '' }}</td>
                                        <td>
                                            {{ isset($interview['interview_start_date']) ? date('d/m/Y', strtotime($interview['interview_start_date'])) : '' }}
                                            @if (isset($interview['interview_start_date']) && isset($interview['interview_end_date']) && $interview['interview_start_date'] != $interview['interview_end_date'])
                                                - {{ date('d/m/Y', strtotime($interview['interview_end_date'])) }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="round_staus {{($interview['interview_status'] == 'Completed') ? 'active' : ''}} {{($interview['interview_status'] == 'Transferred') ? 'inactive' : ''}} {{($interview['interview_status'] == 'Working') ? 'warning' : ''}}">
                                                {{ $interview['interview_status'] ?? 'N/A'}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="" class="add_task">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13.483" height="13.483"
                            viewBox="0 0 13.483 13.483">
                            <path id="plus-small"
                                d="M18.359,11.618H13.865V7.124A1.124,1.124,0,0,0,12.741,6h0a1.124,1.124,0,0,0-1.124,1.124v4.494H7.124A1.124,1.124,0,0,0,6,12.741H6a1.124,1.124,0,0,0,1.124,1.124h4.494v4.494a1.124,1.124,0,0,0,1.124,1.124h0a1.124,1.124,0,0,0,1.124-1.124V13.865h4.494a1.124,1.124,0,0,0,1.124-1.124h0A1.124,1.124,0,0,0,18.359,11.618Z"
                                transform="translate(-6 -6)" opacity="0.5" />
                        </svg>
                        <span>Add task...</span>
                    </a>
                @endforeach
            </section>

        </div>
    </div>
@endsection

@push('scripts')
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

            $('#schedule-to-do-form-create').submit(function(e) {
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
                        if (response.status == true) {
                            window.location.reload();
                        } else {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            toastr.error(response.error);
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
                        });
                    }
                });
            });
        });
    </script>
@endpush
