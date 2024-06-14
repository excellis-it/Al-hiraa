@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Candidates Create
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <!-- page-contain-start  -->
            <div class="integrations-div setting-profile-div">

                <div class="page__heading row align-items-center mb-0">
                    <div class="col-xl-12 mb-3 mb-md-0">
                        <div class="integrations-head">
                            <h2>Add Candidate</h2>
                        </div>
                    </div>
                </div>

                <div class="profile-div">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="integrations-form profile-form">
                                <form action="{{ route('candidates.store') }}" method="POST" id="create-candidate">
                                    @csrf
                                    <div class="row g-2 justify-content-between">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="contact_no">Contact No: <span>*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="contact_no"
                                                        value="{{ old('contact_no') }}" name="contact_no" placeholder="">
                                                </div>
                                                @if ($errors->has('contact_no'))
                                                    <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row g-2 justify-content-between auto-fill">
                                        @include('candidates.auto-fill')

                                    </div>
                                    <div class="row g-2 justify-content-between ">
                                        <div class="col-lg-12">
                                            <div class="save-btn-div d-flex align-items-center">
                                                <button type="submit" class="btn save-btn">save</button>
                                                <a href="{{ route('candidates.index') }}"
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
            <!-- page-contain-end  -->
        </div>


    </div>
@endsection

