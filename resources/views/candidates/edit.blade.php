@php
    use App\Helpers\Helper;
    use App\Constants\Position;
@endphp
@if (isset($edit))

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit"
        @if (Auth::user()->hasRole('DATA ENTRY OPERATOR') || Auth::user()->hasRole('ADMIN')) @else data-bs-backdrop="static" @endif aria-labelledby="offcanvasRightLabel">
        @if (Auth::user()->hasRole('DATA ENTRY OPERATOR') || Auth::user()->hasRole('ADMIN'))
            <a href="" class="cross_x"><i class="fa-solid fa-circle-xmark"></i></a>
        @endif
        <div class="offcanvas-body">
            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="name_box">
                        <div class="">
                            <div class="name_box_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.706" height="22.275"
                                    viewBox="0 0 16.706 22.275">
                                    <g id="user_4_" data-name="user (4)" transform="translate(-64)">
                                        <circle id="Ellipse_323" data-name="Ellipse 323" cx="5.5" cy="5.5"
                                            r="5.5" transform="translate(67 0)" fill="#1492e6" />
                                        <path id="Path_330" data-name="Path 330"
                                            d="M72.353,298.667A8.363,8.363,0,0,0,64,307.02a.928.928,0,0,0,.928.928h14.85a.928.928,0,0,0,.928-.928A8.362,8.362,0,0,0,72.353,298.667Z"
                                            transform="translate(0 -285.673)" fill="#1492e6" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="">
                            <div class="name_box_text">
                                <p>Name</p>
                                <h4>{{ $candidate->full_name ?? 'N/A' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="name_box">
                        <div class="">
                            <div class="name_box_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20.761" height="22.275"
                                    viewBox="0 0 20.761 22.275">
                                    <g id="phone-receiver-silhouette_2_" data-name="phone-receiver-silhouette (2)"
                                        transform="translate(-0.872 0)">
                                        <path id="Path_412" data-name="Path 412"
                                            d="M19.307,15.5c-1.346-1.151-2.711-1.848-4.04-.7l-.794.695c-.581.5-1.66,2.86-5.835-1.942S6.948,8.015,7.53,7.515l.8-.7c1.322-1.152.823-2.6-.13-4.094l-.575-.9C6.664.332,5.621-.646,4.3.5l-.716.626A6.724,6.724,0,0,0,.958,5.58C.48,8.742,1.988,12.364,5.444,16.337s6.83,5.972,10.031,5.937A6.742,6.742,0,0,0,20.243,20.3l.719-.627c1.322-1.149.5-2.319-.846-3.473Z"
                                            fill="#1492e6" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="">
                            <div class="name_box_text">
                                <p>Contact No:</p>
                                <h4>{{ $candidate->contact_no ?? 'N/A' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="name_box">
                        <div class="">
                            <div class="name_box_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 22 22">
                                    <g id="activity" transform="translate(-2.25 -1.5)">
                                        <path id="Path_409" data-name="Path 409"
                                            d="M16.1,3.88a.815.815,0,1,0,0-1.63H12.793c-2,0-3.559,0-4.8.134A6.327,6.327,0,0,0,4.825,3.443,6.247,6.247,0,0,0,3.443,4.825,6.327,6.327,0,0,0,2.384,7.993c-.134,1.241-.134,2.8-.134,4.8v.1c0,2,0,3.559.134,4.8A6.327,6.327,0,0,0,3.443,20.86a6.246,6.246,0,0,0,1.382,1.382A6.326,6.326,0,0,0,7.993,23.3c1.241.134,2.8.134,4.8.134h.1c2,0,3.559,0,4.8-.134a6.326,6.326,0,0,0,3.168-1.059,6.246,6.246,0,0,0,1.382-1.382A6.326,6.326,0,0,0,23.3,17.692c.134-1.241.134-2.8.134-4.8V9.583a.815.815,0,1,0-1.63,0v3.259c0,2.055,0,3.531-.125,4.674a4.742,4.742,0,0,1-.757,2.386A4.615,4.615,0,0,1,19.9,20.924a4.742,4.742,0,0,1-2.386.757c-1.143.124-2.619.125-4.674.125s-3.531,0-4.674-.125a4.742,4.742,0,0,1-2.386-.757A4.616,4.616,0,0,1,4.761,19.9,4.742,4.742,0,0,1,4,17.516c-.124-1.143-.125-2.619-.125-4.674s0-3.531.125-4.674a4.742,4.742,0,0,1,.757-2.386A4.617,4.617,0,0,1,5.783,4.761,4.742,4.742,0,0,1,8.169,4c1.143-.124,2.619-.125,4.674-.125Z"
                                            transform="translate(0 0.065)" fill="#1492e6" />
                                        <path id="Path_410" data-name="Path 410"
                                            d="M6.333,15.057a.815.815,0,1,0,1.463.718L9.383,12.54a1.294,1.294,0,0,1,2.36.08,2.924,2.924,0,0,0,5.331.181l1.587-3.234A.815.815,0,0,0,17.2,8.849l-1.586,3.234a1.294,1.294,0,0,1-2.36-.08,2.924,2.924,0,0,0-5.331-.181Z"
                                            transform="translate(0.346 0.596)" fill="#1492e6" />
                                        <path id="Path_411" data-name="Path 411"
                                            d="M17.5,4.216A2.716,2.716,0,1,0,20.216,1.5,2.716,2.716,0,0,0,17.5,4.216Zm1.63,0A1.086,1.086,0,1,0,20.216,3.13,1.086,1.086,0,0,0,19.13,4.216Z"
                                            transform="translate(1.318 0)" fill="#1492e6" fill-rule="evenodd" />
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="">
                            <div class="name_box_text">
                                <p>Status</p>
                                <div class="round_staus active">
                                    {{ $candidate->candidateStatus->name ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('candidates.update', $candidate->id) }}" method="POST" id="candidate-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div class="can-div d-flex justify-content-between align-items-center">
                        <div class="can-head">
                            <h4>Candidate Details</h4>
                        </div>
                        <div class="edit-1-btn d-flex align-items-center">

                            <div class="edit-2" id="cross-button">

                            </div>
                            <div class="edit-2 m-lg-1" id="submit-button">

                            </div>
                            <div class="edit-1" id="open-input">
                                @can('Edit Candidate')
                                    <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="candidate_form candidate_edit_form">
                        <div class="table-responsive" id="tableContainer">
                            <table class="table" id="candidate-form">
                                <tbody>
                                    {{-- @include('candidates.details-form') --}}
                                    <tr>
                                        <td>Enter By</td>
                                        <td>{{ $candidate->enterBy->full_name ?? 'N/A' }}
                                        </td>
                                        <td>Status</td>
                                        <td>{{ $candidate->candidateStatus->name ?? 'N/A' }}</td>
                                        <td>Mode of Registration</td>
                                        <td>{{ $candidate->mode_of_registration ?? 'N/A' }}</td>
                                    </tr>

                                    <tr>
                                        <td>Source</td>
                                        <td>{{ $candidate->source ?? 'N/A' }}</td>
                                        <td>Last Updated Date</td>
                                        <td>{{ $candidate->updated_at != null ? date('d.m.Y', strtotime($candidate->updated_at)) : 'N/A' }}
                                        </td>
                                        <td>Referred By</td>
                                        <td>
                                            @if ($candidate->referred_by_id != null)
                                                {{ $candidate->referredBy->full_name }}
                                            @else
                                                {{ $candidate->referred_by }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Full Name</td>
                                        <td>{{ $candidate->full_name ?? 'N/A' }}
                                        </td>
                                        <td>Gender</td>
                                        <td>{{ $candidate->gender }}</td>
                                        <td>DOB</td>
                                        <td>{{ $candidate->date_of_birth != null ? date('d.m.Y', strtotime($candidate->date_of_birth)) : 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Age</td>
                                        <td>{{ $candidate->date_of_birth != null ? \Carbon\Carbon::parse($candidate->date_of_birth)->age : 'N/A' }}
                                        </td>
                                        <td>Education</td>
                                        <td>{{ $candidate->education ?? 'N/A' }}</td>
                                        <td>Other Education</td>
                                        <td>{{ $candidate->other_education ?? 'N/A' }}</td>
                                    </tr>

                                    <tr>
                                        <td>Alternate Contact No.</td>
                                        <td>{{ $candidate->alternate_contact_no ?? 'N/A' }}</td>
                                        <td>Whatsapp No.</td>
                                        <td>{{ $candidate->whatapp_no ?? 'N/A' }}</td>
                                        <td>Passport Number.</td>
                                        <td>{{ $candidate->passport_number ?? 'N/A' }}</td>
                                    </tr>

                                    <tr>
                                        <td>Email ID</td>
                                        <td>{{ $candidate->email ?? 'N/A' }}
                                        </td>
                                        <td>City</td>
                                        <td>{{ $candidate->cityName->name ?? 'N/A' }}
                                        </td>
                                        <td>Religion</td>
                                        <td>{{ $candidate->religion ?? 'N/A' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>ECR Type</td>
                                        <td>{{ $candidate->ecr_type ?? 'N/A' }}</td>
                                        <td>Indidan Driving License </td>
                                        <td>
                                            @if ($candidate->candidateIndianLicence()->count() > 0)
                                                @foreach ($candidate->candidateIndianLicence as $key => $value)
                                                    <span class="badge bg-primary rounded-pill">
                                                        {{ $value->licence_name ?? 'N/A' }}
                                                    </span>
                                                @endforeach
                                            @else
                                                {{ 'N/A' }}
                                            @endif

                                        </td>
                                        <td>Gulf Driving License </td>
                                        <td>
                                            @if ($candidate->candidateGulfLicence()->count() > 0)
                                                @foreach ($candidate->candidateGulfLicence as $key => $value)
                                                    <span class="badge bg-primary rounded-pill">
                                                        {{ $value->licence_name ?? 'N/A' }}
                                                    </span>
                                                @endforeach
                                            @else
                                                {{ 'N/A' }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>English Speak</td>
                                        <td>{{ $candidate->english_speak ?? 'N/A' }}
                                        </td>
                                        <td>Arabic Speak</td>
                                        <td>{{ $candidate->arabic_speak ?? 'N/A' }}

                                        </td>
                                        <td>Return</td>
                                        <td>{{ $candidate->return == 1 ? 'YES' : 'N0' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Position Applied For(1)</td>
                                        <td>{{ $candidate->positionAppliedFor1->name ?? 'N/A' }}
                                        </td>
                                        <td>Specialisation for Position (1)</td>
                                        <td>{{ $candidate->specialisation_1 ?? 'N/A' }}
                                        </td>
                                        <td>Position Applied For(2)</td>
                                        <td>{{ $candidate->positionAppliedFor2->name ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Specialisation for Position (2)</td>
                                        <td>{{ $candidate->specialisation_2 ?? 'N/A' }}
                                        </td>
                                        <td>Position Applied For(3)</td>
                                        <td>{{ $candidate->positionAppliedFor3->name ?? 'N/A' }}
                                        </td>
                                        <td>Specialisation for Position (3)</td>
                                        <td>{{ $candidate->specialisation_3 ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Indian Experience (If any?)</td>
                                        <td>{{ $candidate->indian_exp ?? 'N/A' }}
                                        </td>
                                        <td>Abroad Experience (If any?)</td>
                                        <td>{{ $candidate->abroad_exp ?? 'N/A' }}

                                        </td>
                                        <td>Last Call Status</td>
                                        <td>{{ $candidate->lastCandidateActivity->call_status ?? 'N/A' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Remarks</td>
                                        <td colspan="5">{{ $candidate->lastCandidateActivity->remarks ?? 'N/A' }}
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="see-more-container">
                        <a href="javascript:void(0);" class="btn-1" id="seeMoreBtn">See More<img
                                src="{{ asset('assets/images/arrow.png') }}"></a>
                    </div>
                </div>
            </form>

            <div class="candidate_details">
                <h4>Updated Details</h4>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Enter By</td>
                                <td> {{ $candidate->enterBy->full_name ?? 'N/A' }}
                                </td>
                                <td>Updated By</td>
                                <td>{{ $candidate->candidateUpdate->user->full_name ?? 'N/A' }}
                                </td>

                                @php
                                    if (isset($candidate->candidateUpdate->user->full_name)) {
                                        $data = Helper::getUpdatedData(
                                            $candidate->id,
                                            $candidate->candidateUpdate->user_id,
                                        );
                                    } else {
                                        $data = [];
                                    }
                                @endphp
                                @if ($data != null)

                                    <td>Status</td>
                                    <td>
                                        <div class="permission-2 m-lg-1">
                                            <p class="m-md-1">{{ $data['candidateStatus']['name'] ?? '' }}</p>
                                            @if (Auth::user()->hasRole('ADMIN'))
                                                <a href="javascript:void(0);" class="permission" id="permission"
                                                    data-route="{{ route('candidates.permission', ['candidate_id' => $candidate->id, 'candidate_field_update_id' => $data['id']]) }}">
                                                    <span><i class="fa-solid fa-check"></i></span>
                                                </a>
                                            @endif

                                        </div>
                                    </td>

                            </tr>


                            {{-- <tr>
                                    <td>Postion</td>
                                    <td>{{ $data['position'] ?? '' }}
                                    </td>
                                </tr> --}}
@endif

</tbody>
</table>
</div>
</div>
<form action="{{ route('candidates.assign-job', $candidate->id) }}" method="POST" id="candidate-job-create-form">
    @method('PUT')
    @csrf
    <div class="candidate_details">
        <div class="can-div d-flex justify-content-between align-items-center">
            <div class="can-head">
                <h4>Assign Job Details</h4>
            </div>
            <div class="edit-1-btn d-flex align-items-center">

                <div class="edit-2 cross-red" id="cross-button-job">

                </div>
                <div class="edit-2 m-lg-1" id="submit-button-job">

                </div>
                <div class="edit-1" id="open-job-input">
                    @can('Edit Candidate')
                        <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="candidate_form candidate_edit_form">
            <div class="table-responsive" id="tableContainer">
                <table class="table" id="candidate-form-job">
                    <tbody>
                        <tr>
                            <td>Assigned By</td>
                            <td>{{ $assign_job->user->full_name ?? 'N/A' }}
                            </td>
                            <td>Company</td>
                            <td>{{ $assign_job->company->company_name ?? 'N/A' }}
                            </td>
                            <td>Job Title</td>
                            <td>{{ $assign_job->job->job_name ?? 'N/A' }}
                            </td>
                        </tr>

                        <tr>
                            <td>Job Position</td>
                            <td>{{ $assign_job->job->candidatePosition->name ?? 'N/A' }}
                            </td>
                            <td>Job Location</td>
                            <td>{{ $assign_job->job->address ?? 'N/A' }}
                            </td>
                            <td>Interview status</td>
                            <td>
                                {{ $assign_job->interview_status ?? 'N/A' }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#permission').click(function() {
            swal({
                title: "Are you sure?",
                text: "To change the status.",
                type: "warning",
                confirmButtonText: "YES",
                showCancelButton: true
            }).then((result) => {
                if (result.value) {
                    // Perform AJAX request to the route
                    var route = $('#permission').data('route');
                    $.ajax({
                        url: route,
                        type: 'GET', // or 'POST' depending on your route definition
                        success: function(response) {
                            toastr.success('Permission granted successfully');
                            $('#offcanvasEdit').offcanvas('hide');
                            var candidate_id = "{{ $candidate->id }}";
                            $(".candidate-new-" + candidate_id).html(response.view);
                            // Optionally, redirect to a specific location
                            // window.location = response.redirect_url;
                        },
                        error: function(xhr, status, error) {
                            // Handle error if needed
                            console.error(error);
                            swal('Error', 'Unable to process your request',
                                'error');
                        }
                    });
                } else if (result.dismiss === 'cancel') {
                    swal('Cancelled', 'Your stay here :)', 'error');
                }
            });
        });
    });
</script>
<script>
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

            $('#candidate-form').html(`   <tbody class="candidate-form-new">
                    <tr>
                    <td>Enter By</td>
                            <td>
                            <div class="form-group">
                                <input class="form-control uppercase-text" type="text" placeholder="Enter by" aria-label="default input example" value="{{ $candidate->enterBy->full_name ?? '' }}" readonly>
                            </div>
                            </td>

                            <td>Status</td>
                            <td>
                            <select name="cnadidate_status_id" class="form-select uppercase-text" id="">
                                <option value="">Select A Status</option>
                                @foreach ($candidate_statuses as $status)
                                <option value="{{ $status->id }}" {{ $candidate->cnadidate_status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                                </option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="cnadidate_status_id_msg"></span>
                            </td>
                            <td>Mode of Registration</td>
                            <td>
                                <select name="mode_of_registration" class="form-select uppercase-text" id="">
                                        <option value="">Select Type</option>
                                        <option value="CALLING" {{ $candidate->mode_of_registration == 'CALLING' ? 'selected' : '' }}>CALLING</option>
                                        <option value="WALK-IN" {{ $candidate->mode_of_registration == 'WALK-IN' ? 'selected' : '' }}>WALK-IN</option>
                                    </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Source</td>
                            <td>
                                <select name="source" class="form-select uppercase-text" id="">
                                            <option value="">Select Type</option>
                                            @foreach ($sources as $source)
                                            <option value="{{ $source->name }}" {{ $candidate->source == $source->name ? 'selected' : '' }}>
                                                {{ $source->name }}
                                            </option>
                                        @endforeach
                                        </select>
                        </td>
                        <td>Last Updated Date</td>
                            <td>
                            <div class="form-group">
                                <input type="date" class="form-control uppercase-text" id="" value="{{ date('Y-m-d', strtotime($candidate->updated_at)) ?? '' }}" name="last_update_date" placeholder="Last Updated Date" readonly>
                            </div>
                            </td>
                            <td>Referred By</td>
                            <td>
                            <input type="text" class="form-control uppercase-text" id="" value=" @if ($candidate->referred_by_id != null) {{ $candidate->referredBy->full_name }}@else{{ $candidate->referred_by }} @endif" placeholder="Referred By" readonly>
                            </select>
                            </td>
                    </tr>

                        <tr>
                            <td>Full Name</td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate->full_name ?? '' }}" name="full_name" placeholder="Full Name">
                                <span class="text-danger" id="full_name_msg"></span>
                            </div>
                            </td>
                            <td>Gender</td>
                            <td>
                            <select name="gender" class="form-select uppercase-text" id="">
                                <option value="">Select Gender</option>
                                <option value="MALE" {{ $candidate->gender == 'MALE' ? 'selected' : '' }}> MALE </option>
                                <option value="FEMALE" {{ $candidate->gender == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                                <option value="OTHER" {{ $candidate->gender == 'OTHER' ? 'selected' : '' }}>OTHER</option>
                            </select>
                            </td>
                            <td>DOB</td>
                            <td>
                            <div class="form-group date-btn">
                                <input type="text" class="form-control uppercase-text datepicker" id="dob"
                                    value="{{ \Carbon\Carbon::parse($candidate->date_of_birth)->format('d-m-Y') ?? '' }}"
                                    name="dob" max="{{ date('Y-m-d') }}" placeholder="dd-mm-yyyy">
                                <span class="text-danger" id="date_of_birth_msg"></span>
                            </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Age</td>
                            <td>
                                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate->date_of_birth != null ? \Carbon\Carbon::parse($candidate->date_of_birth)->age : 'N/A' }}" name="age" placeholder="Age" readonly>
                            </td>
                            <td>Education</td>
                            <td>
                                <select name="education" class="form-select uppercase-text" id="">
                                    <option value="">Select Type</option>
                                    <option value="5TH PASS" {{ $candidate->education == '5TH PASS' ? 'selected' : '' }}>5TH PASS</option>
                                    <option value="8TH PASS" {{ $candidate->education == '8TH PASS' ? 'selected' : '' }}>8TH PASS</option>
                                    <option value="10TH PASS" {{ $candidate->education == '10TH PASS' ? 'selected' : '' }}>10TH PASS
                                    </option>
                                    <option value="HIGHER SECONDARY"
                                        {{ $candidate->education == 'HIGHER SECONDARY' ? 'selected' : '' }}>HIGHER SECONDARY
                                        </option>
                                    <option value="GRADUATES" {{ $candidate->education == 'GRADUATES' ? 'selected' : '' }}>GRADUATES</option>
                                    <option value="MASTERS" {{ $candidate->education == 'MASTERS' ? 'selected' : '' }}>MASTERS</option>
                                </select>
                            </td>
                            <td>Other Education</td>
                            <td>
                            <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate->other_education ?? '' }}" name="other_education" placeholder="Other Education">
                            </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Alternate Contact No.</td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control uppercase-text" id="" name="alternate_contact_no" value="{{ $candidate->alternate_contact_no ?? '' }}" placeholder="Alternate Contact No.">
                                <span class="text-danger" id="alternate_contact_no_msg"></span>
                                </div>
                            </td>
                            <td>Whatsapp No.</td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control uppercase-text" id="" name="whatapp_no" value="{{ $candidate->whatapp_no ?? '' }}" placeholder="Whats App No.">
                                <span class="text-danger" id="whatapp_no_msg"></span>
                                </div>
                            </td>
                            <td>Passport Number.</td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control uppercase-text" id="" name="passport_number"
                                    value="{{ $candidate->passport_number ?? '' }}" placeholder="">
                                <span class="text-danger" id="passport_number_msg"></span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Email ID</td>
                            <td>
                            <div class="form-group">
                                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate->email ?? '' }}" name="email" placeholder="Email ID" >
                                <span class="text-danger" id="email_msg"></span>
                                </div>
                            </td>
                            <td>City</td>
                            <td>
                                <select name="city" class="form-select new_select2 uppercase-text" id="">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ $candidate->city == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>Religion</td>
                            <td>
                                <select name="religion" class="form-select uppercase-text" id="">
                                    <option value="">Select Religion</option>
                                    <option value="HINDU" {{ $candidate->religion == 'HINDU' ? 'selected' : '' }}>Hindu</option>
                                    <option value="ISLAM" {{ $candidate->religion == 'ISLAM' ? 'selected' : '' }}>Islam</option>
                                    <option value="CHRISTIAN" {{ $candidate->religion == 'CHRISTIAN' ? 'selected' : '' }}>Christian</option>
                                    <option value="SIKH" {{ $candidate->religion == 'SIKH' ? 'selected' : '' }}>Sikh</option>
                                    <option value="BUDDHIST" {{ $candidate->religion == 'BUDDHIST' ? 'selected' : '' }}>Buddhist</option>
                                    <option value="JAIN" {{ $candidate->religion == 'JAIN' ? 'selected' : '' }}>Jain</option>
                                    <option value="OTHER" {{ $candidate->religion == 'OTHER' ? 'selected' : '' }}>Other</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>ECR Type</td>
                            <td>
                            <select name="ecr_type" class="form-select uppercase-text" id="">
                                <option value="">Select ECR</option>
                                <option value="ECR" {{ $candidate->ecr_type == 'ECR' ? 'selected' : '' }}>ECR</option>
                                <option value="ECNR" {{ $candidate->ecr_type == 'ECNR' ? 'selected' : '' }}>ECNR</option>
                            </select>
                            </td>
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
                        </tr>

                        <tr>
                            <td>English Speak</td>
                            <td>
                            <select name="english_speak" class="form-select uppercase-text" id="">
                                <option value="">English Speak</option>
                                <option value="BASIC" {{ strtoupper($candidate->english_speak) == 'BASIC' ? 'selected' : '' }}>BASIC</option>
                                    <option value="GOOD" {{ strtoupper($candidate->english_speak) == 'GOOD' ? 'selected' : '' }}>GOOD</option>
                                    <option value="POOR" {{ strtoupper($candidate->english_speak) == 'POOR' ? 'selected' : '' }}>POOR</option>
                                    <option value="NO" {{ strtoupper($candidate->english_speak) == 'NO' ? 'selected' : '' }}>NO</option>
                            </select>
                            </td>
                             <td>Arabic Speak</td>
                            <td>
                            <select name="arabic_speak" class="form-select uppercase-text" id="">
                                <option value="">Arabic Speak</option>
                                <option value="BASIC" {{ strtoupper($candidate->arabic_speak) == 'BASIC' ? 'selected' : '' }}>BASIC</option>
                                    <option value="GOOD" {{ strtoupper($candidate->arabic_speak) == 'GOOD' ? 'selected' : '' }}>GOOD</option>
                                    <option value="POOR" {{ strtoupper($candidate->arabic_speak) == 'POOR' ? 'selected' : '' }}>POOR</option>
                                    <option value="NO" {{ strtoupper($candidate->arabic_speak) == 'NO' ? 'selected' : '' }}>NO</option>
                            </select>
                            </td>
                            <td>Return</td>
                            <td>
                            <select name="return" class="form-select uppercase-text" id="">
                                <option value="">Return</option>
                                <option value="1" {{ $candidate->return == '1' ? 'selected' : '' }}>YES</option>
                                <option value="0" {{ $candidate->return == '0' ? 'selected' : '' }}>NO</option>
                            </select>
                            </td>
                        </tr>


                        <tr class="position_applied_1">
                                @if ($candidate->positionAppliedFor1)
                                    @if ($candidate->positionAppliedFor1()->where('is_active', 1)->count() > 0)
                                    <td>Position Applied For(1) <span><a href="javascript:void(0);"
                                                    class="position_applied_for_1">Other</a></span></td>
                            <td colspan="5">
                                        <select name="position_applied_for_1" class="form-select uppercase-text new_select2 positionAppliedFor1" id="">
                                            <option value="">Select Position</option>
                                            @foreach ($candidate_positions as $item)
                                                <option value="{{ $item['id'] }}"
                                                    {{ $candidate->position_applied_for_1 == $item['id'] ? 'selected' : '' }}>
                                                    {{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <span class="text-danger" id="position_applied_for_1_msg"></span>
                                    </td>
                                    @else
                                    <td>Position Applied For(1) <span><a href="javascript:void(0);"
                                                    class="position_applied_for_1">List</a></span></td>
                            <td colspan="5">
                                        <input type="text" class="form-control uppercase-text" id=""
                                            value="{{ $candidate->positionAppliedFor1->name ?? '' }}" name="position_applied_for_1"
                                            placeholder="">
                                        </td>
                                        <span class="text-danger" id="position_applied_for_1_msg"></span>
                                    </td>
                                    @endif

                                @else
                                <td>Position Applied For(1) <span><a href="javascript:void(0);"
                                                    class="position_applied_for_1">Other</a></span></td>
                            <td colspan="5">
                                    <select name="position_applied_for_1" class="form-select uppercase-text new_select2 positionAppliedFor1" id="">
                                        <option value="">Select Position</option>
                                        @foreach ($candidate_positions as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ $candidate->position_applied_for_1 == $item['id'] ? 'selected' : '' }}>
                                                {{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="position_applied_for_1_msg"></span>
                                    </td>

                                    </td>
                                @endif

                        </tr>
                        @if ($candidate->positionAppliedFor1)
                            @if ($candidate->positionAppliedFor1()->where('is_active', 1)->count() > 0)
                            <tr class="specialisation_1">
                            <td>Specialisation for Position (1)</td>
                            <td colspan="5">
                                <input type="text"
                                            value="{{ $candidate->specialisation_1 ?? '' }}" class="form-control uppercase-text"
                                            name="specialisation_1">
                            </td>
                        </tr>
                            @endif
                        @endif
                        <tr class="position_applied_2">

                                @if ($candidate->positionAppliedFor2)
                                    @if ($candidate->positionAppliedFor2()->where('is_active', 1)->count() > 0)
                                    <td>Position Applied For(2)<span><a href="javascript:void(0);"
                                                    class="position_applied_for_2">Other</a></span></td>
                            <td colspan="5">
                                        <select name="position_applied_for_2" class="form-select uppercase-text new_select2 positionAppliedFor2" id="">
                                            <option value="">Select Position</option>
                                            @foreach ($candidate_positions as $item)
                                                <option value="{{ $item['id'] }}"
                                                    {{ $candidate->position_applied_for_2 == $item['id'] ? 'selected' : '' }}>
                                                    {{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                            </td>
                                    @else
                                    <td>Position Applied For(2)<span><a href="javascript:void(0);"
                                                    class="position_applied_for_2">List</a></span></td>
                            <td colspan="5">
                                        <input type="text" class="form-control uppercase-text" id=""
                                            value="{{ $candidate->positionAppliedFor2->name ?? '' }}" name="position_applied_for_2"
                                            placeholder="">
                                    @endif
                                </td>
                            </td>
                                @else
                                <td>Position Applied For(2)<span><a href="javascript:void(0);"
                                                    class="position_applied_for_2">Other</a></span></td>
                            <td colspan="5">
                                    <select name="position_applied_for_2" class="form-select uppercase-text new_select2 positionAppliedFor2" id="">
                                        <option value="">Select Position</option>
                                        @foreach ($candidate_positions as $item)
                                            <option value="{{ $item['id'] }}"
                                                {{ $candidate->position_applied_for_2 == $item['id'] ? 'selected' : '' }}>
                                                {{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </td>
                                @endif

                        </tr>
                        @if ($candidate->positionAppliedFor2)
                            @if ($candidate->positionAppliedFor2()->where('is_active', 1)->count() > 0)
                            <tr class="specialisation_2">
                            <td>Specialisation for Position (2)</td>
                            <td colspan="5">
                                <input type="text"
                                            value="{{ $candidate->specialisation_2 ?? '' }}" class="form-control uppercase-text"
                                            name="specialisation_2">
                            </td>
                        </tr>
                            @endif
                        @endif
                        <tr class="position_applied_3">

                                @if ($candidate->positionAppliedFor3)
                                        @if ($candidate->positionAppliedFor3()->where('is_active', 1)->count() > 0)
                                        <td>Position Applied For(3) <span><a href="javascript:void(0);"
                                                        class="position_applied_for_3">Other</a></span></td>
                            <td colspan="5">
                                            <select name="position_applied_for_3" class="form-select uppercase-text new_select2 positionAppliedFor3" id="">
                                                <option value="">Select Position</option>
                                                @foreach ($candidate_positions as $item)
                                                    <option value="{{ $item['id'] }}"
                                                        {{ $candidate->position_applied_for_3 == $item['id'] ? 'selected' : '' }}>
                                                        {{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                </td>
                                        @else
                                        <td>Position Applied For(3) <span><a href="javascript:void(0);"
                                                        class="position_applied_for_3">List</a></span></td>
                            <td colspan="5">
                                            <input type="text" class="form-control uppercase-text" id=""
                                                value="{{ $candidate->positionAppliedFor3->name ?? '' }}" name="position_applied_for_3"
                                                placeholder="">
                                            </td>
                                </td>
                                        @endif
                                    @else
                                    <td>Position Applied For(3) <span><a href="javascript:void(0);"
                                                        class="position_applied_for_3">Other</a></span></td>
                            <td colspan="5">
                                        <select name="position_applied_for_3" class="form-select uppercase-text new_select2 positionAppliedFor3" id="">
                                            <option value="">Select Position</option>
                                            @foreach ($candidate_positions as $item)
                                                <option value="{{ $item['id'] }}"
                                                    {{ $candidate->position_applied_for_3 == $item['id'] ? 'selected' : '' }}>
                                                    {{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </td>
                                    @endif

                        </tr>
                        @if ($candidate->positionAppliedFor3)
                            @if ($candidate->positionAppliedFor3()->where('is_active', 1)->count() > 0)
                            <tr class="specialisation_3">
                            <td>Specialisation for Position (3)</td>
                            <td colspan="5">
                                <input type="text"
                                            value="{{ $candidate->specialisation_3 ?? '' }}" class="form-control uppercase-text"
                                            name="specialisation_3">
                            </td>
                        </tr>
                            @endif
                        @endif


                        <tr>
                            <td>Indian Experience (If any?)</td>
                            <td>
                                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate->indian_exp ?? '' }}"
                                    name="indian_exp" placeholder="">
                                    <span class="text-danger" id="indian_exp_msg"></span>
                            </td>
                            <td>Abroad Experience (If any?)</td>
                            <td>
                                <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate->abroad_exp ?? '' }}"
                                    name="abroad_exp" placeholder="">
                                    <span class="text-danger" id="abroad_exp_msg"></span>
                            </td>
                            <td>Last Call Status</td>
                            <td>
                                <select name="call_status" class="form-select uppercase-text" id="">
                                    <option value="">Select Call Status</option>
                                    @foreach (Position::getCallStatus() as $item)
                                        <option value="{{ $item }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="call_status_msg"></span>
                            </td>
                        </tr>

                        <tr>
                            <td>Remarks</td>
                            <td colspan="5">
                            <div class="form-group">
                                <textarea class="form-control uppercase-text" id="" rows="3" name="remark" placeholder="Remark"></textarea>
                                <span class="text-danger" id="remark_msg"></span>
                            </div>
                            </td>
                        </tr></tbody>`)

            $('.new_select2').each(function() {
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            })
            $(function() {
                $('.datepicker').datepicker({
                    uiLibrary: 'bootstrap5',
                    format: 'dd-mm-yyyy',
                    maxDate: new Date()
                });
            });


        });
        $(document).on("click", '#cross-button', function(e) {

            $(this).html(``);
            $(".see-more-container").hide();
            $('#submit-button').html(``)
            $('#open-input').html(
                ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
            $('#candidate-form').html(`<tbody > <tr>
                                        <td>Enter By</td>
                                        <td>{{ $candidate->enterBy->full_name ?? '' }}
                                        </td>
                                        <td>Status</td>
                                        <td>{{ $candidate->candidateStatus->name ?? '' }}

                                        </td>
                                        <td>Mode of Registration</td>
                                        <td>{{ $candidate->mode_of_registration ?? '' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Source</td>
                                        <td>{{ $candidate->source ?? '' }}

                                        </td>
                                        <td>Last Updated Date</td>
                                        <td>{{ $candidate->updated_at != null ? date('d.m.Y', strtotime($candidate->updated_at)) : 'N/A' }}

                                        </td>
                                        <td>Referred By</td>
                                        <td>
                                            @if ($candidate->referred_by_id != null)
                                                {{ $candidate->referredBy->full_name }}
                                            @else
                                                {{ $candidate->referred_by }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Full Name</td>
                                        <td>{{ $candidate->full_name ?? 'N/A' }}
                                        </td>
                                         <td>Gender</td>
                                        <td>{{ $candidate->gender }}

                                        </td>
                                        <td>DOB</td>
                                        <td>{{ $candidate->date_of_birth != null ? date('d.m.Y', strtotime($candidate->date_of_birth)) : 'N/A' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Age</td>
                                        <td>{{ $candidate->date_of_birth != null ? \Carbon\Carbon::parse($candidate->date_of_birth)->age : 'N/A' }}

                                        </td>
                                        <td>Education</td>
                                        <td>{{ $candidate->education }}

                                        </td>
                                        <td>Other Education</td>
                                        <td>{{ $candidate->other_education ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Alternate Contact No.</td>
                                        <td>{{ $candidate->alternate_contact_no ?? 'N/A' }}

                                        </td>
                                        <td>Whatsapp No.</td>
                                        <td>{{ $candidate->whatapp_no ?? 'N/A' }}

                                        </td>
                                        <td>Passport Number.</td>
                                        <td>{{ $candidate->passport_number ?? 'N/A' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Email ID</td>
                                        <td>{{ $candidate->email ?? 'N/A' }}

                                        </td>
                                        <td>City</td>
                                        <td>{{ $candidate->city ?? 'N/A' }}
                                        </td>
                                        <td>Religion</td>
                                        <td>{{ $candidate->religion ?? 'N/A' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>ECR Type</td>
                                        <td>{{ $candidate->ecr_type ?? 'N/A' }}

                                        </td>
                                        <td>Indidan Driving License </td>
                                        <td> @if ($candidate->candidateIndianLicence()->count() > 0)
                                                @foreach ($candidate->candidateIndianLicence as $key => $value)
                                                <span
                                                                    class="badge bg-primary rounded-pill">
                                                    {{ $value->licence_name ?? 'N/A' }}
                                                    </span>
                                                @endforeach
                                                @else
                                             {{ 'N/A' }}
                                            @endif
                                        </td>
                                        <td>Gulf Driving License </td>
                                        <td> @if ($candidate->candidateGulfLicence()->count() > 0)
                                                @foreach ($candidate->candidateGulfLicence as $key => $value)
                                                <span
                                                                    class="badge bg-primary rounded-pill">
                                                    {{ $value->licence_name ?? 'N/A' }}
                                                    </span>
                                                @endforeach
                                                @else
                                                 {{ 'N/A' }}
                                            @endif

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>English Speak</td>
                                        <td>{{ $candidate->english_speak ?? 'N/A' }}
                                        </td>
                                        <td>Arabic Speak</td>
                                        <td>{{ $candidate->arabic_speak ?? 'N/A' }}

                                        </td>
                                        <td>Return</td>
                                        <td>{{ $candidate->return == 1 ? 'YES' : 'N0' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Position Applied For(1)</td>
                                        <td>{{ $candidate->positionAppliedFor1->name ?? 'N/A' }}
                                        </td>
                                        <td>Specialisation for Position (1)</td>
                                        <td>{{ $candidate->specialisation_1 ?? 'N/A' }}
                                        </td>
                                        <td>Position Applied For(2)</td>
                                        <td>{{ $candidate->positionAppliedFor2->name ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Specialisation for Position (2)</td>
                                        <td>{{ $candidate->specialisation_2 ?? 'N/A' }}
                                        </td>
                                        <td>Position Applied For(3)</td>
                                        <td>{{ $candidate->positionAppliedFor3->name ?? 'N/A' }}
                                        </td>
                                        <td>Specialisation for Position (3)</td>
                                        <td>{{ $candidate->specialisation_3 ?? 'N/A' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Indian Experience (If any?)</td>
                                        <td>{{ $candidate->indian_exp ?? 'N/A' }}
                                        </td>
                                        <td>Abroad Experience (If any?)</td>
                                        <td>{{ $candidate->abroad_exp ?? 'N/A' }}

                                        </td>
                                        <td>Last Call Status</td>
                                        <td>{{ $candidate->lastCandidateActivity->call_status ?? 'N/A' }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Remarks</td>
                                        <td colspan="5">{{ $candidate->lastCandidateActivity->remarks ?? 'N/A' }}

                                        </td>
                                    </tr></tbody>`);
            var visibleRows = 5;
            showRows(visibleRows);

            // Handle the "See More" button click
            $(document).on("click", '#seeMoreBtn', function(e) {
                e.preventDefault();
                // Show additional rows (e.g., 5 more)
                visibleRows += 28;
                showRows(visibleRows);
            });

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
<script>
    $(document).ready(function() {
        // Show the first 5 rows initially
        var visibleRows = 5;
        showRows(visibleRows);

        // Handle the "See More" button click
        $(document).on("click", '#seeMoreBtn', function(e) {
            e.preventDefault();
            // Show additional rows (e.g., 5 more)
            visibleRows += 28;
            showRows(visibleRows);
        });

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

        // let toasterMessageShown = false;
        var ajaxCallAllowed = true;
        $(document).on('submit', '#candidate-edit-form', function(e) {
            e.preventDefault();

            if (!ajaxCallAllowed) {
                return;
            }

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    toastr.success('Candidate details updated successfully');
                    $('#offcanvasEdit').offcanvas('hide');
                    var candidate_id = "{{ $candidate->id }}";
                    console.log(candidate_id);
                    $(".candidate-new-" + candidate_id).html(response.view);
                    ajaxCallAllowed = false;
                },
                error: function(xhr) {
                    // Handle errors (e.g., display validation errors)
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        toastr.error(value);
                    });
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.position_applied_for_1', function() {

            var type = $(this).text();
            // alert(type);
            if (type == 'Other') {
                $('.position_applied_1').html(`<td>Position Applied For(1) <span><a href="javascript:void(0);"
                                class="position_applied_for_1">List</a></span></td> <td colspan="5"> <input type="text"
                                class="form-control uppercase-text" id="" value="{{ $candidate->positionAppliedFor1->name ?? '' }}"
                                name="position_applied_for_1" placeholder=""> </td>`);
                if ($('.specialisation_1').length) {
                    $('.specialisation_1').remove();
                }
            } else {
                $('.position_applied_1').html(
                    `<td>Position Applied For(1) <span><a href="javascript:void(0);"
                                class="position_applied_for_1">Other</a></span></td> <td colspan="5"> <select
                                name="position_applied_for_1" class="form-select uppercase-text new_select2 positionAppliedFor1" id=""> <option
                                    value="">Select Position</option> @foreach ($candidate_positions as $item)
                                <option value="{{ $item['id'] }}"
                                    {{ $candidate->position_applied_for_1 == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}</option> @endforeach </select> </td>`
                );
            }
        });

        $(document).on('click', '.position_applied_for_2', function() {

            var type = $(this).text();
            // alert(type);
            if (type == 'Other') {
                $('.position_applied_2').html(`<td>Position Applied For(2) <span><a href="javascript:void(0);"
                                class="position_applied_for_2">List</a></span></td> <td colspan="5"> <input type="text"
                                class="form-control uppercase-text" id="" value="{{ $candidate->positionAppliedFor2->name ?? '' }}"
                                name="position_applied_for_2" placeholder=""> </td>`);
                if ($('.specialisation_2').length) {
                    $('.specialisation_2').remove();

                }
            } else {
                $('.position_applied_2').html(
                    `<td>Position Applied For(2) <span><a href="javascript:void(0);"
                                class="position_applied_for_2">Other</a></span></td> <td colspan="5"> <select
                                name="position_applied_for_2" class="form-select uppercase-text new_select2 positionAppliedFor2" id=""> <option
                                    value="">Select Position</option> @foreach ($candidate_positions as $item)
                                <option value="{{ $item['id'] }}"
                                    {{ $candidate->position_applied_for_2 == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}</option> @endforeach </select> </td>`
                );
            }
        });

        $(document).on('click', '.position_applied_for_3', function() {

            var type = $(this).text();
            // alert(type);
            if (type == 'Other') {
                $('.position_applied_3').html(`<td>Position Applied For(3) <span><a href="javascript:void(0);"
                                class="position_applied_for_3">List</a></span></td> <td colspan="5"> <input type="text"
                                class="form-control uppercase-text" id="" value="{{ $candidate->positionAppliedFor3->name ?? '' }}"
                                name="position_applied_for_3" placeholder=""> </td>`);
                if ($('.specialisation_3').length) {
                    $('.specialisation_3').remove();

                }
            } else {
                $('.position_applied_3').html(
                    `<td>Position Applied For(3) <span><a href="javascript:void(0);"
                                class="position_applied_for_3">Other</a></span></td> <td colspan="5"> <select
                                name="position_applied_for_3" class="form-select uppercase-text new_select2 positionAppliedFor3" id=""> <option
                                    value="">Select Position</option> @foreach ($candidate_positions as $item)
                                <option value="{{ $item['id'] }}"
                                    {{ $candidate->position_applied_for_3 == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}</option> @endforeach </select> </td>`
                );
            }
        });

        $(document).on('change', '.positionAppliedFor1', function() {
            // Get the selected value
            var selectedPosition = $(this).val();

            // Check if a position is selected
            if (selectedPosition !== '') {
                // Create a new div with the selected position's name
                var newTR =
                    '<tr class="specialisation_1"><td>Specialisation for Position (1)</td><td colspan="5"><input type="text" class="form-control uppercase-text" name="specialisation_1" placeholder=""></td></tr>';
                // Append the new div to the container
                if (!$('.specialisation_1').length) {
                    $('.position_applied_1').after(newTR);
                }
            } else {
                // Remove the tr if no position is selected
                $('.specialisation_1').remove();

            }
        });

        $(document).on('change', '.positionAppliedFor2', function() {
            // Get the selected value
            var selectedPosition = $(this).val();

            // Check if a position is selected
            if (selectedPosition !== '') {
                // Create a new div with the selected position's name
                var newTR =
                    '<tr class="specialisation_2"><td>Specialisation for Position (2)</td><td colspan="5"><input type="text" class="form-control uppercase-text" name="specialisation_2" placeholder=""></td></tr>';
                // Append the new div to the container
                if (!$('.specialisation_2').length) {
                    $('.position_applied_2').after(newTR);
                }
            } else {
                // Remove the tr if no position is selected
                $('.specialisation_2').remove();

            }
        });

        $(document).on('change', '.positionAppliedFor3', function() {
            // Get the selected value
            var selectedPosition = $(this).val();

            // Check if a position is selected
            if (selectedPosition !== '') {
                // Create a new div with the selected position's name
                var newTR =
                    '<tr class="specialisation_3"><td>Specialisation for Position (3)</td><td colspan="5"><input type="text" class="form-control uppercase-text" name="specialisation_3" placeholder=""></td></tr>';
                // Append the new div to the container
                if (!$('.specialisation_3').length) {
                    $('.position_applied_3').after(newTR);
                }
            } else {
                // Remove the tr if no position is selected
                $('.specialisation_3').remove();

            }
        });
    });
</script>
<script>
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
                                            <td>Company </td>
                                            <td>
                                            <div class="form-group">
                                                <select name="company_id" class="form-select uppercase-text company_id" id="company_id">
                                                <option value="">Select Company</option>
                                                @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">
                                                {{ $company->company_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="company_id_job_msg"></span>
                                            </div>
                                            </td>

                                            <td>Job Title</td>
                                            <td>
                                            <select name="interview_id" class="form-select uppercase-text job_id" id="interview_id">
                                                <option value="">Select A Job Title</option>
                                            </select>
                                            <span class="text-danger" id="interview_id_job_msg"></span>
                                            </td>

                                            <td>Interview Status</td>
                                            <td>
                                            <select name="interview_status" class="form-select uppercase-text" id="interview_status">
                                                <option value="">Select A Interview Status</option>
                                                <option value="Interested">Interested</option>
                                                <option value="Not-Interested">Not-Interested</option>
                                            </select>
                                            <span class="text-danger" id="interview_status_job_msg"></span>
                                            </td>
                                        </tr>

                                        </tbody>`);
    });

    $(document).on("click", '#cross-button-job', function(e) {

        $(this).html(``);
        $('#submit-button-job').html(``)
        $('#open-job-input').html(
            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
        $('#candidate-form-job').html(`<tbody>
                                    <tr>
                                        <td>Assigned By</td>
                                        <td>{{ $assign_job->user->full_name ?? 'N/A' }}
                                        </td>
                                        <td>Company</td>
                                        <td>{{ $assign_job->company->company_name ?? 'N/A' }}
                                        </td>
                                        <td>Job Title</td>
                                        <td>{{ $assign_job->job->job_name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Job Location</td>
                                        <td>{{ $assign_job->job->address ?? 'N/A' }}
                                        </td>
                                        <td>Job Position</td>
                                        <td>{{ $assign_job->job->candidatePosition->name ?? 'N/A' }}
                                        </td>
                                        <td>Interview Status</td>
                                        <td>{{ $assign_job->interview_status ?? 'N/A' }}</td>
                                    </tr>

                                </tbody>`);

    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('change', '.company_id', function() {
            var company_id = $(this).val();
            $.ajax({
                url: "{{ route('candidates.getJobs') }}",
                type: 'GET',
                data: {
                    company_id: company_id
                },
                success: function(response) {
                    $('.job_id').html('');
                    $('.job_id').html(response.interviews);
                }
            });
        });
        $(document).on('submit', '#candidate-job-create-form', function(e) {
            e.preventDefault();

            var formData = new FormData($(this)[0]);
            var formElement = $(this);

            swal({
                title: 'Are you sure?',
                text: "You want to assign this job to the candidate!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: formElement.attr('action'),
                        type: formElement.attr('method'),
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == true) {

                                toastr.success('Job assign successfully');
                                $('#offcanvasEdit').offcanvas('hide');
                                var candidate_id = "{{ $candidate->id }}";
                                console.log(candidate_id);
                                $(".candidate-new-" + candidate_id).html(response
                                    .view);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            // Handle errors (e.g., display validation errors)
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                            });
                        }
                    });
                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            });
        });
    });
</script>
@endif
