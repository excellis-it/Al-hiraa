@if (isset($edit))
@can('Edit User Access')
{{-- member create start --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel" style="visibility: hidden;" aria-hidden="true">
    <div class="offcanvas-body">
        <div class="user-acces-table">
            <form action="{{ route('user-access.store', $role->id) }}" method="POST" enctype="multipart/form-data"
                id="role-edit-form">
                @method('PUT')
                @csrf
                <div class="frm-head">
                    <h2>Create New Role</h2>
                </div>
                <div class="name-fill">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" placeholder="" name="role_name" type="text">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="frm-head mb-3">
                    <h3>Assign Permission to Roles</h3>
                </div>
                <div class="container-fluid page__container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 p-0">
                            <div class="table-responsive border-bottom" data-toggle="lists">
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
                                                                        type="checkbox" role="switch"
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
                                                                        type="checkbox" role="switch"
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
                                                                        type="checkbox" role="switch"
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
                                                                        type="checkbox" role="switch"
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
                                                                        type="checkbox" role="switch"
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="save-btn-div d-flex align-items-center">
                        <button type="submit" class="btn save-btn"><span><i
                                    class="fa-solid fa-check"></i></span>Submit</button>
                        <button type="button" class="btn save-btn save-btn-1 close-btn-edit"><span><i
                                    class="fa-solid fa-xmark"></i></span>Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- member create end --}}
@endcan
@endif
