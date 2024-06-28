@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
        aria-hidden="true">
        <div class="offcanvas-body">
            <form action="{{ route('status.update', Crypt::encrypt($status->id)) }}" method="POST"
                enctype="multipart/form-data" id="status-edit-form">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-xl-12">
                        <div class="add-mem-form">

                            <div class="row">
                                <div class="col-xl-12">
                                    <h4>Edit Status</h4>
                                    <div class="form-group">
                                        <label for="">Status Name<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $status->name }}" name="name" placeholder="Enter name">
                                        <span class="text-danger" id="name"></span>
                                    </div>
                                </div>

                                <input type="hidden"  name="id" value="{{ $status->id }}">

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Color<span>*</span></label>
                                        <input type="color" class="form-control" id=""
                                            style="height: 50px;
    width: 50px;
    display: inline-block;
    vertical-align: middle;"
                                            value="{{ $status->color }}" name="color" placeholder="Enter color">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Background Color<span>*</span></label>
                                        <input type="color" class="form-control" id=""
                                            style="height: 50px;
    width: 50px;
    display: inline-block;
    vertical-align: middle;"
                                            value="{{ $status->background }}" name="background"
                                            placeholder="Enter background color">
                                        <span class="text-danger"></span>
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
