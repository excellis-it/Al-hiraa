@if (isset($add))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightJob" aria-labelledby="offcanvasRightLabel"
        aria-hidden="true">
        <div class="offcanvas-body">
            <div class="user-acces-table">
                <form action="{{ route('company-job.store') }}" method="POST" enctype="multipart/form-data"
                    id="company-job-form-create">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <div class="frm-head">
                        <h2>Create New Job</h2>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="add-mem-form job-creat">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Job Name<span>*</span></label>
                                            <input type="text" class="form-control" id="" value=""
                                                name="job_name" placeholder="">
                                            <span class="text-danger" id="job_name_msg_create"></span>
                                        </div>
                                    </div>
                                    {{-- vendors --}}
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Vendor</label>
                                            <select name="vendor_id" class="form-select new_select2" id="">
                                                <option value="">Select a vendor</option>
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">
                                                        {{ $vendor->full_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="vendor_id_msg_create"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Position<span>*</span></label>
                                            <select name="candidate_position_id" class="form-select new_select2"
                                                id="">
                                                <option value="">Select a position</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}">
                                                        {{ $position->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="candidate_position_id_msg_create"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Duty Hours</label>
                                            <select name="duty_hours" class="form-select new_select2" id="">
                                                <option value="">Select a duty hours</option>
                                                <?php for ($i = 1; $i <= 24; $i++) : ?>
                                                <option value="{{ $i }}">{{ $i }}
                                                    Hours per day</option>

                                                <?php endfor; ?>
                                            </select>
                                            <span class="text-danger" id="duty_hours_msg_create"></span>
                                        </div>
                                    </div>
                                    {{-- salary --}}
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Salary*</label>
                                            <input type="text" class="form-control" id="" value=""
                                                name="salary" placeholder="">
                                            <span class="text-danger" id="salary_msg_create"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Contract (Year)</label>
                                            <input type="text" class="form-control" id="" value=""
                                                name="contract" placeholder="">
                                            <span class="text-danger" id="contract_msg_create"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">People Required<span>*</span></label>
                                            <input type="number" class="form-control" id=""
                                                value="" name="quantity_of_people_required" placeholder="">
                                            <span class="text-danger" id="quantity_of_people_required_msg_create"></span>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Benefits </label>
                                            <input type="text" class="form-control" id="" value=""
                                                name="benifits" placeholder="">
                                            <span class="text-danger" id="benifits_msg_create"></span>
                                        </div>
                                    </div>
                                    {{-- service_charge --}}
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Service Charge<span>*</span></label>
                                            <input type="text" class="form-control" id="" value=""
                                                name="service_charge" placeholder="">
                                            <span class="text-danger" id="service_charge_msg_create"></span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Status <span>*</span></label>
                                            <select name="status" class="form-select" id="">
                                                <option value="">Select a status</option>
                                                <option value="Ongoing">Ongoing</option>
                                                <option value="Closed">Closed</option>
                                            </select>
                                            <span class="text-danger" id="status_msg_create"></span>
                                        </div>
                                    </div> --}}
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="">Referral Point</label>
                                            <select name="referral_point_id" class="form-select" id="">
                                                <option value="">Select a referral point</option>
                                                @foreach ($referral_points as $referral_point)
                                                    <option value="{{ $referral_point->id }}">
                                                        {{ $referral_point->point }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="referral_point_msg_create"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="">Location <span>*</span></label>
                                            <input type="text" class="form-control" id="" value=""
                                                name="address" placeholder="">
                                            <span class="text-danger" id="address_msg_create"></span>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="">Job Description</label>
                                            <textarea name="job_description" id="" cols="30" class="form-control" style="height: 100%;"
                                                rows="10"></textarea>
                                            <span class="text-danger" id="job_description_msg_create"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="">Document </label>
                                            <input type="file" class="form-control" id=""
                                                value="" name="document" placeholder="">
                                            <span class="text-danger" id=""></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="save-btn-div d-flex align-items-center">
                                            <button type="submit" class="btn save-btn"><span><i
                                                        class="fa-solid fa-check"></i></span>
                                                Submit</button>
                                            <button type="button"
                                                class="btn save-btn save-btn-1 close-btn-add"><span><i
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
    </div>
@endif
<script>
    // select2
    $(document).ready(function() {
        $('.select2').select2();
    });

    // close button
    $('.close-btn-add').click(function() {
        $('.text-danger').html('');
        $('#offcanvasRightJob').offcanvas('hide');
    });
</script>
