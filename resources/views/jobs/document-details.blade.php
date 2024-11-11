<div class="table-responsive" id="tableContainer">
    <table class="table" id="candidate-form-document">
        <tbody>
            <tr>
                <td> Courier Sent Date</td>
                <td>{{ $candidate_job_detail->courrier_sent_date ?? 'dd-mm-yyyy' }}</td>
                <td> Courier Received Date</td>
                <td>{{ $candidate_job_detail->courrier_received_date ?? 'dd-mm-yyyy' }}</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
</div>


<script>
    // Ticket deatils
    $(document).on("click", '#open-document-input', function(e) {

        $(this).html(``);

        $('#submit-button-document').html(
            `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
        )

        $('#cross-button-document').html(
            `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
        )

        $('#candidate-form-document').html(`<tbody class="candidate-form-new">

            <tr>
                <td>Courier Sent Date*</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="courier_sent_dt" value="{{ \Carbon\Carbon::parse($candidate_job_detail->courrier_sent_date)->format('d-m-Y') ?? '' }}" name="courrier_sent_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Courier Received Date</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="courier_recieve_dt" value="{{ \Carbon\Carbon::parse($candidate_job_detail->courrier_received_date)->format('d-m-Y') ?? '' }}" name="courrier_received_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td colspan="2"></td>

            </tr>

            </tbody>`)

        $('#courier_recieve_dt').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->courrier_received_date ? \Carbon\Carbon::parse($candidate_job_detail->courrier_received_date)->format('d-m-Y') : '' }}"
        });

        $('#courier_sent_dt').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->courrier_sent_date ? \Carbon\Carbon::parse($candidate_job_detail->courrier_sent_date)->format('d-m-Y') : '' }}"
        });

    });

    $(document).on("click", '#cross-button-document', function(e) {

        $(this).html(``);
        $('#submit-button-document').html(``)
        $('#open-document-input').html(
            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
        $('#candidate-form-document').html(`<tbody>
                <tr>
                    <td> Courier Sent Date</td>
                <td>{{ $candidate_job_detail->courrier_sent_date ?? 'dd-mm-yyyy' }}</td>
                <td> Courier Received Date</td>
                <td>{{ $candidate_job_detail->courrier_received_date ?? 'dd-mm-yyyy' }}</td>
                <td colspan="2"></td>
                </tr>
            </tbody>`);
    });
</script>
