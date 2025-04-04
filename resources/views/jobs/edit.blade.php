@php
    use App\Helpers\Helper;
    use App\Constants\Position;
@endphp
@if (isset($edit))
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasRightLabel">
        <a href="" class="cross_x"><i class="fa-solid fa-circle-xmark"></i></a>
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
                                <h4>{{ $candidate_job_detail->full_name ?? 'N/A' }}</h4>
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
            <form action="{{ route('jobs.candidate-details.update', $candidate_job_detail->id) }}" method="POST"
                id="candidate-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div class="accordion" id="candidateAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingCandidateDetails">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseCandidateDetails" aria-expanded="false"
                                    aria-controls="collapseCandidateDetails">
                                    <h5>Candidate Details</h5>
                                </button>
                            </h2>
                            <div id="collapseCandidateDetails" class="accordion-collapse collapse show"
                                aria-labelledby="headingCandidateDetails" data-bs-parent="#candidateAccordion">
                                <div class="accordion-body">
                                    <div class="can-div d-flex justify-content-between align-items-center">
                                        <div class="can-head">
                                            <h5></h5>
                                        </div>
                                        <div class="edit-1-btn d-flex align-items-center">
                                            <div class="edit-2 cross-red" id="cross-button"></div>
                                            <div class="edit-2 m-lg-1" id="submit-button"></div>
                                            <div class="edit-1" id="open-input">
                                                @unless(auth()->user()->hasRole('PROCESS MANAGER'))
                                                @can('Edit Job')
                                                    <a href="javascript:void(0);"><span><i
                                                                class="fa-solid fa-pen"></i></span></a>
                                                @endcan
                                                @endunless
                                            </div>
                                        </div>
                                    </div>
                                    <div class="candidate_form candidate_edit_form" id="candidate-table">
                                        @include('jobs.candidate-details')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="see-more-container">
                        <a href="javascript:void(0);" class="btn-1" id="seeMoreBtn">See More<img src="{{ asset('assets/images/arrow.png') }}"></a>
                    </div> --}}
                </div>

            </form>


            <form action="{{ route('jobs.job-details.update', $candidate_job_detail->id) }}" method="POST"
                id="candidate-job-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div class="accordion mt-4" id="jobAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingJobDetails">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseJobDetails" aria-expanded="false"
                                    aria-controls="collapseJobDetails">
                                    <h5>Job Details</h5>
                                </button>
                            </h2>
                            <div id="collapseJobDetails" class="accordion-collapse collapse "
                                aria-labelledby="headingJobDetails" data-bs-parent="#jobAccordion">
                                <div class="accordion-body">
                                    <div class="can-div d-flex justify-content-between align-items-center">
                                        <div class="can-head">
                                            <h5></h5>
                                        </div>
                                        <div class="edit-1-btn d-flex align-items-center">
                                            <div class="edit-2 cross-red" id="cross-button-job"></div>
                                            <div class="edit-2 m-lg-1" id="submit-button-job"></div>
                                            <div class="edit-1" id="open-job-input">
                                                @unless(auth()->user()->hasRole('PROCESS MANAGER'))
                                                @can('Edit Job')
                                                    <a href="javascript:void(0);"><span><i
                                                                class="fa-solid fa-pen"></i></span></a>
                                                @endcan
                                                @endunless
                                            </div>
                                        </div>
                                    </div>
                                    <div class="candidate_form candidate_edit_form" id="job-table">
                                        @include('jobs.job-details')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form action="{{ route('jobs.family-details.update', $candidate_job_detail->id) }}" method="POST"
                id="candidate-family-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div class="accordion" id="familyAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFamilyDetails">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFamilyDetails" aria-expanded="false"
                                    aria-controls="collapseFamilyDetails">
                                    <h5>Family Details</h5>
                                </button>
                            </h2>
                            <div id="collapseFamilyDetails" class="accordion-collapse collapse"
                                aria-labelledby="headingFamilyDetails" data-bs-parent="#familyAccordion">
                                <div class="accordion-body">
                                    <div class="can-div d-flex justify-content-between align-items-center">
                                        <div class="can-head">
                                            <h5></h5>
                                        </div>
                                        <div class="edit-1-btn d-flex align-items-center">
                                            <div class="edit-2 cross-red" id="cross-button-family">
                                                <!-- Cross button for canceling edit -->
                                            </div>
                                            <div class="edit-2 m-lg-1" id="submit-button-family">
                                                <!-- Submit button -->
                                            </div>
                                            <div class="edit-1" id="open-family-input">
                                                @can('Edit Job')
                                                    <a href="javascript:void(0);"><span><i
                                                                class="fa-solid fa-pen"></i></span></a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="candidate_form candidate_edit_form" id="job-family-table">
                                        @include('jobs.family-details')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <form action="{{ route('jobs.medical-details.update', $candidate_job_detail->id) }}" method="POST"
                id="candidate-medical-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div class="accordion" id="medicalAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingMedical">
                                <button
                                    class="accordion-button collapsed d-flex justify-content-between align-items-center"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseMedical"
                                    aria-expanded="false" aria-controls="collapseMedical">
                                    <h5>Medical Details</h5>
                                </button>
                            </h2>
                            <div id="collapseMedical" class="accordion-collapse collapse"
                                aria-labelledby="headingMedical" data-bs-parent="#medicalAccordion">
                                <div class="accordion-body">
                                    <div class="can-div d-flex justify-content-between align-items-center">
                                        <div class="can-head">
                                            <h5></h5>
                                        </div>
                                        <div class="edit-1-btn d-flex align-items-center">

                                            <div class="edit-2 cross-red" id="cross-button-medical">

                                            </div>
                                            <div class="edit-2 m-lg-1" id="submit-button-medical">

                                            </div>
                                            <div class="edit-1" id="open-medical-input">
                                                @unless(auth()->user()->hasRole('RECRUITER'))
                                                @can('Edit Job')
                                                    <a href="javascript:void(0);"><span><i
                                                                class="fa-solid fa-pen"></i></span></a>
                                                @endcan
                                                @endunless
                                            </div>
                                        </div>
                                    </div>

                                    <div class="candidate_form candidate_edit_form" id="job-medical-table">
                                        @include('jobs.medical-details')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form action="{{ route('jobs.payment-details.update', $candidate_job_detail->id) }}" method="POST"
                id="candidate-payment-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div class="accordion" id="paymentAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPayment">
                                <button
                                    class="accordion-button collapsed d-flex justify-content-between align-items-center"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayment"
                                    aria-expanded="false" aria-controls="collapsePayment">
                                    <h5>Payment Details</h5>
                                </button>
                            </h2>
                            <div id="collapsePayment" class="accordion-collapse collapse"
                                aria-labelledby="headingPayment" data-bs-parent="#paymentAccordion">
                                <div class="accordion-body">
                                    <div class="can-div d-flex justify-content-between align-items-center">
                                        <div class="can-head">
                                            <h5></h5>
                                        </div>
                                        <div class="edit-1-btn d-flex align-items-center">

                                            <div class="edit-2 cross-red" id="cross-button-payment">

                                            </div>
                                            <div class="edit-2 m-lg-1" id="submit-button-payment">

                                            </div>
                                            <div class="edit-1" id="open-payment-input">
                                                @can('Edit Job')
                                                    <a href="javascript:void(0);"><span><i
                                                                class="fa-solid fa-pen"></i></span></a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="candidate_form candidate_edit_form" id="job-payment-table">
                                        @include('jobs.payment-details')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <form action="{{ route('jobs.document-details.update', $candidate_job_detail->id) }}" method="POST"
                id="candidate-document-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div class="accordion" id="documentAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingDocument">
                                <button
                                    class="accordion-button collapsed d-flex justify-content-between align-items-center"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocument"
                                    aria-expanded="false" aria-controls="collapseDocument">
                                    <h5>Courier Details</h5>
                                </button>
                            </h2>
                            <div id="collapseDocument" class="accordion-collapse collapse"
                                aria-labelledby="headingDocument" data-bs-parent="#documentAccordion">
                                <div class="accordion-body">
                                    <div class="can-div d-flex justify-content-between align-items-center">
                                        <div class="can-head">
                                            <h5></h5>
                                        </div>
                                        <div class="edit-1-btn d-flex align-items-center">

                                            <div class="edit-2 cross-red" id="cross-button-document">

                                            </div>
                                            <div class="edit-2 m-lg-1" id="submit-button-document">

                                            </div>
                                            <div class="edit-1" id="open-document-input">
                                                @unless(auth()->user()->hasRole('RECRUITER'))
                                                @can('Edit Job')
                                                    <a href="javascript:void(0);"><span><i
                                                                class="fa-solid fa-pen"></i></span></a>
                                                @endcan
                                                @endunless
                                            </div>
                                        </div>
                                    </div>
                                    <div class="candidate_form candidate_edit_form" id="job-document-table">
                                        @include('jobs.document-details')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <form action="{{ route('jobs.visa-details.update', $candidate_job_detail->id) }}" method="POST"
                id="candidate-visa-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div id="visaAccordion" class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingVisa">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseVisa" aria-expanded="false"
                                    aria-controls="collapseVisa">
                                    <h5>Visa Details</h5>
                                </button>
                            </h2>
                            <div id="collapseVisa" class="accordion-collapse collapse" aria-labelledby="headingVisa"
                                data-bs-parent="#visaAccordion">
                                <div class="accordion-body">
                                    <div class="can-div d-flex justify-content-between align-items-center">
                                        <div class="can-head">
                                            <h5></h5>
                                        </div>
                                        <div class="edit-1-btn d-flex align-items-center">
                                            <div class="edit-2 cross-red" id="cross-button-visa"></div>
                                            <div class="edit-2 m-lg-1" id="submit-button-visa"></div>
                                            <div class="edit-1" id="open-visa-input">
                                                @can('Edit Job')
                                                    <a href="javascript:void(0);"><span><i
                                                                class="fa-solid fa-pen"></i></span></a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" candidate_form candidate_edit_form" id="job-visa-table">
                                        @include('jobs.visa-details')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <form action="{{ route('jobs.ticket-details.update', $candidate_job_detail->id) }}" method="POST"
                id="candidate-ticket-edit-form">
                @method('PUT')
                @csrf
                <div class="candidate_details">
                    <div class="accordion" id="ticketAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTicket">
                                <button
                                    class="accordion-button collapsed d-flex justify-content-between align-items-center"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTicket"
                                    aria-expanded="false" aria-controls="collapseTicket">
                                    <h5>Flight Details</h5>

                                </button>
                            </h2>
                            <div id="collapseTicket" class="accordion-collapse collapse "
                                aria-labelledby="headingTicket" data-bs-parent="#ticketAccordion">
                                <div class="accordion-body">
                                    <div class="can-div d-flex justify-content-between align-items-center">
                                        <div class="can-head">
                                            <h5></h5>
                                        </div>
                                        <div class="edit-1-btn d-flex align-items-center">

                                            <div class="edit-2 cross-red" id="cross-button-ticket">

                                            </div>
                                            <div class="edit-2 m-lg-1" id="submit-button-ticket">

                                            </div>
                                            <div class="edit-1" id="open-ticket-input">
                                                @can('Edit Job')
                                                    <a href="javascript:void(0);"><span><i
                                                                class="fa-solid fa-pen"></i></span></a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="candidate_form candidate_edit_form" id="job-ticket-table">
                                        @include('jobs.ticket-details')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).off('click', '[data-bs-target="#collapsePayment"], [data-bs-target="#collapseDocument"], [data-bs-target="#collapseVisa"], [data-bs-target="#collapseTicket"]').on("click",
                '[data-bs-target="#collapsePayment"], [data-bs-target="#collapseDocument"], [data-bs-target="#collapseVisa"], [data-bs-target="#collapseTicket"]',
                function(event) {
                    let medicalStatus = $('.medical_status').val(); // Get medical status value

                    if (medicalStatus !== "FIT") {
                        event.preventDefault(); // Prevent the accordion from opening
                        setTimeout(() => {
                            $('#collapsePayment, #collapseDocument, #collapseVisa, #collapseTicket')
                                .removeClass('show'); // Ensure all sections remain closed
                        }, 500);

                        alert(
                            "You can only access payment, courier, visa & flight details if the medical status is FIT."
                        );
                    }
                });

            $(document).on("change", '.medical_status', function() {
                let medicalStatus = $(this).val(); // Get medical status value

                if (medicalStatus !== "FIT") {
                    $('#collapsePayment, #collapseDocument, #collapseVisa, #collapseTicket').removeClass(
                        'show');
                }
            });
        });
    </script>





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
        $(document).ready(function() {
            // Show the first 5 rows initially
            // var visibleRows = 2;
            // showRows(visibleRows);

            // Handle the "See More" button click
            // $(document).on("click", '#seeMoreBtn', function(e) {
            //     e.preventDefault();
            //     // Show additional rows (e.g., 5 more)
            //     visibleRows += 28;
            //     showRows(visibleRows);
            // });

            // Function to show the specified number of rows
            // function showRows(rowsToShow) {
            //     var $tableContainer = $("#tableContainer");
            //     var $tableRows = $tableContainer.find("tbody tr");

            //     // Hide all rows
            //     $tableRows.hide();

            //     // Show the specified number of rows
            //     $tableRows.slice(0, rowsToShow).show();

            //     // Toggle the "See More" button visibility based on the total number of rows
            //     if ($tableRows.length > rowsToShow) {
            //         $(".see-more-container").show();
            //     } else {
            //         $(".see-more-container").hide();
            //     }
            // }

            $(document).off('submit', '#candidate-edit-form').on('submit', '#candidate-edit-form',
                function(e) {
                    e.preventDefault();

                    // Disable the submit button to prevent multiple submissions
                    $('#submit-button').prop('disabled', true);

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
                            $(".candidate-new-" + candidate_id).html(response.view);
                            $('#candidate-table').html(response.view1);
                            $('#submit-button').html(``);
                            $('#cross-button').html(``);

                            // show the edit button
                            $('#open-input').html(
                                `<a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                            );
                        },
                        error: function(xhr) {
                            // Handle errors (e.g., display validation errors)
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                            });
                        },
                        complete: function() {
                            // Re-enable the submit button after the request is complete
                            $('#submit-button').prop('disabled', false);
                        }
                    });
                });


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

            $(document).off('submit', '#candidate-job-edit-form').on('submit', '#candidate-job-edit-form',
                function(e) {
                    e.preventDefault();

                    // Disable the submit button to prevent multiple submissions
                    $('#submit-button-job').prop('disabled', true);

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
                            $(".candidate-new-" + candidate_id).html(response.view);
                            $('#job-table').html(response.view1);
                            $('#submit-button-job').html(``);
                            $('#cross-button-job').html(``);

                            // show the edit button
                            $('#open-job-input').html(
                                `<a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                            );
                        },
                        error: function(xhr) {
                            // Handle errors (e.g., display validation errors)
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                            });
                        },
                        complete: function() {
                            // Re-enable the submit button regardless of success or error
                            $('#submit-button-job').prop('disabled', false);
                        }
                    });
                });

        });
    </script>

    <script>
        //family details update
        $(document).off('submit', '#candidate-family-edit-form').on('submit', '#candidate-family-edit-form',
            function(e) {
                e.preventDefault();

                // Disable the submit button to prevent multiple submissions
                $('#submit-button-family').prop('disabled', true);

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success('Candidate family details updated successfully');

                        var candidate_id = "{{ $candidate_job_detail->id }}";
                        $(".candidate-new-" + candidate_id).html(response.view);
                        $('#job-family-table').html(response.view1);
                        $('#submit-button-family').html(``);
                        $('#cross-button-family').html(``);

                        // Show the edit button
                        $('#open-family-input').html(
                            `<a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                        );

                        // Re-enable the submit button after success
                        $('#submit-button-family').prop('disabled', false);
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value);
                        });

                        // Re-enable the submit button on error
                        $('#submit-button-family').prop('disabled', false);
                    }
                });
            });
    </script>

    <script>
        $(document).off('submit', '#candidate-medical-edit-form').on('submit', '#candidate-medical-edit-form',
            function(e) {
                e.preventDefault();

                // Disable the submit button to prevent multiple submissions
                var $submitButton = $('#submit-button-medical');
                $submitButton.prop('disabled', true);

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success('Candidate medical details updated successfully');
                        var candidate_id = "{{ $candidate_job_detail->id }}";
                        $(".candidate-new-" + candidate_id).html(response.view);
                        $('#job-medical-table').html(response.view1);
                        $('#submit-button-medical').html(``);
                        $('#cross-button-medical').html(``);

                        // Show the edit button
                        $('#open-medical-input').html(
                            `<a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                        );
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    },
                    complete: function() {
                        // Re-enable the submit button after the AJAX call is complete
                        $submitButton.prop('disabled', false);
                    }
                });
            });
    </script>

    <script>
        $(document).off('submit', '#candidate-visa-edit-form').on('submit', '#candidate-visa-edit-form',
            function(e) {
                e.preventDefault();

                // Disable the submit button to prevent multiple submissions
                $('#submit-button-visa').prop('disabled', true);

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
                        $(".candidate-new-" + candidate_id).html(response.view);
                        $("#job-visa-table").html(response.view1);

                        // Clear the button HTML
                        $('#submit-button-visa').html(``);
                        $('#cross-button-visa').html(``);

                        // Show the edit button
                        $('#open-visa-input').html(
                            `<a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                        );
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value);
                        });
                    },
                    complete: function() {
                        // Re-enable the submit button after the AJAX call is complete
                        $('#submit-button-visa').prop('disabled', false);
                    }
                });
            });
    </script>

    <script>
        $(document).off('submit', '#candidate-ticket-edit-form').on('submit', '#candidate-ticket-edit-form',
            function(e) {
                e.preventDefault();

                // Disable the submit button to prevent multiple submissions
                $('#submit-button-ticket').prop('disabled', true);

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == true) {
                            toastr.success('Candidate ticket details updated successfully');
                            var candidate_id = "{{ $candidate_job_detail->id }}";
                            $(".candidate-new-" + candidate_id).html(response.view);
                            $('#job-ticket-table').html(response.view1);
                            $('#submit-button-ticket').html(``);
                            $('#cross-button-ticket').html(``);

                            // show the edit button
                            $('#open-ticket-input').html(
                                ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                            );
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
                    },
                    complete: function() {
                        // Re-enable the submit button after the AJAX request is complete
                        $('#submit-button-ticket').prop('disabled', false);
                    }
                });
            });
    </script>

    <script>
        $(document).off('submit', '#candidate-document-edit-form').on('submit', '#candidate-document-edit-form',
            function(e) {
                e.preventDefault();

                // Disable the submit button to prevent multiple submissions
                $('#submit-button-document').prop('disabled', true);

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success('Candidate document details updated successfully');
                        var candidate_id = "{{ $candidate_job_detail->id }}";
                        $(".candidate-new-" + candidate_id).html(response.view);
                        $('#job-document-table').html(response.view1);
                        $('#submit-button-document').html(``);
                        $('#cross-button-document').html(``);

                        // show the edit button
                        $('#open-document-input').html(
                            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                        );
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value);
                        });
                    },
                    complete: function() {
                        // Re-enable the submit button after the AJAX request is complete
                        $('#submit-button-document').prop('disabled', false);
                    }
                });
            });
    </script>

    <script>
        //paymnent details
        $(document).off('submit', '#candidate-payment-edit-form').on('submit', '#candidate-payment-edit-form',
            function(e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);

                // Disable the submit button to prevent multiple submissions
                $('#submit-button-payment').prop('disabled', true);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success('Candidate payment details updated successfully');
                        var candidate_id = "{{ $candidate_job_detail->id }}";
                        $(".candidate-new-" + candidate_id).html(response.view);
                        $('#job-payment-table').html(response.view1);
                        $('#submit-button-payment').html(``);
                        $('#cross-button-payment').html(``);

                        // Show the edit button
                        $('#open-payment-input').html(
                            `<a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                        );
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value);
                        });
                    },
                    complete: function() {
                        // Re-enable the submit button after the request completes
                        $('#submit-button-payment').prop('disabled', false);
                    }
                });
            });
    </script>
    <script>
        // Function to calculate total amount and due amount
        function calculateTotalAndDue() {
            var fst_installment_amount = parseFloat($('input[name="fst_installment_amount"]').val()) || 0;
            var secnd_installment_amount = parseFloat($('input[name="secnd_installment_amount"]').val()) || 0;
            var third_installment_amount = parseFloat($('input[name="third_installment_amount"]').val()) || 0;
            var fourth_installment_amount = parseFloat($('input[name="fourth_installment_amount"]').val()) || 0;

            // Calculate total amount (sum of installments)
            var total_amount = fst_installment_amount + secnd_installment_amount + third_installment_amount +
                fourth_installment_amount;
            $('input[name="total_amount"]').val(total_amount);

            // Get discount and job service charge (default to 0 if empty)
            var discount = parseFloat($('input[name="discount"]').val()) || 0;
            var job_service_charge = parseFloat($('input[name="job_service_charge"]').val()) || 0;

            // Calculate due amount (total_amount - discount - job_service_charge)
            var due_amount = job_service_charge - total_amount - discount;
            $('input[name="due_amount"]').val(due_amount);
        }

        // Listen for keyup event on all installment input fields, discount, and service charge fields
        $(document).on('keyup',
            'input[name="fst_installment_amount"], input[name="secnd_installment_amount"], input[name="third_installment_amount"], input[name="fourth_installment_amount"], input[name="discount"], input[name="job_service_charge"]',
            calculateTotalAndDue);
    </script>
@endif
