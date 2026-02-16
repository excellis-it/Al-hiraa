@php
    use App\Helpers\Helper;
    use App\Constants\Position;
@endphp

{{-- Hidden template for edit mode --}}
<div id="candidate-edit-template" style="display:none;">
    <table>
        <tbody class="candidate-form-new">
            <tr>
                <td>Full Name*</td>
                <td>
                    <div class="form-group">
                        <input class="form-control uppercase-text" type="text" placeholder=""
                            aria-label="default input example" value="{{ $candidate_job_detail->full_name ?? '' }}"
                            name="full_name">
                    </div>
                </td>
                <td>DOB*</td>
                <td>
                    <div class="form-group date-btn">
                        <input type="text" class="form-control uppercase-text dob" id="dob"
                            value="{{ $candidate_job_detail->date_of_birth ? \Carbon\Carbon::parse($candidate_job_detail->date_of_birth)->format('d-m-Y') : '' }}"
                            name="dob" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="date_of_birth_msg"></span>
                    </div>
                </td>
                <td>Gender</td>
                <td>
                    <select name="gender" class="form-select uppercase-text" id="">
                        <option value="">Select Gender</option>
                        <option value="MALE" {{ $candidate_job_detail->gender == 'MALE' ? 'selected' : '' }}> MALE
                        </option>
                        <option value="FEMALE" {{ $candidate_job_detail->gender == 'FEMALE' ? 'selected' : '' }}>FEMALE
                        </option>
                        <option value="OTHER" {{ $candidate_job_detail->gender == 'OTHER' ? 'selected' : '' }}>OTHER
                        </option>
                    </select>
                </td>
            </tr>

            <input type="hidden" class="form-control uppercase-text"
                value="{{ $candidate_job_detail->candidate_id ?? '' }}" name="candidate_id">

            <tr>
                <td>Passport Number*</td>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control uppercase-text" id="" name="passport_number"
                            value="{{ $candidate_job_detail->passport_number ?? '' }}" placeholder="">
                        <span class="text-danger" id="passport_number_msg"></span>
                    </div>
                </td>
                <td>Passport Expiry Date*</td>
                <td>
                    <div class="form-group date-btn">
                        <input type="text" class="form-control uppercase-text passport_expiry_date"
                            id="passport_expiry_date"
                            value="{{ $candidate_job_detail->passport_expiry ? \Carbon\Carbon::parse($candidate_job_detail->passport_expiry)->format('d-m-Y') : '' }}"
                            name="passport_expiry" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="passport_expiry_msg"></span>
                    </div>
                </td>
                <td>ECR Type</td>
                <td>
                    <select name="ecr_type" class="form-select uppercase-text" id="">
                        <option value="">Select ECR Type</option>
                        <option value="ECR" {{ $candidate_job_detail->ecr_type == 'ECR' ? 'selected' : '' }}>ECR
                        </option>
                        <option value="ECNR" {{ $candidate_job_detail->ecr_type == 'ECNR' ? 'selected' : '' }}>ECNR
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Contact No</td>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control uppercase-text" id="" name="contact_no"
                            value="{{ $candidate_job_detail->contact_no ?? '' }}" placeholder="">
                        <span class="text-danger" id="contact_no_msg"></span>
                    </div>
                </td>
                <td>WhatsApp No.</td>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control uppercase-text" id="" name="whatapp_no"
                            value="{{ $candidate_job_detail->whatapp_no ?? '' }}" placeholder="">
                        <span class="text-danger" id="whatapp_no_msg"></span>
                    </div>
                </td>
                <td>Alternate Contact No.</td>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control uppercase-text" id=""
                            name="alternate_contact_no" value="{{ $candidate_job_detail->alternate_contact_no ?? '' }}"
                            placeholder="">
                        <span class="text-danger" id="alternate_contact_no_msg"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Associate</td>
                <td>
                    <select name="associate_id" class="form-select uppercase-text new_select2" id="associate_id">
                        <option value="">Select Associate</option>
                        @foreach ($associates as $associate)
                            <option value="{{ $associate->id }}"
                                {{ $candidate_job_detail->associate_id == $associate->id ? 'selected' : '' }}>
                                {{ $associate->name }} ({{ $associate->phone_number }})
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>Address</td>
                <td>
                    <input type="text" class="form-control uppercase-text" id=""
                        value="{{ $candidate_job_detail->address ?? '' }}" name="address" placeholder="">
                </td>
                <td>Email ID</td>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control uppercase-text" id=""
                            value="{{ $candidate_job_detail->email ?? '' }}" name="email" placeholder="">
                        <span class="text-danger" id="email_msg"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Religion</td>
                <td>
                    <select name="religion" class="form-select uppercase-text" id="">
                        <option value="">Select Religion</option>
                        <option value="HINDU" {{ $candidate_job_detail->religion == 'HINDU' ? 'selected' : '' }}>
                            Hindu</option>
                        <option value="ISLAM" {{ $candidate_job_detail->religion == 'ISLAM' ? 'selected' : '' }}>
                            Islam</option>
                        <option value="MUSLIM" {{ $candidate_job_detail->religion == 'MUSLIM' ? 'selected' : '' }}>
                            Muslim</option>
                        <option value="CHRISTIAN"
                            {{ $candidate_job_detail->religion == 'CHRISTIAN' ? 'selected' : '' }}>Christian</option>
                        <option value="SIKH" {{ $candidate_job_detail->religion == 'SIKH' ? 'selected' : '' }}>Sikh
                        </option>
                        <option value="BUDDHIST"
                            {{ $candidate_job_detail->religion == 'BUDDHIST' ? 'selected' : '' }}>Buddhist</option>
                        <option value="JAIN" {{ $candidate_job_detail->religion == 'JAIN' ? 'selected' : '' }}>Jain
                        </option>
                        <option value="OTHER" {{ $candidate_job_detail->religion == 'OTHER' ? 'selected' : '' }}>
                            Other</option>
                    </select>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

