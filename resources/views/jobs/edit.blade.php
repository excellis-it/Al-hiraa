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
                                            {{ $candidate_job_detail->jobTitle->job_name }}
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
                                        <td colspan="3">@if ($gulf_driving_license != null)
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
                                        <td>{{ $candidate_job_detail->date_of_interview ?? ''}}</td>
                                        <td>Date of Selection</td>
                                        <td>{{ $candidate_job_detail->date_of_selection ?? ''}}</td>  
                                        <td>Mode of Selection</td>
                                        <td>{{ $candidate_job_detail->mode_of_selection ?? ''}}</td>                                     
                                    </tr>
                                    <tr>
                                        <td>Interview Location</td>
                                        <td>{{ $candidate_job_detail->interview_location ?? ''}}</td>
                                        <td>Client Remarks</td>
                                        <td>{{ $candidate_job_detail->client_remarks ?? ''}}</td>
                                        <td>Other Remarks</td>
                                        <td>{{ $candidate_job_detail->other_remarks ?? ''}}</td>
                                    </tr>
                                    <tr>
                                       
                                        <td>Sponsor</td>
                                        <td>{{ $candidate_job_detail->sponsor ?? ''}}</td>
                                        <td>Country</td>
                                        <td>{{ $candidate_job_detail->country ?? ''}}</td>
                                        <td>Salary</td>
                                        @if ($candidate_job_detail->salary != null)
                                        <td>{{ $candidate_job_detail->salary ?? 'N/A' }}</td>
                                        @else
                                        <td>{{ $candidate_job_detail->jobTitle->salary ?? 'N/A'}}</td>
                                        @endif
                                        
                                    </tr>
                                    <tr>
                                        <td>Service Charge</td>
                                        <td>{{ $candidate_job_detail->jobTitle->service_charge ?? '00.00'}}</td>
                                        <td>Food Allowance</td>
                                        <td>{{ $candidate_job_detail->food_allowance ?? '00.00'}}</td>
                                        <td>Contract Duration</td>
                                        <td>{{ $candidate_job_detail->contract_duration ?? ''}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Mofa No</td>
                                        <td>{{ $candidate_job_detail->mofa_no ?? ''}}</td>
                                        <td>Mofa Date</td>
                                        <td colspan="3">{{ $candidate_job_detail->mofa_date ?? ''}}</td>
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
                                        <td colspan="3">{{ $candidate_job_detail->job_status ?? 'N/A'}}</td>
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
        $(document).on('click', '#permission', function(e) {
            swal({
                    title: "Are you sure?",
                    text: "To change the status.",
                    type: "warning",
                    confirmButtonText: "YES",
                    showCancelButton: true
                })
                .then((result) => {
                    if (result.value) {
                        window.location = $(this).data('route');
                    } else if (result.dismiss === 'cancel') {
                        swal(
                            'Cancelled',
                            'Your stay here :)',
                            'error'
                        )
                    }
                })
        });
    </script>
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
                        <td>Full Name</td>
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
                        <td>Gender</td>
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
                        <td>DOB</td>
                        <td>
                        <div class="form-group">
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
                            @foreach($jobs as $job)
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
                            @foreach($candidate_positions as $position)
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
                        <td colspan="3">
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
                   
                 </tbody>`)

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
                                        <td>{{ $candidate_job_detail->full_name ?? ''}}</td>
                                        <td>Email</td>
                                        <td>{{ $candidate_job_detail->email ?? ''}}</td>
                                        <td>Gender</td>
                                        <td>{{ $candidate_job_detail->gender ?? ''}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Date of birth</td>
                                        <td>{{ $candidate_job_detail->date_of_birth ?? ''}}</td>
                                        <td>whatapp_no</td>
                                        <td>{{ $candidate_job_detail->whatapp_no ?? ''}}</td>
                                        <td>Alternate Contact No</td>
                                        <td>{{ $candidate_job_detail->alternate_contact_no ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Religion</td>
                                        <td>{{ $candidate_job_detail->religion ?? ''}}</td>
                                        <td>City</td>
                                        <td>{{ $candidate_job_detail->city ?? ''}}</td>
                                        <td>Address</td>
                                        <td>{{ $candidate_job_detail->address ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Education</td>
                                        <td>{{ $candidate_job_detail->education ?? ''}}</td>
                                        <td>Other Education</td>
                                        <td>{{ $candidate_job_detail->other_education ?? ''}}</td>
                                        <td>Passport Number</td>
                                        <td>{{ $candidate_job_detail->passport_number ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>English_speak</td>
                                        <td>{{ $candidate_job_detail->english_speak ?? ''}}</td>
                                        <td>Arabic Speak</td>
                                        <td>{{ $candidate_job_detail->arabic_speak ?? ''}}</td>
                                        <td>Assign By </td>
                                        <td>@if ($candidate_job_detail->assign_by_id != null)
                                                {{ $candidate_job_detail->assignBy->first_name.' '.$candidate_job_detail->assignBy->last_name }}
                                            @else
                                                {{ $candidate_job_detail->assignBy ?? '' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Job Title</td>
                                        <td>@if ($candidate_job_detail->jobTitle != null)
                                            {{ $candidate_job_detail->jobTitle->job_name }}
                                            @else
                                                {{ $candidate_job_detail->jobTitle ?? '' }}
                                            @endif
                                        </td>
                                        <td>Job Position</td>
                                        <td>@if ($candidate_job_detail->jobTitle->candidatePosition != null)
                                            {{ $candidate_job_detail->jobTitle->candidatePosition->name ?? ''}}
                                            @else
                                                {{ $candidate_job_detail->jobTitle ?? '' }}
                                            @endif
                                        </td>
                                        <td>Job Location</td>
                                        <td>{{ $candidate_job_detail->job_location ?? ''}}</td>
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
                                        <td colspan="3">@if ($gulf_driving_license != null)
                                            @foreach($gulf_driving_license as $key => $value)
                                                {{ $value ?? 'N/A' }},
                                            @endforeach
                                            @else
                                                {{ 'N/A' }}
                                            @endif
                                        </td>
                                        
                                    </tr>
                                    
                                </tbody>`);
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

            $(document).on('submit', '#candidate-edit-form', function(e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success('Candidate details updated successfully');
                        // $('#offcanvasEdit').offcanvas('hide');
                        var candidate_id = "{{ $candidate_job_detail->id }}";
                        $(".candidate-new-"+candidate_id).html(response.view);
                        $('#submit-button').html(``);
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
        //job details
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
                    <td>Date of Interview</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->date_of_interview)->format('d-m-Y') ?? '' }}" name="date_of_interview" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>

                    <td>Date of Selection</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->date_of_selection)->format('d-m-Y') ?? '' }}" name="date_of_selection" placeholder="dd-mm-yyyy">

                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Mode of Selection</td>
                    <td>
                        <select name="mode_of_selection" class="form-select uppercase-text" id="" >
                            <option value="">mode of selection</option>
                            <option value="Full Time" {{$candidate_job_detail->mode_of_selection == 'Full Time' ? 'selected':''}}>Full Time</option>
                            <option value="Part Time" {{$candidate_job_detail->mode_of_selection == 'Part Time' ? 'selected':''}}>Part Time</option>
                            <option value="Contract" {{$candidate_job_detail->mode_of_selection == 'Contract' ? 'selected':''}}>Contract</option>
                        </select>
                         
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                </tr>
                <tr>
                    <td>Interview Location</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->interview_location ?? '' }}" name="interview_location" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Client Remarks</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->client_remarks ?? '' }}" name="client_remarks" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Other Remarks</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->other_remarks ?? '' }}" name="other_remarks" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                </tr>
                <tr>
                    <td>Sponsor</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->sponsor ?? '' }}" name="sponsor" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Country</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->country ?? '' }}" name="country" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Salary</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->salary ?? '' }}" name="salary" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                </tr>
                <tr>
                    <td>Service Charge</td>
                    <td><input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->jobTitle->service_charge ?? '00.00'}}"  placeholder="" readonly>
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Food Allowance</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->food_allowance ?? '' }}" name="food_allowance" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Contract Duration</td>
                    <td colspan="3">
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->contract_duration ?? '' }}" name="contract_duration" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                   
                </tr>
                <tr>
                    <td>Mofa No</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->mofa_no ?? '' }}" name="mofa_no" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Mofa Date</td>
                    <td colspan="3">
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->mofa_date)->format('d-m-Y') ?? '' }}" name="mofa_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                   
                </tr>
                </tbody>`);

                $('.datepicker').datepicker({
                    dateFormat: 'dd-mm-yy',
                });
        });

        $(document).on("click", '#cross-button-job', function(e) {

            $(this).html(``);
            $('#submit-button-job').html(``)
            $('#open-job-input').html(
                ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
            $('#candidate-form-job').html(`<tbody>
                                    <tr>
                                        <td>Date of Interview</td>
                                        <td>{{ $candidate_job_detail->date_of_interview ?? ''}}</td>
                                        <td>Date of Selection</td>
                                        <td>{{ $candidate_job_detail->date_of_selection ?? ''}}</td>  
                                        <td>Mode of Selection</td>
                                        <td>{{ $candidate_job_detail->mode_of_selection ?? ''}}</td>                                     
                                    </tr>
                                    <tr>
                                        <td>Interview Location</td>
                                        <td>{{ $candidate_job_detail->interview_location ?? ''}}</td>
                                        <td>Client Remarks</td>
                                        <td>{{ $candidate_job_detail->client_remarks ?? ''}}</td>
                                        <td>Other Remarks</td>
                                        <td>{{ $candidate_job_detail->other_remarks ?? ''}}</td>
                                    </tr>
                                    <tr>
                                       
                                        <td>Sponsor</td>
                                        <td>{{ $candidate_job_detail->sponsor ?? ''}}</td>
                                        <td>Country</td>
                                        <td>{{ $candidate_job_detail->country ?? ''}}</td>
                                        <td>Salary</td>
                                        <td>{{ $candidate_job_detail->salary ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Service Charge</td>
                                        <td>{{ $candidate_job_detail->jobTitle->service_charge ?? '00.00'}}</td>
                                        <td>Food Allowance</td>
                                        <td>{{ $candidate_job_detail->food_allowance ?? ''}}</td>
                                        <td>Contract Duration</td>
                                        <td colspan="3">{{ $candidate_job_detail->contract_duration ?? ''}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Mofa No</td>
                                        <td>{{ $candidate_job_detail->mofa_no ?? ''}}</td>
                                        <td>Mofa Date</td>
                                        <td colspan="3">{{ $candidate_job_detail->mofa_date ?? ''}}</td>
                                    </tr>
                                </tbody>`);

        });
    </script>


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
                    <td>{{ $candidate_job_detail->family_contact_name ?? ''}}</td>
                    <td>Family Contact No</td>
                    <td>{{ $candidate_job_detail->family_contact_no ?? ''}}</td>
                </tr>
            </tbody>`);
        });
    </script>

    <script>
        // medical deatils
        $(document).on("click", '#open-medical-input', function(e) {

            $(this).html(``);

            $('#submit-button-medical').html(
                `<button type="submit"><span class=""><i class="fa-solid fa-check"></i></span></button>`
            )

            $('#cross-button-medical').html(
                `<button type="button"><span class=""><i class="fa-solid fa-close"></i></span></button>`
            )


            $('#candidate-form-medical').html(`<tbody class="candidate-form-new">
                                        
                <tr>
                    <td>Medical Application Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->medical_application_date)->format('d-m-Y') ?? '' }}" name="medical_application_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Medical Completion Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->medical_completion_date)->format('d-m-Y') ?? '' }}" name="medical_completion_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Medical Status</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->medical_status ?? '' }}" name="medical_status" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                </tr>
                
                </tbody>`);

                $('.datepicker').datepicker({
                    dateFormat: 'dd-mm-yy',
                });
        });

        $(document).on("click", '#cross-button-medical', function(e) {

            $(this).html(``);
            $('#submit-button-medical').html(``);
            $('#open-medical-input').html(
                ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
            $('#candidate-form-medical').html(`<tbody>
                <tr>                                        
                        
                    <td>Medical Application Date</td>
                    <td>{{ $candidate_job_detail->medical_application_date ?? 'N/A'}}</td>
                    <td>Medical Completion Date</td>
                    <td>{{ $candidate_job_detail->medical_completion_date ?? 'N/A'}}</td>
                    <td>Medical Status</td>
                    <td>{{ $candidate_job_detail->medical_status ?? 'N/A'}}</td>
                </tr>
            </tbody>`);
        });
    </script>

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
                    <td>Visa Receiving Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->visa_receiving_date)->format('d-m-Y') ?? '' }}" name="visa_receiving_date" placeholder="dd-mm-yyyy">

                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Visa Issue Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->visa_issue_date)->format('d-m-Y') ?? '' }}" name="visa_issue_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Visa Expiry Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->visa_expiry_date)->format('d-m-Y') ?? '' }}" name="visa_expiry_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                </tr>
                
                </tbody>`);

                $('.datepicker').datepicker({
                    dateFormat: 'dd-mm-yy',
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
                        <td>{{ $candidate_job_detail->visa_receiving_date ?? ''}}</td>
                        <td>Visa Issue Date</td>
                        <td>{{ $candidate_job_detail->visa_issue_date ?? ''}}</td>
                        <td>Visa Expiry Date</td>
                        <td>{{ $candidate_job_detail->visa_expiry_date ?? ''}}</td>
                    </tr>
                </tbody>`);
        });
    </script>

    <script>
        // Ticket deatils
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
                    <td>Ticket Booking Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->ticket_booking_date)->format('d-m-Y') ?? '' }}" name="ticket_booking_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Ticket Confirmation Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->ticket_confirmation_date)->format('d-m-Y') ?? '' }}" name="ticket_confirmation_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                   
                </tr>
                
                </tbody>`)

                $('.datepicker').datepicker({
                    dateFormat: 'dd-mm-yy',
                });
        });

        $(document).on("click", '#cross-button-ticket', function(e) {

            $(this).html(``);
            $('#submit-button-ticket').html(``)
            $('#open-ticket-input').html(
                ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
            $('#candidate-form-ticket').html(`<tbody>
                    <tr>                                                      
                        <td>Ticket Booking Date</td>
                        <td>{{ $candidate_job_detail->ticket_booking_date ?? 'N/A'}}</td>
                        <td>Ticket Confirmation Date</td>
                        <td>{{ $candidate_job_detail->ticket_confirmation_date ?? 'N/A'}}</td>
                    </tr>
                </tbody>`);
        });
    </script>

    <script>
        // payment deatils
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
                    <td>1st Installment Amount</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->fst_installment_amount ?? '' }}" name="fst_installment_amount" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>1st Installment Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->fst_installment_date)->format('d-m-Y') ?? '' }}" name="fst_installment_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>2nd Installment Amount</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->secnd_installment_amount ?? '' }}" name="secnd_installment_amount" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    
                </tr>
                <tr>
                    <td>2nd Installment Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->secnd_installment_date)->format('d-m-Y') ?? '' }}" name="secnd_installment_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>3rd Installment Amount</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->third_installment_amount ?? '' }}" name="third_installment_amount" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>3rd Installment Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->third_installment_date)->format('d-m-Y') ?? '' }}" name="third_installment_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                   
                </tr>
                <tr>
                    <td>4th Installment Amount</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->fourth_installment_amount ?? '' }}" name="fourth_installment_amount" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>4th Installment Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->fourth_installment_date)->format('d-m-Y') ?? '' }}" name="fourth_installment_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    
                    <td>Total Amount</td>
                    <td>
                        <input type="text" class="form-control uppercase-text" id="" value="{{ $candidate_job_detail->total_amount ?? '' }}" name="total_amount" placeholder="">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                </tr>
                <tr>
                    <td>Deployment Date</td>
                    <td>
                        <input type="text" class="form-control uppercase-text datepicker" id="" value="{{ \Carbon\Carbon::parse($candidate_job_detail->deployment_date)->format('d-m-Y') ?? '' }}" name="deployment_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Job Status</td>
                    
                        <td colspan="3">
                            <select name="job_status" class="form-select uppercase-text" id="">
                                <option value="">Select Job Status</option>
                                <option value="Active" {{ $candidate_job_detail->job_status == 'Active' ? 'selected' : '' }}> Active </option>
                                <option value="Deactive" {{ $candidate_job_detail->job_status == 'Deactive' ? 'selected' : '' }}>Deactive</option>
                            </select>
                        </td>
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    
                </tr>
                
                </tbody>`)

                $('.datepicker').datepicker({
                    dateFormat: 'dd-mm-yy',
                })
               
        });

        $(document).on("click", '#cross-button-payment', function(e) {

            $(this).html(``);
            $('#submit-button-payment').html(``)
            $('#open-payment-input').html(
                ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`)
            $('#candidate-form-payment').html(`<tbody>
                                    <tr>                                        
                                        <td>1st Installment Amount</td>
                                        <td>{{ $candidate_job_detail->fst_installment_amount ?? 'N/A'}}</td>
                                        <td>1st Installment Date</td>
                                        <td>{{ $candidate_job_detail->fst_installment_date ?? 'N/A'}}</td>
                                        <td>2nd Installment Amount</td>
                                        <td>{{ $candidate_job_detail->secnd_installment_amount ?? 'N/A'}}</td>
                                        <td>2nd Installment Date</td>
                                        <td>{{ $candidate_job_detail->secnd_installment_date ?? 'N/A'}}</td>
                                    </tr>
                                    
                                    <tr>                                        
                                        <td>3rd Installment Amount</td>
                                        <td>{{ $candidate_job_detail->third_installment_amount ?? 'N/A'}}</td>
                                        <td>3rd Installment Date</td>
                                        <td>{{ $candidate_job_detail->third_installment_date ?? 'N/A'}}</td>
                                        <td>4th Installment Amount</td>
                                        <td>{{ $candidate_job_detail->fourth_installment_amount ?? 'N/A'}}</td>
                                        <td>4th Installment Date</td>
                                        <td>{{ $candidate_job_detail->fourth_installment_date ?? 'N/A'}}</td>
                                    </tr>
                                    
                                    <tr> 
                                        <td>Total Amount</td>
                                        <td>{{ $candidate_job_detail->total_amount ?? 'N/A'}}</td>                                       
                                        <td>Deployment Date</td>
                                        <td>{{ $candidate_job_detail->deployment_date ?? 'N/A'}}</td>
                                        <td>Job Status</td>
                                        <td colspan="3">{{ $candidate_job_detail->job_status ?? 'N/A'}}</td>
                                        
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
                $(document).on('submit', '#candidate-job-edit-form', function(e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success('Candidate job details updated successfully');
                        // $('#offcanvasEdit').offcanvas('hide');
                        var candidate_id = "{{ $candidate_job_detail->id }}";
                        $(".candidate-new-"+candidate_id).html(response.view);
                        $('#submit-button-job').html(``);
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
        //family details update
        $(document).on('submit', '#candidate-family-edit-form', function(e) {
                e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success('Candidate family details updated successfully');
                    // $('#offcanvasEdit').offcanvas('hide');
                    var candidate_id = "{{ $candidate_job_detail->id }}";
                    $(".candidate-new-"+candidate_id).html(response.view);
                    $('#submit-button-family').html(``);
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
    </script>

    <script>
        
        $(document).on('submit', '#candidate-medical-edit-form', function(e) {
                e.preventDefault();

           
            var formData = new FormData($(this)[0]);
             // Define the flag

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    
                    toastr.success('Candidate medical details updated successfully'); 
                    var candidate_id = "{{ $candidate_job_detail->id }}";
                    $(".candidate-new-"+candidate_id).html(response.view);
                    $('#submit-button-medical').html(``);
                    
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
    </script>

    <script>
         $(document).on('submit', '#candidate-visa-edit-form', function(e) {
                e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    
                    toastr.success('Candidate visa details updated successfully');
                    var candidate_id = "{{ $candidate_job_detail->id }}";
                    $(".candidate-new-"+candidate_id).html(response.view);
                    $('#submit-button-visa').html(``);
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
    </script>

    <script>
        $(document).on('submit', '#candidate-ticket-edit-form', function(e) {
            e.preventDefault();

        var formData = new FormData($(this)[0]);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success('Candidate ticket details updated successfully');
                    var candidate_id = "{{ $candidate_job_detail->id }}";
                    $(".candidate-new-"+candidate_id).html(response.view);
                    $('#submit-button-ticket').html(``);
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
    </script>

    <script>
        
        //paymnent details
        $(document).on('submit', '#candidate-payment-edit-form', function(e) {
            e.preventDefault();

        var formData = new FormData($(this)[0]);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success('Candidate payment details updated successfully');
                    var candidate_id = "{{ $candidate_job_detail->id }}";
                    $(".candidate-new-"+candidate_id).html(response.view);
                    $('#submit-button-payment').html(``);
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
    </script>

@endif
