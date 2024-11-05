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
                        <div class="add-mem-form job-creat">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Job Name<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $job->job_name }}" name="job_name" placeholder="">
                                        <span class="text-danger" id="job_name_msg_job"></span>
                                    </div>
                                </div>
                                {{-- vendors --}}
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Vendors<span>*</span></label>
                                        <select name="vendor_id" class="form-select new_select2" id="" disabled>
                                            <option value="">Select an vendor</option>
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->id }}"
                                                    {{ $job->vendor_id == $vendor->id ? 'selected' : '' }}>
                                                    {{ $vendor->full_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="vendor_id_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Position<span>*</span></label>
                                        <select name="candidate_position_id" class="form-select new_select2" id="">
                                            <option value="">Select a position</option>
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}"
                                                    {{ $job->candidate_position_id == $position->id ? 'selected' : '' }}>
                                                    {{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="candidate_position_id_msg_job"></span>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Duty Hours</label>
                                        <select name="duty_hours" class="form-select select2" id="">
                                            <option value="">Select a duty hours</option>
                                            <?php for ($i = 1; $i <= 24; $i++) : ?>
                                            <option
                                                value="{{ $i }}"{{ $job->duty_hours == $i ? 'selected' : '' }}>
                                                {{ $i }} Hours per
                                                day</option>
                                            <?php endfor; ?>
                                        </select>
                                        <span class="text-danger" id="duty_hours_msg_job"></span>
                                    </div>
                                </div>
                                {{-- salary --}}
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Salary <span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $job->salary }}" name="salary" placeholder="">
                                        <span class="text-danger" id="salary_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Contract (Year)</label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $job->contract }}" name="contract" placeholder="">
                                        <span class="text-danger" id="contract_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Number of people required<span>*</span></label>
                                        <input type="number" class="form-control" id=""
                                            value="{{ $job->quantity_of_people_required }}" name="quantity_of_people_required" placeholder="">
                                        <span class="text-danger" id="quantity_of_people_required_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Benefits</label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $job->benifits }}" name="benifits" placeholder="">
                                        <span class="text-danger" id="benifits_msg_job"></span>
                                    </div>
                                </div>
                                 {{-- service_charge --}}
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="">Service Charge<span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $job->service_charge }}" name="service_charge" placeholder="">
                                        <span class="text-danger" id="service_charge_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="">Status <span>*</span></label>
                                        <select name="status" class="form-select" id="">
                                            <option value="">Select a status</option>
                                            <option value="Ongoing"{{ $job->status == 'Ongoing' ? 'selected' : '' }}>
                                                Ongoing</option>
                                            <option value="Closed"{{ $job->status == 'Closed' ? 'selected' : '' }}>
                                                Closed</option>
                                        </select>
                                        <span class="text-danger" id="status_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="">Referral Point</label>
                                        <select name="referral_point_id" class="form-select" id="">
                                            <option value="">Select a referral point</option>
                                            @foreach ($referral_points as $referral_point)
                                                <option value="{{ $referral_point->id }}"{{ $job->referral_point_id == $referral_point->id ? 'selected' : ''}}>
                                                    {{ $referral_point->point }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="referral_point_msg_create"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Location <span>*</span></label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $job->address }}" name="address" placeholder="">
                                        <span class="text-danger" id="address_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Job Description</label>
                                        <textarea name="job_description" id="" cols="30" class="form-control" style="height: 100%;"
                                            rows="10">{{ $job->job_description }}</textarea>
                                        <span class="text-danger" id="job_description_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Document</label>
                                        <input type="file" class="form-control" id=""
                                            value="{{ $job->document }}" name="document" placeholder="">

                                        <span class="text-danger" id=""></span>
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
<script>
    // select2
    $(document).ready(function() {
            $('.new_select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            })
        });
</script>
<script>
    function loadCities(state_id) {
        if (state_id) {
            $.ajax({
                url: "{{ route('company-job.get-city') }}",
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#edit_city_id').empty();
                    $('#edit_city_id').append('<option value="">Select a city</option>');
                    var city_id = "{{ $job->city_id ?? '' }}";
                    $.each(response.cities, function(key, value) {
                        $('#edit_city_id').append('<option value="' + value.id + '"' + (city_id == value.id ? 'selected' : '') + '>' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#edit_city_id').empty();
            $('#edit_city_id').append('<option value="">Select a city</option>');
        }
    }

    // On state change
    $('#edit_state_id').change(function() {
        loadCities($(this).val());
    });

    // On page load
    $(document).ready(function() {
        var state_id = $('#edit_state_id').val();
        console.log(state_id);
        loadCities(state_id);
    });
</script>
