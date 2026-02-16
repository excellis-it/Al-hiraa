@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Create Candidate Job
@endsection
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="integrations-div setting-profile-div">
                <div class="page__heading row align-items-center mb-0">
                    <div class="col-xl-12 mb-3 mb-md-0">
                        <div class="integrations-head">
                            <h2>Add Candidate Job</h2>
                        </div>
                    </div>
                </div>

                <div class="profile-div">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="integrations-form profile-form">
                                <form action="{{ route('jobs.store') }}" method="POST" id="create-candidate-job">
                                    @csrf
                                    <h4 class="mb-3">Job Details</h4>
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="company_id">Company <span>*</span></label>
                                                <select name="company_id" id="company_id" class="form-select select2">
                                                    <option value="">Select Company</option>
                                                    @foreach ($recent_interviews->pluck('company')->unique('id') as $company)
                                                        <option value="{{ $company->id }}">{{ $company->company_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger" id="company_id_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="job_id">Job <span>*</span></label>
                                                <select name="job_id" id="job_id" class="form-select select2" disabled>
                                                    <option value="">Select Job</option>
                                                </select>
                                                <span class="text-danger" id="job_id_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="interview_id">Interview <span>*</span></label>
                                                <select name="interview_id" id="interview_id" class="form-select select2"
                                                    disabled>
                                                    <option value="">Select Interview</option>
                                                </select>
                                                <span class="text-danger" id="interview_id_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="associate_id">Associate</label>
                                                <select name="associate_id" id="associate_id" class="form-select select2">
                                                    <option value="">Select Associate</option>
                                                    @foreach ($associates as $associate)
                                                        <option value="{{ $associate->id }}">{{ $associate->name }}
                                                            ({{ $associate->phone_number }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger" id="associate_id_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h4 class="mb-3">Auto-Filled Details</h4>
                                    <div class="row g-2">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Salary</label>
                                                <input type="text" name="salary" id="salary" class="form-control"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Food Allowance</label>
                                                <input type="text" name="food_allowance" id="food_allowance"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Contract Duration</label>
                                                <input type="text" name="contract_duration" id="contract_duration"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Service Charge</label>
                                                <input type="text" name="service_charge" id="service_charge"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h4 class="mb-3">Candidate Details</h4>
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="full_name">Full Name <span>*</span></label>
                                                <input type="text" name="full_name" class="form-control"
                                                    value="{{ old('full_name') }}">
                                                <span class="text-danger" id="full_name_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="passport_number">Passport Number <span>*</span></label>
                                                <input type="text" name="passport_number" class="form-control"
                                                    value="{{ old('passport_number') }}">
                                                <span class="text-danger" id="passport_number_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="passport_expiry">Passport Expiry Date <span>*</span></label>
                                                <input type="text" name="passport_expiry" id="passport_expiry"
                                                    class="form-control datepicker" value="{{ old('passport_expiry') }}">
                                                <span class="text-danger" id="passport_expiry_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="contact_no">Contact No <span>*</span></label>
                                                <input type="text" name="contact_no" class="form-control"
                                                    value="{{ old('contact_no') }}">
                                                <span class="text-danger" id="contact_no_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="gender">Gender <span>*</span></label>
                                                <select name="gender" class="form-select">
                                                    <option value="MALE"
                                                        {{ old('gender') == 'MALE' ? 'selected' : '' }}>MALE</option>
                                                    <option value="FEMALE"
                                                        {{ old('gender') == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                                                    <option value="OTHER"
                                                        {{ old('gender') == 'OTHER' ? 'selected' : '' }}>OTHER</option>
                                                </select>
                                                <span class="text-danger" id="gender_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="dob">Date of Birth <span>*</span></label>
                                                <input type="text" name="dob" class="form-control" id="dob"
                                                    value="{{ old('dob') }}">
                                                <span class="text-danger" id="dob_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="date_of_selection">Selection Date <span>*</span></label>
                                                <input type="text" name="date_of_selection" id="date_of_selection"
                                                    class="form-control datepicker"
                                                    value="{{ old('date_of_selection') }}">
                                                <span class="text-danger" id="date_of_selection_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="whatapp_no">WhatsApp No</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">+91</span>
                                                    <input type="text" name="whatapp_no" class="form-control"
                                                        value="{{ old('whatapp_no') }}">
                                                </div>
                                                <span class="text-danger" id="whatapp_no_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="religion">Religion</label>
                                                <select name="religion" class="form-select">
                                                    <option value="">Select Religion</option>
                                                    <option value="HINDU"
                                                        {{ old('religion') == 'HINDU' ? 'selected' : '' }}>HINDU</option>
                                                    <option value="MUSLIM"
                                                        {{ old('religion') == 'MUSLIM' ? 'selected' : '' }}>MUSLIM</option>
                                                    <option value="CHRISTIAN"
                                                        {{ old('religion') == 'CHRISTIAN' ? 'selected' : '' }}>CHRISTIAN
                                                    </option>
                                                    <option value="SIKH"
                                                        {{ old('religion') == 'SIKH' ? 'selected' : '' }}>SIKH</option>
                                                    <option value="BUDDHIST"
                                                        {{ old('religion') == 'BUDDHIST' ? 'selected' : '' }}>BUDDHIST
                                                    </option>
                                                    <option value="JAIN"
                                                        {{ old('religion') == 'JAIN' ? 'selected' : '' }}>JAIN</option>
                                                    <option value="OTHER"
                                                        {{ old('religion') == 'OTHER' ? 'selected' : '' }}>OTHER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="ecr_type">ECR Type</label>
                                                <select name="ecr_type" class="form-select">
                                                    <option value="">Select Type</option>
                                                    <option value="ECR"
                                                        {{ old('ecr_type') == 'ECR' ? 'selected' : '' }}>ECR</option>
                                                    <option value="ECNR"
                                                        {{ old('ecr_type') == 'ECNR' ? 'selected' : '' }}>ECNR</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="save-btn-div d-flex align-items-center">
                                                <button type="submit" class="btn save-btn">Save</button>
                                                <a href="{{ route('jobs.index') }}"
                                                    class="btn save-btn save-btn-1">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });

            $('#date_of_selection').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy',
            });

            $('#dob').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy',
                maxDate: function() {
                    var today = new Date();
                    today.setDate(today.getDate() - 1);
                    return today;
                }
            });

            $('#passport_expiry').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy',
                minDate: function() {
                    var today = new Date();
                    today.setDate(today.getDate());
                    return today;
                }
            });

            $('#company_id').on('change', function() {
                var company_id = $(this).val();
                $('#job_id').html('<option value="">Select Job</option>').prop('disabled', true);
                $('#interview_id').html('<option value="">Select Interview</option>').prop('disabled',
                    true);
                resetAutoFill();

                if (company_id) {
                    $.get("{{ route('jobs.get-company-jobs-ajax', '') }}/" + company_id, function(data) {
                        if (data.status == 'success') {
                            $.each(data.jobs, function(i, job) {
                                $('#job_id').append('<option value="' + job.id + '">' + job
                                    .job_name + '</option>');
                            });
                            $('#job_id').prop('disabled', false);
                        }
                    });
                }
            });

            $('#job_id').on('change', function() {
                var job_id = $(this).val();
                $('#interview_id').html('<option value="">Select Interview</option>').prop('disabled',
                    true);
                resetAutoFill();

                if (job_id) {
                    $.get("{{ route('jobs.get-job-interviews-ajax', '') }}/" + job_id, function(data) {
                        if (data.status == 'success') {
                            $.each(data.interviews, function(i, int) {
                                $('#interview_id').append('<option value="' + int.id +
                                    '">' + int.interview_id + ' (' + int
                                    .interview_start_date + ')</option>');
                            });
                            if (data.interviews.length == 1) {
                                $('#interview_id').val(data.interviews[0].id).trigger('change');
                            }
                            $('#interview_id').prop('disabled', false);
                        }
                    });
                }
            });

            var currentInterviewData = null;

            $('#interview_id').on('change', function() {
                var int_id = $(this).val();
                if (int_id) {
                    $.get("{{ route('jobs.get-interview-data-ajax', '') }}/" + int_id, function(data) {
                        if (data.status == 'success') {
                            currentInterviewData = data;
                            $('#salary').val(data.salary);
                            $('#food_allowance').val(data.food_allowance);
                            $('#contract_duration').val(data.contract_duration);
                            updateServiceCharge();
                        }
                    });
                } else {
                    resetAutoFill();
                    currentInterviewData = null;
                }
            });

            $('#associate_id').on('change', function() {
                updateServiceCharge();
            });

            function updateServiceCharge() {
                if (currentInterviewData) {
                    var associate_id = $('#associate_id').val();
                    if (associate_id) {
                        $('#service_charge').val(currentInterviewData.associate_charge);
                    } else {
                        $('#service_charge').val(currentInterviewData.service_charge);
                    }
                }
            }

            function resetAutoFill() {
                $('#salary').val('');
                $('#food_allowance').val('');
                $('#contract_duration').val('');
                $('#service_charge').val('');
            }

            function showError(field, message) {
                $('#' + field + '_error').text(message);
            }

            $('#create-candidate-job').on('submit', function(e) {
                e.preventDefault();
                $('.text-danger').text('');

                var formData = new FormData(this);
                var whatsapp = formData.get('whatapp_no');
                if (whatsapp && !whatsapp.startsWith('+91')) {
                    formData.set('whatapp_no', '+91' + whatsapp);
                }

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                            window.location.href = response.redirect_url;
                        } else {
                            if (response.errors) {
                                $.each(response.errors, function(key, val) {
                                    showError(key, val[0]);
                                });
                            } else {
                                toastr.error(response.message);
                            }
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, val) {
                                showError(key, val[0]);
                            });
                        } else {
                            toastr.error('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
