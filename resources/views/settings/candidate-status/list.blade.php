@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Status List
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading row align-items-center">
                {{-- member create start --}}
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                         aria-hidden="true">
                        <div class="offcanvas-body">
                            <form action="" method="POST" enctype="multipart/form-data"
                                id="ip-restrictions-form-create">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <h4>Add IP Address</h4>
                                        <div class="add-mem-form">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label for="">IP<span>*</span></label>
                                                        <input type="text" class="form-control" id="" value=""
                                                            name="ip_address" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <div class="form-group">
                                                        <label for="">Status<span>*</span></label>
                                                        <select name="is_active"  class="form-select">
                                                            <option value="">Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>


                                                <div class="col-lg-12 mt-3">
                                                    <div class="save-btn-div d-flex align-items-center">
                                                        <button type="submit" class="btn save-btn"><span><i
                                                                    class="fa-solid fa-check"></i></span> Submit</button>
                                                        <button type="button"
                                                            class="btn save-btn save-btn-1 close-btn"><span><i
                                                                    class="fa-solid fa-xmark"></i></span>Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                {{-- member create end --}}
                <div id="edit-ip-restrictions">
                    @include('settings.candidate-status.edit')
                </div>

                {{-- member edit end --}}


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
                {{-- <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="d-flex justify-content-center justify-content-md-start">
                        <div class="btn-group me-4">
                            <a href="add_candidate.html" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                aria-controls="offcanvasRight" class="btn addcandidate_btn"><i class="fas fa-plus"></i>
                                Add
                                IP</a>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- page-contain-start  -->
            <div class="integrations-div team-members-div">
                <div class="page__heading row align-items-center mb-0">
                    <div class="col-xl-10 mb-3 mb-md-0">
                        <div class="integrations-head">
                            <h2>Status list</h2>
                        </div>
                    </div>
                    {{-- <div class="col-xl-2 mb-3 mb-md-0">
                        <select class="form-select" name="search_status" id="status">
                            <option value="">Search by Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div> --}}

                </div>


                <div class="user-acces-table team-members-table">
                    <div class="container-fluid page__container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 p-0">
                                <div class="table-responsive border-bottom" data-toggle="lists">
                                    <table class="table mb-0 table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status name</th>
                                                {{-- <th>Color</th>
                                                <th>Background Color</th> --}}
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="user_tbody">
        
                                            @include('settings.candidate-status.filter')
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
            $(document).on('click', '.close-btn', function() {
                $('.text-danger').html('');
                $('#offcanvasRight').offcanvas('hide');
            });

            $('#ip-restrictions-form-create').submit(function(e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success response
                        window.location.reload();
                        // toastr.success('Member details added successfully');
                    },
                    error: function(xhr) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        // Handle errors (e.g., display validation errors)
                        $('.text-danger').html('');
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('[name="' + key + '"]').next('.text-danger').html(value[
                                0]);
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(document).on('click', '#delete', function(e) {
            swal({
                    title: "Are you sure?",
                    text: "To delete this Status.",
                    type: "warning",
                    confirmButtonText: "Yes",
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
            $(document).on('click', '.close-btn-edit', function() {
                $('.text-danger').html('');
                $('#offcanvasEdit').offcanvas('hide');
            });

            $(document).on('click', '.edit-route', function() {
                var route = $(this).data('route');
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
                $.ajax({
                    url: route,
                    type: 'GET',
                    success: function(response) {
                        $('#edit-ip-restrictions').html(response.view);
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        $('#offcanvasEdit').offcanvas('show');
                    },
                    error: function(xhr) {
                        // Handle errors
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        console.log(xhr);
                    }
                });
            });

            // Handle the form submission
            $(document).on('submit', '#status-edit-form', function(e) {


                e.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.location.reload();
                        // toastr.success('Members details updated successfully');
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
        });
    </script>
    <script>
        $(document).ready(function() {


            function fetch_data(page, query,status) {
                $.ajax({
                    url: "{{ route('status.filter') }}",
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
