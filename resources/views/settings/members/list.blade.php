@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Team Members
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading row align-items-center">
                {{-- member create start --}}
                @can('Create Team')
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                        aria-hidden="true">
                        <div class="offcanvas-body">
                            <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data"
                                id="member-form-create">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-xl-6">
                                        <div class="add-mem-1">
                                            <div class="profile-img-box">
                                                <div class="profile-img">
                                                    <img src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                                        id="blah">
                                                    <div class="pro-cam-img-1">
                                                        <label for="file-input">
                                                            <img src="{{ asset('assets/images/cam-img.png') }}">
                                                        </label>
                                                        <input id="file-input" type="file" name="profile_picture"
                                                            onchange="readURL(this);">
                                                    </div>
                                                </div>
                                                <div class="profile-text">
                                                    <h4>Profile Image</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="add-mem-form">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">First Name<span>*</span></label>
                                                        <input type="text" class="form-control" id="" value=""
                                                            name="first_name" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Last Name<span>*</span></label>
                                                        <input type="text" class="form-control" id="" value=""
                                                            name="last_name" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Email<span>*</span></label>
                                                        <input type="text" class="form-control" id="" value=""
                                                            name="email" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="">Phone<span>*</span></label>
                                                        <input type="text" class="form-control" id="" value=""
                                                            name="phone" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label for="">Designation <span>*</span></label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="role_type" id="roleTypeSelect">
                                                            <option value="">Select a Designation</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12" id="vendorServiceChargeField" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="">Vendor Service Charge <span>*</span></label>
                                                        <input type="text" class="form-control" name="vendor_service_charge"
                                                            placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="ps-div">
                                                        <div class="form-group">
                                                            <label for="">Password <span>*</span></label>
                                                            <input type="password" class="form-control" id="password"
                                                                value="{{ old('password') }}" name="password" placeholder="">
                                                            <div class="eye-icon-2" id="rand-pass">
                                                                <span><i class="fa fa-random"></i></span>
                                                            </div>
                                                            <div class="eye-icon-1" id="first-eye">
                                                                <span><i class="fa-solid fa-eye-slash"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="ps-div">
                                                        <div class="form-group">
                                                            <label for="">Confirm Password <span>*</span></label>
                                                            <input type="password" class="form-control" id="confirm_password"
                                                                value="{{ old('confirm_password') }}" name="confirm_password"
                                                                placeholder="">
                                                            <div class="eye-icon-1" id="second-eye">
                                                                <span><i class="fa-solid fa-eye-slash"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger"></span>
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
                @endcan

                {{-- member create end --}}

                {{-- member edit start --}}
                @can('Edit Team')
                    <div id="edit-members">
                        @include('settings.members.edit')
                    </div>
                @endcan

                {{-- member edit end --}}


                <div class="col-xl-8 col-lg-7 col-md-6 mb-3 mb-md-0">
                    <div class="d-flex w-100">
                        <form class="search-form d-flex w-100" id="search-form">
                            <button class="btn" type="submit" role="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="text" class="form-control" placeholder="Advance Search.." name="query"
                                id="query">
                            <div class="btn-group">
                                <button type="submit" class="btn advance_search_btn">Advance Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                @can('Create Team')
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <div class="btn-group me-4">
                                <a href="add_candidate.html" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight" class="btn addcandidate_btn"><i class="fas fa-plus"></i>
                                    Add
                                    Memeber</a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <!-- page-contain-start  -->
            <div class="integrations-div team-members-div">
                <div class="page__heading row align-items-center mb-0">
                    <div class="col-xl-12 mb-3 mb-md-0">
                        <div class="integrations-head">
                            <h2>Team Members</h2>
                        </div>
                    </div>
                </div>
                <div class="user-acces-table team-members-table">
                    <div class="container-fluid page__container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 p-0">
                                <div class="table-responsive border-bottom" data-toggle="lists">
                                    <table class="table mb-0 table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Team Member Name</th>
                                                <th>Start Date</th>
                                                <th>Phone Number</th>
                                                <th>Login ID</th>
                                                <th>Code</th>
                                                <th>Vendor Charge</th>
                                                <th>Designation</th>
                                                <th>Status</th>
                                                @can('Delete Team')
                                                    <th><svg xmlns="http://www.w3.org/2000/svg" width="2" height="12"
                                                            viewBox="0 0 2 12">
                                                            <g id="Group_87" data-name="Group 87"
                                                                transform="translate(-1898 -172)">
                                                                <circle id="Ellipse_238" data-name="Ellipse 238"
                                                                    cx="1" cy="1" r="1"
                                                                    transform="translate(1898 172)" fill="#989898" />
                                                                <circle id="Ellipse_239" data-name="Ellipse 239"
                                                                    cx="1" cy="1" r="1"
                                                                    transform="translate(1898 177)" fill="#989898" />
                                                                <circle id="Ellipse_240" data-name="Ellipse 240"
                                                                    cx="1" cy="1" r="1"
                                                                    transform="translate(1898 182)" fill="#989898" />
                                                            </g>
                                                        </svg></th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="user_tbody">
                                            @include('settings.members.filter')
                                        </tbody>
                                    </table>
                                </div>
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
        document.getElementById('roleTypeSelect').addEventListener('change', function() {
            const vendorField = document.getElementById('vendorServiceChargeField');
            if (this.value === 'VENDOR') {
                vendorField.style.display = 'block';
            } else {
                vendorField.style.display = 'none';
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#first-eye').click(function() {
                $('#password').attr('type', $('#password').is(':password') ? 'text' : 'password');
                $(this).find('i').toggleClass('fa-eye-slash fa-eye');
            });
            $('#second-eye').click(function() {
                $('#confirm_password').attr('type', $('#confirm_password').is(':password') ? 'text' :
                    'password');
                $(this).find('i').toggleClass('fa-eye-slash fa-eye');
            });
            $(document).on('click', '#third-eye', function() {
                $('#password_edit').attr('type', $('#password_edit').is(':password') ? 'text' : 'password');
                $(this).find('i').toggleClass('fa-eye-slash fa-eye');
            });
            $(document).on('click', '#fourth-eye', function() {
                $('#confirm_password_edit').attr('type', $('#confirm_password_edit').is(':password') ?
                    'text' :
                    'password');
                $(this).find('i').toggleClass('fa-eye-slash fa-eye');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.close-btn', function() {
                $('.text-danger').html('');
                $('#offcanvasRight').offcanvas('hide');
            });

            $('#member-form-create').submit(function(e) {
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
                        // Handle success response
                        if (response.status == true) {
                            window.location.reload();
                        } else {
                            window.location.reload();
                        }

                        // toastr.success('Member details added successfully');
                    },
                    error: function(xhr) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        // Handle errors (e.g., display validation errors)
                        $('.text-danger').html('');
                        var errors = xhr.responseJSON.errors;
                        console.log(xhr.responseJSON.errors);

                        $.each(errors, function(key, value) {
                            $('[name="' + key + '"]').next('.text-danger').html(value[
                                0]);
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(document).on('click', '#delete', function(e) {
            swal({
                    title: "Are you sure?",
                    text: "To delete this user.",
                    type: "warning",
                    confirmButtonText: "Yes",
                    showCancelButton: true
                })
                .then((result) => {
                    if (result.value) {
                        window.location = $(this).data('route');
                    } else if (result.dismiss === 'cancel') {
                        swal(
                            'Cancelled',
                            'Your stay here :)',
                            'error'
                        )
                    }
                })
        });
    </script>
    <script>
        $(document).on('change', '.toggle-class', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('members.status') }}',
                data: {
                    'status': status,
                    'user_id': user_id
                },
                success: function(resp) {
                    toastr.success('Status updated successfully');
                }
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
                        $('#edit-members').html(response.view);
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
            $(document).on('submit', '#member-edit-form', function(e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.location.reload();
                        // toastr.success('Members details updated successfully');
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            // Assuming you have a span with class "text-danger" next to each input
                            $('#' + key + '_msg').html(value[0]);
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {


            function fetch_data(page, query) {
                $.ajax({
                    url: "{{ route('members.filter') }}",
                    data: {
                        page: page,
                        search: query
                    },
                    success: function(data) {
                        console.log(data.view);
                        $('#user_tbody').html(data.view);
                    }
                });
            }

            $(document).on('submit', '.search-form', function(e) {
                e.preventDefault();
                var query = $('#query').val();
                var page = $('#hidden_page').val();
                fetch_data(page, query);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#query').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query);
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#rand-pass', function() {
                var randomstring = Math.random().toString(36).slice(-8);
                $('#password').val(randomstring);
                $('#confirm_password').val(randomstring);
                $('#password').attr('type', 'text');
                $('#first-eye').find('i').addClass('fa-eye');

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#edit_role_type', function() {
                var selectedRole = $(this).val();
                if (selectedRole === 'VENDOR') {
                    $('#editVendorServiceChargeField').show();
                    $('#edit_vendor_service_charge').attr('required', 'required');
                } else {
                    $('#editVendorServiceChargeField').hide();
                    $('#edit_vendor_service_charge').removeAttr('required');
                }
            });
        });
    </script>
@endpush
