<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdits"
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
                        <h4>{{ $candidate_job_detail->full_name ?? 'N/A'}}</h4>
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
                        <p>WhatsApp No:</p>
                        <h4>{{ $candidate_job_detail->whatapp_no ?? 'N/A' }}</h4>
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
                        <p>Job Status</p>
                        <div class="round_staus active">
                            {{ $candidate_job_detail->job_status ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('jobs.candidate-details.update', $candidate_job_detail->id) }}" method="POST" id="candidate-edit-form">
        @method('PUT')
        @csrf
        <div class="candidate_details">
            <div class="can-div d-flex justify-content-between align-items-center">
                <div class="can-head">
                    <h4>Candidate Details</h4>
                </div>
                <div class="edit-1-btn d-flex align-items-center">

                    <div class="edit-2 cross-red" id="cross-button">

                    </div>
                    <div class="edit-2 m-lg-1" id="submit-button">

                    </div>
                    <div class="edit-1" id="open-input">
                        @can('Edit Job')
                            <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="candidate_form candidate_edit_form">
                <div class="table-responsive" id="tableContainer">
                    <table class="table" id="candidate-form">

                        <tbody>
                            <tr>
                                <td>Full Name</td>
                                <td>{{ $candidate_job_detail->full_name ?? 'N/A'}}</td>
                                <td>Email</td>
                                <td>{{ $candidate_job_detail->email ?? 'N/A'}}</td>
                                <td>Gender</td>
                                <td>{{ $candidate_job_detail->gender ?? 'N/A'}}</td>

                            </tr>
                            <tr>
                                <td>Date of birth</td>
                                <td>{{ $candidate_job_detail->date_of_birth ?? 'N/A'}}</td>
                                <td>whatapp_no</td>
                                <td>{{ $candidate_job_detail->whatapp_no ?? 'N/A'}}</td>
                                <td>Alternate Contact No</td>
                                <td>{{ $candidate_job_detail->alternate_contact_no ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>Religion</td>
                                <td>{{ $candidate_job_detail->religion ?? 'N/A'}}</td>
                                <td>City</td>
                                <td>{{ $candidate_job_detail->city ?? 'N/A'}}</td>
                                <td>Address</td>
                                <td>{{ $candidate_job_detail->address ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>Education</td>
                                <td>{{ $candidate_job_detail->education ?? 'N/A'}}</td>
                                <td>Other Education</td>
                                <td>{{ $candidate_job_detail->other_education ?? 'N/A'}}</td>
                                <td>Passport Number</td>
                                <td>{{ $candidate_job_detail->passport_number ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>English_speak</td>
                                <td>{{ $candidate_job_detail->english_speak ?? 'N/A'}}</td>
                                <td>Arabic Speak</td>
                                <td>{{ $candidate_job_detail->arabic_speak ?? 'N/A'}}</td>
                                <td>Assign By </td>
                                <td>@if ($candidate_job_detail->assign_by_id != null)
                                        {{ $candidate_job_detail->assignBy->first_name.' '.$candidate_job_detail->assignBy->last_name }}
                                    @else
                                        {{ $candidate_job_detail->assignBy ?? 'N/A' }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Job Title</td>
                                <td>@if ($candidate_job_detail->jobTitle != null)
                                    {{ $candidate_job_detail->jobTitle->job_name ?? 'N/A'}}
                                    @else
                                        {{ $candidate_job_detail->jobTitle ?? 'N/A' }}
                                    @endif
                                </td>
                                <td>Job Position</td>
                                <td>@if ($candidate_job_detail->jobTitle->candidatePosition != null)
                                    {{ $candidate_job_detail->jobTitle->candidatePosition->name ?? 'N/A'}}
                                    @else
                                        {{ $candidate_job_detail->jobTitle ?? 'N/A' }}
                                    @endif
                                </td>
                                <td>Job Location</td>
                                <td>{{ $candidate_job_detail->job_location ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <td>Indian Driving Licence</td>
                                <td>@if ($indian_driving_license != null)
                                    @foreach($indian_driving_license as $key => $value)
                                        {{ $value ?? 'N/A' }},
                                    @endforeach
                                    @else
                                        {{ 'N/A' }}
                                    @endif
                                </td>
                                <td>Gulf Driving Licence</td>
                                <td>@if ($gulf_driving_license != null)
                                    @foreach($gulf_driving_license as $key => $value)
                                        {{ $value ?? 'N/A' }},
                                    @endforeach
                                    @else
                                        {{ 'N/A' }}
                                    @endif
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


    <form action="{{ route('jobs.job-details.update', $candidate_job_detail->id) }}" method="POST"
        id="candidate-job-edit-form">
        @method('PUT')
        @csrf
        <div class="candidate_details">
            <div class="can-div d-flex justify-content-between align-items-center">
                <div class="can-head">
                    <h4>Job Details</h4>
                </div>
                <div class="edit-1-btn d-flex align-items-center">

                    <div class="edit-2 cross-red" id="cross-button-job">

                    </div>
                    <div class="edit-2 m-lg-1" id="submit-button-job">

                    </div>
                    <div class="edit-1" id="open-job-input">
                        @can('Edit Job')
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
                                <td>Date of Interview</td>
                                <td>{{ $candidate_job_detail->date_of_interview ?? 'N/A'}}</td>
                                <td>Date of Selection</td>
                                <td>{{ $candidate_job_detail->date_of_selection ?? 'N/A'}}</td>
                                <td>Mode of Selection</td>
                                <td>{{ $candidate_job_detail->mode_of_selection ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>Interview Location</td>
                                <td>{{ $candidate_job_detail->interview_location ?? 'N/A'}}</td>
                                <td>Client Remarks</td>
                                <td>{{ $candidate_job_detail->client_remarks ?? 'N/A'}}</td>
                                <td>Other Remarks</td>
                                <td>{{ $candidate_job_detail->other_remarks ?? 'N/A'}}</td>
                            </tr>
                            <tr>

                                <td>Sponsor</td>
                                <td>{{ $candidate_job_detail->sponsor ?? 'N/A'}}</td>
                                <td>Country</td>
                                <td>{{ $candidate_job_detail->country ?? 'N/A'}}</td>
                                <td>Salary</td>
                                <td>{{ $candidate_job_detail->salary ?? 'N/A'}}</td>
                            </tr>
                            <tr>

                                <td>Food Allowance</td>
                                <td>{{ $candidate_job_detail->food_allowance ?? 'N/A'}}</td>
                                <td>Contract Duration</td>
                                <td>{{ $candidate_job_detail->contract_duration ?? 'N/A'}}</td>

                            </tr>
                            <tr>
                                <td>Mofa No</td>
                                <td>{{ $candidate_job_detail->mofa_no ?? 'N/A'}}</td>
                                <td>Mofa Date</td>
                                <td>{{ $candidate_job_detail->mofa_date ?? 'N/A'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('jobs.family-details.update', $candidate_job_detail->id) }}" method="POST"
        id="candidate-family-edit-form">
        @method('PUT')
        @csrf
        <div class="candidate_details">
            <div class="can-div d-flex justify-content-between align-items-center">
                <div class="can-head">
                    <h4>Family Details</h4>
                </div>
                <div class="edit-1-btn d-flex align-items-center">

                    <div class="edit-2 cross-red" id="cross-button-family">

                    </div>
                    <div class="edit-2 m-lg-1" id="submit-button-family">

                    </div>
                    <div class="edit-1" id="open-family-input">
                        @can('Edit Job')
                            <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="candidate_form candidate_edit_form">
                <div class="table-responsive" id="tableContainer">
                    <table class="table" id="candidate-form-family">
                        <tbody>
                            <tr>
                                <td>Family Contact Name</td>
                                <td>{{ $candidate_job_detail->family_contact_name ?? 'N/A'}}</td>
                                <td>Family Contact No</td>
                                <td>{{ $candidate_job_detail->family_contact_no ?? 'N/A'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('jobs.medical-details.update', $candidate_job_detail->id) }}" method="POST"
        id="candidate-medical-edit-form">
        @method('PUT')
        @csrf
        <div class="candidate_details">
            <div class="can-div d-flex justify-content-between align-items-center">
                <div class="can-head">
                    <h4>Medical Details</h4>
                </div>
                <div class="edit-1-btn d-flex align-items-center">

                    <div class="edit-2 cross-red" id="cross-button-medical">

                    </div>
                    <div class="edit-2 m-lg-1" id="submit-button-medical">

                    </div>
                    <div class="edit-1" id="open-medical-input">
                        @can('Edit Job')
                            <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="candidate_form candidate_edit_form">
                <div class="table-responsive" id="tableContainer">
                    <table class="table" id="candidate-form-medical">
                        <tbody>
                            <tr>

                                <td>Medical Application Date</td>
                                <td>{{ $candidate_job_detail->medical_application_date ?? 'N/A'}}</td>
                                <td>Medical Completion Date</td>
                                <td>{{ $candidate_job_detail->medical_completion_date ?? 'N/A'}}</td>
                                <td>Medical Status</td>
                                <td>{{ $candidate_job_detail->medical_status ?? 'N/A'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('jobs.visa-details.update', $candidate_job_detail->id) }}" method="POST"
        id="candidate-visa-edit-form">
        @method('PUT')
        @csrf
        <div class="candidate_details">
            <div class="can-div d-flex justify-content-between align-items-center">
                <div class="can-head">
                    <h4>Visa Details</h4>
                </div>
                <div class="edit-1-btn d-flex align-items-center">

                    <div class="edit-2 cross-red" id="cross-button-visa">

                    </div>
                    <div class="edit-2 m-lg-1" id="submit-button-visa">

                    </div>
                    <div class="edit-1" id="open-visa-input">
                        @can('Edit Job')
                            <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="candidate_form candidate_edit_form">
                <div class="table-responsive" id="tableContainer">
                    <table class="table" id="candidate-form-visa">
                        <tbody>
                            <tr>
                                <td>Visa Receiving Date</td>
                                <td>{{ $candidate_job_detail->visa_receiving_date ?? 'N/A'}}</td>
                                <td>Visa Issue Date</td>
                                <td>{{ $candidate_job_detail->visa_issue_date ?? 'N/A'}}</td>
                                <td>Visa Expiry Date</td>
                                <td>{{ $candidate_job_detail->visa_expiry_date ?? 'N/A'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('jobs.ticket-details.update', $candidate_job_detail->id) }}" method="POST"
        id="candidate-ticket-edit-form">
        @method('PUT')
        @csrf
        <div class="candidate_details">
            <div class="can-div d-flex justify-content-between align-items-center">
                <div class="can-head">
                    <h4>Ticket Details</h4>
                </div>
                <div class="edit-1-btn d-flex align-items-center">

                    <div class="edit-2 cross-red" id="cross-button-ticket">

                    </div>
                    <div class="edit-2 m-lg-1" id="submit-button-ticket">

                    </div>
                    <div class="edit-1" id="open-ticket-input">
                        @can('Edit Job')
                            <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="candidate_form candidate_edit_form">
                <div class="table-responsive" id="tableContainer">
                    <table class="table" id="candidate-form-ticket">
                        <tbody>
                            <tr>
                                <td>Ticket Booking Date</td>
                                <td>{{ $candidate_job_detail->ticket_booking_date ?? 'N/A'}}</td>
                                <td>Ticket Confirmation Date</td>
                                <td>{{ $candidate_job_detail->ticket_confirmation_date ?? 'N/A'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('jobs.payment-details.update', $candidate_job_detail->id) }}" method="POST"
        id="candidate-payment-edit-form">
        @method('PUT')
        @csrf
        <div class="candidate_details">
            <div class="can-div d-flex justify-content-between align-items-center">
                <div class="can-head">
                    <h4>Payment Details</h4>
                </div>
                <div class="edit-1-btn d-flex align-items-center">

                    <div class="edit-2 cross-red" id="cross-button-payment">

                    </div>
                    <div class="edit-2 m-lg-1" id="submit-button-payment">

                    </div>
                    <div class="edit-1" id="open-payment-input">
                        @can('Edit Job')
                            <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="candidate_form candidate_edit_form">
                <div class="table-responsive" id="tableContainer">
                    <table class="table" id="candidate-form-payment">
                        <tbody>
                            <tr>
                                <td>1st Installment Amount</td>
                                <td>{{ $candidate_job_detail->fst_installment_amount ?? 'N/A'}}</td>
                                <td>1st Installment Date</td>
                                <td>{{ $candidate_job_detail->fst_installment_date ?? 'N/A'}}</td>
                                <td>2nd Installment Amount</td>
                                <td>{{ $candidate_job_detail->secnd_installment_amount ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <td>2nd Installment Date</td>
                                <td>{{ $candidate_job_detail->secnd_installment_date ?? 'N/A'}}</td>
                                <td>3rd Installment Amount</td>
                                <td>{{ $candidate_job_detail->third_installment_amount ?? 'N/A'}}</td>
                                <td>3rd Installment Date</td>
                                <td>{{ $candidate_job_detail->third_installment_date ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <td>4th Installment Amount</td>
                                <td>{{ $candidate_job_detail->fourth_installment_amount ?? 'N/A'}}</td>
                                <td>4th Installment Date</td>
                                <td>{{ $candidate_job_detail->fourth_installment_date ?? 'N/A'}}</td>
                                <td>Total Amount</td>
                                <td>{{ $candidate_job_detail->total_amount ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>Deployment Date</td>
                                <td>{{ $candidate_job_detail->deployment_date ?? 'N/A'}}</td>
                                <td>Job Status</td>
                                <td>{{ $candidate_job_detail->job_status ?? 'N/A'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
