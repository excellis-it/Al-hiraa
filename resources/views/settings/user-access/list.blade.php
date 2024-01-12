@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - User Access Control
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="user-acces-div">
                <div class="row justify-content-end align-items-center">
                    @can('Create User Access')
                        {{-- member create start --}}
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                            aria-labelledby="offcanvasRightLabel" style="visibility: hidden;" aria-hidden="true">
                            <div class="offcanvas-body">
                                <div class="user-acces-table">
                                    <form action="{{ route('user-access.store') }}" method="POST" enctype="multipart/form-data"
                                        id="role-form-create">
                                        @csrf
                                        <div class="frm-head">
                                            <h2>Create New Role</h2>
                                        </div>
                                        <div class="name-fill">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" placeholder="" name="role_name" type="text">
                                                <span class="text-danger" id="role_name_msg_error"></span>
                                            </div>
                                        </div>
                                        <div class="frm-head mb-3">
                                            <h3>Assign Permission to Roles</h3>
                                        </div>
                                        <div class="container-fluid page__container">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 p-0">
                                                    <div class="table-responsive border-bottom" data-toggle="lists">
                                                        @if (!empty($permissions))
                                                            @php
                                                                $modules = ['Profile','Candidate', 'Job', 'Company', 'Schedule', 'New Registration', 'Revenue', 'Team Performance', 'Team', 'User Access', 'Support'];

                                                            @endphp
                                                            <table class="table mb-0 table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 50px; text-align: center;">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" id="checkAll"
                                                                                    class="custom-control-input js-check-selected-row">
                                                                            </div>
                                                                        </th>
                                                                        <th>Select All</th>
                                                                        <th>Manage</th>
                                                                        <th>Create</th>
                                                                        <th>Update</th>
                                                                        <th>Delete</th>
                                                                        <th>View</th>
                                                                        <th>Export</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="list">
                                                                    @foreach ($modules as $module)
                                                                        <tr>
                                                                            <td></td>
                                                                            <td>{{ ucfirst($module) }} </td>
                                                                            <td>
                                                                                @if (in_array('Manage ' . $module, (array) $permissions))
                                                                                    @if ($key = array_search('Manage ' . $module, $permissions))
                                                                                        <div class="toggle-check">
                                                                                            <div class="form-check form-switch">
                                                                                                <input class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    role="switch"
                                                                                                    name="permissions[]"
                                                                                                    value="{{ $key }}"
                                                                                                    id="flexSwitchCheckChecked">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if (in_array('Create ' . $module, (array) $permissions))
                                                                                    @if ($key = array_search('Create ' . $module, $permissions))
                                                                                        <div class="toggle-check">
                                                                                            <div class="form-check form-switch">
                                                                                                <input class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    role="switch"
                                                                                                    name="permissions[]"
                                                                                                    value="{{ $key }}"
                                                                                                    id="flexSwitchCheckChecked">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </td>

                                                                            <td>
                                                                                @if (in_array('Edit ' . $module, (array) $permissions))
                                                                                    @if ($key = array_search('Edit ' . $module, $permissions))
                                                                                        <div class="toggle-check">
                                                                                            <div class="form-check form-switch">
                                                                                                <input class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    role="switch"
                                                                                                    name="permissions[]"
                                                                                                    value="{{ $key }}"
                                                                                                    id="flexSwitchCheckChecked">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if (in_array('Delete ' . $module, (array) $permissions))
                                                                                    @if ($key = array_search('Delete ' . $module, $permissions))
                                                                                        <div class="toggle-check">
                                                                                            <div class="form-check form-switch">
                                                                                                <input class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    role="switch"
                                                                                                    name="permissions[]"
                                                                                                    value="{{ $key }}"
                                                                                                    id="flexSwitchCheckChecked">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if (in_array('View ' . $module, (array) $permissions))
                                                                                    @if ($key = array_search('View ' . $module, $permissions))
                                                                                        <div class="toggle-check">
                                                                                            <div class="form-check form-switch">
                                                                                                <input class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    role="switch"
                                                                                                    name="permissions[]"
                                                                                                    value="{{ $key }}"
                                                                                                    id="flexSwitchCheckChecked">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if (in_array('Export ' . $module, (array) $permissions))
                                                                                    @if ($key = array_search('Export ' . $module, $permissions))
                                                                                        <div class="toggle-check">
                                                                                            <div class="form-check form-switch">
                                                                                                <input class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    role="switch"
                                                                                                    name="permissions[]"
                                                                                                    value="{{ $key }}"
                                                                                                    id="flexSwitchCheckChecked">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <div class="alert alert-danger" role="alert">
                                                                No Permissions Found
                                                            </div>
                                                        @endif
                                                        <span class="text-danger" id="permissions_msg_error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="save-btn-div d-flex align-items-center">
                                                <button type="submit" class="btn save-btn"><span><i
                                                            class="fa-solid fa-check"></i></span>Submit</button>
                                                <button type="button" class="btn save-btn save-btn-1 close-btn"><span><i
                                                            class="fa-solid fa-xmark"></i></span>Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- member create end --}}
                    @endcan
                    @can('Edit User Access')
                        <div id="edit-user-access">
                            @include('settings.user-access.edit')
                        </div>
                        {{-- member edit end --}}
                    @endcan
                    @can('Create User Access')
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="d-flex justify-content-center justify-content-md-end">
                                <div class="btn-group me-4 mb-3">
                                    <a href="add_candidate.html" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                        aria-controls="offcanvasRight" class="btn addcandidate_btn"><i
                                            class="fas fa-plus"></i>
                                        Add
                                        Designation & Permission</a>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="user-acces-table">
                    <div class="container-fluid page__container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 p-0">
                                <div class="table-responsive border-bottom" data-toggle="lists">
                                    <table class="table mb-0 table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Designation</th>
                                                <th>Permission</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="user_tbody">
                                            @if (count($roles) > 0)
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        <td
                                                            @can('Edit User Access') class="edit-route" data-route="{{ route('user-access.edit', $role['id']) }}" @endcan>
                                                            {{ $role->name }}</td>
                                                        <td
                                                            @can('Edit User Access') class="edit-route" data-route="{{ route('user-access.edit', $role['id']) }}" @endcan>
                                                            @foreach ($role->permissions as $permission)
                                                                <span
                                                                    class="badge bg-primary rounded-pill">{{ $permission->name }}</span>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @can('Delete User Access')
                                                                @if ($role->name == 'RECRUITER' || $role->name == 'PROCESS MANAGER' || $role->name == 'DATA ENTRY OPERATOR' || $role->name == 'ASSOCIATE')
                                                                @else
                                                                    <a title="Delete User"
                                                                        data-route="{{ route('user-access.delete', Crypt::encrypt($role->id)) }}"
                                                                        href="javascipt:void(0);" id="delete"> <span
                                                                            class="trash-icon"><i
                                                                                class="fas fa-trash"></i></span></a>
                                                                @endif
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

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
        $(document).on('click', '#delete', function(e) {
            swal({
                    title: "Are you sure?",
                    text: "To delete this Role.",
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
    {{-- checkAll  the checkbox  but on box is not checked  checkAll checkbox is unchecked --}}

    <script>
        $(document).ready(function() {
            $("#checkAll").click(function() {
                $('input:checkbox').prop('checked', this.checked);
            });

            // Handle individual checkboxes
            $('input:checkbox').not("#checkAll").click(function() {
                if (!this.checked) {
                    $("#checkAll").prop('checked', false);
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

            $('#role-form-create').submit(function(e) {
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
                        // toastr.success('Role & Permission added successfully');
                    },
                    error: function(xhr) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        // Handle errors (e.g., display validation errors)
                        $('.text-danger').html('');
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '_msg_error').html(value[0]);
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
                        $('#edit-user-access').html(response.view);
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
            $(document).on('submit', '#role-edit-form', function(e) {
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
                        // toastr.success('Role & Permission updated successfully');
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
@endpush
