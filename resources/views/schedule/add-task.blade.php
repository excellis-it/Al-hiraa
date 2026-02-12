@if (isset($add))
    <div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="offcanvasRightJob"
        aria-labelledby="offcanvasRightLabel" aria-hidden="true" style="width: 600px;">
        <div class="offcanvas-header bg-gradient border-0"
            style="background: #014d8f">
            <h5 class="offcanvas-title text-white fw-bold" id="offcanvasRightLabel">
                <i class="fas fa-briefcase me-2"></i>Create New Job for {{ $company->company_name }}
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4">
            <form action="{{ route('company-job.store') }}" method="POST" enctype="multipart/form-data"
                id="company-job-form-create">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}">

                <div class="row g-4">
                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Job Name<span
                                    class="text-danger ms-1">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-tag text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="job_name"
                                    placeholder="Enter job name">
                            </div>
                            <span class="text-danger small" id="job_name_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Vendor</label>
                            <select name="vendor_id" class="form-select select2-job" id="">
                                <option value="">Select a vendor</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->full_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" id="vendor_id_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Position<span
                                    class="text-danger ms-1">*</span></label>
                            <select name="candidate_position_id" class="form-select select2-job" id="">
                                <option value="">Select a position</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" id="candidate_position_id_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Duty Hours</label>
                            <select name="duty_hours" class="form-select select2-job" id="">
                                <option value="">Select duty hours</option>
                                @for ($i = 1; $i <= 24; $i++)
                                    <option value="{{ $i }}">{{ $i }} Hours per day</option>
                                @endfor
                            </select>
                            <span class="text-danger small" id="duty_hours_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Salary<span
                                    class="text-danger ms-1">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-money-bill-wave text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="salary"
                                    placeholder="e.g. 50000">
                            </div>
                            <span class="text-danger small" id="salary_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Contract (Year)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-file-contract text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="contract"
                                    placeholder="e.g. 2">
                            </div>
                            <span class="text-danger small" id="contract_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">People Required<span
                                    class="text-danger ms-1">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-users text-muted"></i></span>
                                <input type="number" class="form-control border-start-0 ps-0"
                                    name="quantity_of_people_required" placeholder="e.g. 5">
                            </div>
                            <span class="text-danger small" id="quantity_of_people_required_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Benefits</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-gift text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="benifits"
                                    placeholder="e.g. Insurance, Housing">
                            </div>
                            <span class="text-danger small" id="benifits_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Service Charge<span
                                    class="text-danger ms-1">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-dollar-sign text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="service_charge"
                                    placeholder="Enter charge">
                            </div>
                            <span class="text-danger small" id="service_charge_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Referral Point</label>
                            <select name="referral_point_id" class="form-select select2-job" id="">
                                <option value="">Select a referral point</option>
                                @foreach ($referral_points as $referral_point)
                                    <option value="{{ $referral_point->id }}">{{ $referral_point->point }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" id="referral_point_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Location<span
                                    class="text-danger ms-1">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-map-marker-alt text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="address"
                                    placeholder="Enter job location">
                            </div>
                            <span class="text-danger small" id="address_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Job Description</label>
                            <textarea name="job_description" rows="4" class="form-control" placeholder="Enter detailed job description"></textarea>
                            <span class="text-danger small" id="job_description_msg_create"></span>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">Document</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="fas fa-file-upload text-muted"></i></span>
                                <input type="file" class="form-control border-start-0 ps-0" name="document">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn text-white px-4 fw-semibold shadow-sm flex-grow-1 py-2"
                                style="background: #014d8f;">
                                <i class="fa-solid fa-check me-2"></i>Create Job
                            </button>
                            <button type="button"
                                class="btn btn-light px-4 fw-semibold shadow-sm flex-grow-1 py-2 close-btn-add"
                                style="border: 1px solid #ddd;">
                                <i class="fa-solid fa-xmark me-2"></i>Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize select2 for the newly loaded content
            $('.select2-job').select2({
                dropdownParent: $('#offcanvasRightJob')
            });
        });

        $('.close-btn-add').click(function() {
            $('.text-danger').html('');
            var offcanvasElement = document.getElementById('offcanvasRightJob');
            var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
            if (offcanvas) offcanvas.hide();
        });
    </script>
@endif
