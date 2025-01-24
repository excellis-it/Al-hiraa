<div class="table-responsive" id="tableContainer">
    <table class="table" id="candidate-form-payment">
        <tbody>
            <tr>
                <td>1st Installment Amount</td>
                <td>{{ $candidate_job_detail->fst_installment_amount ?? '' }}</td>
                <td> Date</td>
                <td>{{ $candidate_job_detail->fst_installment_date ?? 'dd-mm-yyyy' }}</td>
                <td> Remarks</td>
                <td>{{ $candidate_job_detail->fst_installment_remarks ?? '' }}</td>
            </tr>

            <tr>
                <td>2nd Installment Amount</td>
                <td>{{ $candidate_job_detail->secnd_installment_amount ?? '' }}</td>
                <td> Date</td>
                <td>{{ $candidate_job_detail->secnd_installment_date ?? 'dd-mm-yyyy' }}</td>
                <td> Remarks</td>
                <td>{{ $candidate_job_detail->secnd_installment_remarks ?? '' }}</td>
            </tr>

            <tr>
                <td>3rd Installment Amount</td>
                <td>{{ $candidate_job_detail->third_installment_amount ?? '' }}</td>
                <td> Date</td>
                <td>{{ $candidate_job_detail->third_installment_date ?? 'dd-mm-yyyy' }}</td>
                <td> Remarks</td>
                <td>{{ $candidate_job_detail->third_installment_remarks ?? '' }}</td>
            </tr>
            <tr>
                <td>4th Installment Amount</td>
                <td>{{ $candidate_job_detail->fourth_installment_amount ?? '' }}</td>
                <td> Date</td>
                <td>{{ $candidate_job_detail->fourth_installment_date ?? 'dd-mm-yyyy' }}</td>
                <td> Remarks</td>
                <td>{{ $candidate_job_detail->fourth_installment_remarks ?? '' }}</td>
            </tr>
            <tr>
                <td>Discount Amount</td>
                <td>{{ $candidate_job_detail->discount ?? 'N/A' }}</td>
                <td>Total Amount</td>
                <td>{{ $candidate_job_detail->total_amount ?? 'N/A' }}</td>
                <td>Due Amount</td>
                <td>{{ $candidate_job_detail->due_amount ?? 'N/A' }}</td>
                {{-- <td>Deployment Date</td>
                <td>{{ $candidate_job_detail->deployment_date ?? 'N/A' }}</td> --}}
                {{-- <td>Job Status</td>
                <td colspan="3">{{ $candidate_job_detail->job_status ?? 'N/A' }}</td> --}}
            </tr>
        </tbody>
    </table>
</div>


