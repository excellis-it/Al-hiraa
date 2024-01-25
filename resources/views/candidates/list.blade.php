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
                @if (Auth::user()->hasRole('ADMIN'))
                    <div class="col-lg-12 col-md-12 mb-2">
                        <div class="action_btn">
                            <div class="dropdown">
                                <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Action
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void();" data-bs-toggle="modal"
                                            data-bs-target="#bulk_status">Changing status</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">WhatsApp message</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">SMS</a></li>
                                </ul>
                            </div>
                        </div>
                        @if (Auth::user()->hasRole('ADMIN'))
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
                @endif
                <div class="col-lg-12 col-md-12">
                    <div class="table-responsive border-bottom" data-toggle="lists">
                        <table class="table mb-0 table-bordered">
                            <thead>
                                <tr>
                                    @if (Auth::user()->hasRole('ADMIN'))
                                        <th>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox"
                                                    class="custom-control-input js-check-selected-row checkAll"
                                                    name="checkAll">
                                            </div>
                                        </th>
                                    @endif

                                    @can('View Candidate')
                                        <th>
                                            View

                                            {{-- <div class="d-flex">
                                                <div>View</div> <div class="dropdown">
                                                  <span class="dropdown-toggle ps-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-filter"></i>
                                                  </span>
                                                  <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                  </ul>
                                                </div>
                                            </div> --}}
                                        </th>
                                    @endcan
                                    {{-- <th></th> --}}
                                    {{-- <th>Enter By</th> --}}

                                    <th>Status <div>
                                            <select name="cnadidate_status_id" id="cnadidate_status_id_filter"
                                                class="select_width">
                                                <option value="">Select A Status</option>
                                                @foreach ($candidate_statuses as $status)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>Last Call Status <div>
                                            <select name="call_status" class="select_width" id="last_call_status_filter">
                                                <option value="">Select Call Status</option>
                                                @foreach (Position::getCallStatus() as $item)
                                                    <option value="{{ $item }}">
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>Last Update Date</th>
                                    <th>Last Update By</th>
                                    <th>Mode of Registration
                                        <div>
                                            <select name="mode_of_registration" class="select_width"
                                                id="mode_of_registration_filter">
                                                <option value="">Select Type</option>
                                                <option value="Calling">Calling</option>
                                                <option value="Walk-in">Walk-in</option>
                                            </select>
                                        </div>

                                    </th>
                                    <th>Source
                                        <div>
                                            <select name="source" class="select_width" id="source_filter">
                                                <option value="">Select Source Type</option>
                                                <option value="Telecalling">Telecalling
                                                </option>
                                                <option value="Reference">Reference</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Instagram">Instagram</option>
                                                <option value="Others">Others </option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>Full Name</th>
                                    <th>Gender
                                        <div>
                                            <select name="gender" class="select_width" id="gender_filter">
                                                <option value="">Select Gender</option>
                                                <option value="Male"> Male </option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>DOB</th>
                                    <th>Age</th>
                                    <th>Education
                                        <div>
                                            <select name="education" class="select_width" id="education_filter">
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
                                    <th>Position Applied For(1) <div>
                                            <select name="position_applied_for" class="select_width"
                                                id="position_applied_for_filter">
                                                <option value="">Select Position</option>
                                                @foreach ($candidate_positions as $item)
                                                    <option value="{{ $item['id'] }}">
                                                        {{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>Position Applied For(2) <div>
                                            <select name="position_applied_for" class="select_width"
                                                id="position_applied_for_filter_2">
                                                <option value="">Select Position</option>
                                                @foreach ($candidate_positions as $item)
                                                    <option value="{{ $item['id'] }}">
                                                        {{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>Position Applied For(3) <div>
                                            <select name="position_applied_for" class="select_width"
                                                id="position_applied_for_filter_3">
                                                <option value="">Select Position</option>
                                                @foreach ($candidate_positions as $item)
                                                    <option value="{{ $item['id'] }}">
                                                        {{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        Passport Number
                                    </th>
                                    <th>
                                        City
                                        <div>
                                            <select name="city" class="select_width" id="city_filter">
                                                <option value="">Select City</option>
                                                <option value="Mumbai" {{ old('city') == 'Mumbai' ? 'selected' : '' }}>
                                                    Mumbai</option>
                                                <option value="Delhi" {{ old('city') == 'Delhi' ? 'selected' : '' }}>
                                                    Delhi</option>
                                                <option value="Kolkata" {{ old('city') == 'Kolkata' ? 'selected' : '' }}>
                                                    Kolkata</option>
                                                <option value="Chennai" {{ old('city') == 'Chennai' ? 'selected' : '' }}>
                                                    Chennai</option>
                                                <option value="Bangalore"
                                                    {{ old('city') == 'Bangalore' ? 'selected' : '' }}>Bangalore</option>
                                                <option value="Hyderabad"
                                                    {{ old('city') == 'Hyderabad' ? 'selected' : '' }}>Hyderabad</option>
                                                <option value="Ahmedabad"
                                                    {{ old('city') == 'Ahmedabad' ? 'selected' : '' }}>Ahmedabad</option>
                                                <option value="Pune" {{ old('city') == 'Pune' ? 'selected' : '' }}>Pune
                                                </option>
                                                <option value="Surat" {{ old('city') == 'Surat' ? 'selected' : '' }}>
                                                    Surat</option>
                                                <option value="Jaipur" {{ old('city') == 'Jaipur' ? 'selected' : '' }}>
                                                    Jaipur</option>
                                                <option value="Kanpur" {{ old('city') == 'Kanpur' ? 'selected' : '' }}>
                                                    Kanpur</option>
                                                <option value="Nagpur" {{ old('city') == 'Nagpur' ? 'selected' : '' }}>
                                                    Nagpur</option>
                                                <option value="Lucknow" {{ old('city') == 'Lucknow' ? 'selected' : '' }}>
                                                    Lucknow</option>
                                                <option value="Thane" {{ old('city') == 'Thane' ? 'selected' : '' }}>
                                                    Thane</option>
                                                <option value="Bhopal" {{ old('city') == 'Bhopal' ? 'selected' : '' }}>
                                                    Bhopal</option>
                                                <option value="Visakhapatnam"
                                                    {{ old('city') == 'Visakhapatnam' ? 'selected' : '' }}>Visakhapatnam
                                                <option value="Pimpri-Chinchwad"
                                                    {{ old('city') == 'Pimpri-Chinchwad' ? 'selected' : '' }}>
                                                    Pimpri-Chinchwad</option>
                                                <option value="Patna" {{ old('city') == 'Patna' ? 'selected' : '' }}>
                                                    Patna</option>
                                                <option value="Vadodara"
                                                    {{ old('city') == 'Vadodara' ? 'selected' : '' }}>Vadodara</option>
                                                <option value="Ghaziabad"
                                                    {{ old('city') == 'Ghaziabad' ? 'selected' : '' }}>Ghaziabad</option>
                                                <option value="Ludhiana"
                                                    {{ old('city') == 'Ludhiana' ? 'selected' : '' }}>Ludhiana</option>
                                                <option value="Agra" {{ old('city') == 'Agra' ? 'selected' : '' }}>Agra
                                                </option>
                                                <option value="Nashik" {{ old('city') == 'Nashik' ? 'selected' : '' }}>
                                                    Nashik</option>
                                                <option value="Faridabad"
                                                    {{ old('city') == 'Faridabad' ? 'selected' : '' }}>Faridabad</option>
                                                <option value="Meerut" {{ old('city') == 'Meerut' ? 'selected' : '' }}>
                                                    Meerut</option>
                                                <option value="Rajkot" {{ old('city') == 'Rajkot' ? 'selected' : '' }}>
                                                    Rajkot</option>
                                                <option value="Kalyan-Dombivali"
                                                    {{ old('city') == 'Kalyan-Dombivali' ? 'selected' : '' }}>
                                                    Kalyan-Dombivali</option>
                                                <option value="Vasai-Virar"
                                                    {{ old('city') == 'Vasai-Virar' ? 'selected' : '' }}>Vasai-Virar
                                                <option value="Varanasi"
                                                    {{ old('city') == 'Varanasi' ? 'selected' : '' }}>Varanasi</option>
                                                <option value="Srinagar"
                                                    {{ old('city') == 'Srinagar' ? 'selected' : '' }}>Srinagar</option>
                                                <option value="Aurangabad"
                                                    {{ old('city') == 'Aurangabad' ? 'selected' : '' }}>Aurangabad</option>
                                                <option value="Dhanbad" {{ old('city') == 'Dhanbad' ? 'selected' : '' }}>
                                                    Dhanbad</option>
                                            </select>
                                        </div>
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
                                        <div>
                                            <select name="english_speak" class="select_width" id="english_speak_filter">
                                                <option value="">Select English Type</option>
                                                <option value="Basic">Basic</option>
                                                <option value="Good">Good</option>
                                                <option value="Poor">Poor</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        Arabic Speak
                                        <div>
                                            <select name="arabic_speak" class="select_width" id="arabic_speak_filter">
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
                                        ECR Type
                                        <div>
                                            <select name="ecr_type" class="select_width" id="ecr_type_filter">
                                                <option value="">Select ECR</option>
                                                <option value="ECR">ECR</option>
                                                <option value="ECNR">ECNR</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th>
                                        Indian Work Experience
                                    </th>
                                    <th>
                                        Abroad Work Experience
                                    </th>
                                    <th>Remarks</th>
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

            function fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                last_call_status, mode_of_registration, education, city,
                position_applied_for_2, position_applied_for_3,
                english_speak, arabic_speak) {
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
                        mode_of_registration: mode_of_registration,
                        education: education,
                        city: city,
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
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
                    position_applied_for_2, position_applied_for_3,
                    english_speak, arabic_speak);
            });

            $(document).on('change', '#position_applied_for_filter_2', function() {
                var cnadidate_status_id = $('#cnadidate_status_id_filter').val();
                var page = $('#hidden_page').val();
                var query = $('#query').val();
                var source = $('#source_filter').val();
                var gender = $('#gender_filter').val();
                var position_applied_for_2 = $(this).val();
                var position_applied_for = $('#position_applied_for_filter').val();
                var position_applied_for_3 = $('#position_applied_for_filter_3').val();
                var english_speak = $('#english_speak_filter').val();
                var arabic_speak = $('#arabic_speak_filter').val();
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var last_call_status = $('#last_call_status_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();
                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var mode_of_registration = $(this).val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $(this).val();
                var city = $('#city_filter').val();
                var ecr_type = $('#ecr_type_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $(this).val();
                var ecr_type = $('#ecr_type_filter').val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                var mode_of_registration = $('#mode_of_registration_filter').val();
                var education = $('#education_filter').val();
                var city = $('#city_filter').val();
                var ecr_type = $(this).val();

                fetch_data(page, query, cnadidate_status_id, source, gender, position_applied_for, ecr_type,
                    last_call_status, mode_of_registration, education, city,
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
                            var date = new Date(value.created_at);
                            var formattedDate = date.getDate().toString().padStart(2,
                                '0') + ' ' + date.toLocaleString('default', {
                                month: 'short'
                            }) + ', ' + date.getFullYear();
                            var call_status = value.call_status == null ? 'N/A' : value
                                .call_status;
                            html += '<div class="activity_box">';
                            html += '<div class="activity_box_dd">';
                            html += '<div class="activity_box_ff">';
                            html += '<div class="active-user">';
                            html += value.user.first_name + ' ' + value.user.last_name;
                            html += '</div>';
                            html += '<div class="all_ansered">Call Status: <span>' +
                                call_status +
                                '</span></div>';
                            html += '</div>';
                            html += '<div class="date">' + formattedDate + '</div>';
                            html += '</div>';
                            html += '<div class="active-comment">';
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
@endpush
