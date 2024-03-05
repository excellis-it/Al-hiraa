@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Company
@endsection
@push('styles')
@endpush
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="row page__heading">
                @can('Create Company')
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
                        aria-hidden="true">
                        <div class="offcanvas-body">
                            <div class="user-acces-table">
                                <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data"
                                    id="company-form-create">
                                    @csrf
                                    <div class="frm-head">
                                        <h2>Create New Company</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="add-mem-form">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label for="">Company Name<span>*</span></label>
                                                            <input type="text" class="form-control" id=""
                                                                value="" name="company_name" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Company Address <span>*</span></label>
                                                            <input type="text" class="form-control" id=""
                                                                value="" name="company_address" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Company Industry <span>*</span></label>
                                                            <input type="text" class="form-control" id=""
                                                                value="" name="company_industry" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Company Website</label>
                                                            <input type="text" class="form-control" id=""
                                                                value="" name="company_website" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label for="">Company Logo </label>
                                                            <input type="file" class="form-control" id=""
                                                                value="" name="company_logo" placeholder="">
                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <div class="form-group">
                                                            <label for="">Company Description</label>
                                                            <textarea name="company_description" id="" cols="30" class="form-control" style="height: 100%;"
                                                                rows="10"></textarea>
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
                    </div>
                @endcan
                <div class="col-xl-8 col-lg-7 col-md-6 mb-3 mb-md-0">
                    <div class="">
                        <form class="search-form d-flex" action="javascript:void(0);">
                            <button class="btn" type="submit" role="button"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                            <input type="text" class="form-control query" placeholder="Advance Search..">
                        </form>
                    </div>
                </div>
                @can('Create Company')
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <div class="btn-group me-4">
                                <a href="add_candidate.html" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                    aria-controls="offcanvasRight" class="btn addcandidate_btn"><i class="fas fa-plus"></i>
                                    Add
                                    Company</a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <section class="food-box-sec pt-0">
                <div class="container-fluid" id="company-filter">
                    @include('companies.filter')
                </div>
            </section>
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

            $('#company-form-create').submit(function(e) {
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

                        if (response.status == true) {
                            window.location.reload();
                        } else {
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            toastr.error(response.error);
                        }
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
        $(document).ready(function() {


            function fetch_data(page, query) {
                $.ajax({
                    url: "{{ route('companies.filter') }}",
                    data: {
                        page: page,
                        search: query
                    },
                    success: function(data) {
                        $('#company-filter').html(data.view);
                    }
                });
            }

            $(document).on('keyup', '.query', function(e) {
                e.preventDefault();
                var query = $(this).val();
                // alert(query);
                var page = $('#hidden_page').val();
                fetch_data(page, query);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('.query').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query);
            });

        });
    </script>
@endpush
