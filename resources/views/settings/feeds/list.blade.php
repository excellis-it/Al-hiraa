@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Feed List
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading row align-items-center">
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                    aria-hidden="true">
                    <div class="offcanvas-body">
                        <form action="{{ route('feeds.store') }}" method="POST" enctype="multipart/form-data"
                            id="member-form-create">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="frm-head">
                                        <h2>Add Feed</h2>
                                    </div>
                                    <div class="add-mem-form">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="form-group">
                                                    <label for="">Feed Title<span>*</span></label>
                                                    <input type="text" class="form-control" name="title">
                                                    <span class="text-danger" id="title"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Feed Image (Multiple)<span>*</span></label>
                                                    <input type="file" class="form-control" name="image[]" multiple>
                                                    <span class="text-danger" id="image"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Feed Description<span>*</span></label>
                                                    <textarea class="form-control" name="description"></textarea>
                                                    <span class="text-danger" id="description"></span>
                                                </div>
                                                {{-- multiple file upload --}}

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
                <div id="edit-city">
                    @include('settings.feeds.edit')
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
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="d-flex justify-content-center justify-content-md-start">
                        <div class="btn-group me-4">
                            <a href="add_candidate.html" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                aria-controls="offcanvasRight" class="btn addcandidate_btn"><i class="fas fa-plus"></i>
                                Add
                                Feed</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-contain-start  -->
            <div class="integrations-div team-members-div">
                <div class="page__heading row align-items-center mb-0">
                    <div class="col-lg-6 col-6 mb-2">
                        <div class="integrations-head">
                            <h2>Manage Feed</h2>
                        </div>
                    </div>

                    <div class="col-lg-6 col-6 mb-2" style="display: flex;justify-content: end;">
                        <div class="action_btn">
                            <div class="dropdown">
                                <a class="btn reset-btn" href="{{ route('feeds.index') }}"><i class="fas fa-redo-alt"></i>
                                    Reset</a>
                            </div>
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
                                                <th>#ID</th>
                                                <th>Feed Title</th>
                                                <th>Feed Description</th>
                                                <th><svg xmlns="http://www.w3.org/2000/svg" width="2" height="12"
                                                        viewBox="0 0 2 12">
                                                        <g id="Group_87" data-name="Group 87"
                                                            transform="translate(-1898 -172)">
                                                            <circle id="Ellipse_238" data-name="Ellipse 238" cx="1"
                                                                cy="1" r="1" transform="translate(1898 172)"
                                                                fill="#989898" />
                                                            <circle id="Ellipse_239" data-name="Ellipse 239"
                                                                cx="1" cy="1" r="1"
                                                                transform="translate(1898 177)" fill="#989898" />
                                                            <circle id="Ellipse_240" data-name="Ellipse 240"
                                                                cx="1" cy="1" r="1"
                                                                transform="translate(1898 182)" fill="#989898" />
                                                        </g>
                                                    </svg></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="user_tbody">
                                            @include('settings.feeds.filter')
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

            $('#member-form-create').submit(function(e) {
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
                        // Handle errors (e.g., display validation errors)
                        $('.text-danger').html('');
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            if (key.includes('.')) {
                                // Handle array validation errors
                                var fieldName = key.split('.');
                                var fieldName = fieldName[0];
                                // Display errors for array fields
                                var num = key.match(/\d+/)[0];
                                console.log(value[0]);
                                // console.log( $('#' + fieldName+ '_error.' + num).html(value[0]));
                               toastr.error(value[0]);
                               $('#loading').removeClass('loading');
                               $('#loading-content').removeClass('loading-content');
                            } else {
                                // Display errors for non-array fields
                                // $('#' + key + '_msg').html(value[0]);
                                toastr.error(value[0]);
                                $('#loading').removeClass('loading');
                                $('#loading-content').removeClass('loading-content');
                            }
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
                    text: "To delete this post.",
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
                        $('#edit-city').html(response.view);
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
            $(document).on('submit', '#feed-edit-form', function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // alert('Feed details updated successfully');
                        window.location.reload();
                        // toastr.success('Feed details updated successfully');
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., display validation errors)
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            // Assuming you have a span with class "text-danger" next to each input
                            $('#' + key + '_msg').html(value[0]);
                            $('#' + key + '_msg').html(value[1]);
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {


            function fetch_data(page, query) {
                $.ajax({
                    url: "{{ route('feeds.filter') }}",
                    data: {
                        page: page,
                        search: query,
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
                fetch_data(page, query);
            });

            $(document).on('change', '#status', function(e) {
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
    <script>
        $(document).ready(function() {
            $(document).on('click', '.remove-image', function() {
                var id = $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                // show confirm alert
                if (!confirm("Do you really want to delete this image?")) {
                    return false;
                } else {
                    $.ajax({
                        url: "{{ route('feeds.deleteImage') }}",
                        type: 'GET',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function() {
                            toastr.success('Image Deleted Successfully');
                            $('#' + id).remove();
                        }
                    });
                }
            });
        });
    </script>
@endpush
