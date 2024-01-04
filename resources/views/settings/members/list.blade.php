@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Socail Media
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading row align-items-center">
                {{-- member create start --}}
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                    style="visibility: hidden;" aria-hidden="true">
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
                                                    <label for="">Phone</label>
                                                    <input type="text" class="form-control" id="" value=""
                                                        name="phone" placeholder="">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label for="">Designation <span>*</span></label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="role_type">
                                                        <option value="">Select a Designation</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="ps-div">
                                                    <div class="form-group">
                                                        <label for="">Password <span>*</span></label>
                                                        <input type="password" class="form-control" id="password"
                                                            value="{{ old('password') }}" name="password" placeholder="">
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
                {{-- member create end --}}


                <div class="col-xl-8 col-lg-7 col-md-6 mb-3 mb-md-0">
                    <div class="d-flex w-100">
                        <form class="search-form d-flex w-100" action="index.html">
                            <button class="btn" type="submit" role="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="text" class="form-control" placeholder="Advance Search..">
                            <div class="btn-group">
                                <button type="button" class="btn advance_search_btn">Advance Search</button>

                            </div>
                        </form>
                    </div>
                </div>
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
                                                <th>Designation</th>
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
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="user_tbody">
                                            @if (count($members) > 0)
                                                @foreach ($members as $member)
                                                    <tr>
                                                        <td>
                                                            <span class="user-icon">
                                                                @if ($member->profile_picture)
                                                                    <img src="{{ Storage::url($member->profile_picture) }}"
                                                                        class="table-img" alt="">
                                                                @else
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                                        height="24" viewBox="0 0 25 24">
                                                                        <g id="Group_86" data-name="Group 86"
                                                                            transform="translate(-435.5 -219)">
                                                                            <g id="Ellipse_85" data-name="Ellipse 85"
                                                                                transform="translate(435.5 219)"
                                                                                fill="#fff" stroke="#d9d9d9"
                                                                                stroke-width="1">
                                                                                <ellipse cx="12.5" cy="12"
                                                                                    rx="12.5" ry="12"
                                                                                    stroke="none" />
                                                                                <ellipse cx="12.5" cy="12"
                                                                                    rx="12" ry="11.5"
                                                                                    fill="none" />
                                                                            </g>
                                                                            <g id="user"
                                                                                transform="translate(444.352 226)">
                                                                                <ellipse id="Ellipse_12"
                                                                                    data-name="Ellipse 12" cx="2.588"
                                                                                    cy="2.588" rx="2.588"
                                                                                    ry="2.588"
                                                                                    transform="translate(1.122 0)"
                                                                                    fill="#6a6a6a" />
                                                                                <path id="Path_28" data-name="Path 28"
                                                                                    d="M67.882,298.667A3.887,3.887,0,0,0,64,302.549a.431.431,0,0,0,.431.431h6.9a.431.431,0,0,0,.431-.431A3.887,3.887,0,0,0,67.882,298.667Z"
                                                                                    transform="translate(-64 -292.628)"
                                                                                    fill="#6a6a6a" />
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                @endif

                                                            </span>
                                                            {{ $member->full_name }}
                                                        </td>
                                                        <td>{{ date('d/m/Y', strtotime($member->created_at)) }}</td>
                                                        <td>{{ $member->phone }}</td>
                                                        <td>{{ $member->email }}</td>
                                                        <td>{{ $member->getRoleNames()->first() }}
                                                            <!-- <span class="del-icon">

                                                                                                            </span> -->
                                                        </td>
                                                        <td>
                                                            <a title="Delete User"
                                                                data-route="{{ route('members.delete', Crypt::encrypt($member->id)) }}"
                                                                href="javascipt:void(0);" id="delete"> <span
                                                                    class="trash-icon"><i
                                                                        class="fas fa-trash"></i></span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">No Data Found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end mt-1">
                                        {!! $members->links() !!}
                                    </div>
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
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.close-btn').click(function() {
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
                        window.location.reload();
                        toastr.success('Member details added successfully');
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
@endpush
