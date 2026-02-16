{{-- Hidden template for edit mode --}}
<div id="job-edit-template" style="display:none;">
    <table>
        <tbody class="candidate-form-new">
            <tr>
                <td>Date of Interview</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text interview_date" id="interview_date"
                        value="{{ $candidate_job_detail->date_of_interview ? \Carbon\Carbon::parse($candidate_job_detail->date_of_interview)->format('d-m-Y') : '' }}"
                        name="date_of_interview" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_date_msg"></span>
                </td>

                <td>Date of Selection</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text selection_date" id="selection_date"
                        value="{{ $candidate_job_detail->date_of_selection ? \Carbon\Carbon::parse($candidate_job_detail->date_of_selection)->format('d-m-Y') : '' }}"
                        name="date_of_selection" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="selection_date_msg"></span>
                </td>
                <td>Mode of Selection</td>
                <td>
                    <select name="mode_of_selection" class="form-select uppercase-text" id="">
                        <option value="">Select Mode</option>
                        <option value="FACE TO FACE"
                            {{ $candidate_job_detail->mode_of_selection == 'FACE TO FACE' ? 'selected' : '' }}>FACE TO
                            FACE</option>
                        <option value="ONLINE"
                            {{ $candidate_job_detail->mode_of_selection == 'ONLINE' ? 'selected' : '' }}>ONLINE</option>
                        <option value="DIRECT"
                            {{ $candidate_job_detail->mode_of_selection == 'DIRECT' ? 'selected' : '' }}>DIRECT</option>
                    </select>
                    <span class="text-danger" id="mode_of_selection_msg"></span>
                </td>
            </tr>
            <tr>
                <td>Service Charge</td>
                <td><input type="text" class="form-control uppercase-text" id=""
                        value="{{ $candidate_job_detail->job_service_charge ?? '0.00' }}" placeholder="">
                </td>
                <td>Company</td>
                <td>
                    <select name="" class="form-select uppercase-text" id="" disabled
                        style="background-color: #e9ecef;">
                        <option value="">Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ $candidate_job_detail->company_id == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="company_id" value="{{ $candidate_job_detail->company_id }}">
                </td>
                <td>Sponsor</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id=""
                        value="{{ $candidate_job_detail->sponsor ?? '' }}" name="sponsor" placeholder="">
                </td>
            </tr>
            <tr>
                <td>Job Title</td>
                <td>
                    <select name="" class="form-select uppercase-text" id="" disabled
                        style="background-color: #e9ecef;">
                        <option value="">Select Job Title</option>
                        @foreach ($jobs as $job)
                            <option value="{{ $job->id }}"
                                {{ $candidate_job_detail->job_id == $job->id ? 'selected' : '' }}>
                                {{ $job->job_name }} ({{ $job->job_id ?? '-' }})</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="job_id" value="{{ $candidate_job_detail->job_id }}">
                </td>
                <td>Salary</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id=""
                        value="{{ $candidate_job_detail->salary ?? '' }}" name="salary" placeholder="">
                </td>
                <td>Food Allowance</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id=""
                        value="{{ $candidate_job_detail->food_allowance ?? '' }}" name="food_allowance" placeholder="">
                </td>
            </tr>
            <tr>
                <td>Country</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id=""
                        value="{{ $candidate_job_detail->country ?? '' }}" name="country" placeholder="">
                </td>
                <td>Contract Duration (Year)</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id=""
                        value="{{ $candidate_job_detail->contract_duration ?? '' }}" name="contract_duration"
                        placeholder="">
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Client Remarks</td>
                <td colspan="2">
                    <input type="text" class="form-control uppercase-text" id=""
                        value="{{ $candidate_job_detail->client_remarks ?? '' }}" name="client_remarks" placeholder="">
                </td>
                <td>Other Remarks</td>
                <td colspan="2">
                    <input type="text" class="form-control uppercase-text" id=""
                        value="{{ $candidate_job_detail->other_remarks ?? '' }}" name="other_remarks" placeholder="">
                </td>
            </tr>
        </tbody>
    </table>
</div>

