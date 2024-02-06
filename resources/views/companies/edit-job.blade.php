@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasJobEdit" aria-labelledby="offcanvasRightLabel"
        aria-hidden="true">
        <div class="offcanvas-body">
            <form action="{{ route('company-job.update', Crypt::encrypt($job->id)) }}" method="POST"
                enctype="multipart/form-data" id="company-job-edit-form">
                @method('PUT')
                @csrf
                <div class="frm-head">
                    <h2>Edit Job</h2>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add-mem-form">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Job Name<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{$job->job_name}}" name="job_name" placeholder="">
                                        <span class="text-danger" id="job_name_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Duty Hours</label>
                                        <select name="duty_hours" class="form-select" id="">
                                            <option value="">Select a duty hours</option>
                                            <?php for ($i = 1; $i <= 24; $i++) : ?>
                                            <option value="{{$i}}"{{$job->duty_hours == $i ? 'selected' : ''}}>{{$i}} Hours per
                                                day</option>
                                        <?php endfor; ?>
                                        </select>
                                        <span class="text-danger" id="duty_hours_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Contract (Year)</label>
                                        <input type="text" class="form-control" id=""
                                            value="{{$job->contract}}" name="contract" placeholder="">
                                        <span class="text-danger" id="contract_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Benifits</label>
                                        <input type="text" class="form-control" id=""
                                            value="{{$job->benifits}}" name="benifits" placeholder="">
                                        <span class="text-danger" id="benifits_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Status <span>*</span></label>
                                        <select name="status" class="form-select" id="">
                                            <option value="">Select a status</option>
                                            <option value="Ongoing"{{$job->status == "Ongoing" ? 'selected' : ''}}>Ongoing</option>
                                            <option value="Closed"{{$job->status == "Closed" ? 'selected' : ''}}>Closed</option>
                                        </select>
                                        <span class="text-danger" id="status_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Job Description</label>
                                        <textarea name="job_description" id="" cols="30" class="form-control" style="height: 100%;"
                                            rows="10">{{$job->job_description}}</textarea>
                                        <span class="text-danger" id="job_description_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="save-btn-div d-flex align-items-center">
                                        <button type="submit" class="btn save-btn"><span><i
                                                    class="fa-solid fa-check"></i></span> Update</button>
                                        <button type="button"
                                            class="btn save-btn save-btn-1 close-btn-job-edit"><span><i
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
