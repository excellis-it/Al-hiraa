@extends('layouts.master')
@section('title')
{{ env('APP_NAME') }} - Associates
@endsection
@push('styles')
@endpush
@section('content')
<div class="mdk-drawer-layout__content page">
    <div class="container-fluid page__heading-container">
        <div class="page__heading row align-items-center">
            {{-- associate create start --}}
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                aria-hidden="true">
                <div class="offcanvas-body">
                    <form action="{{ route('associates.store') }}" method="POST" id="associate-form-create">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="add-mem-form">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="">Name<span>*</span></label>
                                                <input type="text" class="form-control" value="{{ old('name') }}"
                                                    name="name">
                                                <span class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="">Phone Number<span>*</span></label>
                                                <input type="text" class="form-control" value="{{ old('phone_number') }}"
                                                    name="phone_number">
                                                <span class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="">Associate ID</label>
                                                <input type="text" class="form-control" value="Auto Generated"
                                                    readonly disabled>
                                                <small class="text-muted">Associate ID will be auto-generated (e.g., AL-AS-00001)</small>
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
            {{-- associate create end --}}

            {{-- associate edit start --}}
            <div id="edit-associates">
                @include('settings.associates.edit')
            </div>
            {{-- associate edit end --}}

            <div class="col-xl-8 col-lg-7 col-md-6 mb-3 mb-md-0">
                <div class="d-flex w-100">
                    <form class="search-form d-flex w-100" id="search-form">
                        <button class="btn" type="submit" role="button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <input type="text" class="form-control" placeholder="Search Associates.." name="query"
                            id="query">
                        <div class="btn-group">
                            <button type="submit" class="btn advance_search_btn">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="d-flex justify-content-center justify-content-md-start">
                    <div class="btn-group me-4">
                        <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                            aria-controls="offcanvasRight" class="btn addcandidate_btn"><i class="fas fa-plus"></i>
                            Add Associate</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-contain-start  -->
        <div class="integrations-div team-members-div">
            <div class="page__heading row align-items-center mb-0">
                <div class="col-xl-12 mb-3 mb-md-0">
                    <div class="integrations-head">
                        <h2>Associates List</h2>
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
                                            <th>Associate ID</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Created Date</th>
                                            {{-- <th>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2" height="12"
                                                    viewBox="0 0 2 12">
                                                    <g id="Group_87" data-name="Group 87"
                                                        transform="translate(-1898 -172)">
                                                        <circle id="Ellipse_238" data-name="Ellipse 238"
                                                            cx="1" cy="1" r="1"
                                                            transform="translate(1898 172)" fill="#989898" />
                                                        <circle id="Ellipse_239" data-name="Ellipse 239"
                                                            cx="1" cy="1" r="1"
                                                            transform="translate(1898 177)" fill="#989898" />
                                                        <circle id="Ellipse_240" data-name="Ellipse 240"
                                                            cx="1" cy="1" r="1"
                                                            transform="translate(1898 182)" fill="#989898" />
                                                    </g>
                                                </svg>
                                            </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="associate_tbody">
                                        @include('settings.associates.filter')
                                    </tbody>
                                </table>
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

        $('#associate-form-create').submit(function(e) {
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
                    window.location.reload();
                },
                error: function(xhr) {
                    $('#loading').removeClass('loading');
                    $('#loading-content').removeClass('loading-content');
                    $('.text-danger').html('');
                    var errors = xhr.responseJSON.errors;

                    $.each(errors, function(key, value) {
                        $('[name="' + key + '"]').next('.text-danger').html(value[0]);
                    });
                }
            });
        });
    });
</script>
<script>
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var deleteRoute = $(this).data('route');

        swal({
                title: "Are you sure?",
                text: "To delete this associate.",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true
            })
            .then((result) => {
                if (result.value) {
                    $('#loading').addClass('loading');
                    $('#loading-content').addClass('loading-content');

                    $.ajax({
                        url: deleteRoute,
                        type: 'GET',
                        success: function(response) {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');

                            if (response.status) {
                                toastr.success(response.message);
                                // Reload the page after a short delay to show the toastr
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            toastr.error('Failed to delete associate');
                        }
                    });
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
                    $('#edit-associates').html(response.view);
                    $('#loading').removeClass('loading');
                    $('#loading-content').removeClass('loading-content');
                    $('#offcanvasEdit').offcanvas('show');
                },
                error: function(xhr) {
                    $('#loading').removeClass('loading');
                    $('#loading-content').removeClass('loading-content');
                    console.log(xhr);
                }
            });
        });

        $(document).on('submit', '#associate-edit-form', function(e) {
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
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#' + key + '_msg').html(value[0]);
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
                url: "{{ route('associates.filter') }}",
                data: {
                    page: page,
                    search: query
                },
                success: function(data) {
                    $('#associate_tbody').html(data.view);
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
