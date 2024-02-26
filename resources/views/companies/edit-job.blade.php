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
                                {{-- states --}}
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">State<span>*</span></label>
                                        <select name="state_id" class="form-select new_select2 state_id" id="edit_state_id">
                                            <option value="">Select a state</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ $job->state_id == $state->id ? 'selected' : '' }}>
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="state_id_msg_job"></span>
                                    </div>
                                </div>
                                {{-- cities --}}
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">City<span>*</span></label>
                                        <select name="city_id" class="form-select new_select2 city_id" id="edit_city_id">
                                            <option value="">Select a city</option>
                                        </select>
                                        <span class="text-danger" id="city_id_msg_job"></span>
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
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Contract (Year)</label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $job->contract }}" name="contract" placeholder="">
                                        <span class="text-danger" id="contract_msg_job"></span>
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
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Benifits</label>
                                        <input type="text" class="form-control" id=""
                                            value="{{ $job->benifits }}" name="benifits" placeholder="">
                                        <span class="text-danger" id="benifits_msg_job"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
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
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Job Description</label>
                                        <textarea name="job_description" id="" cols="30" class="form-control" style="height: 100%;"
                                            rows="10">{{ $job->job_description }}</textarea>
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