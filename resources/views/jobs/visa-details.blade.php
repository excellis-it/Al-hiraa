<div class="table-responsive" id="tableContainer">
    <table class="table" id="candidate-form-visa">
        <tbody>
            <tr>
                <td>Visa Receiving Date</td>
                <td>{{ $candidate_job_detail->visa_receiving_date ?? 'dd-mm-yyyy' }}</td>
                <td>Visa Issue Date</td>
                <td>{{ $candidate_job_detail->visa_issue_date ?? 'dd-mm-yyyy' }}</td>
                <td>Visa Expiry Date</td>
                <td>{{ $candidate_job_detail->visa_expiry_date ?? 'dd-mm-yyyy' }}</td>
            </tr>
            <tr>
                <td>Mofa No</td>
                <td>{{ $candidate_job_detail->mofa_no ?? '' }}</td>
                <td>Mofa Applied Date</td>
                <td>{{ $candidate_job_detail->mofa_date ?? 'dd-mm-yyyy' }}</td>
                <td> Mofa Received Date</td>
                <td>{{ $candidate_job_detail->mofa_received_date ?? 'dd-mm-yyyy' }}</td>
            </tr>
            <tr>
                <td>VFS Applied Date</td>
                <td>{{ $candidate_job_detail->vfs_applied_date ?? 'dd-mm-yyyy' }}</td>
                <td>VFS Received Date</td>
                <td>{{ $candidate_job_detail->vfs_received_date ?? 'dd-mm-yyyy' }}</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    // visa deatils
    $(document).on("click", '#open-visa-input', function(e) {

        $(this).html(``);

        $('#submit-button-visa').html(
            `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
        )

        $('#cross-button-visa').html(
            `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
        )

        $('#candidate-form-visa').html(`<tbody class="candidate-form-new">

            <tr>
                <td>Visa Receiving Date*</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="visa_rec_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->visa_receiving_date)->format('d-m-Y') ?? '' }}" name="visa_receiving_date" placeholder="dd-mm-yyyy">

                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Visa Issue Date</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="visa_issu_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->visa_issue_date)->format('d-m-Y') ?? '' }}" name="visa_issue_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Visa Expiry Date</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="visa_expiry_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->visa_expiry_date)->format('d-m-Y') ?? '' }}" name="visa_expiry_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
            </tr>
  <tr>
                <td>Mofa No</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->mofa_no ?? '' }}" name="mofa_no" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Mofa Applied Date</td>
                <td  class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="mofa_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->mofa_date)->format('d-m-Y') ?? '' }}" name="mofa_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td> Mofa Received Date</td>
                <td  class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="mofa_received_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->mofa_received_date)->format('d-m-Y') ?? '' }}" name="mofa_received_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
            </tr>
            <tr>
                <td>VFS Applied Date</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="vfs_applied_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->vfs_applied_date)->format('d-m-Y') ?? '' }}" name="vfs_applied_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>VFS Received Date</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="vfs_received_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->vfs_received_date)->format('d-m-Y') ?? '' }}" name="vfs_received_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td colspan="2"></td>
            </tr>
            </tbody>`);

        $('#visa_rec_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->visa_receiving_date ? \Carbon\Carbon::parse($candidate_job_detail->visa_receiving_date)->format('d-m-Y') : '' }}"
        });

        $('#mofa_received_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->mofa_received_date ? \Carbon\Carbon::parse($candidate_job_detail->mofa_received_date)->format('d-m-Y') : '' }}"
        });

        $('#vfs_applied_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->vfs_applied_date ? \Carbon\Carbon::parse($candidate_job_detail->vfs_applied_date)->format('d-m-Y') : '' }}"
        });

        $('#vfs_received_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->vfs_received_date ? \Carbon\Carbon::parse($candidate_job_detail->vfs_received_date)->format('d-m-Y') : '' }}"
        });

        $('#mofa_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->mofa_date ? \Carbon\Carbon::parse($candidate_job_detail->mofa_date)->format('d-m-Y') : '' }}"
        });

        $('#visa_issu_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->visa_issue_date ? \Carbon\Carbon::parse($candidate_job_detail->visa_issue_date)->format('d-m-Y') : '' }}"
        });

        $('#visa_expiry_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->visa_expiry_date ? \Carbon\Carbon::parse($candidate_job_detail->visa_expiry_date)->format('d-m-Y') : '' }}"
        });
    });

    $(document).on("click", '#cross-button-visa', function(e) {

        $(this).html(``);
        $('#submit-button-visa').html(``);
        $('#open-visa-input').html(
            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
        $('#candidate-form-visa').html(`<tbody>
                <tr>
                    <td>Visa Receiving Date</td>
                    <td>{{ $candidate_job_detail->visa_receiving_date ?? 'dd-mm-yyyy' }}</td>
                    <td>Visa Issue Date</td>
                    <td>{{ $candidate_job_detail->visa_issue_date ?? 'dd-mm-yyyy' }}</td>
                    <td>Visa Expiry Date</td>
                    <td>{{ $candidate_job_detail->visa_expiry_date ?? 'dd-mm-yyyy' }}</td>
                </tr>
            </tbody>`);
    });
</script>
