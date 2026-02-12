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
                                            r="5.5" transform="translate(67 0)" fill="#04589a" />
                                        <path id="Path_330" data-name="Path 330"
                                            d="M72.353,298.667A8.363,8.363,0,0,0,64,307.02a.928.928,0,0,0,.928.928h14.85a.928.928,0,0,0,.928-.928A8.362,8.362,0,0,0,72.353,298.667Z"
                                            transform="translate(0 -285.673)" fill="#04589a" />
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
                                            fill="#04589a" />
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
                                            transform="translate(0 0.065)" fill="#04589a" />
                                        <path id="Path_410" data-name="Path 410"
                                            d="M6.333,15.057a.815.815,0,1,0,1.463.718L9.383,12.54a1.294,1.294,0,0,1,2.36.08,2.924,2.924,0,0,0,5.331.181l1.587-3.234A.815.815,0,0,0,17.2,8.849l-1.586,3.234a1.294,1.294,0,0,1-2.36-.08,2.924,2.924,0,0,0-5.331-.181Z"
                                            transform="translate(0.346 0.596)" fill="#04589a" />
                                        <path id="Path_411" data-name="Path 411"
                                            d="M17.5,4.216A2.716,2.716,0,1,0,20.216,1.5,2.716,2.716,0,0,0,17.5,4.216Zm1.63,0A1.086,1.086,0,1,0,20.216,3.13,1.086,1.086,0,0,0,19.13,4.216Z"
                                            transform="translate(1.318 0)" fill="#04589a" fill-rule="evenodd" />
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
                    <div class="candidate_form candidate_edit_form" id="candidate-table">
                        @include('jobs.candidate-details')

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
                    <div class="candidate_form candidate_edit_form" id="job-table">
                        @include('jobs.job-details')

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
                    <div class="candidate_form candidate_edit_form" id="job-family-table">
                        @include('jobs.family-details')

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
                                @unless (auth()->user()->hasRole('RECRUITER'))
                                    @can('Edit Job')
                                        <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>
                                    @endcan
                                @endunless
                            </div>
                        </div>
                    </div>
                    <div class="candidate_form candidate_edit_form" id="job-medical-table">
                        @include('jobs.medical-details')
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
                    <div class="candidate_form candidate_edit_form" id="job-visa-table">
                        @include('jobs.visa-details')

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
                    <div class="candidate_form candidate_edit_form" id="job-ticket-table">
                        @include('jobs.ticket-details')
                        {{-- <div class="table-responsive" id="tableContainer">
                            <table class="table" id="candidate-form-ticket">
                                <tbody>
                                    <tr>
                                        <td>Ticket Booking Date</td>
                                        <td>{{ $candidate_job_detail->ticket_booking_date ?? 'dd-mm-yyyy' }}</td>
                                        <td>Ticket Confirmation Date</td>
                                        <td>{{ $candidate_job_detail->ticket_confirmation_date ?? 'dd-mm-yyyy' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}
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
                    <div class="candidate_form candidate_edit_form" id="job-payment-table">
                        @include('jobs.payment-details')
                        {{-- <div class="table-responsive" id="tableContainer">
                            <table class="table" id="candidate-form-payment">
                                <tbody>
                                    <tr>
                                        <td>1st Installment Amount</td>
                                        <td>{{ $candidate_job_detail->fst_installment_amount ?? '' }}</td>
                                        <td>1st Installment Date</td>
                                        <td>{{ $candidate_job_detail->fst_installment_date ?? 'dd-mm-yyyy' }}</td>
                                        <td>2nd Installment Amount</td>
                                        <td>{{ $candidate_job_detail->secnd_installment_amount ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <td>2nd Installment Date</td>
                                        <td>{{ $candidate_job_detail->secnd_installment_date ?? 'dd-mm-yyyy' }}</td>
                                        <td>3rd Installment Amount</td>
                                        <td>{{ $candidate_job_detail->third_installment_amount ?? '' }}</td>
                                        <td>3rd Installment Date</td>
                                        <td>{{ $candidate_job_detail->third_installment_date ?? 'dd-mm-yyyy' }}</td>
                                    </tr>

                                    <tr>
                                        <td>4th Installment Amount</td>
                                        <td>{{ $candidate_job_detail->fourth_installment_amount ?? '' }}</td>
                                        <td>4th Installment Date</td>
                                        <td>{{ $candidate_job_detail->fourth_installment_date ?? 'dd-mm-yyyy' }}</td>
                                        <td>Total Amount</td>
                                        <td>{{ $candidate_job_detail->total_amount ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Deployment Date</td>
                                        <td>{{ $candidate_job_detail->deployment_date ?? 'N/A' }}</td>
                                        <td>Job Status</td>
                                        <td colspan="3">{{ $candidate_job_detail->job_status ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}
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
                        $(".candidate-new-" + candidate_id).html(response.view);
                        $('#candidate-table').html(response.view1);
                        $('#submit-button').html(``);
                        $('#cross-button').html(``);

                        // show the edit button
                        $('#open-input').html(
                            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                        )
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
                    <td class="date-btn">
                        <input type="text" class="form-control uppercase-text datepicker" id="tickt_booking_dt" value="{{ \Carbon\Carbon::parse($candidate_job_detail->ticket_booking_date)->format('d-m-Y') ?? '' }}" name="ticket_booking_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>
                    <td>Ticket Confirmation Date</td>
                    <td class="date-btn">
                        <input type="text" class="form-control uppercase-text datepicker" id="ticket_confirm_dt" value="{{ \Carbon\Carbon::parse($candidate_job_detail->ticket_confirmation_date)->format('d-m-Y') ?? '' }}" name="ticket_confirmation_date" placeholder="dd-mm-yyyy">
                        <span class="text-danger" id="interview_id_job_msg"></span>
                    </td>

                </tr>

                </tbody>`)

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
                        <td>Ticket Booking Date</td>
                        <td>{{ $candidate_job_detail->ticket_booking_date ?? 'dd-mm-yyyy' }}</td>
                        <td>Ticket Confirmation Date</td>
                        <td>{{ $candidate_job_detail->ticket_confirmation_date ?? 'dd-mm-yyyy' }}</td>
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
                        $(".candidate-new-" + candidate_id).html(response.view);
                        $('#job-table').html(response.view1);
                        $('#submit-button-job').html(``);
                        $('#cross-button-job').html(``);

                        // show the edit button
                        $('#open-job-input').html(
                            ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                        )
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
                    $(".candidate-new-" + candidate_id).html(response.view);
                    $('#job-family-table').html(response.view1);
                    $('#submit-button-family').html(``);
                    $('#cross-button-family').html(``);

                    // show the edit button
                    $('#open-family-input').html(
                        ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                    )
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
                    $(".candidate-new-" + candidate_id).html(response.view);
                    $('#job-medical-table').html(response.view1);
                    $('#submit-button-medical').html(``);
                    $('#cross-button-medical').html(``);

                    // show the edit button
                    $('#open-medical-input').html(
                        ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                    )

                },
                error: function(xhr) {
                    // Handle errors (e.g., display validation errors)
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        toastr.error(value[0]);
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
                    $(".candidate-new-" + candidate_id).html(response.view);
                    $("#job-visa-table").html(response.view1);

                    $('#submit-button-visa').html(``);
                    $('#cross-button-visa').html(``);

                    // show the edit button
                    $('#open-visa-input').html(
                        ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                    )
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
                    $(".candidate-new-" + candidate_id).html(response.view);
                    $('#job-ticket-table').html(response.view1);
                    $('#submit-button-ticket').html(``);
                    $('#cross-button-ticket').html(``);

                    // show the edit button
                    $('#open-ticket-input').html(
                        ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                    )

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
                    $(".candidate-new-" + candidate_id).html(response.view);
                    $('#job-payment-table').html(response.view1);
                    $('#submit-button-payment').html(``);
                    $('#cross-button-payment').html(``);
                    // show the edit button
                    $('#open-payment-input').html(
                        ` <a href="javascript:void(0);"><span><i class="fa-solid fa-pen"></i></span></a>`
                    )

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
        // Function to calculate total amount
        function calculateTotal() {
            var fst_installment_amount = parseFloat($('input[name="fst_installment_amount"]').val()) || 0;
            var secnd_installment_amount = parseFloat($('input[name="secnd_installment_amount"]').val()) || 0;
            var third_installment_amount = parseFloat($('input[name="third_installment_amount"]').val()) || 0;
            var fourth_installment_amount = parseFloat($('input[name="fourth_installment_amount"]').val()) || 0;

            var total_amount = fst_installment_amount + secnd_installment_amount + third_installment_amount +
                fourth_installment_amount;
            $('input[name="total_amount"]').val(total_amount);
        }

        // Listen for keyup event on all installment input fields
        $(document).on('keyup',
            'input[name="fst_installment_amount"], input[name="secnd_installment_amount"], input[name="third_installment_amount"], input[name="fourth_installment_amount"]',
            calculateTotal);
    </script>
@endif
