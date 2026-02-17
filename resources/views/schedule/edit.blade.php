@if (isset($edit))
    <div class="offcanvas offcanvas-end border-0 shadow-lg" tabindex="-1" id="offcanvasEdit"
        aria-labelledby="offcanvasEditLabel" aria-hidden="true" style="width: 500px;">
        <div class="offcanvas-header bg-gradient border-0" style="background: #014d8f;">
            <h5 class="offcanvas-title text-white fw-bold" id="offcanvasEditLabel">
                <i class="fas fa-edit me-2"></i>Edit Interview
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4">
            <form action="{{ route('schedule-to-do.update', Crypt::encrypt($interview->id)) }}" method="POST"
                enctype="multipart/form-data" id="schedule-edit-form">
                @method('PUT')
                @csrf
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-briefcase text-success me-2"></i>Job <span
                                    class="text-danger ms-1">*</span>
                            </label>
                            <select name="job_id" id="job_id_edit" class="form-select">
                                <option value="">Choose Job</option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}"
                                        @if ($job->id == $interview->job_id) selected @endif>
                                        {{ $job->job_name }} ({{ $job->job_id }})
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger small" id="job_id_msg_error"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-calendar-alt text-info me-2"></i>Interview Date<span
                                    class="text-danger ms-1">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker border-start-0 ps-0"
                                    id="edit_interview_date_{{ $interview->id }}"
                                    value="{{ $interview->interview_start_date ? date('d-m-Y', strtotime($interview->interview_start_date)) : '' }}"
                                    name="interview_date" placeholder="Select date">
                            </div>
                            <span class="text-danger small" id="interview_date_msg_error"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>Interview Location<span
                                    class="text-danger ms-1">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control border-start-0 ps-0" id="interview_location"
                                    value="{{ $interview->interview_location ?? '' }}" name="interview_location"
                                    placeholder="Enter location">
                            </div>
                            <span class="text-danger small" id="interview_location_msg_error"></span>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn text-white px-4 fw-semibold shadow-sm flex-grow-1 py-2"
                                style="background: #014d8f;">
                                <i class="fa-solid fa-check me-2"></i>Update
                            </button>
                            <button type="button"
                                class="btn btn-light px-4 fw-semibold shadow-sm flex-grow-1 py-2 close-btn-edit"
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
        $('#edit_interview_date_{{ $interview->id }}').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            minDate: new Date()
        });
    </script>

    <style>
        /* Premium UI Enhancements for Edit Form */
        #offcanvasEdit .offcanvas-header {
            border-radius: 0;
        }

        #offcanvasEdit .form-control:focus,
        #offcanvasEdit .form-select:focus {
            border-color: #014d8f;
            box-shadow: 0 0 0 0.2rem rgba(1, 77, 143, 0.15);
        }

        #offcanvasEdit .input-group-text {
            background-color: #f8f9fa;
        }

        #offcanvasEdit .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        #offcanvasEdit .form-select,
        #offcanvasEdit .form-control {
            height: 38px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }

        #offcanvasEdit .form-label {
            font-size: 14px;
            margin-bottom: 8px;
        }

        #offcanvasEdit .text-danger.small {
            font-size: 12px;
            display: block;
            margin-top: 4px;
        }

        #offcanvasEdit .btn {
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        #offcanvasEdit .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #offcanvasEdit .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
    </style>
@endif
