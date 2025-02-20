<div class="table-responsive" id="tableContainer">
    <table class="table" id="candidate-form-ticket">
        <tbody>
            <tr>
                <td>Flight Booking Date</td>
                <td>{{ $candidate_job_detail->ticket_booking_date ?? 'dd-mm-yyyy' }}</td>
                <td>Flight Confirmation Date</td>
                <td>{{ $candidate_job_detail->ticket_confirmation_date ?? 'dd-mm-yyyy' }}</td>
                <td>On Boarding Flight City</td>
                <td>{{ $candidate_job_detail->onboarding_flight_city ?? 'N/A' }}</td>

            </tr>
            <tr>
                <td>Deployment Date</td>
                <td colspan="5">{{ $candidate_job_detail->deployment_date ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
</div>


<script>
    // Flight deatils
    $(document).on("click", '#open-ticket-input', function(e) {

        $(this).html(``);

        $('#submit-button-ticket').html(
            `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
        )

        $('#cross-button-ticket').html(
            `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
        )

        $('#candidate-form-ticket').html(`<tbody class="candidate-form-new">

            <tr>
                <td>Flight Booking Date*</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="tickt_booking_dt" value="{{ \Carbon\Carbon::parse($candidate_job_detail->ticket_booking_date)->format('d-m-Y') ?? '' }}" name="ticket_booking_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Flight Confirmation Date</td>
                <td class="date-btn">
                    <input type="text" class="form-control uppercase-text datepicker" id="ticket_confirm_dt" value="{{ \Carbon\Carbon::parse($candidate_job_detail->ticket_confirmation_date)->format('d-m-Y') ?? '' }}" name="ticket_confirmation_date" placeholder="dd-mm-yyyy">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>On Boarding Flight City</td>
                <td class="text-btn">
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->onboarding_flight_city ?? '' }}" name="onboarding_flight_city" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>

            </tr>
            <tr>
             <td>Deployment Date</td>
            <td class="date-btn" colspan="5">
                <input type="text" class="form-control uppercase-text datepicker" id="deploy-date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->deployment_date)->format('d-m-Y') ?? '' }}" name="deployment_date" placeholder="dd-mm-yyyy">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
            </tr>
            </tbody>`)

        $('#deploy-date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->deployment_date ? \Carbon\Carbon::parse($candidate_job_detail->deployment_date)->format('d-m-Y') : '' }}"
        });

        $('#ticket_confirm_dt').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->ticket_confirmation_date ? \Carbon\Carbon::parse($candidate_job_detail->ticket_confirmation_date)->format('d-m-Y') : '' }}"
        });

        $('#tickt_booking_dt').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->ticket_booking_date ? \Carbon\Carbon::parse($candidate_job_detail->ticket_booking_date)->format('d-m-Y') : '' }}"
        });


    });

    $(document).on("click", '#cross-button-ticket', function(e) {

        $(this).html(``);
        $('#submit-button-ticket').html(``)
        $('#open-ticket-input').html(
            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
        $('#candidate-form-ticket').html(`<tbody>
                <tr>
                    <td>Flight Booking Date</td>
                    <td>{{ $candidate_job_detail->ticket_booking_date ?? 'dd-mm-yyyy' }}</td>
                    <td>Flight Confirmation Date</td>
                    <td>{{ $candidate_job_detail->ticket_confirmation_date ?? 'dd-mm-yyyy' }}</td>
                    <td>On Boarding Flight City</td>
                    <td>{{ $candidate_job_detail->onboarding_flight_city ?? 'N/A' }}</td>

                </tr>
                  <tr>
                <td>Deployment Date</td>
                <td colspan="5">{{ $candidate_job_detail->deployment_date ?? 'N/A' }}</td>
            </tr>
            </tbody>`);
    });
</script>
