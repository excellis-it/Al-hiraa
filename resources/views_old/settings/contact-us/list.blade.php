@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Contact us List
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
                        <div class="btn-group me-4">
                            <div class="dropdown">
                                <a class="btn reset-btn" href="{{route('contact-us.index')}}" ><i class="fas fa-redo-alt"></i> Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-contain-start  -->
            <div class="integrations-div team-members-div">
                <div class="page__heading row align-items-center mb-0">
                    <div class="col-xl-10 mb-3 mb-md-0">
                        <div class="integrations-head">
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                </div>


                <div class="user-acces-table team-members-table">
                    <div class="container-fluid page__container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 p-0">
                                <div class="table-responsive border-bottom" data-toggle="lists">
                                    <table class="table mb-0 table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="user_tbody">
                                            @include('settings.contact-us.filter')
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-contain-end  -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {


            function fetch_data(page, query,status) {
                $.ajax({
                    url: "{{ route('contact-us.filter') }}",
                    data: {
                        page: page,
                        search: query,
                        status: status,
                    },
                    success: function(data) {
                        console.log(data.view);
                        $('#user_tbody').html(data.view);
                    }
                });
            }

            $(document).on('submit', '.search-form', function(e) {
                e.preventDefault();
                var query = $('#query').val();
                var page = $('#hidden_page').val();
                var status = $('#status').val();
                fetch_data(page, query,status);
            });

            $(document).on('change', '#status', function(e) {
                e.preventDefault();
                var status = $('#status').val();
                var query = $('#query').val();
                var page = $('#hidden_page').val();
                fetch_data(page, query, status);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#query').val();
                var status = $('#status').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query, status);
            });

        });
    </script>

@endpush
