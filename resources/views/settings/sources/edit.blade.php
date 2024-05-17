@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
         aria-hidden="true">
        <div class="offcanvas-body">
            <form action="{{ route('sources.update', Crypt::encrypt($source->id)) }}" method="POST" enctype="multipart/form-data"
                id="source-edit-form">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-xl-12">
                        <div class="frm-head">
                            <h2>Update Source</h2>
                        </div>
                        <div class="add-mem-form">

                            <div class="row">
                                <div class="col-xl-12">

                                    <div class="form-group">
                                        <label for="">Source Name<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $source->name }}" name="name" placeholder="">
                                        <span class="text-danger" id="name_msg"></span>
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
