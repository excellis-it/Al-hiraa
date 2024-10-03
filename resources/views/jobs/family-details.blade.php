<div class="table-responsive" id="tableContainer">
    <table class="table" id="candidate-form-family">
        <tbody>
            <tr>
                <td>Family Contact Name</td>
                <td>{{ $candidate_job_detail->family_contact_name ?? 'N/A' }}</td>
                <td>Family Contact No</td>
                <td>{{ $candidate_job_detail->family_contact_no ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    // family deatils
    $(document).on("click", '#open-family-input', function(e) {

        $(this).html(``);

        $('#submit-button-family').html(
            `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
        )

        $('#cross-button-family').html(
            `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
        )


        $('#candidate-form-family').html(`<tbody class="candidate-form-new">

            <tr>
                <td>Family Contact Name</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->family_contact_name ?? '' }}" name="family_contact_name" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
                <td>Family Contact No</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->family_contact_no ?? '' }}" name="family_contact_no" placeholder="">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                </td>
            </tr>

            </tbody>`);
    });

    $(document).on("click", '#cross-button-family', function(e) {

        $(this).html(``);
        $('#submit-button-family').html(``)
        $('#open-family-input').html(
            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
        $('#candidate-form-family').html(`<tbody>
            <tr>
                <td>Family Contact Name</td>
                <td>{{ $candidate_job_detail->family_contact_name ?? '' }}</td>
                <td>Family Contact No</td>
                <td>{{ $candidate_job_detail->family_contact_no ?? '' }}</td>
            </tr>
        </tbody>`);
    });
</script>
