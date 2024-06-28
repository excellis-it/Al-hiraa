@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
        aria-hidden="true">
        <div class="offcanvas-body">
            <form action="{{ route('companies.update', Crypt::encrypt($company->id)) }}" method="POST"
                enctype="multipart/form-data" id="company-edit-form">
                @method('PUT')
                @csrf
                <div class="frm-head">
                    <h2>Edit Company</h2>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add-mem-form">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Company Name<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $company->company_name ?? ''}}" name="company_name" placeholder="">
                                        <span class="text-danger" id="company_name_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Company Address <span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{  Str::limit($company->company_address, 10) ?? ''}}" name="company_address"
                                            placeholder="">
                                         <span class="text-danger" id="company_address_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Company Industry <span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $company->company_industry ?? ''}}" name="company_industry"
                                            placeholder="">
                                         <span class="text-danger" id="company_industry_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Company Website</label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $company->company_website ?? ''}}" name="company_website"
                                            placeholder="">
                                         <span class="text-danger" id="company_website_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Company Logo </label>
                                        <input type="file" class="form-control" id="" value=""
                                            name="company_logo" placeholder="">
                                         <span class="text-danger" id="company_logo_msg"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Company Description</label>
                                        <textarea name="company_description" id="" cols="30" class="form-control" style="height: 100%;"
                                            rows="10">{{ $company->company_description ?? ''}}</textarea>
                                         <span class="text-danger" id="company_description_msg"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="save-btn-div d-flex align-items-center">
                                        <button type="submit" class="btn save-btn"><span><i
                                                    class="fa-solid fa-check"></i></span> update</button>
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
