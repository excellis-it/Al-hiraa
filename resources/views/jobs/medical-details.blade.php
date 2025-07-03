<div class="table-responsive" id="tableContainer">
    <table class="table" id="candidate-form-medical">
        <tbody>
            <tr>
                <td>Medical Approval Date</td>
                <td>{{ $candidate_job_detail->medical_approval_date ?? 'dd-mm-yyyy' }}</td>
                <td>Medical Application Date</td>
                <td>{{ $candidate_job_detail->medical_application_date ?? 'dd-mm-yyyy' }}</td>

                <td>Medical Completion Date</td>
                <td>{{ $candidate_job_detail->medical_completion_date ?? 'dd-mm-yyyy' }}</td>


            </tr>
            <tr>
                <td>Medical Expiry Date</td>
                <td>{{ $candidate_job_detail->medical_expiry_date ?? 'dd-mm-yyyy' }}</td>
                <td>Medical Status</td>
                <td>{{ $candidate_job_detail->medical_status ?? '' }}

                    <select name="medical_status" class="form-select uppercase-text medical_status" hidden>
                        <option value="">SELECT A STATUS</option>
                        <option value="FIT" {{ $candidate_job_detail->medical_status == 'FIT' ? 'selected' : '' }}>FIT
                        </option>
                        <option value="UNFIT" {{ $candidate_job_detail->medical_status == 'UNFIT' ? 'selected' : '' }}>
                            UNFIT</option>
                            <option value="BACKOUT" {{ $candidate_job_detail->medical_status == 'BACKOUT' ? 'selected' : '' }}>
                                BACKOUT</option>
                        <option value="REPEAT" {{ $candidate_job_detail->medical_status == 'REPEAT' ? 'selected' : '' }}>
                            REPEAT</option>
                            <option value="PENDING" {{ $candidate_job_detail->medical_status == 'PENDING' ? 'selected' : '' }}>
                                PENDING</option>
                    </select>
                </td>

                @if ($candidate_job_detail->medical_status == 'REPEAT')
                    <td colspan="" class="">Repeat Date</td>
                    <td colspan="" class="">
                        {{ $candidate_job_detail->medical_repeat_date ?? 'dd-mm-yyyy' }}
                    </td>
                @endif
                <td colspan="4"></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    // medical deatils
    $(document).ready(function() {
        $(document).on("click", '#open-medical-input', function(e) {
            // Initial check on page load

            $(this).html(``);

            $('#submit-button-medical').html(
                `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
            )

            $('#cross-button-medical').html(
                `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
            )


            $('#candidate-form-medical').html(`<tbody class="candidate-form-new">

            <tr>
                  <td>Medical Approval Date*</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="med_date110" value="{{ \Carbon\Carbon::parse($candidate_job_detail->medical_approval_date)->format('d-m-Y') ?? '' }}" name="medical_approval_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Medical Application Date</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="med_date1" value="{{ \Carbon\Carbon::parse($candidate_job_detail->medical_application_date)->format('d-m-Y') ?? '' }}" name="medical_application_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>

                <td>Medical Completion Date</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="med_date2" value="{{ \Carbon\Carbon::parse($candidate_job_detail->medical_completion_date)->format('d-m-Y') ?? '' }}" name="medical_completion_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>

                </tr>
                <tr>
                     <td>Medical Expiry Date</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="med_date4" value="{{ \Carbon\Carbon::parse($candidate_job_detail->medical_expiry_date)->format('d-m-Y') ?? '' }}" name="medical_expiry_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Medical Status</td>
                <td>
                    <select name="medical_status" class="form-select uppercase-text medical_status" id="medical_status">
                        <option value="">SELECT A STATUS</option>
                            <option value="FIT" {{ $candidate_job_detail->medical_status == 'FIT' ? 'selected' : '' }}>FIT</option>
                            <option value="UNFIT" {{ $candidate_job_detail->medical_status == 'UNFIT' ? 'selected' : '' }}>UNFIT</option>
                             <option value="BACKOUT" {{ $candidate_job_detail->medical_status == 'BACKOUT' ? 'selected' : '' }}>BACKOUT</option>
                            <option value="REPEAT" {{ $candidate_job_detail->medical_status == 'REPEAT' ? 'selected' : '' }}>REPEAT</option>
                            <option value="PENDING" {{ $candidate_job_detail->medical_status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                            </select>
                </td>
                @if ($candidate_job_detail->medical_status == 'REPEAT')
                <td class="repeat-date-row">Repeat Date</td>
                <td class="repeat-date-row">
                    <input type="text" class="form-control uppercase-text datepicker" id="med_date3" value="{{ \Carbon\Carbon::parse($candidate_job_detail->medical_repeat_date)->format('d-m-Y') ?? '' }}" name="medical_repeat_date" placeholder="dd-mm-yyyy">
                </td>
                @else
                <td class="repeat-date-row" style="display:none;">Repeat Date</td>
                <td class="repeat-date-row" style="display:none;">
                    <input type="text" class="form-control uppercase-text datepicker" id="med_date3" value="" name="medical_repeat_date" placeholder="">
                    </td>

                @endif

            </tr>

            </tbody>`);
            $('#med_date1').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy',
                value: "{{ $candidate_job_detail->medical_application_date ? \Carbon\Carbon::parse($candidate_job_detail->medical_application_date)->format('d-m-Y') : '' }}"
            });
            $('#med_date110').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy',
                value: "{{ $candidate_job_detail->medical_approval_date ? \Carbon\Carbon::parse($candidate_job_detail->medical_approval_date)->format('d-m-Y') : '' }}"
            });

            @if ($candidate_job_detail->medical_status == 'REPEAT')
                $('#med_date3').datepicker({
                    uiLibrary: 'bootstrap5',
                    format: 'dd-mm-yyyy',
                    value: "{{ $candidate_job_detail->medical_repeat_date ? \Carbon\Carbon::parse($candidate_job_detail->medical_repeat_date)->format('d-m-Y') : '' }}"
                });
            @else
                $('#med_date3').datepicker({
                    uiLibrary: 'bootstrap5',
                    format: 'dd-mm-yyyy',
                    value: ""
                });
            @endif
            $('#med_date2').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy',
                value: "{{ $candidate_job_detail->medical_completion_date ? \Carbon\Carbon::parse($candidate_job_detail->medical_completion_date)->format('d-m-Y') : '' }}"
            });
            $('#med_date4').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy',
                value: "{{ $candidate_job_detail->medical_expiry_date ? \Carbon\Carbon::parse($candidate_job_detail->medical_expiry_date)->format('d-m-Y') : '' }}"
            });
        });

        function toggleRepeatDateField() {
            var selectedStatus = $('#medical_status').val();

            if (selectedStatus === 'REPEAT') {
                $('.repeat-date-row').show();
            } else {
                $('.repeat-date-row').hide();
            }
        }



        // Toggle field on dropdown change
        $(document).on('change', '#medical_status', function() {
            // alert('selectedStatus');
            toggleRepeatDateField();
        });

        $(document).on("click", '#cross-button-medical', function(e) {

            $(this).html(``);
            $('#submit-button-medical').html(``);
            $('#open-medical-input').html(
                ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
            $('#candidate-form-medical').html(`<tbody>
            <tr>
                <td>Medical Approval Date</td>
                <td>{{ $candidate_job_detail->medical_approval_date ?? 'dd-mm-yyyy' }}</td>
                <td>Medical Application Date</td>
                <td>{{ $candidate_job_detail->medical_application_date ?? 'dd-mm-yyyy' }}</td>

                <td>Medical Completion Date</td>
                <td>{{ $candidate_job_detail->medical_completion_date ?? 'dd-mm-yyyy' }}</td>


            </tr>
            <tr>
                <td>Medical Expiry Date</td>
                <td>{{ $candidate_job_detail->medical_expiry_date ?? 'dd-mm-yyyy' }}</td>
                <td>Medical Status</td>
                <td>{{ $candidate_job_detail->medical_status ?? '' }}

                    <select name="medical_status" class="form-select uppercase-text medical_status" hidden>
                            <option value="">SELECT A STATUS</option>
                                <option value="FIT" {{ $candidate_job_detail->medical_status == 'FIT' ? 'selected' : '' }}>FIT</option>
                                <option value="UNFIT" {{ $candidate_job_detail->medical_status == 'UNFIT' ? 'selected' : '' }}>UNFIT</option>
                                 <option value="BACKOUT" {{ $candidate_job_detail->medical_status == 'BACKOUT' ? 'selected' : '' }}>BACKOUT</option>
                                <option value="REPEAT" {{ $candidate_job_detail->medical_status == 'REPEAT' ? 'selected' : '' }}>REPEAT</option>
                                <option value="PENDING" {{ $candidate_job_detail->medical_status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                </select></td>

                @if ($candidate_job_detail->medical_status == 'REPEAT')
                    <td colspan="" class="">Repeat Date</td>
                    <td colspan="" class="">
                        {{ $candidate_job_detail->medical_repeat_date ?? 'dd-mm-yyyy' }}
                    </td>
                @endif
                <td colspan="4"></td>
            </tr>
        </tbody>`);
        });
    });
</script>
