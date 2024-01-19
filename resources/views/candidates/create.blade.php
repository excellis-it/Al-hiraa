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
                                <form action="{{ route('candidates.store') }}" method="POST">
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
            $('.select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            })
        });
    </script>
    <script>
        $(document).ready(function() {
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
                            $('.auto-fill').html(response.view);
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
                } else {
                    $('.position_applied_1').html(
                        ` <label for="">Position Applied For(1) <span>*</span> <span><a href="javascript:void(0);"
                class="position_applied_for_1">Other</a></span></label><select name="position_applied_for_1" class="form-select select2" id="">
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
                } else {
                    $('.position_applied_2').html(
                        ` <label for="">Position Applied For(2) <span>*</span> <span><a href="javascript:void(0);"
                class="position_applied_for_2">Other</a></span></label><select name="position_applied_for_2" class="form-select select2" id="">
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
                        ` <label for="">Position Applied For(3) <span>*</span> <span><a href="javascript:void(0);"
                class="position_applied_for_3">List</a></span></label><input type="text" class="form-control" id="" name="position_applied_for_3" placeholder="">`
                    );
                } else {
                    $('.position_applied_3').html(
                        ` <label for="">Position Applied For(3) <span>*</span> <span><a href="javascript:void(0);"
                class="position_applied_for_3">Other</a></span></label><select name="position_applied_for_3" class="form-select select2" id="">
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
        });
    </script>
@endpush
