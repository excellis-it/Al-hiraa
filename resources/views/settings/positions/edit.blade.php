@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
         aria-hidden="true">
        <div class="offcanvas-body">
            <form action="{{ route('positions.update', Crypt::encrypt($position->id)) }}" method="POST" enctype="multipart/form-data"
                id="position-edit-form">
                @method('PUT')
                @csrf
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add-mem-form">

                            <div class="row">
                                <div class="col-xl-12">
                                    <h4>Edit Team Position</h4>
                                    <div class="form-group">
                                        <label for="">Position Name<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $position->name }}" name="position_name" placeholder="">
                                        <span class="text-danger" id="position_name_msg"></span>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Status<span>*</span></label>
                                        <select name="position_status"  class="form-control">
                                            <option value="1" {{ $position->is_active == 1 ? 'selected':'' }}>Active</option>
                                            <option value="0" {{ $position->is_active == 0 ? 'selected':'' }}>Inactive</option>
                                        </select>
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
