@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Company
@endsection
@push('styles')
    <style>
        /* Start Toogle */

        .button-switch {
            font-size: 1.2em;
            height: 1.875em;
            margin-bottom: 0.625em;
            position: relative;
            width: 2.5em;
        }

        .button-switch .lbl-off,
        .button-switch .lbl-on {
            cursor: pointer;
            display: block;
            font-size: 0.9em;
            font-weight: bold;
            line-height: 1em;
            position: absolute;
            top: 0.5em;
            transition: opacity 0.25s ease-out 0.1s;
            text-transform: uppercase;
        }

        .button-switch .lbl-off {
            right: 0.4375em;
        }

        .button-switch .lbl-on {
            color: #fefefe;
            opacity: 0;
            left: 0.4375em;
        }

        .button-switch .switch {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            height: 0;
            font-size: 1em;
            left: 0;
            line-height: 0;
            outline: none;
            position: absolute;
            top: 0;
            width: 0;
            margin-top: 21px;
        }

        .button-switch .switch:before,
        .button-switch .switch:after {
            content: "";
            font-size: 1em;
            position: absolute;
        }

        .button-switch .switch:before {
            border-radius: 1.25em;
            background: #bdc3c7;
            height: 1.1em;
            left: -0.25em;
            top: -0.1875em;
            transition: background-color 0.25s ease-out 0.1s;
            width: 2.6em;
        }

        .button-switch .switch:after {
            box-shadow: 0 0.0625em 0.375em 0 #666;
            border-radius: 50%;
            background: #fefefe;
            height: 0.7em;
            transform: translate(0, 0);
            transition: transform 0.25s ease-out 0.1s;
            width: 0.7em;
        }

        .button-switch .switch:checked:after {
            transform: translate(1.3em, 0);
        }

        .button-switch .switch:checked~.lbl-off {
            opacity: 0;
        }

        .button-switch .switch:checked~.lbl-on {
            opacity: 1;
        }

        .button-switch .switch#switch-orange:checked:before {
            background: #1492e6;
        }

        .button-switch .switch#switch-blue:checked:before {
            background: #3498db;
        }

        /* End Toogle   */
    </style>
    <style>
        /* General Tabs Styling */
        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }
        .nav-tabs .nav-item {
            margin-bottom: -1px;
        }
        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            color: #6c757d;
            padding: 0.75rem 1rem;
            transition: color 0.3s ease, background-color 0.3s ease, border-color 0.3s ease;
        }
        .nav-tabs .nav-link.active {
            background-color: #007bff;
            border-color: #dee2e6 #dee2e6 #fff;
            color: #fff;
        }
        .nav-tabs .nav-link:hover {
            color: #495057;
        }

        /* Active & Inactive Tab Content */
        .tab-content {
            border: 1px solid #dee2e6;
            border-top: none;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 0 0 0.25rem 0.25rem;
        }

        /* Food Box Styling */
        
    </style>

