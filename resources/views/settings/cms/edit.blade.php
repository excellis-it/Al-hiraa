@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
        aria-hidden="true">
        <div class="offcanvas-body">
            <form action="{{ route('cms.update', Crypt::encrypt($cms->id)) }}" method="POST" enctype="multipart/form-data"
                id="cms-edit-form">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-xl-12">
                        <div class="frm-head">
                            <h2>Update Page Details</h2>
                        </div>
                        <div class="add-mem-form">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Page Name<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $cms->page_name }}" name="page_name" placeholder="">
                                        <span class="text-danger" id="page_name_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Title<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $cms->title }}" name="title" placeholder="">
                                        <span class="text-danger" id="title_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Slug<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $cms->slug }}" name="slug" placeholder="">
                                        <span class="text-danger" id="slug_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Is Active<span>*</span></label>
                                        <select name="is_active" class="form-select">
                                            <option value="">Select Status</option>
                                            <option value="1" {{ $cms->is_active == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $cms->is_active == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        <span class="text-danger" id="page_name_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Content<span>*</span></label>
                                        <textarea name="content" id="edit_description" cols="30" rows="30" class="form-control">{{ $cms->content }}</textarea>
                                        <span class="text-danger" id="is_active_msg"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="save-btn-div d-flex align-items-center">
                                        <button type="submit" class="btn save-btn"><span><i
                                                    class="fa-solid fa-check"></i></span> Update</button>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#edit_description"));
    </script>
@endif