<script>
    $(document).on("click", '#open-payment-input', function(e) {

        $(this).html(``);

        $('#submit-button-payment').html(
            `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
        )

        $('#cross-button-payment').html(
            `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
        )

        $('#candidate-form-payment').html(`<tbody class="candidate-form-new">

            <tr>
            <td>1st Installment Amount*</td>
            <td>
                  <input type="hidden" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->job_service_charge ?? '' }}" name="job_service_charge" placeholder="">
                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->fst_installment_amount ?? '' }}" name="fst_installment_amount" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
            <td> Date</td>
            <td class="date-btn">
                <input type="text" class="form-control uppercase-text datepicker" id="instl1_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->fst_installment_date)->format('d-m-Y') ?? '' }}" name="fst_installment_date" placeholder="dd-mm-yyyy">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
            <td> Remarks*</td>
            <td>
                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->fst_installment_remarks ?? '' }}" name="fst_installment_remarks" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>

        </tr>
        <tr>
            <td>2nd Installment Amount</td>
            <td class="date-btn">
                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->secnd_installment_amount ?? '' }}" name="secnd_installment_amount" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
            <td> Date</td>
            <td class="date-btn">
                <input type="text" class="form-control uppercase-text datepicker" id="instl2_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->secnd_installment_date)->format('d-m-Y') ?? '' }}" name="secnd_installment_date" placeholder="dd-mm-yyyy">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>

            <td> Remarks</td>
            <td class="date-btn">
                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->secnd_installment_remarks ?? '' }}" name="secnd_installment_remarks" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
        </tr>
        <tr>
            <td>3rd Installment Amount</td>
            <td>
                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->third_installment_amount ?? '' }}" name="third_installment_amount" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
            <td> Date</td>
            <td class="date-btn">
                <input type="text" class="form-control uppercase-text datepicker" id="instl3_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->third_installment_date)->format('d-m-Y') ?? '' }}" name="third_installment_date" placeholder="dd-mm-yyyy">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>

            <td> Remarks</td>
            <td>
                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->third_installment_remarks ?? '' }}" name="third_installment_remarks" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>

        </tr>
        <tr>
            <td>4th Installment Amount</td>
            <td>
                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->fourth_installment_amount ?? '' }}" name="fourth_installment_amount" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
            <td> Date</td>
            <td class="date-btn">
                <input type="text" class="form-control uppercase-text datepicker" id="instl4_date" value="{{ \Carbon\Carbon::parse($candidate_job_detail->fourth_installment_date)->format('d-m-Y') ?? '' }}" name="fourth_installment_date" placeholder="dd-mm-yyyy">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
            <td> Remarks</td>
            <td>
                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->fourth_installment_remarks ?? '' }}" name="fourth_installment_remarks" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
        </tr>
        <tr>
            <td>Discount Amount</td>
            <td>
                <input type="text" class="form-control uppercase-text" id=""  value="{{ $candidate_job_detail->discount ?? '' }}" name="discount" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
            <td>Total Amount</td>
            <td>
                <input type="text" class="form-control uppercase-text" id="" readonly value="{{ $candidate_job_detail->total_amount ?? '' }}" name="total_amount" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>
            <td>Due Amount</td>
            <td>
                <input type="text" class="form-control uppercase-text" id="" readonly value="{{ $candidate_job_detail->due_amount ?? '' }}" name="due_amount" placeholder="">
                <span class="text-danger" id="interview_id_job_msg"></span>
            </td>

        </tr>
    </tbody>`)

        // <td>Job Status</td>

        //         <td colspan="3">
        //             <select name="job_status" class="form-select uppercase-text" id="">
        //                 <option value="">Select Job Status</option>
        //                 <option value="Active" {{ $candidate_job_detail->job_status == 'Active' ? 'selected' : '' }}> Active </option>
        //                 <option value="Deactive" {{ $candidate_job_detail->job_status == 'Deactive' ? 'selected' : '' }}>Deactive</option>
        //             </select>
        //         </td>


        $('#instl1_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->fst_installment_date ? \Carbon\Carbon::parse($candidate_job_detail->fst_installment_date)->format('d-m-Y') : date('d-m-Y') }}"
        });
        // second installment default date is 30 days after now date
        $('#instl2_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->secnd_installment_date ? \Carbon\Carbon::parse($candidate_job_detail->secnd_installment_date)->format('d-m-Y') : date('d-m-Y', strtotime('+30 days')) }}"
        });
        // third installment default date is 60 days after now date
        $('#instl3_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->third_installment_date ? \Carbon\Carbon::parse($candidate_job_detail->third_installment_date)->format('d-m-Y') : date('d-m-Y', strtotime('+60 days')) }}"
        });
        // fourth installment default date is 90 days after now date
        $('#instl4_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            value: "{{ $candidate_job_detail->fourth_installment_date ? \Carbon\Carbon::parse($candidate_job_detail->fourth_installment_date)->format('d-m-Y') : date('d-m-Y', strtotime('+90 days')) }}"
        });
    });

    $(document).on("click", '#cross-button-payment', function(e) {

        $(this).html(``);
        $('#submit-button-payment').html(``)
        $('#open-payment-input').html(
            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
        $('#candidate-form-payment').html(`<tbody>
                       <tr>
                <td>1st Installment Amount</td>
                <td>{{ $candidate_job_detail->fst_installment_amount ?? '' }}</td>
                <td> Date</td>
                <td>{{ $candidate_job_detail->fst_installment_date ?? 'dd-mm-yyyy' }}</td>
                <td> Remarks</td>
                <td>{{ $candidate_job_detail->fst_installment_remarks ?? '' }}</td>
            </tr>

            <tr>
                <td>2nd Installment Amount</td>
                <td>{{ $candidate_job_detail->secnd_installment_amount ?? '' }}</td>
                <td> Date</td>
                <td>{{ $candidate_job_detail->secnd_installment_date ?? 'dd-mm-yyyy' }}</td>
                <td> Remarks</td>
                <td>{{ $candidate_job_detail->secnd_installment_remarks ?? '' }}</td>
            </tr>

            <tr>
                <td>3rd Installment Amount</td>
                <td>{{ $candidate_job_detail->third_installment_amount ?? '' }}</td>
                <td> Date</td>
                <td>{{ $candidate_job_detail->third_installment_date ?? 'dd-mm-yyyy' }}</td>
                <td> Remarks</td>
                <td>{{ $candidate_job_detail->third_installment_remarks ?? '' }}</td>
            </tr>
            <tr>
                <td>4th Installment Amount</td>
                <td>{{ $candidate_job_detail->fourth_installment_amount ?? '' }}</td>
                <td> Date</td>
                <td>{{ $candidate_job_detail->fourth_installment_date ?? 'dd-mm-yyyy' }}</td>
                <td> Remarks</td>
                <td>{{ $candidate_job_detail->fourth_installment_remarks ?? '' }}</td>
            </tr>
            <tr>
                <td>Discount Amount</td>
                <td>{{ $candidate_job_detail->discount ?? 'N/A' }}</td>
                <td>Total Amount</td>
                <td>{{ $candidate_job_detail->total_amount ?? 'N/A' }}</td>
                <td>Due Amount</td>
                <td>{{ $candidate_job_detail->due_amount ?? 'N/A' }}</td>
                {{-- <td>Deployment Date</td>
                <td>{{ $candidate_job_detail->deployment_date ?? 'N/A' }}</td> --}}
                {{-- <td>Job Status</td>
                <td colspan="3">{{ $candidate_job_detail->job_status ?? 'N/A' }}</td> --}}
            </tr>
                    </tbody>`);
    });
</script>
