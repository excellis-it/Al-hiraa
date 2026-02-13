@if (isset($edit))
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
    aria-hidden="true">
    <div class="offcanvas-body">
        <form action="{{ route('associates.update', $associate->id) }}" method="POST"
            id="associate-edit-form">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-12">
                    <div class="add-mem-form">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="">Name<span>*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ $associate->name }}" name="name">
                                    <span class="text-danger" id="name_msg"></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="">Phone Number<span>*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ $associate->phone_number }}" name="phone_number">
                                    <span class="text-danger" id="phone_number_msg"></span>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="">Associate ID</label>
                                    <input type="text" class="form-control"
                                        value="{{ $associate->associate_id }}" readonly disabled>
                                    <small class="text-muted">Associate ID cannot be changed</small>
                                </div>
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
@endif