@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="row page__heading">
                @can('Create Company')
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                        aria-hidden="true">
                        <div class="offcanvas-body">
                            <div class="user-acces-table">
                                <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data"
                                    id="company-form-create">
                                    @csrf
                                    <div class="frm-head">
                                        <h2>Create New Company</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="add-mem-form">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label for="">Company Name<span>*</span></label>
                                                            <input type="text" class="form-control" id=""
                                                                value="" name="company_name" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Company Address <span>*</span></label>
                                                            <input type="text" class="form-control" id=""
                                                                value="" name="company_address" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Company Industry <span>*</span></label>
                                                            <input type="text" class="form-control" id=""
                                                                value="" name="company_industry" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Company Website</label>
                                                            <input type="text" class="form-control" id=""
                                                                value="" name="company_website" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Company Logo </label>
                                                            <input type="file" class="form-control" id=""
                                                                value="" name="company_logo" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label for="">Company Description</label>
                                                            <textarea name="company_description" id="" cols="30" class="form-control" style="height: 100%;"
                                                                rows="10"></textarea>
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mt-3">
                                                        <div class="save-btn-div d-flex align-items-center">
                                                            <button type="submit" class="btn save-btn"><span><i
                                                                        class="fa-solid fa-check"></i></span> Submit</button>
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
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="importCanvas" aria-labelledby="importCanvasLabel"
                        aria-hidden="true">
                        <div class="offcanvas-body">
                            <div class="import-excel-section">
                                <form action="{{ route('company-job.import') }}" method="POST" id="company-job-form-import"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="company_id" value="">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="importCanvasLabel">Import Excel</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-content">
                                        <div class="mb-3">
                                            <div class="row mb-3">
                                                <div class="col-md-12 mb-6">
                                                    <label class="form-label">Download example Excel file</label>
                                                    <a href="{{ route('company-job.download.sample') }}"
                                                        class="btn btn-sm btn-primary rounded">
                                                        <i class="ti ti-download"></i> Download
                                                    </a>
                                                </div>
                                            </div>

                                            <input type="file" class="form-control" id="file" name="file"
                                                style="height: auto">
                                            <span class="text-danger" id="file-err"></span>
                                        </div>
                                    </div>
                                    <div class="offcanvas-footer">
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                        aria-hidden="true">
                        <div class="offcanvas-body">
                            <div class="user-acces-table">
                                <form id="company-form-create" action="{{ route('companies.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="step">
                                        <div class="step-1">
                                            <div class="frm-head">
                                                <h2>Create New Company</h2>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label for="">Company Name<span>*</span></label>
                                                        <input type="text" class="form-control" id="" value=""
                                                            name="company_name" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Company Address <span>*</span></label>
                                                        <input type="text" class="form-control" id="" value=""
                                                            name="company_address" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Company Industry <span>*</span></label>
                                                        <input type="text" class="form-control" id="" value=""
                                                            name="company_industry" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Company Website</label>
                                                        <input type="text" class="form-control" id="" value=""
                                                            name="company_website" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Company Logo </label>
                                                        <input type="file" class="form-control" id="" value=""
                                                            name="company_logo" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label for="">Company Description</label>
                                                        <textarea name="company_description" id="" cols="30" class="form-control" style="height: 100%;"
                                                            rows="10"></textarea>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-3">
                                                    <div class="save-btn-div d-flex align-items-center">
                                                        <button type="button" class="btn save-btn next-step">Next</button>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="step-2 d-none">
                                            <div class="frm-head">
                                                <h2>Add Job</h2>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="add-mem-form job-creat">
                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Job Name<span>*</span></label>
                                                                    <input type="text" class="form-control" id=""
                                                                        value="" name="job_name" placeholder="">
                                                                    <span class="text-danger" id="job_name_msg_create"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Vendor</label>
                                                                    <select name="vendor_id" class="form-select new_select2"
                                                                        id="">
                                                                        <option value="">Select a vendor</option>
                                                                        @foreach ($vendors as $vendor)
                                                                            <option value="{{ $vendor->id }}">
                                                                                {{ $vendor->full_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger"
                                                                        id="vendor_id_msg_create"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Position<span>*</span></label>
                                                                    <select name="candidate_position_id"
                                                                        class="form-select new_select2" id="">
                                                                        <option value="">Select a position</option>
                                                                        @foreach ($positions as $position)
                                                                            <option value="{{ $position->id }}">
                                                                                {{ $position->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger"
                                                                        id="candidate_position_id_msg_create"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Duty Hours</label>
                                                                    <select name="duty_hours" class="form-select new_select2"
                                                                        id="">
                                                                        <option value="">Select a duty hours</option>
                                                                        <?php for ($i = 1; $i <= 24; $i++) : ?>
                                                                        <option value="{{ $i }}">{{ $i }}
                                                                            Hours per day</option>

                                                                        <?php endfor; ?>
                                                                    </select>
                                                                    <span class="text-danger"
                                                                        id="duty_hours_msg_create"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Salary<span>*</span></label>
                                                                    <input type="text" class="form-control" id=""
                                                                        value="" name="salary" placeholder="">
                                                                    <span class="text-danger" id="salary_msg_create"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Quantity of people
                                                                        required<span>*</span></label>
                                                                    <input type="number" class="form-control" id=""
                                                                        value="" name="quantity_of_people_required"
                                                                        placeholder="">
                                                                    <span class="text-danger"
                                                                        id="quantity_of_people_required_msg_create"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Contract (Year)</label>
                                                                    <input type="text" class="form-control" id=""
                                                                        value="" name="contract" placeholder="">
                                                                    <span class="text-danger" id="contract_msg_create"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Benefits (Food Allowance)</label>
                                                                    <input type="text" class="form-control" id=""
                                                                        value="" name="benifits" placeholder="">
                                                                    <span class="text-danger" id="benifits_msg_create"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Service Charge<span>*</span></label>
                                                                    <input type="text" class="form-control" id=""
                                                                        value="" name="service_charge" placeholder="">
                                                                    <span class="text-danger"
                                                                        id="service_charge_msg_create"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Referral Point</label>
                                                                    <select name="referral_point_id" class="form-select"
                                                                        id="">
                                                                        <option value="">Select a referral point</option>
                                                                        @foreach ($referral_points as $referral_point)
                                                                            <option value="{{ $referral_point->id }}">
                                                                                {{ $referral_point->point }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="text-danger"
                                                                        id="referral_point_msg_create"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12">
                                                                <div class="form-group">
                                                                    <label for="">Location <span>*</span></label>
                                                                    <input type="text" class="form-control" id=""
                                                                        value="" name="address" placeholder="">
                                                                    <span class="text-danger" id="address_msg_create"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12">
                                                                <div class="form-group">
                                                                    <label for="">Job Description</label>
                                                                    <textarea name="job_description" id="" cols="30" class="form-control" style="height: 100%;"
                                                                        rows="10"></textarea>
                                                                    <span class="text-danger"
                                                                        id="job_description_msg_create"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12">
                                                                <div class="form-group">
                                                                    <label for="">Document </label>
                                                                    <input type="file" class="form-control" id=""
                                                                        value="" name="document" placeholder="">
                                                                    <span class="text-danger" id=""></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 mt-3">
                                                                <div class="save-btn-div d-flex align-items-center">
                                                                    <button type="button"
                                                                        class="btn add-anoter-btn previous-step"
                                                                        data-previous="1">Previous</button>
                                                                    <button type="button"
                                                                        class="btn save-btn next-step-2">Next</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="step-3 d-none">
                                            <div class="frm-head">
                                                <h2>Interview Schedule</h2>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="add-mem-form">
                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Start Date </label>
                                                                    <input type="text" class="form-control datepicker"
                                                                        id="strt_date" value="{{ date('d-m-Y') }}"
                                                                        name="interview_start_date" placeholder="">
                                                                    <span class="text-danger"
                                                                        id="interview_start_date_msg"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">End Date<span>*</span></label>
                                                                    <input type="text" class="form-control datepicker"
                                                                        id="end1_date" value=""
                                                                        name="interview_end_date" placeholder="">
                                                                    <span class="text-danger"
                                                                        id="interview_end_date_msg"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12">
                                                                <div class="form-group">
                                                                    <label for="">Interview
                                                                        Location<span>*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        id="interview_location" value=""
                                                                        name="interview_location" placeholder="">
                                                                    <span class="text-danger"
                                                                        id="interview_location_msg"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 mt-3">
                                                                <div class="save-btn-div d-flex align-items-center">
                                                                    <button type="button"
                                                                        class="btn add-anoter-btn previous-step"
                                                                        data-previous="2">Previous</button>

                                                                    <button type="submit"
                                                                        class="btn save-btn submit-form">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                @endcan
                <div class="col-xl-8 col-lg-7 col-md-6 mb-3 mb-md-0">
                    <div class="">
                        <form class="search-form d-flex" action="javascript:void(0);">
                            <button class="btn" type="submit" role="button"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                            <input type="text" class="form-control query" placeholder="Advance Search..">
                        </form>
                    </div>
                </div>
                @can('Create Company')
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <div class="btn-group me-4">
                                <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight" class="btn addcandidate_btn"><i class="fas fa-plus"></i>
                                    Add
                                    Company</a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <section class="food-box-sec pt-0">
                <div class="container-fluid" id="company-filter">
                    @include('companies.filter')
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
            $(document).on('click', '.close-btn', function() {
                $('.text-danger').html('');
                $('#offcanvasRight').offcanvas('hide');
            });

            // $('#company-form-create').submit(function(e) {
            //     e.preventDefault();

            //     var formData = new FormData($(this)[0]);
            //     $('#loading').addClass('loading');
            //     $('#loading-content').addClass('loading-content');
            //     $.ajax({
            //         url: $(this).attr('action'),
            //         type: $(this).attr('method'),
            //         data: formData,
            //         contentType: false,
            //         processData: false,
            //         success: function(response) {

            //             if (response.status == true) {
            //                 window.location.reload();
            //             } else {
            //                 $('#loading').removeClass('loading');
            //                 $('#loading-content').removeClass('loading-content');
            //                 toastr.error(response.error);
            //             }
            //         },
            //         error: function(xhr) {
            //             $('#loading').removeClass('loading');
            //             $('#loading-content').removeClass('loading-content');
            //             // Handle errors (e.g., display validation errors)
            //             $('.text-danger').html('');
            //             var errors = xhr.responseJSON.errors;
            //             $.each(errors, function(key, value) {
            //                 $('[name="' + key + '"]').next('.text-danger').html(value[
            //                     0]);
            //             });
            //         }
            //     });
            // });

            // Handle 'Next' button click
            $('.next-step, .next-step-2').on('click', function() {
                let step = $(this).hasClass('next-step') ? 1 : 2; // Determine current step
                let formData = $('#company-form-create').serialize(); // Serialize form data

                $.ajax({
                    url: `/validate-step/${step}`, // Adjust route as needed
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('.text-danger').empty();
                            // If successful, show the next step
                            $('.step-' + step).addClass('d-none'); // Hide current step
                            $('.step-' + (step + 1)).removeClass('d-none'); // Show next step
                        }
                    },
                    error: function(xhr) {
                        // Clear previous error messages
                        $('.text-danger').empty();

                        // Show validation errors
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                // Display error messages under the corresponding field
                                $('input[name="' + key + '"], select[name="' + key +
                                    '"], textarea[name="' + key + '"]').next(
                                    '.text-danger').text(value[0]);
                            });
                        } else {
                            toastr.error(xhr);
                        }
                    }
                });
            });

            // Handle 'Previous' button click
            $('.previous-step').on('click', function() {
                let previousStep = $(this).data(
                    'previous'); // Get the previous step from data-previous attribute
                $('.step-' + (previousStep + 1)).addClass('d-none'); // Hide current step
                $('.step-' + previousStep).removeClass('d-none'); // Show previous step
            });

            // Handle form submission for the final step
            $('#company-form-create').submit(function(e) {
                e.preventDefault();

                let formData = new FormData($('#company-form-create')[0]); // Use FormData for file uploads

                $.ajax({
                    url: $('#company-form-create').attr('action'), // Use form's action attribute
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == true) {
                            // Close the company creation offcanvas
                            $('#offcanvasRight').offcanvas('hide');
                            toastr.success(response.message);
                            // Update the import offcanvas with the company_id from the response
                            $('input[name="company_id"]').val(response.company_id);

                            // Open the import offcanvas
                            $('#importCanvas').offcanvas('show');

                            // Update any additional UI elements, if necessary
                            $('#company-filter').html(response.view);
                        } else {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            toastr.error(response.error);
                        }
                    },
                    error: function(xhr) {
                        // Clear previous error messages
                        $('.text-danger').empty();

                        // Show validation errors
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('input[name="' + key + '"], select[name="' + key +
                                    '"], textarea[name="' + key + '"]').next(
                                    '.text-danger').text(value[0]);
                                $('#' + key + '_msg').html(value[0]);
                            });
                        }
                    }
                });
            });


        });
    </script>
      <script>
        $(document).on('submit', '#company-job-form-import', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('#loading').addClass('loading');
            $('#loading-content').addClass('loading-content');
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    //windows load with toastr message
                    window.location.href = response.route;

                    toastr.success('Job imported successfully');
                },
                error: function(xhr) {
                    // Handle errors (e.g., display validation errors)
                    //clear any old errors
                    $('#loading').removeClass('loading');
                    $('#loading-content').removeClass('loading-content');

                    $('.text-danger').html('');
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        // console.log(key);
                        // Assuming you have a div with class "text-danger" next to each input
                        $('[name="file"]').next('.text-danger').html(value[
                            0]);
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.toggle-class', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var company_id = $(this).data('id');
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('companies.change-status') }}',
                    data: {
                        'status': status,
                        'company_id': company_id
                    },
                    success: function(resp) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        window.location.reload();
                        toastr.success(resp.success);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {


            function fetch_data(page, query) {
                $.ajax({
                    url: "{{ route('companies.filter') }}",
                    data: {
                        page: page,
                        search: query
                    },
                    success: function(data) {
                        $('#company-filter').html(data.view);
                    }
                });
            }

            $(document).on('keyup', '.query', function(e) {
                e.preventDefault();
                var query = $(this).val();
                // alert(query);
                var page = $('#hidden_page').val();
                fetch_data(page, query);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('.query').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query);
            });

        });
    </script>
@endpush
