@if (isset($edit))
        @php
            $modules = ['Profile','Candidate', 'Job', 'Company', 'Schedule', 'New Registration', 'Revenue', 'Team Performance', 'Team', 'User Access', 'Support'];

        @endphp
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
            style="visibility: hidden;" aria-hidden="true">
            <div class="offcanvas-body">
                <div class="user-acces-table">
                    <form action="{{ route('user-access.update', Crypt::encrypt($role->id)) }}" method="POST" enctype="multipart/form-data"
                        id="role-edit-form">
                        @method('PUT')
                        @csrf
                        <div class="frm-head">
                            <h2>Create New Role</h2>
                        </div>
                        <div class="name-fill">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control" placeholder="" name="role_name" type="text"
                                    value="{{ $role->name }}" @if ($role->name == 'ASSOCIATE') readonly @endif>
                                <span class="text-danger" id="role_name_msg"></span>
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
                                        <table class="table mb-0 table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px; text-align: center;">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" id="checkAllEdit"
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
                                                                            {{--   {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }} --}}
                                                                            <input class="form-check-input" type="checkbox"
                                                                                role="switch" name="permissions[]"
                                                                                value="{{ $key }}" @if (in_array($key, $role->permissions()->pluck('id')->toArray())) checked  @endif id="flexSwitchCheckChecked">
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
                                                                            <input class="form-check-input" type="checkbox"
                                                                                role="switch" name="permissions[]"
                                                                                value="{{ $key }}" @if (in_array($key, $role->permissions()->pluck('id')->toArray())) checked  @endif id="flexSwitchCheckChecked">
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
                                                                            <input class="form-check-input" type="checkbox"
                                                                                role="switch" name="permissions[]" @if (in_array($key, $role->permissions()->pluck('id')->toArray())) checked  @endif
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
                                                                            <input class="form-check-input" type="checkbox" @if (in_array($key, $role->permissions()->pluck('id')->toArray())) checked  @endif
                                                                                role="switch" name="permissions[]"
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
                                                                            <input class="form-check-input" type="checkbox"  @if (in_array($key, $role->permissions()->pluck('id')->toArray())) checked  @endif
                                                                                role="switch" name="permissions[]"
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
                                                                            <input class="form-check-input" type="checkbox"  @if (in_array($key, $role->permissions()->pluck('id')->toArray())) checked  @endif
                                                                                role="switch" name="permissions[]"
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
                                            <p>No permissions available</p>
                                        @endif
                                        <span class="text-danger" id="permissions_msg"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="save-btn-div d-flex align-items-center">
                                <button type="submit" class="btn save-btn"><span><i
                                            class="fa-solid fa-check"></i></span>Update</button>
                                <button type="button" class="btn save-btn save-btn-1 close-btn-edit"><span><i
                                            class="fa-solid fa-xmark"></i></span>Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#checkAllEdit").click(function() {
                    $('input:checkbox').prop('checked', this.checked);
                });

                // Handle individual checkboxes
                $('input:checkbox').not("#checkAllEdit").click(function() {
                    if (!this.checked) {
                        $("#checkAllEdit").prop('checked', false);
                    }
                });
            });
        </script>
@endif
