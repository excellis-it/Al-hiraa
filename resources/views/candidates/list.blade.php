@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Candidates
@endsection
@push('styles')
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
                <div id="candidate-edit">
                    @include('candidates.edit')
                </div>
                {{-- end edit candidates --}}
                <div class="col-xl-8 col-lg-7 col-md-6 mb-3 mb-md-0">
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


                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="d-flex justify-content-center justify-content-md-start">
                        @can('Create Candidate')
                            <div class="btn-group me-4">
                                <a href="{{ route('candidates.create') }}" class="btn addcandidate_btn">Add Candidate</a>
                                @if (Auth::user()->hasRole('ADMIN'))
                                    <button type="button"
                                        class="btn dropdown-toggle dropdown-toggle-split addcandidate_dropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                        <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-bs-whatever="@fat">Import CSV</a></li>
                                    </ul>
                                @endif

                            </div>
                        @endcan
                        @can('Export Candidate')
                            <div class="btn-group ">
                                <button type="button" class="btn export_csv export_cnadidate_csv">Export CSV</button>
                                <button type="button" class="btn dropdown-toggle dropdown-toggle-split export_dropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><a class="dropdown-item" href="{{ route('candidates.export') }}">Export CSV</a></li>
                                </ul>
                            </div>
                        @endcan
                    </div>
                </div>

            </div>

        </div>

        <div class="container-fluid page__container">
            <div class="row mb-2">
                <div class="col-md-2">
                    {{-- status --}}
                    <select name="cnadidate_status_id" class="form-select" id="cnadidate_status_id_filter">
                        <option value="">Select A Status</option>
                        @foreach ($candidate_statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
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
                <div class="col-md-2">
                    <select name="gender" class="form-select" id="gender_filter">
                        <option value="">Select Gender</option>
                        <option value="Male"> Male </option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="position_applied_for" class="form-select select2" id="position_applied_for_filter">
                        <option value="">Select Position</option>
                        @foreach (Position::getPosition() as $item)
                            <option value="{{ $item }}">
                                {{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="english_speak" class="form-select" id="english_speak_filter">
                        <option value="">Select English Type</option>
                        <option value="Basic">Basic</option>
                        <option value="Good">Good</option>
                        <option value="Poor">Poor</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="arabic_speak" class="form-select" id="arabic_speak_filter">
                        <option value="">Select Arbic Type</option>
                        <option value="Basic">Basic</option>
                        <option value="Good">Good</option>
                        <option value="Poor">Poor</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="table-responsive border-bottom" data-toggle="lists">
                        <table class="table mb-0 table-bordered">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    {{-- <th>Enter By</th> --}}
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    <th>Call Status</th>
                                    <th>Mode of Registration</th>
                                    <th>Source</th>
                                    <th>Last Update Date</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>Age</th>
                                    <th>Education</th>
                                    <th>
                                        Other Education
                                    </th>
                                    <th>Position Applied For(1)</th>
                                    <th>Position Applied For(2)</th>
                                    <th>Position Applied For(3)</th>
                                    <th>
                                        Passport Number
                                    </th>
                                    <th>
                                        City
                                    </th>
                                    <th>
                                        Referred By
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
                                        English Speak
                                    </th>
                                    <th>
                                        Arabic Speak
                                    </th>
                                    <th>
                                        Gulf Return
                                    </th>
                                    <th>
                                        ECR Type
                                    </th>
                                    <th>
                                        Indian Work Experience
                                    </th>
                                    <th>
                                        Abroad Work Experience
                                    </th>
                                    @can('View Candidate')
                                        <th>

                                        </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="list" id="candidate_body">

                                @include('candidates.filter')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.export_cnadidate_csv').on('click', function() {
                window.location.href = '{{ route('candidates.export') }}';
            });

            function fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for,
                english_speak, arabic_speak) {
                $.ajax({
                    url: "{{ route('candidates.filter') }}",
                    data: {
                        page: page,
                        search: query,
                        cnadidate_status_id: cnadidate_status_id,
                        source: source,
                        gender: gender,
                        position_applied_for : position_applied_for,
                        english_speak : english_speak,
                        arabic_speak : arabic_speak
                    },
                    success: function(data) {
                        console.log(data.view);
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
                var position_applied_for = $('#position_applied_for_filter').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for,
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
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();


                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for,
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
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for,
                    english_speak, arabic_speak);
            });


            $(document).on('change', '#source_filter', function() {

                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $(this).val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#gender_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $(this).val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#position_applied_for_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $(this).val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#english_speak_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var english_speak = $(this).val();
                var arabic_speak = $('#arabic_speak_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#arabic_speak_filter', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $(this).val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for,
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
                    success: function(response) {
                        if (response.status == 'error') {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            toastr.error(response.message);
                            return false;
                        } else {
                            $('#candidate-edit').html(response.view);
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            $('#offcanvasEdit').offcanvas('show');
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        console.log(xhr);
                    }
                });
            });
            @if (Session::has('candidate_id'))
                var route = "{{ route('candidates.edit', Session::get('candidate_id')) }}";
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
                $.ajax({
                    url: route,
                    type: 'GET',
                    success: function(response) {
                        if (response.status == 'error') {
                            toastr.error(response.message);
                            return false;
                        } else {
                            $('#candidate-edit').html(response.view);
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            $('#offcanvasEdit').offcanvas('show');
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        console.log(xhr);
                    }
                });
            @endif
        });
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
                        // console.log(resp.view);
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
                            var date = new Date(value.created_at);
                            var formattedDate = date.getDate().toString().padStart(2,
                                '0') + ' ' + date.toLocaleString('default', {
                                month: 'short'
                            }) + ', ' + date.getFullYear();
                            html += '<div class="testimonial-box">';
                            html += '<div class="box-top">';
                            html += '<div class="profile">';
                            html += '<div class="name-user">';
                            html += '<strong class="date">Activity on ' +
                                formattedDate + '</strong>';
                            html += '<br>';
                            @if (Auth::user()->hasRole('ADMIN'))
                                html += '<p><b>' + value.call_status + '(' + value.user
                                    .first_name + ' ' + value.user.last_name +
                                    ')</b></p>';
                            @else
                                html += '<p><b>' + value.call_status + '</b></p>';
                            @endif
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="client-comment">';
                            html += '<p>' + value.remarks + '</p>';
                            html += '</div>';
                            html += '</div>';
                        });

                        $('#show-details').html(html);
                    }
                });
            });
        });
    </script>
@endpush