{{-- Hidden template for view mode --}}
<div id="job-view-template" style="display:none;">
    <table>
        <tbody>
            <tr>
                <td>Date of Interview</td>
                <td>{{ $candidate_job_detail->date_of_interview ?? 'N/A' }}</td>
                <td>Date of Selection</td>
                <td>{{ $candidate_job_detail->date_of_selection ?? 'N/A' }}</td>
                <td>Mode of Selection</td>
                <td>{{ $candidate_job_detail->mode_of_selection ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Service Charge</td>
                <td>{{ $candidate_job_detail->job_service_charge ?? 'N/A' }}</td>
                <td>Company</td>
                <td>{{ $candidate_job_detail->company->company_name ?? 'N/A' }}</td>
                <td>Sponsor</td>
                <td>{{ $candidate_job_detail->sponsor ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Job Title</td>
                <td>
                    @if ($candidate_job_detail->jobTitle != null)
                        {{ $candidate_job_detail->jobTitle->job_name ?? 'N/A' }}
                        ({{ $candidate_job_detail->jobTitle->job_id ?? '-' }})
                    @else
                        N/A
                    @endif
                </td>
                <td>Salary</td>
                <td>
                    @if ($candidate_job_detail->salary != null)
                        {{ $candidate_job_detail->salary }}
                    @else
                        {{ $candidate_job_detail->jobTitle->salary ?? 'N/A' }}
                    @endif
                </td>
                <td>Food Allowance</td>
                <td>{{ $candidate_job_detail->food_allowance ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Country</td>
                <td>{{ $candidate_job_detail->country ?? 'N/A' }}</td>
                <td>Contract Duration (Year)</td>
                <td>{{ $candidate_job_detail->contract_duration ? $candidate_job_detail->contract_duration . ' years' : 'N/A' }}
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Client Remarks</td>
                <td colspan="2">{{ $candidate_job_detail->client_remarks ?? 'N/A' }}</td>
                <td>Other Remarks</td>
                <td colspan="2">{{ $candidate_job_detail->other_remarks ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
</div>

{{-- Visible table container --}}
<div class="table-responsive" id="tableContainerJob">
    <table class="table" id="candidate-form-job">
        <tbody>
            <tr>
                <td>Date of Interview</td>
                <td>{{ $candidate_job_detail->date_of_interview ?? 'N/A' }}</td>
                <td>Date of Selection</td>
                <td>{{ $candidate_job_detail->date_of_selection ?? 'N/A' }}</td>
                <td>Mode of Selection</td>
                <td>{{ $candidate_job_detail->mode_of_selection ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Service Charge</td>
                <td>{{ $candidate_job_detail->job_service_charge ?? 'N/A' }}</td>
                <td>Company</td>
                <td>{{ $candidate_job_detail->company->company_name ?? 'N/A' }}</td>
                <td>Sponsor</td>
                <td>{{ $candidate_job_detail->sponsor ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Job Title</td>
                <td>
                    @if ($candidate_job_detail->jobTitle != null)
                        {{ $candidate_job_detail->jobTitle->job_name ?? 'N/A' }}
                        ({{ $candidate_job_detail->jobTitle->job_id ?? '-' }})
                    @else
                        N/A
                    @endif
                </td>
                <td>Salary</td>
                <td>
                    @if ($candidate_job_detail->salary != null)
                        {{ $candidate_job_detail->salary }}
                    @else
                        {{ $candidate_job_detail->jobTitle->salary ?? 'N/A' }}
                    @endif
                </td>
                <td>Food Allowance</td>
                <td>{{ $candidate_job_detail->food_allowance ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Country</td>
                <td>{{ $candidate_job_detail->country ?? 'N/A' }}</td>
                <td>Contract Duration (Year)</td>
                <td>{{ $candidate_job_detail->contract_duration ? $candidate_job_detail->contract_duration . ' years' : 'N/A' }}
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Client Remarks</td>
                <td colspan="2">{{ $candidate_job_detail->client_remarks ?? 'N/A' }}</td>
                <td>Other Remarks</td>
                <td colspan="2">{{ $candidate_job_detail->other_remarks ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    //job details
    $(document).off("click", '#open-job-input').on("click", '#open-job-input', function(e) {

        $(this).html('');

        $('#submit-button-job').html(
            '<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>'
        );

        $('#cross-button-job').html(
            '<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>'
        );

        // Get edit form HTML from hidden template
        var editHtml = $('#job-edit-template').find('tbody').parent().html();
        $('#candidate-form-job').html(editHtml);

        // Initialize datepickers (after elements exist in DOM)
        $('#candidate-form-job .selection_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy'
        });

        $('#candidate-form-job .interview_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy'
        });

    });

    $(document).off("click", '#cross-button-job').on("click", '#cross-button-job', function(e) {

        $(this).html('');
        $('#submit-button-job').html('');
        $('#open-job-input').html(
            '<a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>');

        // Get view mode HTML from hidden template
        var viewHtml = $('#job-view-template').find('tbody').parent().html();
        $('#candidate-form-job').html(viewHtml);

    });
</script>
