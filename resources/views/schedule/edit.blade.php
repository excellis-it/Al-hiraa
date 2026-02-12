@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel"
        aria-hidden="true">
        <div class="offcanvas-body">
            <form action="{{ route('schedule-to-do.update', Crypt::encrypt($interview->id)) }}" method="POST"
                enctype="multipart/form-data" id="schedule-edit-form">
                @method('PUT')
                @csrf
                <div class="frm-head">
                    <h2>Edit Interview</h2>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add-mem-form">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Job <span>*</span></label>
                                        <select name="job_id" id="job_id" class="form-select">
                                            <option value="">Choose Job</option>
                                            @foreach ($jobs as $job)
                                                <option value="{{ $job->id }}"
                                                    @if ($job->id == $interview->job_id) selected @endif>
                                                    {{ $job->job_name }} ({{ $job->job_id }})</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="job_id_msg_error"></span>
                                    </div>
                                </div>
                                {{-- <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="">Status <span>*</span></label>
                                        <select name="interview_status" class="form-select" id="">
                                            <option value="">Select a status</option>
                                            <option value="Working" @if ($interview->interview_status == 'Working') selected @endif>
                                                Working</option>
                                            <option value="Transferred"
                                                @if ($interview->interview_status == 'Transferred') selected @endif>Transferred</option>
                                            <option value="Completed" @if ($interview->interview_status == 'Completed') selected @endif>
                                                Completed</option>
                                        </select>
                                        <span class="text-danger" id="interview_status_msg"></span>
                                    </div>
                                </div> --}}
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Interview Date<span>*</span></label>
                                        <input type="text" class="form-control datepicker" id="edit_interview_date"
                                            value="{{ $interview->interview_start_date ? date('d-m-Y', strtotime($interview->interview_start_date)) : '' }}"
                                            name="interview_date" placeholder="">
                                        <span class="text-danger" id="interview_date_msg_error"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="">Interview Location<span>*</span></label>
                                        <input type="text" class="form-control" id="interview_location"
                                            value="{{ $interview->interview_location ?? '' }}" name="interview_location"
                                            placeholder="">
                                        <span class="text-danger" id="interview_location_msg_error"></span>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <div class="save-btn-div d-flex align-items-center">
                                        <button type="submit" class="btn save-btn"><span><i
                                                    class="fa-solid fa-check"></i></span>
                                            Update</button>
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
    <script>
        $('#edit_interview_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
        });
    </script>
@endif
