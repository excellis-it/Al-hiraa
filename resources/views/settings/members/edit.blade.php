@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
         aria-hidden="true">
        <div class="offcanvas-body">
            <form action="{{ route('members.update', Crypt::encrypt($member->id)) }}" method="POST" enctype="multipart/form-data"
                id="member-edit-form">
                @method('PUT')
                @csrf
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="add-mem-1">
                            <div class="profile-img-box">
                                <div class="profile-img">

                                    @if ($member->profile_picture)
                                        <img src="{{ Storage::url($member->profile_picture) }}" alt=""
                                            id="edit-blah">
                                    @else
                                        <img src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                            id="edit-blah">
                                    @endif
                                    <div class="pro-cam-img-1">
                                        <label for="file-input-edit">
                                            <img src="{{ asset('assets/images/cam-img.png') }}">
                                        </label>
                                        <input id="file-input-edit" type="file" name="profile_picture"
                                            onchange="readEditURL(this);">
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
                                        <input type="text" class="form-control" id=""
                                            value="{{ $member->first_name }}" name="first_name" placeholder="">
                                        <span class="text-danger" id="first_name_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Last Name<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $member->last_name }}" name="last_name" placeholder="">
                                        <span class="text-danger" id="last_name_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Email<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $member->email }}" name="email" placeholder="">
                                        <span class="text-danger" id="email_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $member->phone }}" name="phone" placeholder="">
                                        <span class="text-danger" id="phone_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Designation <span>*</span></label>
                                        <select class="form-select" aria-label="Default select example" name="role_type" id="edit_role_type">
                                            <option>Select a Designation</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" @if ($role->name == $member->role_type) selected @endif>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="role_type_msg"></span>
                                    </div>
                                </div>

                                <div class="col-xl-12" id="editVendorServiceChargeField" style="{{ $member->role_type == 'VENDOR' ? 'display: block;' : 'display: none;' }}">
                                    <div class="form-group">
                                        <label for="">Vendor Service Charge <span>*</span></label>
                                        <input type="text" class="form-control" name="vendor_service_charge" id="edit_vendor_service_charge" value="{{ $member->vendor_service_charge }}" placeholder="">
                                        <span class="text-danger" id="vendor_service_charge_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="ps-div">
                                        <div class="form-group">
                                            <label for="">Password </label>
                                            <input type="password" class="form-control" id="password_edit" name="password"
                                                placeholder="">
                                            <div class="eye-icon-1" id="third-eye">
                                                <span><i class="fa-solid fa-eye-slash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger" id="password_msg"></span>
                                </div>
                                <div class="col-xl-6">
                                    <div class="ps-div">
                                        <div class="form-group">
                                            <label for="">Confirm Password </label>
                                            <input type="password" class="form-control" id="confirm_password_edit"
                                                name="confirm_password" placeholder="">
                                            <div class="eye-icon-1" id="fourth-eye">
                                                <span><i class="fa-solid fa-eye-slash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger" id="confirm_password_msg"></span>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="save-btn-div d-flex align-items-center">
                                        <button type="submit" class="btn save-btn"><span><i
                                                    class="fa-solid fa-check"></i></span> Submit</button>
                                        <button type="button" class="btn save-btn save-btn-1 close-btn-edit"><span><i
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

    <script>
        function readEditURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit-blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file-input-edit").change(function() {
            readEditURL(this);
        });
    </script>
@endif
