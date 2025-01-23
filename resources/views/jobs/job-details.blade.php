<div class="table-responsive" id="tableContainer">
    <table class="table" id="candidate-form-job">
        <tbody>
            <tr>
                <td>Date of Interview</td>
                <td>{{ $candidate_job_detail->date_of_interview ?? 'dd-mm-yyyy' }}</td>
                <td>Date of Selection</td>
                <td>{{ $candidate_job_detail->date_of_selection ?? 'dd-mm-yyyy' }}</td>
                <td>Mode of Selection</td>
                <td>{{ $candidate_job_detail->mode_of_selection ?? '' }}</td>
            </tr>
            <tr>
                <td>Service Charge</td>
                <td>{{ $candidate_job_detail->job_service_charge ?? '' }}</td>
                <td>Food Allowance</td>
                <td>{{ $candidate_job_detail->food_allowance ?? '' }}</td>
                <td>Contract Duration (Year)</td>
                <td colspan="3">
                    {{ $candidate_job_detail->contract_duration ? $candidate_job_detail->contract_duration . ' years' : 'N/A' }}
                </td>

            </tr>

            <tr>
                <td>Sponsor</td>
                <td>{{ $candidate_job_detail->sponsor ?? '' }}</td>
                <td>Country</td>
                <td>{{ $candidate_job_detail->country ?? '' }}</td>
                <td>Salary</td>
                @if ($candidate_job_detail->salary != null)
                    <td>{{ $candidate_job_detail->salary ?? 'N/A' }}</td>
                @else
                    <td>{{ $candidate_job_detail->jobTitle->salary ?? 'N/A' }}</td>
                @endif

            </tr>
            <tr>
                <td>Interview Location</td>
                <td colspan="3">{{ $candidate_job_detail->interview_location ?? '' }}</td>
                <td>Company Name</td>
                <td colspan="3">{{ $candidate_job_detail->company->company_name ?? '' }}</td>
            </tr>
            <tr>
                <td>Client Remarks</td>
                <td colspan="3">{{ $candidate_job_detail->client_remarks ?? '' }}</td>
                <td>Other Remarks</td>
                <td colspan="3">{{ $candidate_job_detail->other_remarks ?? '' }}</td>
            </tr>

        </tbody>
    </table>
</div>


<script>
    //job details
    $(document).on("click", '#open-job-input', function(e) {

        $(this).html(``);

        $('#submit-button-job').html(
            `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
        )

        $('#cross-button-job').html(
            `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
        )

        $('#candidate-form-job').html(`<tbody class="candidate-form-new">

            <tr>
                <td>Date of Interview*</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="interview_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->date_of_interview)->format('d-m-Y') ?? '' }}" name="date_of_interview" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>

                <td>Date of Selection</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="selection_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->date_of_selection)->format('d-m-Y') ?? '' }}" name="date_of_selection" placeholder="dd-mm-yyyy">

                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Mode of Selection</td>
                <td>
                    <select name="mode_of_selection" class="form-select uppercase-text" id="" >
                        <option value="">mode of selection</option>
                        <option value="Full Time" {{ $candidate_job_detail->mode_of_selection == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                        <option value="Part Time" {{ $candidate_job_detail->mode_of_selection == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                        <option value="Contract" {{ $candidate_job_detail->mode_of_selection == 'Contract' ? 'selected' : '' }}>Contract</option>
                    </select>

                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
            </tr>
 <tr>
                <td>Service Charge</td>
                <td><input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->job_service_charge ?? '00.00' }}"  placeholder="" readonly>
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Food Allowance</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->food_allowance ?? '' }}" name="food_allowance" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Contract Duration (Year)</td>
                <td colspan="3">
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->contract_duration ?? '' }}" name="contract_duration" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>

            </tr>
            <tr>
                <td>Sponsor</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->sponsor ?? '' }}" name="sponsor" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Country</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->country ?? '' }}" name="country" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Salary*</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->salary ?? '' }}" name="salary" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
            </tr>

             <tr>
                <td>Interview Location</td>
                <td colspan="3">
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->interview_location ?? '' }}" name="interview_location" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Company Name</td>
                <td colspan="3">
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->company->company_name ?? '' }}" name="company_name" placeholder="" disabled>
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
            </tr>
                <tr>
                <td>Client Remarks</td>
                <td colspan="3">
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->client_remarks ?? '' }}" name="client_remarks" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Other Remarks</td>
                <td colspan="3">
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->other_remarks ?? '' }}" name="other_remarks" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
            </tr>
            </tbody>`);



        $('#selection_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->date_of_selection ? \Carbon\Carbon::parse($candidate_job_detail->date_of_selection)->format('d-m-Y') : '' }}"
        });

        $('#interview_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->date_of_interview ? \Carbon\Carbon::parse($candidate_job_detail->date_of_interview)->format('d-m-Y') : '' }}"
        });
    });

    $(document).on("click", '#cross-button-job', function(e) {

        $(this).html(``);
        $('#submit-button-job').html(``)
        $('#open-job-input').html(
            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
        $('#candidate-form-job').html(`<tbody>
                                <tr>
                                    <td>Date of Interview</td>
                                    <td>{{ $candidate_job_detail->date_of_interview ?? 'dd-mm-yyyy' }}</td>
                                    <td>Date of Selection</td>
                                    <td>{{ $candidate_job_detail->date_of_selection ?? 'dd-mm-yyyy' }}</td>
                                    <td>Mode of Selection</td>
                                    <td>{{ $candidate_job_detail->mode_of_selection ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Service Charge</td>
                                    <td>{{ $candidate_job_detail->job_service_charge ?? '' }}</td>
                                    <td>Food Allowance</td>
                                    <td>{{ $candidate_job_detail->food_allowance ?? '' }}</td>
                                    <td>Contract Duration (Year)</td>
                                    <td colspan="3">{{ $candidate_job_detail->contract_duration ?? '' }}</td>

                                </tr>
                                <tr>

                                    <td>Sponsor</td>
                                    <td>{{ $candidate_job_detail->sponsor ?? '' }}</td>
                                    <td>Country</td>
                                    <td>{{ $candidate_job_detail->country ?? '' }}</td>
                                    <td>Salary</td>
                                    <td>{{ $candidate_job_detail->salary ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Interview Location</td>
                                    <td colspan="3">{{ $candidate_job_detail->interview_location ?? '' }}</td>
                                    <td>Company Name</td>
                                    <td colspan="3">{{ $candidate_job_detail->company->company_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Client Remarks</td>
                                    <td colspan="3">{{ $candidate_job_detail->client_remarks ?? '' }}</td>
                                    <td>Other Remarks</td>
                                    <td colspan="3">{{ $candidate_job_detail->other_remarks ?? '' }}</td>
                                </tr>
                            </tbody>`);

    });
</script>
