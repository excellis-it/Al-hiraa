@php
    use App\Helpers\Helper;
    use App\Constants\Position;
@endphp
<div class="table-responsive" id="tableContainer">
    <table class="table" id="candidate-form">

        <tbody>
            <tr>
                <td>Full Name</td>
                <td>{{ $candidate_job_detail->full_name ?? 'N/A' }}</td>
                <td>Email</td>
                <td>{{ $candidate_job_detail->email ?? 'N/A' }}</td>
                <td>Gender</td>
                <td>{{ $candidate_job_detail->gender ?? 'N/A' }}</td>

            </tr>
            <tr>
                <td>Date of birth</td>
                <td>{{ $candidate_job_detail->date_of_birth ?? 'N/A' }}</td>
                <td>whatapp_no</td>
                <td>{{ $candidate_job_detail->whatapp_no ?? 'N/A' }}</td>
                <td>Alternate Contact No</td>
                <td>{{ $candidate_job_detail->alternate_contact_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Religion</td>
                <td>{{ $candidate_job_detail->religion ?? 'N/A' }}</td>
                <td>City</td>
                <td>{{ $candidate_job_detail->city ?? 'N/A' }}</td>
                <td>Address</td>
                <td>{{ $candidate_job_detail->address ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Education</td>
                <td>{{ $candidate_job_detail->education ?? 'N/A' }}</td>
                <td>Other Education</td>
                <td>{{ $candidate_job_detail->other_education ?? 'N/A' }}</td>
                <td>Passport Number</td>
                <td>{{ $candidate_job_detail->passport_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>English_speak</td>
                <td>{{ $candidate_job_detail->english_speak ?? 'N/A' }}</td>
                <td>Arabic Speak</td>
                <td>{{ $candidate_job_detail->arabic_speak ?? 'N/A' }}</td>
                <td>Assign By </td>
                <td>
                    @if ($candidate_job_detail->assign_by_id != null)
                        {{ isset($candidate_job_detail->assignBy) && $candidate_job_detail->assignBy ? $candidate_job_detail->assignBy->first_name . ' ' . $candidate_job_detail->assignBy->last_name : 'N/A' }}
                    @else
                        {{ $candidate_job_detail->assignBy ?? 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Job Title</td>
                <td>
                    @if ($candidate_job_detail->jobTitle != null)
                        {{ $candidate_job_detail->jobTitle->job_name }}
                    @else
                        {{ $candidate_job_detail->jobTitle ?? 'N/A' }}
                    @endif
                </td>
                <td>Job Position</td>
                <td>
                    @if ($candidate_job_detail->jobTitle->candidatePosition != null)
                        {{ $candidate_job_detail->jobTitle->candidatePosition->name ?? 'N/A' }}
                    @else
                        {{ $candidate_job_detail->jobTitle ?? 'N/A' }}
                    @endif
                </td>
                <td>Job Location</td>
                <td>{{ $candidate_job_detail->job_location ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td>Indian Driving Licence</td>
                <td>
                    @if ($indian_driving_license != null)
                        @foreach ($indian_driving_license as $key => $value)
                            {{ $value ?? 'N/A' }},
                        @endforeach
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
                <td>Gulf Driving Licence</td>
                <td>
                    @if ($gulf_driving_license != null)
                        @foreach ($gulf_driving_license as $key => $value)
                            {{ $value ?? 'N/A' }},
                        @endforeach
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
                <td>Interview Status</td>
                <td>
                    @if ($candidate_job_detail->job_interview_status == 'Selected')
                        <span
                            style="color: green;">{{ $candidate_job_detail->job_interview_status }}</span>
                    @else
                        {{ $candidate_job_detail->job_interview_status ?? 'N/A' }}
                    @endif
                </td>

            </tr>

        </tbody>
    </table>
</div>


<script>
    //candidates details form
    $(document).ready(function() {


        $(document).on("click", '#open-input', function(e) {

            $(this).html(``);

            $(".see-more-container").hide();
            $('#submit-button').html(
                `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
            )

            $('#cross-button').html(
                `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
            )

            $('#candidate-form').html(`
            <tbody class="candidate-form-new">
                <tr>
                    <td>Full Name*</td>
                    <td><div class="form-group">
                            <input class="form-control uppercase-text" type="text" placeholder="" aria-label="default input example" value="{{ $candidate_job_detail->full_name ?? '' }}" name="full_name">
                        </div>
                    </td>
                    <td>Email ID</td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->email ?? '' }}" name="email" placeholder="" >
                            <span class="text-danger" id="email_msg"></span>
                        </div>
                    </td>
                    <td>Gender*</td>
                    <td>
                        <select name="gender" class="form-select uppercase-text" id="">
                            <option value="">Select Gender</option>
                            <option value="MALE" {{ $candidate_job_detail->gender == 'MALE' ? 'selected' : '' }}> MALE </option>
                            <option value="FEMALE" {{ $candidate_job_detail->gender == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                            <option value="OTHER" {{ $candidate_job_detail->gender == 'OTHER' ? 'selected' : '' }}>OTHER</option>
                        </select>
                    </td>
                </tr>

                <input type="hidden" class="form-control uppercase-text" value="{{ $candidate_job_detail->candidate_id ?? '' }}" name="candidate_id" >

                <tr>
                    <td>DOB*</td>
                    <td>
                    <div class="form-group date-btn">
                        <input type="text" class="form-control uppercase-text datepicker" id="dob"
                            value="{{ \Carbon\Carbon::parse($candidate_job_detail->date_of_birth)->format('d-m-Y') ?? '' }}"
                            name="dob" max="{{ date('Y-m-d') }}" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="date_of_birth_msg"></span>
                    </div>
                    </td>
                    <td>Whatsapp No.</td>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control uppercase-text" id="" name="whatapp_no" value="{{ $candidate_job_detail->whatapp_no ?? '' }}" placeholder="">
                        <span class="text-danger" id="whatapp_no_msg"></span>
                        </div>
                    </td>
                    <td>Alternate Contact No.</td>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control uppercase-text" id="" name="alternate_contact_no" value="{{ $candidate_job_detail->alternate_contact_no ?? '' }}" placeholder="">
                        <span class="text-danger" id="alternate_contact_no_msg"></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Religion</td>
                    <td>
                        <select name="religion" class="form-select uppercase-text" id="">
                            <option value="">Select Religion</option>
                            <option value="HINDU" {{ $candidate_job_detail->religion == 'HINDU' ? 'selected' : '' }}>Hindu</option>
                            <option value="ISLAM" {{ $candidate_job_detail->religion == 'ISLAM' ? 'selected' : '' }}>Islam</option>
                            <option value="CHRISTIAN" {{ $candidate_job_detail->religion == 'CHRISTIAN' ? 'selected' : '' }}>Christian</option>
                            <option value="SIKH" {{ $candidate_job_detail->religion == 'SIKH' ? 'selected' : '' }}>Sikh</option>
                            <option value="BUDDHIST" {{ $candidate_job_detail->religion == 'BUDDHIST' ? 'selected' : '' }}>Buddhist</option>
                            <option value="JAIN" {{ $candidate_job_detail->religion == 'JAIN' ? 'selected' : '' }}>Jain</option>
                            <option value="OTHER" {{ $candidate_job_detail->religion == 'OTHER' ? 'selected' : '' }}>Other</option>
                        </select>
                    </td>
                    <td>City</td>
                    <td>
                        <select name="city" class="form-select new_select2 uppercase-text" id="">
                            <option value="">Select City</option>
                            @foreach (Position::getCity() as $city)
                                <option value="{{ $city }}" {{ $candidate_job_detail->city == $city ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>Address</td>
                    <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->address ?? '' }}" name="address" placeholder="">
                    </td>
                </tr>

                <tr>
                    <td>Education</td>
                    <td>
                        <select name="education" class="form-select uppercase-text" id="">
                            <option value="">Select Type</option>
                            <option value="5TH PASS" {{ $candidate_job_detail->education == '5TH PASS' ? 'selected' : '' }}>5TH PASS</option>
                            <option value="8TH PASS" {{ $candidate_job_detail->education == '8TH PASS' ? 'selected' : '' }}>8TH PASS</option>
                            <option value="10TH PASS" {{ $candidate_job_detail->education == '10TH PASS' ? 'selected' : '' }}>10TH PASS
                            </option>
                            <option value="HIGHER SECONDARY"
                                {{ $candidate_job_detail->education == 'HIGHER SECONDARY' ? 'selected' : '' }}>HIGHER SECONDARY
                                </option>
                            <option value="GRADUATES" {{ $candidate_job_detail->education == 'GRADUATES' ? 'selected' : '' }}>GRADUATES</option>
                            <option value="MASTERS" {{ $candidate_job_detail->education == 'MASTERS' ? 'selected' : '' }}>MASTERS</option>
                        </select>
                    </td>
                    <td>Other Education</td>
                    <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->other_education ?? '' }}" name="other_education" placeholder="">
                    </td>
                    <td>Passport Number.</td>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control uppercase-text" id="" name="passport_number"
                            value="{{ $candidate_job_detail->passport_number ?? '' }}" placeholder="">
                        <span class="text-danger" id="passport_number_msg"></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>English Speak</td>
                    <td>
                    <select name="english_speak" class="form-select uppercase-text" id="">
                        <option value="">English Speak</option>
                        <option value="BASIC" {{ strtoupper($candidate_job_detail->english_speak) == 'BASIC' ? 'selected' : '' }}>BASIC</option>
                            <option value="GOOD" {{ strtoupper($candidate_job_detail->english_speak) == 'GOOD' ? 'selected' : '' }}>GOOD</option>
                            <option value="POOR" {{ strtoupper($candidate_job_detail->english_speak) == 'POOR' ? 'selected' : '' }}>POOR</option>
                            <option value="NO" {{ strtoupper($candidate_job_detail->english_speak) == 'NO' ? 'selected' : '' }}>NO</option>
                    </select>
                    </td>
                    <td>Arabic Speak</td>
                    <td>
                    <select name="arabic_speak" class="form-select uppercase-text" id="">
                        <option value="">Arabic Speak</option>
                        <option value="BASIC" {{ strtoupper($candidate_job_detail->arabic_speak) == 'BASIC' ? 'selected' : '' }}>BASIC</option>
                            <option value="GOOD" {{ strtoupper($candidate_job_detail->arabic_speak) == 'GOOD' ? 'selected' : '' }}>GOOD</option>
                            <option value="POOR" {{ strtoupper($candidate_job_detail->arabic_speak) == 'POOR' ? 'selected' : '' }}>POOR</option>
                            <option value="NO" {{ strtoupper($candidate_job_detail->arabic_speak) == 'NO' ? 'selected' : '' }}>NO</option>
                    </select>
                    </td>
                    <td>Assign by</td>
                    <td>
                    <input type="text" class="form-control uppercase-text" id="" name="assign_by_id"
                            value="{{ $candidate_job_detail->assignBy->first_name ?? '' }} {{ $candidate_job_detail->assignBy->last_name ?? '' }}"placeholder="" readonly>
                    </td>
                </tr>
                <tr>
                   <td>Job Title</td>
                    <td>
                    <select name="job_title" class="form-select uppercase-text job_id" id="job_title" disabled>
                        <option value="">Select A Job Title</option>
                        @foreach ($jobs as $job)
                            <option value="{{ $job->id }}" {{ $candidate_job_detail->job_id == $job->id ? 'selected' : '' }}>
                                {{ $job->job_name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="job_title" value="{{ $candidate_job_detail->job_id }}">
                    <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>

                    <td>Job Position</td>
                    <td>
                    <select name="job_position" class="form-select uppercase-text job_id" id="job_position" disabled>
                        <option value="">Select A Job Position</option>
                        @foreach ($candidate_positions as $position)
                            <option value="{{ $position->id }}" {{ $candidate_job_detail->job_position == $position->id ? 'selected' : '' }}>
                                {{ $position->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="job_position" value="{{ $candidate_job_detail->job_position }}">
                    </td>
                    <td>Job Location</td>
                    <td>
                    <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->job_location ?? '' }}" name="job_location" placeholder="">
                    </td>
                </tr>
                <tr>
                    <td>Indian Driving License</td>
                    <td>
                        <select name="indian_driving_license[]" class="form-select uppercase-text new_select2" id="" multiple>
                            <option value="" disabled>Select Indian Driving License</option>
                            <option value="2 WHEELER" {{ in_array('2 WHEELER', $indian_driving_license) ? 'selected' : '' }}>
                                2 WHEELER</option>
                            <option value="4 WHEELER" {{ in_array('4 WHEELER', $indian_driving_license) ? 'selected' : '' }}>
                                4 WHEELER</option>
                            <option value="HV" {{ in_array('HV', $indian_driving_license) ? 'selected' : '' }}>HV</option>
                        </select>
                    </td>
                    <td>Gulf Driving License</td>
                    <td>
                        <select name="international_driving_license[]" class="form-select uppercase-text new_select2" id="" multiple>
                            <option value="" disabled>Select Gulf Driving License</option>
                            <option value="2 WHEELER" {{ in_array('2 WHEELER', $gulf_driving_license) ? 'selected' : '' }}>
                                2 WHEELER</option>
                            <option value="4 WHEELER" {{ in_array('4 WHEELER', $gulf_driving_license) ? 'selected' : '' }}>
                                4 WHEELER</option>
                            <option value="HV" {{ in_array('HV', $gulf_driving_license) ? 'selected' : '' }}>HV</option>
                        </select>
                    </td>
                    <td>Interview Status</td>
                    <td>
                    <select name="interview_status" class="form-select uppercase-text" id="">
                            <option value="Interested" {{ $candidate_job_detail->job_interview_status == 'Interested' ? 'selected' : '' }} {{ $candidate_job_detail->job_interview_status == 'Selected' ? 'disabled' : '' }}>Interested</option>
                            <option value="Selected" {{ $candidate_job_detail->job_interview_status == 'Selected' ? 'selected' : '' }}>Selected</option>
                            <option value="Not-Interested" {{ $candidate_job_detail->job_interview_status == 'Not-Interested' ? 'selected' : '' }}>Not-Interested</option>
                    </select>
                    </td>
                </tr>

             </tbody>`)

            $('#dob').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd-mm-yyyy',
            });

            $('.new_select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            })


        });
        $(document).on("click", '#cross-button', function(e) {

            $(this).html(``);
            $(".see-more-container").hide();
            $('#submit-button').html(``)
            $('#open-input').html(
                ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
            $('#candidate-form').html(`
                              <tbody>
            <tr>
                <td>Full Name</td>
                <td>{{ $candidate_job_detail->full_name ?? 'N/A' }}</td>
                <td>Email</td>
                <td>{{ $candidate_job_detail->email ?? 'N/A' }}</td>
                <td>Gender</td>
                <td>{{ $candidate_job_detail->gender ?? 'N/A' }}</td>

            </tr>
            <tr>
                <td>Date of birth</td>
                <td>{{ $candidate_job_detail->date_of_birth ?? 'N/A' }}</td>
                <td>whatapp_no</td>
                <td>{{ $candidate_job_detail->whatapp_no ?? 'N/A' }}</td>
                <td>Alternate Contact No</td>
                <td>{{ $candidate_job_detail->alternate_contact_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Religion</td>
                <td>{{ $candidate_job_detail->religion ?? 'N/A' }}</td>
                <td>City</td>
                <td>{{ $candidate_job_detail->city ?? 'N/A' }}</td>
                <td>Address</td>
                <td>{{ $candidate_job_detail->address ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Education</td>
                <td>{{ $candidate_job_detail->education ?? 'N/A' }}</td>
                <td>Other Education</td>
                <td>{{ $candidate_job_detail->other_education ?? 'N/A' }}</td>
                <td>Passport Number</td>
                <td>{{ $candidate_job_detail->passport_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>English_speak</td>
                <td>{{ $candidate_job_detail->english_speak ?? 'N/A' }}</td>
                <td>Arabic Speak</td>
                <td>{{ $candidate_job_detail->arabic_speak ?? 'N/A' }}</td>
                <td>Assign By </td>
                <td>
                    @if ($candidate_job_detail->assign_by_id != null)
                        {{ isset($candidate_job_detail->assignBy) && $candidate_job_detail->assignBy ? $candidate_job_detail->assignBy->first_name . ' ' . $candidate_job_detail->assignBy->last_name : 'N/A' }}
                    @else
                        {{ $candidate_job_detail->assignBy ?? 'N/A' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Job Title</td>
                <td>
                    @if ($candidate_job_detail->jobTitle != null)
                        {{ $candidate_job_detail->jobTitle->job_name }}
                    @else
                        {{ $candidate_job_detail->jobTitle ?? 'N/A' }}
                    @endif
                </td>
                <td>Job Position</td>
                <td>
                    @if ($candidate_job_detail->jobTitle->candidatePosition != null)
                        {{ $candidate_job_detail->jobTitle->candidatePosition->name ?? 'N/A' }}
                    @else
                        {{ $candidate_job_detail->jobTitle ?? 'N/A' }}
                    @endif
                </td>
                <td>Job Location</td>
                <td>{{ $candidate_job_detail->job_location ?? 'N/A' }}</td>
            </tr>

            <tr>
                <td>Indian Driving Licence</td>
                <td>
                    @if ($indian_driving_license != null)
                        @foreach ($indian_driving_license as $key => $value)
                            {{ $value ?? 'N/A' }},
                        @endforeach
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
                <td>Gulf Driving Licence</td>
                <td>
                    @if ($gulf_driving_license != null)
                        @foreach ($gulf_driving_license as $key => $value)
                            {{ $value ?? 'N/A' }},
                        @endforeach
                    @else
                        {{ 'N/A' }}
                    @endif
                </td>
                <td>Interview Status</td>
                <td>
                    @if ($candidate_job_detail->job_interview_status == 'Selected')
                        <span
                            style="color: green;">{{ $candidate_job_detail->job_interview_status }}</span>
                    @else
                        {{ $candidate_job_detail->job_interview_status ?? 'N/A' }}
                    @endif
                </td>

            </tr>

        </tbody>`);
            // var visibleRows = 5;
            // showRows(visibleRows);

            // Handle the "See More" button click
            // $(document).on("click", '#seeMoreBtn', function(e) {
            //     e.preventDefault();
            //     // Show additional rows (e.g., 5 more)
            //     visibleRows += 28;
            //     showRows(visibleRows);
            // });

            // Function to show the specified number of rows
            function showRows(rowsToShow) {
                var $tableContainer = $("#tableContainer");
                var $tableRows = $tableContainer.find("tbody tr");

                // Hide all rows
                $tableRows.hide();

                // Show the specified number of rows
                $tableRows.slice(0, rowsToShow).show();

                // Toggle the "See More" button visibility based on the total number of rows
                if ($tableRows.length > rowsToShow) {
                    $(".see-more-container").show();
                } else {
                    $(".see-more-container").hide();
                }
            }
        });
    });
</script>
