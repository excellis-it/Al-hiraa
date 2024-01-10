@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Candidates
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading row align-items-center">
                <div class="col-xl-8 col-lg-7 col-md-6 mb-3 mb-md-0">
                    <div class="d-flex w-100">
                        <form class="search-form d-flex w-100" id="search-form">
                            <button class="btn" type="submit" role="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <input type="text" class="form-control" placeholder="Advance Search.." name="query"
                                id="query">
                            <div class="btn-group">
                                <button type="submit" class="btn advance_search_btn">Advance Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="d-flex justify-content-center justify-content-md-start">
                        @can('Create Candidate')
                            <div class="btn-group me-4">
                                <a href="{{ route('candidates.create') }}" class="btn addcandidate_btn">Add Candidate</a>
                                <button type="button" class="btn dropdown-toggle dropdown-toggle-split addcandidate_dropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><a class="dropdown-item" href="#">Import CSV</a></li>
                                </ul>
                            </div>
                        @endcan
                        <div class="btn-group">
                            <button type="button" class="btn export_csv">Export CSV</button>
                            <button type="button" class="btn dropdown-toggle dropdown-toggle-split export_dropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="#">Export CSV</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="all_filter_btn">
                <ul>
                    <li>
                        <a href="" class="active_aa">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.598" height="19.633"
                                viewBox="0 0 19.598 19.633">
                                <path id="pen-clip"
                                    d="M16.557,6.5,5.055,18.088a2.478,2.478,0,0,1-2.822.474L1.4,19.4a.8.8,0,0,1-.581.237A.838.838,0,0,1,.237,19.4a.815.815,0,0,1,0-1.153l.834-.834a2.479,2.479,0,0,1,.474-2.831L11.772,4.3a2.523,2.523,0,0,0-2.683.515L6.61,7.3a.8.8,0,0,1-.581.237A.838.838,0,0,1,5.448,7.3a.815.815,0,0,1,0-1.153L7.927,3.665a4.071,4.071,0,0,1,2.9-1.194,4.03,4.03,0,0,1,2.61.965c.033,0,3.117,3.076,3.117,3.076ZM18.684.532a2.541,2.541,0,0,0-3.379.245L14.218,1.865l3.493,3.493L18.873,4.2A2.473,2.473,0,0,0,18.684.532Z"
                                    transform="translate(0.003 -0.001)" />
                            </svg>
                            Assign Job</a>
                    </li>
                    <li><a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.091" height="19.088"
                                viewBox="0 0 19.091 19.088">
                                <path id="Path_359" data-name="Path 359"
                                    d="M15.655,4.157a2.53,2.53,0,1,1,2.53,2.53,2.53,2.53,0,0,1-2.53-2.53Zm4.37,4.735V13.32a4.591,4.591,0,0,1-4.591,4.591H14.045a.92.92,0,0,0-.735.366L11.929,20.11a1.311,1.311,0,0,1-2.208,0l-1.38-1.831a1.023,1.023,0,0,0-.736-.368H6.225a4.6,4.6,0,0,1-4.6-4.6V6.917a4.6,4.6,0,0,1,4.6-4.6h7.226a.917.917,0,0,1,.895,1.1,4.01,4.01,0,0,0,.026,1.617,3.885,3.885,0,0,0,2.934,2.934A4.01,4.01,0,0,0,18.923,8a.917.917,0,0,1,1.1.895ZM8.065,10.6a.92.92,0,1,0-.92.92A.92.92,0,0,0,8.065,10.6Zm3.68,0a.92.92,0,1,0-.92.92A.92.92,0,0,0,11.745,10.6Zm3.68,0a.92.92,0,1,0-.92.92A.92.92,0,0,0,15.425,10.6Z"
                                    transform="translate(-1.625 -1.627)" />
                            </svg>
                            SMS</a></li>
                    <li><a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.088" height="19.088"
                                viewBox="0 0 19.088 19.088">
                                <path id="_x30_8.Whatsapp"
                                    d="M19.544,10a9.552,9.552,0,0,0-7.73,15.151L10.5,28.61l3.794-1.1a9.442,9.442,0,0,0,5.249,1.575,9.544,9.544,0,0,0,0-19.088Zm5.082,13.5-1.026,1c-1.074,1.074-3.913-.1-6.418-2.625-2.505-2.505-3.627-5.345-2.625-6.394l1.026-1.026a1.038,1.038,0,0,1,1.432,0l1.5,1.5a.994.994,0,0,1-.382,1.646.966.966,0,0,0-.644,1.169,4.582,4.582,0,0,0,2.792,2.768,1,1,0,0,0,1.169-.644.994.994,0,0,1,1.646-.382l1.5,1.5A1.125,1.125,0,0,1,24.626,23.5Z"
                                    transform="translate(-10 -10)" />
                            </svg>
                            WhatsApp</a></li>
                    <li><a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20.072" height="20.072"
                                viewBox="0 0 20.072 20.072">
                                <path id="envelope-download"
                                    d="M12.332,5.256a.836.836,0,0,1,1.183.013l1.539,1.573V.836a.836.836,0,1,1,1.673,0V6.842l1.539-1.573a.837.837,0,0,1,1.2,1.171l-2.1,2.149A2.072,2.072,0,0,1,15.9,9.2a.033.033,0,0,1-.016,0,2.054,2.054,0,0,1-1.455-.6L12.319,6.44a.836.836,0,0,1,.013-1.183Zm-2.3,7.642a2.509,2.509,0,0,0,1.775-.733l1.958-1.958a3.758,3.758,0,0,1-.523-.43L11.123,7.611a2.509,2.509,0,0,1,.038-3.548c.4-.388,1.209-1.1,1.735-1.554H4.182A4.17,4.17,0,0,0,.622,4.525l7.639,7.64a2.509,2.509,0,0,0,1.775.733Zm8.518-3.14a3.636,3.636,0,0,1-3.048,1.076l-2.513,2.513a4.188,4.188,0,0,1-5.915,0L.038,6.308C.027,6.44,0,6.559,0,6.691v9.2a4.187,4.187,0,0,0,4.182,4.182H15.89a4.187,4.187,0,0,0,4.182-4.182V8.206Z" />
                            </svg>
                            Email</a></li>
                </ul>
            </div> --}}
        </div>
        <div class="container-fluid page__container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="table-responsive border-bottom" data-toggle="lists">
                        <table class="table mb-0 table-bordered">
                            <thead>
                                <tr>
                                    {{-- <th></th> --}}
                                    <th>Remarks</th>
                                    <th>Enter By</th>
                                    <th>Status</th>
                                    <th>Mode of Registration</th>
                                    <th>Source</th>
                                    <th>Last Update Date</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>Age</th>
                                    <th>Education</th>
                                    <th>Contact No:</th>
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


        function fetch_data(page, query) {
            $.ajax({
                url: "{{ route('candidates.filter') }}",
                data: {
                    page: page,
                    search: query
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
            fetch_data(page, query);
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            var query = $('#query').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, query);
        });

    });
</script>
@endpush