@push('scripts')

    <script>
        $(document).ready(function() {

            jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
                phone_number = phone_number.replace(/\s+/g, "");
                return this.optional(element) || phone_number.length > 9 &&
                    phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
            }, "Please specify a valid phone number");

            jQuery.validator.addMethod("phoneIN", function(phone_number, element) {
                phone_number = phone_number.replace(/\s+/g, "");
                return this.optional(element) || phone_number.length > 9 &&
                    phone_number.match(/^(\+91-?)?([6-9]\d{9})$/);
            }, "Please specify a valid phone number");

            jQuery.validator.addMethod("passportIN", function(passport_no, element) {
                passport_no = passport_no.replace(/\s+/g, "");
                return this.optional(element) || passport_no.match(/^[A-Za-z][0-9]{7}$/);
            }, "Please specify a valid Passport number");

            // Add custom validation method for date format
            $.validator.addMethod("dateITA", function(value, element) {
                // DD-MM-YYYY format
                return value.match(/^\d{2}-\d{2}-\d{4}$/);
            }, "Please enter a valid date in the format dd-mm-yyyy.");

            $("#create-candidate").validate({
                rules: {
                    contact_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    full_name: {
                        required: true,
                    },
                    dob: {
                        required: true,
                        dateITA: true,
                    },
                    cnadidate_status_id: {
                        required: true,
                    },
                    email: {
                        required: false,
                        email: true,
                        remote: {
                            url: "{{ route('candidates.check-email') }}",
                            type: "GET",
                            data: {
                                phone: function() {
                                    return $("#contact_no").val();
                                },
                                _token: "{{ csrf_token() }}",
                            },
                            dataFilter: function(data) {
                                var response = JSON.parse(data);
                                console.log(response.status);
                                if (response.status == true) {
                                    return '"' + "Email already exists" + '"';
                                } else {
                                    return 'true';
                                }
                            }

                        },
                    },
                    position_applied_for_1: {
                        required: true,
                    },
                    alternate_contact_no: {
                        required: false,
                        minlength: 10,
                        maxlength: 10,
                    },
                    whatapp_no: {
                        required: false,
                        phoneIN: true,
                    },
                    passport_number: {
                        required: false,
                        passportIN: true,
                    },
                    indian_exp: {
                        required: false,
                        maxlength: 100,
                    },
                    abroad_exp: {
                        required: false,
                        maxlength: 100,
                    },
                },

                messages: {
                    contact_no: {
                        required: "Please enter contact number",
                        minlength: "Contact number should be 10 digits",
                        maxlength: "Contact number should be 10 digits",
                    },
                    full_name: {
                        required: "Please enter full name",
                    },
                    dob: {
                        required: "Please enter date of birth",
                    },
                    cnadidate_status_id: {
                        required: "Please select candidate status",
                    },
                    email: {
                        // not required
                        required: "Please enter email",
                        email: "Please enter valid email",

                    },
                    position_applied_for_1: {
                        required: "Please select position applied for",
                    },
                    alternate_contact_no: {
                        required: "Please enter alternate contact number",
                        minlength: "Alternate contact number should be 10 digits",
                        maxlength: "Alternate contact number should be 10 digits",
                    },
                    whatapp_no: {
                        required: "Please enter whatsapp number",
                        phoneIN: "Please enter valid whatsapp number",
                    },
                    passport_number: {
                        required: "Please enter passport number",
                        passportIN: "Please enter valid passport number",
                    },
                    indian_exp: {
                        required: "Please enter indian experience",
                        minlength: "Indian experience should be 80 to 100 characters",
                        maxlength: "Indian experience should be 80 to 100 characters",
                    },
                    abroad_exp: {
                        required: "Please enter abroad experience",
                        minlength: "Abroad experience should be 80 to 100 characters",
                        maxlength: "Abroad experience should be 80 to 100 characters",
                    },
                },
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                dateFormat: 'dd-mm-yy',
                maxDate: new Date(),

            });
            $('#contact_no').on('keyup', function() {
                var contact_no = $(this).val();
                // if +91 in this number then remove it
                if (contact_no.startsWith('+91')) {
                    new_number = contact_no.replace('+91', '');
                    $(this).val(new_number);
                } else {
                    new_number = contact_no;
                }
                console.log(new_number);
                if (new_number.length >= 10) {
                    $.ajax({
                        url: "{{ route('candidates.auto-fill') }}",
                        type: "GET",
                        data: {
                            contact_no: new_number
                        },
                        success: function(response) {
                            if (response.status == 'success') {

                                $('.auto-fill').html(response.view);
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.referred_type', function() {
                var type = $(this).text();
                // alert(type);
                if (type == 'Agents') {
                    $('.referred_by_id').html(
                        `<label for="">Referred by <span><a href="javascript:void(0);" class="referred_type">Other</a></span></label>
                    <select name="referred_by_id" class="form-select" id="">
                        <option value="">Select Type</option>
                        @foreach ($associates as $item)
                            <option value="{{ $item['id'] }}">{{ $item['full_name'] }}</option>
                        @endforeach
                    </select>`
                    );
                } else {
                    $('.referred_by_id').html(
                        `<label for="">Referred by <span><a href="javascript:void(0);" class="referred_type">Agents</a></span></label>
                    <input type="text" class="form-control" id="" name="referred_by" placeholder="">`
                    );
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.position_applied_for_1', function() {

                var type = $(this).text();
                // alert(type);
                if (type == 'Other') {
                    $('.position_applied_1').html(
                        ` <label for="">Position Applied For(1) <span>*</span> <span><a href="javascript:void(0);"
                class="position_applied_for_1">List</a></span></label><input type="text" class="form-control" id="" name="position_applied_for_1" placeholder="">`
                    );

                    if ($('.specialisation_1').length) {

                        $('.specialisation_1').remove();
                    }

                } else {
                    $('.position_applied_1').html(
                        ` <label for="">Position Applied For(1) <span>*</span> <span><a href="javascript:void(0);"
                class="position_applied_for_1">Other</a></span></label><select name="position_applied_for_1" class="form-select select2 positionAppliedFor1" id="">
                        <option value="">Select Type</option>
                        @foreach ($candidate_positions as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>`
                    );
                }

                $(document).ready(function() {
                    $('.select2').each(function() {
                        $(this).select2({
                            dropdownParent: $(this).parent()
                        });
                    })
                });
            });

            $(document).on('click', '.position_applied_for_2', function() {

                var type = $(this).text();
                // alert(type);
                if (type == 'Other') {
                    $('.position_applied_2').html(
                        ` <label for="">Position Applied For(2) <span>*</span> <span><a href="javascript:void(0);"
                class="position_applied_for_2">List</a></span></label><input type="text" class="form-control" id="" name="position_applied_for_2" placeholder="">`
                    );
                    if ($('.specialisation_2').length) {

                        $('.specialisation_2').remove();
                    }
                } else {
                    $('.position_applied_2').html(
                        ` <label for="">Position Applied For(2) <span>*</span> <span><a href="javascript:void(0);"
                class="position_applied_for_2">Other</a></span></label><select name="position_applied_for_2" class="form-select select2 positionAppliedFor2" id="">
                        <option value="">Select Type</option>
                        @foreach ($candidate_positions as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>`
                    );
                }
                $(document).ready(function() {
                    $('.select2').each(function() {
                        $(this).select2({
                            dropdownParent: $(this).parent()
                        });
                    })
                });
            });

            $(document).on('click', '.position_applied_for_3', function() {

                var type = $(this).text();
                // alert(type);
                if (type == 'Other') {
                    $('.position_applied_3').html(
                        ` <label for="">Position Applied For(3) <span><a href="javascript:void(0);"
                class="position_applied_for_3">List</a></span></label><input type="text" class="form-control" id="" name="position_applied_for_3" placeholder="">`
                    );
                    if ($('.specialisation_3').length) {

                        $('.specialisation_3').remove();
                    }
                } else {
                    $('.position_applied_3').html(
                        ` <label for="">Position Applied For(3)  <span><a href="javascript:void(0);"
                class="position_applied_for_3">Other</a></span></label><select name="position_applied_for_3" class="form-select select2 positionAppliedFor3" id="">
                        <option value="">Select Type</option>
                        @foreach ($candidate_positions as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>`
                    );
                }
                $(document).ready(function() {
                    $('.select2').each(function() {
                        $(this).select2({
                            dropdownParent: $(this).parent()
                        });
                    })
                });
            });


        });
    </script>
    <script>
        // whatsapp number start with +91
        $(document).ready(function() {
            $(document).on('keyup', 'input[name="whatapp_no"]', function() {
                var whatapp_no = $(this).val();
                if (whatapp_no.length > 0) {
                    if (!whatapp_no.startsWith('+91')) {
                        $(this).val('+91' + whatapp_no);
                    }
                }

            });
            $(document).on('change', '.positionAppliedFor1', function() {
                // Get the selected value
                var selectedPosition = $(this).val();

                // Check if a position is selected
                if (selectedPosition !== '') {
                    // Create a new div with the selected position's name
                    var newDiv = $(
                        '<div class="col-lg-4 specialisation_1"><div class="form-group "><label>Specialisation for Position (1)</label><input type="text" class="form-control" name="specialisation_1"></div></div>'
                    );

                    // only append if the new specialisation_1 div doesn't exist
                    if (!$('.specialisation_1').length) {
                        $(this).closest('.col-lg-4').after(newDiv);
                    }

                } else {
                    // Remove the new div if position is not selected
                    $(this).closest('.col-lg-4').next('.col-lg-4').remove();
                }
            });

            $(document).on('change', '.positionAppliedFor2', function() {
                // Get the selected value
                var selectedPosition = $(this).val();

                // Check if a position is selected
                if (selectedPosition !== '') {
                    // Create a new div with the selected position's name
                    var newDiv = $(
                        '<div class="col-lg-4 specialisation_2"><div class="form-group "><label>Specialisation for Position (2)</label><input type="text" class="form-control" name="specialisation_2"></div></div>'
                    );

                    // only append if the new specialisation_2 div doesn't exist
                    if (!$('.specialisation_2').length) {
                        $(this).closest('.col-lg-4').after(newDiv);
                    }

                } else {
                    // Remove the new div if position is not selected
                    $(this).closest('.col-lg-4').next('.col-lg-4').remove();
                }
            });

            $(document).on('change', '.positionAppliedFor3', function() {
                // Get the selected value
                var selectedPosition = $(this).val();

                // Check if a position is selected
                if (selectedPosition !== '') {
                    // Create a new div with the selected position's name
                    var newDiv = $(
                        '<div class="col-lg-4 specialisation_3"><div class="form-group "><label>Specialisation for Position (3)</label><input type="text" class="form-control" name="specialisation_3"></div></div>'
                    );

                    // only append if the new specialisation_3 div doesn't exist
                    if (!$('.specialisation_3').length) {
                        $(this).closest('.col-lg-4').after(newDiv);
                    }

                } else {
                    // Remove the new div if position is not selected
                    $(this).closest('.col-lg-4').next('.col-lg-4').remove();
                }
            });

        });
    </script>
@endpush