{{-- Hidden template for view mode --}}
<div id="candidate-view-template" style="display:none;">
    <table>
        <tbody>
            <tr>
                <td>Full Name</td>
                <td>{{ $candidate_job_detail->full_name ?? 'N/A' }}</td>
                <td>Date of Birth</td>
                <td>{{ $candidate_job_detail->date_of_birth ?? 'N/A' }}</td>
                <td>Gender</td>
                <td>{{ $candidate_job_detail->gender ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Passport Number</td>
                <td>{{ $candidate_job_detail->passport_number ?? 'N/A' }}</td>
                <td>Passport Expiry Date</td>
                <td>{{ $candidate_job_detail->passport_expiry ?? 'N/A' }}</td>
                <td>ECR Type</td>
                <td>{{ $candidate_job_detail->ecr_type ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Contact No</td>
                <td>{{ $candidate_job_detail->contact_no ?? 'N/A' }}</td>
                <td>WhatsApp No</td>
                <td>{{ $candidate_job_detail->whatapp_no ?? 'N/A' }}</td>
                <td>Alternate Contact No</td>
                <td>{{ $candidate_job_detail->alternate_contact_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Associate</td>
                <td>
                    @if ($candidate_job_detail->associate_id && $candidate_job_detail->associate)
                        {{ $candidate_job_detail->associate->name ?? 'N/A' }}
                        ({{ $candidate_job_detail->associate->phone_number ?? '' }})
                    @else
                        N/A
                    @endif
                </td>
                <td>Address</td>
                <td>{{ $candidate_job_detail->address ?? 'N/A' }}</td>
                <td>Email</td>
                <td>{{ $candidate_job_detail->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Religion</td>
                <td>{{ $candidate_job_detail->religion ?? 'N/A' }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="table-responsive" id="tableContainerCandidate">
    <table class="table" id="candidate-form">
        <tbody>
            <tr>
                <td>Full Name</td>
                <td>{{ $candidate_job_detail->full_name ?? 'N/A' }}</td>
                <td>Date of Birth</td>
                <td>{{ $candidate_job_detail->date_of_birth ?? 'N/A' }}</td>
                <td>Gender</td>
                <td>{{ $candidate_job_detail->gender ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Passport Number</td>
                <td>{{ $candidate_job_detail->passport_number ?? 'N/A' }}</td>
                <td>Passport Expiry Date</td>
                <td>{{ $candidate_job_detail->passport_expiry ?? 'N/A' }}</td>
                <td>ECR Type</td>
                <td>{{ $candidate_job_detail->ecr_type ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Contact No</td>
                <td>{{ $candidate_job_detail->contact_no ?? 'N/A' }}</td>
                <td>WhatsApp No</td>
                <td>{{ $candidate_job_detail->whatapp_no ?? 'N/A' }}</td>
                <td>Alternate Contact No</td>
                <td>{{ $candidate_job_detail->alternate_contact_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Associate</td>
                <td>
                    @if ($candidate_job_detail->associate_id && $candidate_job_detail->associate)
                        {{ $candidate_job_detail->associate->name ?? 'N/A' }}
                        ({{ $candidate_job_detail->associate->phone_number ?? '' }})
                    @else
                        N/A
                    @endif
                </td>
                <td>Address</td>
                <td>{{ $candidate_job_detail->address ?? 'N/A' }}</td>
                <td>Email</td>
                <td>{{ $candidate_job_detail->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Religion</td>
                <td>{{ $candidate_job_detail->religion ?? 'N/A' }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    //candidates details form
    $(document).off("click", '#open-input').on("click", '#open-input', function(e) {

        $(this).html('');

        $(".see-more-container").hide();
        $('#submit-button').html(
            '<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>'
        );

        $('#cross-button').html(
            '<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>'
        );

        // Get edit form HTML from hidden template
        var editHtml = $('#candidate-edit-template').find('tbody').parent().html();
        $('#candidate-form').html(editHtml);

        // Initialize datepickers (after elements exist in DOM)
        $('#candidate-form .dob').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            maxDate: function() {
                var today = new Date();
                today.setDate(today.getDate() - 1);
                return today;
            }
        });

        $('#candidate-form .passport_expiry_date').datepicker({
            uiLibrary: 'bootstrap5',
            format: 'dd-mm-yyyy',
            minDate: new Date() // today + future allowed
        });


        // Initialize Select2 ONLY on visible form elements
        $('#candidate-form .new_select2').each(function() {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });

    });

    $(document).off("click", '#cross-button').on("click", '#cross-button', function(e) {

        $(this).html('');
        $(".see-more-container").hide();
        $('#submit-button').html('');
        $('#open-input').html(
            '<a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>');

        // Get view mode HTML from hidden template
        var viewHtml = $('#candidate-view-template').find('tbody').parent().html();
        $('#candidate-form').html(viewHtml);
    });
</script>
