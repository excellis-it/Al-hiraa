@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Candidates
@endsection
@push('styles')
    <style>
        .loading-spinner {
            display: block;
            margin: 0 auto;
            padding: 2em;
        }
    </style>
@endpush
@section('content')
    @php
        use App\Helpers\Helper;
        use App\Constants\Position;
    @endphp

    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading row align-items-center">

                {{-- edit candidates --}}
                <div id="candidate-edit" class="jobs_canvas">
                    @include('candidates.edit')
                </div>
                {{-- end edit candidates --}}
                <div class="col-xl-8 col-lg-6 col-md-6 mb-3 mb-md-0">
                    <div class="d-flex w-100">
                        <form class="search-form d-flex w-100" id="search-form">
                            <button class="btn" type="submit" role="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="text" class="form-control" placeholder="Search.." name="query" id="query">
                            <div class="btn-group">
                                <button type="submit" class="btn advance_search_btn"
                                    style="border-right: none;">Search</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="d-flex justify-content-center justify-content-md-start">
                        @can('Create Candidate')
                            <div class="btn-group me-4">
                                <a href="{{ route('candidates.create') }}" class="btn addcandidate_btn">Add Candidate</a>
                                @if (Auth::user()->hasRole('ADMIN') ||
                                        Auth::user()->hasRole('OPERATION MANAGER') ||
                                        Auth::user()->hasRole('PROCESS MANAGER'))
                                    <button type="button"
                                        class="btn dropdown-toggle dropdown-toggle-split addcandidate_dropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-bs-whatever="@fat">Import Excel</a></li>
                                    </ul>
                                @endif

                            </div>
                        @endcan
                        @can('Export Candidate')
                            <div class="btn-group">
                                <button type="button" class="btn export_csv export_cnadidate_csv" data-bs-toggle="modal"
                                    data-bs-target="#exportModal">
                                    Export CSV
                                </button>
                                <button type="button" class="btn dropdown-toggle dropdown-toggle-split export_dropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><a class="dropdown-item export_cnadidate_csv" href="javascript:void(0);"
                                            data-bs-toggle="modal" data-bs-target="#exportModal">Export CSV</a></li>
                                </ul>
                            </div>

                            <!-- Export Modal -->
                            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="exportForm" method="POST" action="{{ route('candidates.export') }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exportModalLabel">Select Date Range for Export</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="start_date" class="form-label">Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="end_date" class="form-label">End Date</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Export</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>

            </div>

        </div>

        <div class="container-fluid page__container">
            {{-- <div class="row mb-2">
                <div class="col-md-4 col-xl-2 col-lg-4 col-6 mb-2">
                    <select name="cnadidate_status_id" class="form-select" id="cnadidate_status_id_filter">
                        <option value="">Select A Status</option>
                        @foreach ($candidate_statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-xl-2 col-lg-4 col-6 mb-2">
                    <select name="source" class="form-select" id="source_filter">
                        <option value="">Select Source Type</option>
                        <option value="Telecalling">Telecalling
                        </option>
                        <option value="Reference">Reference</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Others">Others </option>
                    </select>
                </div>
                <div class="col-md-4 col-xl-2 col-lg-4 col-6 mb-2">
                    <select name="gender" class="form-select" id="gender_filter">
                        <option value="">Select Gender</option>
                        <option value="Male"> Male </option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-4 col-xl-2 col-lg-4 col-6 mb-2">
                    <select name="position_applied_for" class="form-select select2" id="position_applied_for_filter">
                        <option value="">Select Position</option>
                        @foreach ($candidate_positions as $item)
                            <option value="{{ $item['id'] }}">
                                {{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-xl-2 col-lg-4 col-6 mb-2">
                    <select name="english_speak" class="form-select" id="english_speak_filter">
                        <option value="">Select English Type</option>
                        <option value="Basic">Basic</option>
                        <option value="Good">Good</option>
                        <option value="Poor">Poor</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-4 col-xl-2 col-lg-4 col-6 mb-2">
                    <select name="arabic_speak" class="form-select" id="arabic_speak_filter">
                        <option value="">Select Arbic Type</option>
                        <option value="Basic">Basic</option>
                        <option value="Good">Good</option>
                        <option value="Poor">Poor</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div> --}}
            <div class="row">

                <div class="col-lg-6 col-6 mb-2">
                    @if (Auth::user()->hasRole('ADMIN'))
                        <div class="action_btn">
                            <div class="dropdown">
                                <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Action
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void();" data-bs-toggle="modal"
                                            data-bs-target="#bulk_status">Changing status</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#whatsappModal">WhatsApp message</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#smsModal">SMS</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Modal of bulk changing status -->
                        <div class="modal fade" id="bulk_status" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change status in bulk</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('candidates.bulk.status.update') }}" id="change_status">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Status</label>
                                                    <select name="change_status" class="form-select"
                                                        id="change_status_id">
                                                        <option value="">Select A Status</option>
                                                        @foreach ($candidate_statuses as $status)
                                                            <option value="{{ $status->id }}">{{ $status->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn save-btn">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    @endif
                </div>

                <div class="col-lg-6 col-6 mb-2" style="display: flex;justify-content: end;">
                    <div class="action_btn">
                        <div class="dropdown">
                            <a class="btn reset-btn" href="{{ route('candidates.index') }}"><i
                                    class="fas fa-redo-alt"></i> Reset</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="table-wrapper table-responsive border-bottom" data-toggle="lists">
                        <table class="table mb-0 table-bordered table-hover" id="candidate_body12">
                            <thead class="candy-p">
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                class="custom-control-input js-check-selected-row checkAll"
                                                name="checkAll">
                                        </div>
                                    </th>

                                    @can('View Candidate')
                                        <th class="stick">
                                            View

                                        </th>
                                    @endcan
                                    {{-- <th></th> --}}
                                    {{-- <th>Enter By</th> --}}

                                    <th>
                                        <div>
                                            <select name="cnadidate_status_id" id="cnadidate_status_id_filter"
                                                class="select_width status_select" multiple data-coreui-search="true">
                                                <option value="">Select A Status</option>
                                                @foreach ($candidate_statuses as $status)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="single_select">
                                            <select name="call_status" class="select_width last_call_status "
                                                id="last_call_status_filter">
                                                <option value="">Select Call Status</option>
                                                @foreach (Position::getCallStatus() as $item)
                                                    <option value="{{ $item }}">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>Last Update Date</th>
                                    {{-- <th>Last Update By</th> --}}
                                    <th>
                                        <div class="single_select">
                                            <select name="last_update_by" class="select_width last_update_by"
                                                id="last_updated_by_filter">
                                                <option value="">Select Last Update By</option>
                                                @foreach ($candidate_last_updates as $val)
                                                    <option value="{{ $val->user->id ?? '' }}">
                                                        {{ $val->user->first_name ?? '' }}
                                                        {{ $val->user->last_name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        Interview Status
                                    </th>
                                    <th class="can_full">Full Name</th>
                                    <th>Age</th>
                                    <th>
                                        Indian Work Experience
                                    </th>
                                    <th>
                                        Abroad Work Experience
                                    </th>
                                    <th>
                                        <div>
                                            <select name="position_applied_for" class="select_width position1_select"
                                                id="position_applied_for_filter" multiple>
                                                <option value="">Select Position</option>
                                                @foreach ($candidate_positions as $item)
                                                    <option value="{{ $item['id'] }}">
                                                        {{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        Specialisation for Position (1)
                                    </th>
                                    <th>
                                        <div>
                                            <select name="position_applied_for" class="select_width position2_select"
                                                id="position_applied_for_filter_2" multiple>
                                                <option value="">Select Position</option>
                                                @foreach ($candidate_positions as $item)
                                                    <option value="{{ $item['id'] }}">
                                                        {{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        Specialisation for Position (2)
                                    </th>
                                    <th>
                                        <div>
                                            <select name="position_applied_for" class="select_width position3_select"
                                                id="position_applied_for_filter_3" multiple>
                                                <option value="">Select Position</option>
                                                @foreach ($candidate_positions as $item)
                                                    <option value="{{ $item['id'] }}">
                                                        {{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        Specialisation for Position (3)
                                    </th>

                                    <th>DOB</th>
                                    <th>
                                        <div>
                                            <select name="gender" class="select_width gender_select" id="gender_filter"
                                                multiple>
                                                <option value="">Select Gender</option>
                                                <option value="Male"> Male </option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </th>


                                    <th>
                                        <div>
                                            <select name="education" class="select_width education_select"
                                                id="education_filter" multiple>
                                                <option value="">Select Type</option>
                                                <option value="5th Pass">5th Pass</option>
                                                <option value="8th Pass">8th Pass</option>
                                                <option value="10th Pass">10th Pass </option>
                                                <option value="Higher Secondary">Higher
                                                    Secondary</option>
                                                <option value="Graduates">Graduates</option>
                                                <option value="Masters">Masters</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        Other Education
                                    </th>




                                    <th>

                                        <div class="single_select">
                                            <select name="city" class="select_width city_select " id="city_filter">
                                                <option value="">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ old('city') == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>


                                    <th>
                                        Religion
                                    </th>
                                    <th>
                                        Indian Driving License
                                    </th>
                                    <th>
                                        Gulf Driving License
                                    </th>
                                    <th>

                                        <div class="single_select">
                                            <select name="english_speak" class="select_width eng_spk_select "
                                                id="english_speak_filter">
                                                <option value="">Select English Type</option>
                                                <option value="Basic">Basic</option>
                                                <option value="Good">Good</option>
                                                <option value="Poor">Poor</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>

                                        <div class="single_select">
                                            <select name="arabic_speak" class="select_width arbic_select "
                                                id="arabic_speak_filter">
                                                <option value="">Select Arbic Type</option>
                                                <option value="Basic">Basic</option>
                                                <option value="Good">Good</option>
                                                <option value="Poor">Poor</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        Gulf Return
                                    </th>
                                    <th>

                                        <div class="single_select">
                                            <select name="ecr_type" class="select_width ecr_select "
                                                id="ecr_type_filter">
                                                <option value="">Select ECR</option>
                                                <option value="ECR">ECR</option>
                                                <option value="ECNR">ECNR</option>
                                            </select>
                                        </div>
                                    </th>

                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="candidate_body">
                                @include('candidates.filter')
                            </tbody>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SMS Modal -->
    <div class="modal fade" id="smsModal" tabindex="-1" aria-labelledby="smsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smsModalLabel">Send SMS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- SMS content -->
                    <form id="send-candidate-sms" action="{{ route('candidates.send-sms') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="smsMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="smsMessage" rows="15" cols="15" placeholder="Enter your message"
                                style="height:auto;"></textarea>
                        </div>
                        <button type="submit" class="btn save-btn">Send SMS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Modal -->
    <div class="modal fade" id="whatsappModal" tabindex="-1" aria-labelledby="whatsappModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="whatsappModalLabel">Send WhatsApp Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- WhatsApp content -->
                    <form id="send-candidate-whatsapp" action="{{ route('candidates.send-whatsapp') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="whatsappMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="whatsappMessage" rows="15" cols="15" placeholder="Enter your message"
                                style="height:auto;"></textarea>
                        </div>
                        <button type="submit" class="btn save-btn">Send WhatsApp</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('submit', '#send-candidate-sms', function(e) {
                e.preventDefault();
                var message = $('#smsMessage').val();

                //  get the candidate id which checkbox is checked
                var candidate_ids = [];
                $('.checkd-row:checked').each(function() {
                    candidate_ids.push($(this).data('id'));
                });
                // are you sure you want to change status
                if (candidate_ids.length == 0) {
                    toastr.error('Please select atleast one candidate');
                    return false;
                }
                if (message == '') {
                    toastr.error('Please write something to send message');
                    return false;
                }

                // are you sure confirm msg show
                swal({
                        title: 'Are you sure?',
                        text: "You want to send message of selected candidates!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, send it!'
                    })
                    .then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: $(this).attr('action'),
                                type: $(this).attr('method'),
                                data: {
                                    message: message,
                                    candidate_ids: candidate_ids,
                                },
                                success: function(response) {
                                    //windows load with toastr message
                                    if (response.status == false) {
                                        toastr.error(response.message);
                                    } else {
                                        window.location.reload();
                                    }


                                },
                                error: function(xhr) {
                                    var errors = xhr.responseJSON.errors;
                                    $.each(errors, function(key, value) {
                                        toastr.error(value[0]);
                                    });
                                }
                            });
                        } else {
                            toastr.error('You have cancelled!');
                        }
                    });
            });

            $(document).on('submit', '#send-candidate-whatsapp', function(e) {
                e.preventDefault();
                var message = $('#whatsappMessage').val();

                //  get the candidate id which checkbox is checked
                var candidate_ids = [];
                $('.checkd-row:checked').each(function() {
                    candidate_ids.push($(this).data('id'));
                });
                // are you sure you want to change status
                if (candidate_ids.length == 0) {
                    toastr.error('Please select atleast one candidate');
                    return false;
                }
                if (message == '') {
                    toastr.error('Please write something to send whatsapp message');
                    return false;
                }

                // are you sure confirm msg show
                swal({
                        title: 'Are you sure?',
                        text: "You want to send whatsapp message of selected candidates!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, send it!'
                    })
                    .then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: $(this).attr('action'),
                                type: $(this).attr('method'),
                                data: {
                                    message: message,
                                    candidate_ids: candidate_ids
                                },
                                success: function(response) {
                                    //windows load with toastr message
                                    window.location.reload();
                                },
                                error: function(xhr) {
                                    var errors = xhr.responseJSON.errors;
                                    $.each(errors, function(key, value) {
                                        toastr.error(value[0]);
                                    });
                                }
                            });
                        } else {
                            toastr.error('You have cancelled!');
                        }
                    });
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            // $('.export_cnadidate_csv').on('click', function() {
            //     // $('#loading').addClass('loading');
            //     // $('#loading-content').addClass('loading-content');
            //     window.location.href = "{{ route('candidates.export') }}";
            // });



            function fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                last_call_status, last_update_by, mode_of_registration, education, city,
                position_applied_for_2, position_applied_for_3,
                english_speak, arabic_speak) {
                $('#candidate_body').html(`<tr><td colspan="15">
                    <div class="spinner-border text-align-center" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div></td></tr>
                `);

                $.ajax({
                    url: "{{ route('candidates.filter') }}",
                    data: {
                        page: page,
                        search: query,
                        cnadidate_status_id: cnadidate_status_id,
                        source: source,
                        gender: gender,
                        position_applied_for: position_applied_for,
                        position_applied_for_2: position_applied_for_2,
                        position_applied_for_3: position_applied_for_3,
                        english_speak: english_speak,
                        arabic_speak: arabic_speak,
                        ecr_type: ecr_type,
                        last_call_status: last_call_status,
                        last_update_by: last_update_by,
                        mode_of_registration: mode_of_registration,
                        education: education,
                        city: city,
                        call_status: '{{ request()->call_status }}',
                        candidate_entry: '{{ request()->candidate_entry }}',
                        filter_position_id: '{{ request()->position_id }}',
                    },
                    success: function(data) {
                        // console.log(data.view);
                        $('#candidate_body').html(data.view);
                    }
                });
            }

            $(document).on('submit', '.search-form', function(e) {
                e.preventDefault();
                var query = $('#query').val();
                var page = $('#hidden_page').val();
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();

                // position applied for array data receive

                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();

                // var position_applied_for = $('#position_applied_for_filter').val();
                // var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                // var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#query').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');

                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            // filter by status & source & gender & position_applied_for & english_speak & arabic_speak

            $(document).on('change', '#cnadidate_status_id_filter', function() {
                var cnadidate_status_id = $(this).val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });


            $(document).on('change', '#source_filter', function() {


                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $(this).val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#gender_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $(this).val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#position_applied_for_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $(this).val();


                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#position_applied_for_filter_2', function() {

                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var position_applied_for_2 = $(this).val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#position_applied_for_filter_3', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_3 = $(this).val();



                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#english_speak_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $(this).val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#arabic_speak_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $(this).val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            // last_call_status_filter

            $(document).on('change', '#last_call_status_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var last_call_status = $(this).val();
                var last_update_by = $('#last_updated_by_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#mode_of_registration_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var mode_of_registration = $(this).val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#education_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $(this).val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#city_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $(this).val();
                var ecr_type = $('#ecr_type_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });


            $(document).on('change', '#ecr_type_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $('#last_updated_by_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $(this).val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            // last updated by filter

            $(document).on('change', '#last_updated_by_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_2 = $('#position_applied_for_filter_2').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var last_call_status = $('#last_call_status_filter').val();
                var last_update_by = $(this).val();

                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, last_update_by, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });



        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-route', function() {
                var route = $(this).data('route');
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');

                $.ajax({
                    url: route,
                    type: 'GET',
                    data: {
                        call_status: '{{ request()->call_status }}',
                        candidate_entry: '{{ request()->candidate_entry }}',
                        filter_position_id: '{{ request()->position_id }}',
                    },
                    success: function(response) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');

                        if (response.status === 'error') {
                            toastr.error(response.message);
                            return;
                        }

                        $('#candidate-edit').html(response.view);
                        $('#offcanvasEdit').offcanvas('show');
                    },
                    error: function(xhr) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        console.log(xhr);
                    }
                });
            });
        });


        // {{-- @if (Session::has('candidate_id'))
        //         var route = "{{ route('candidates.edit', Session::get('candidate_id')) }}";
        //         $('#loading').addClass('loading');
        //         $('#loading-content').addClass('loading-content');
        //         $.ajax({
        //             url: route,
        //             type: 'GET',
        //             success: function(response) {
        //                 if (response.status == 'error') {
        //                     toastr.error(response.message);
        //                     return false;
        //                 } else {
        //                     $('#candidate-edit').html(response.view);
        //                     $('#loading').removeClass('loading');
        //                     $('#loading-content').removeClass('loading-content');
        //                     $('#offcanvasEdit').offcanvas('show');
        //                 }
        //             },
        //             error: function(xhr) {
        //                 // Handle errors
        //                 $('#loading').removeClass('loading');
        //                 $('#loading-content').removeClass('loading-content');
        //                 console.log(xhr);
        //             }
        //         });
        //     @endif --}}
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-close', function() {
                $('.text-danger').html('');
            });

            $(document).on('submit', '#candidate-form-import', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        //windows load with toastr message
                        window.location.reload();

                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        //clear any old errors
                        $('.text-danger').html('');
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            // console.log(key);
                            // Assuming you have a div with class "text-danger" next to each input
                            $('[name="file"]').next('.text-danger').html(value[
                                0]);
                        });
                    }
                });
            });

            $(document).on('click', '.view-details-btn', function(e) {
                e.preventDefault();
                var route = $(this).data('route');
                // load data from remote url
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: route,
                    success: function(resp) {
                        // console.log(resp);
                        //  open modal
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');

                        var candidate_activities = resp.candidate_activities;
                        // console.log(candidate_activities);
                        if (candidate_activities.length == 0) {
                            $('#show-details').html(
                                '<div class="testimonial-box"><div class="box-top"><div class="profile"><div class="name-user"><strong class="date">No Activity Found...</strong></div></div></div></div>'
                            );
                            return false;
                        }
                        var html = '';
                        $.each(candidate_activities, function(key, value) {
                            if (value.created_at) {
                                var date = new Date(value.created_at);

                                var formattedDate = date.getDate().toString().padStart(
                                        2, '0') + ' ' +
                                    date.toLocaleString('default', {
                                        month: 'short'
                                    }) + ', ' +
                                    date.getFullYear();

                                var hours = date.getHours();
                                var minutes = date.getMinutes().toString().padStart(2,
                                    '0');
                                var ampm = hours >= 12 ? 'PM' : 'AM';
                                hours = hours % 12 || 12; // Convert to 12-hour format
                                var formattedTime = hours + ':' + minutes + ' ' + ampm;

                                var fullFormattedDate = formattedDate + ' ' +
                                    formattedTime;
                            } else {
                                var fullFormattedDate = 'Date not available';
                            }

                            // html += fullFormattedDate;


                            var call_status = value.call_status == null ? 'N/A' : value
                                .call_status;
                            html += '<div class="activity_box">';
                            html += '<div class="activity_box_dd">';
                            html += '<div class="activity_box_ff">';
                            html += '<div class="active-user">';
                            html += (value.user?.first_name || '') + ' ' + (value.user
                                ?.last_name || '');

                            html += '</div>';
                            html += '<div class="all_ansered">Call Status: <span>' +
                                call_status +
                                '</span></div>';
                            html += '</div>';
                            html += '<div class="date">' + fullFormattedDate + '</div>';
                            html += '</div>';
                            html += '<div class="active-comment">';
                            html += '<p>' + value.remarks + '</p>';
                            html += '</div>';
                            html += '</div>';

                        });

                        $('#show-details').html(html);
                        // exampleModal2
                        $('#exampleModal2').modal('show');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Check-all functionality
            $(document).on('change', '.checkAll', function() {
                $(".checkd-row").prop('checked', $(this).prop('checked'));
            });

            // Individual checkbox change
            $(document).on('change', '.checkd-row', function() {
                if (!$(this).prop("checked")) {
                    $(".checkAll").prop("checked", false);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#change_status', function(e) {
                e.preventDefault();
                var status_id = $('#change_status_id').val();
                //  get the candidate id which checkbox is checked
                var candidate_ids = [];
                $('.checkd-row:checked').each(function() {
                    candidate_ids.push($(this).data('id'));
                });
                // are you sure you want to change status
                if (candidate_ids.length == 0) {
                    toastr.error('Please select atleast one candidate');
                    return false;
                }
                if (status_id == '') {
                    toastr.error('Please select status');
                    return false;
                }

                // are you sure confirm msg show
                swal({
                        title: 'Are you sure?',
                        text: "You want to change status of selected candidates!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!'
                    })
                    .then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: $(this).attr('action'),
                                type: $(this).attr('method'),
                                data: {
                                    status_id: status_id,
                                    candidate_ids: candidate_ids,
                                },
                                success: function(response) {
                                    //windows load with toastr message
                                    window.location.reload();
                                },
                                error: function(xhr) {
                                    var errors = xhr.responseJSON.errors;
                                    $.each(errors, function(key, value) {
                                        toastr.error(value[0]);
                                    });
                                }
                            });
                        } else {
                            toastr.error('You have cancelled!');
                        }
                    });
            });
        });
    </script>


    <script>
        $('.status_select').select2({
            closeOnSelect: false,
            placeholder: "Status",
            allowClear: true,
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Status');
            }
        });






        // gender multi select
        $(".gender_select").select2({
            closeOnSelect: false,
            placeholder: "Gender",
            allowClear: true
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Gender'); // Set placeholder text manually
            }
        });
        //education multi select
        $(".education_select").select2({
            closeOnSelect: false,
            placeholder: "Education",
            allowClear: false
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Education'); // Set placeholder text manually
            }
        });
        //position1 multi select
        $(".position1_select").select2({
            closeOnSelect: false,
            placeholder: "Position Applied For(1)",
            allowClear: false
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Position Applied For(1)'); // Set placeholder text manually
            }
        });
        //position2 multi select
        $(".position2_select").select2({
            closeOnSelect: false,
            placeholder: "Position Applied For(2)",
            allowClear: false
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Position Applied For(2)'); // Set placeholder text manually
            }
        });
        //position2 multi select
        $(".position3_select").select2({
            closeOnSelect: false,
            placeholder: "Position Applied For(3)",
            allowClear: false
        }).on('change', function(e) {
            var selectedTags = $(this).select2('data').map(function(tag) {
                return tag.text;
            });

            var $selection = $(this).next('.select2-container').find('.select2-selection__rendered');

            if (selectedTags.length > 2) {
                $selection.html(selectedTags.slice(0, 2).join(', ') + ', ...');
            } else if (selectedTags.length > 0) {
                $selection.html(selectedTags.join(', '));
            } else {
                $selection.html('Position Applied For(3)'); // Set placeholder text manually
            }
        });

        //Last call status select
        $(".last_call_status").select2({
            placeholder: "Last call Status",
            allowClear: true,
        });

        //Last call status select
        $(".last_update_by").select2({
            placeholder: "Last Updated By",
            allowClear: true,
        });

        //mode registration status select
        $(".mode_registration_select").select2({
            placeholder: "Mode of Registration",
            allowClear: true,
        });

        //source status select
        $(".source_status").select2({
            placeholder: "Source",
            allowClear: true,
        });

        //city select
        $(".city_select").select2({
            placeholder: "City",
            allowClear: true,
        });

        //english speak select
        $(".eng_spk_select").select2({
            placeholder: "English Speak",
            allowClear: true,
        })

        // arbic speak select
        $(".arbic_select").select2({
            placeholder: "Arabic Speak",
            allowClear: true,
        })

        //ecr type select
        $(".ecr_select").select2({
            placeholder: "ECR Type",
            allowClear: true,
        })
    </script>


    <script>
        $(document).ready(function() {
            $('#query').tagator({
                autocomplete: [
                    @foreach (Position::getPosition() as $item)
                        '{{ $item }}',
                    @endforeach
                    // Include numbers in the autocomplete options
                    @foreach (Position::getNumber() as $number)
                        '{{ $number->contact_no }}',
                    @endforeach
                ],
                useDimmer: true
            });
        });
    </script>
@endpush
