@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Company
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="row page__heading">
                @can('Create Company')
                    {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
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
                    </div> --}}
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                        aria-hidden="true">
                        <div class="offcanvas-body">
                            <div class="user-acces-table">
                                <form id="company-form-create" action="{{ route('companies.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="step">
                                        <!-- Step 1: Company Details -->
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

                                        <!-- Step 2: Job Details -->
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
                                                            {{-- vendors --}}
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Vendor<span>*</span></label>
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
                                                            {{-- salary --}}
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
                                                                    <label for="">Benefits</label>
                                                                    <input type="text" class="form-control" id=""
                                                                        value="" name="benifits" placeholder="">
                                                                    <span class="text-danger" id="benifits_msg_create"></span>
                                                                </div>
                                                            </div>
                                                            {{-- service_charge --}}
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="">Service Charge<span>*</span></label>
                                                                    <input type="text" class="form-control" id=""
                                                                        value="" name="service_charge" placeholder="">
                                                                    <span class="text-danger"
                                                                        id="service_charge_msg_create"></span>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-xl-4">
                                                                <div class="form-group">
                                                                    <label for="">Status <span>*</span></label>
                                                                    <select name="status" class="form-select" id="">
                                                                        <option value="">Select a status</option>
                                                                        <option value="Ongoing">Ongoing</option>
                                                                        <option value="Closed">Closed</option>
                                                                    </select>
                                                                    <span class="text-danger" id="status_msg_create"></span>
                                                                </div>
                                                            </div> --}}
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
                                                                    <button type="button" class="btn add-anoter-btn previous-step"
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
                    </div>
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
                                <a href="add_candidate.html" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
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
                let formData = new FormData($('#company-form-create')[
                0]); // Use FormData to include file uploads

                $.ajax({
                    url: $('#company-form-create').attr('action'), // Use form's action attribute
                    method: 'POST',
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
