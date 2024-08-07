@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Jobs
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
                <div id="job-edit" class="jobs_canvas">
                    @include('jobs.edit')
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

                    </div>
                </div>

            </div>
            <section class="food-box-sec">
                {{-- <div class="col-lg-6 col-6 mb-2" style="display: flex;justify-content: end;">
                    <div class="action_btn">
                        <div class="dropdown">
                            <a class="btn reset-btn" href="{{ route('jobs.index') }}"><i class="fas fa-redo-alt"></i>
                                Reset</a>
                        </div>
                    </div>
                </div> --}}
                <div class="food-box-slider-box">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="food_box_slid">
                                @foreach ($companies as $company)
                                    <div class="food_box_padding " data-id="{{ $company->id }}">
                                        <div class="food-box filter-company" data-id="{{ $company->id }}">
                                            <div class="food-box-img">
                                                <img src="{{ Storage::url($company->company_logo) }}" alt="">
                                            </div>
                                            <div class="food-box-head">
                                                <h3>{{ $company->company_name }}</h3>
                                            </div>
                                            <div class="food-status">
                                                <div class="food-status-1">
                                                    <h4>Location:</h4>
                                                </div>
                                                <div class="food-status-2">
                                                    <h4>{{ Str::limit($company->company_address, 10) }}</h4>
                                                </div>
                                            </div>

                                            <div class="food-status">
                                                <div class="food-status-1">
                                                    <h4>Website:</h4>
                                                </div>
                                                <div class="food-status-2">
                                                    <h4>{{ Str::limit($company->company_website,15) }}</h4>
                                                </div>
                                            </div>

                                            <div class="food-status">
                                                <div class="food-status-1">
                                                    <h4>Date:</h4>
                                                </div>
                                                <div class="food-status-2">
                                                    <h4>{{ $company->created_at->format('d.m.Y') }}</h4>
                                                </div>
                                            </div>

                                            <div class="food-status">


                                                <div class="multi-select-box-1">
                                                    <select name="job_id[]" id="job_id" class="form-select job_select"
                                                        multiple size="3">
                                                        <option value="">Search position</option>
                                                        @foreach ($company->jobs as $job)
                                                            @php
                                                                $maxLength = 15;
                                                                $jobName = $job->job_name;
                                                                $truncatedJobName =
                                                                    strlen($jobName) > $maxLength
                                                                        ? substr($jobName, 0, $maxLength) . '...'
                                                                        : $jobName;
                                                            @endphp
                                                            <option value="{{ $job->id }}">{{ $truncatedJobName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="company-filter">

            
            @include('jobs.company-filter', ['candidate_jobs' => $candidate_jobs, 'count' => $count])
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            function fetch_data(page, query, company, int_pipeline, job_id) {
                $('#loading').addClass('loading');
                $('#loading-content').addClass('loading-content');
                $.ajax({
                    url: "{{ route('candidates-jobs.filter') }}",
                    method: 'GET',
                    data: {
                        page: page,
                        search: query,
                        company: company,
                        int_pipeline: int_pipeline,
                        job_id: job_id
                    },
                    success: function(response) {
                        $('#loading').removeClass('loading');
                        $('#loading-content').removeClass('loading-content');
                        console.log(response.view);
                        $('#company-filter').html(response.view);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        console.error('Status:', status);
                        console.error('Response:', xhr.responseText);
                    }
                });
            }

            $(document).on('submit', '.search-form', function(e) {
                e.preventDefault();
                var company = $('.filter-company.active').data('id');
                var query = $('#query').val();
                var page = $('#hidden_page').val() || 1;
                var int_pipeline = $('.interview-active').data('val');
                var job_id = $('select[name="job_id[]"]').val();

                fetch_data(page, query, company, int_pipeline, job_id);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#query').val();
                var company = $('.filter-company.active').data('id');
                var int_pipeline = $('.interview-active').data('val');
                var job_id = $('select[name="job_id[]"]').val();

                fetch_data(page, query, company, int_pipeline, job_id);
            });

            $(document).on('click', '.filter-company', function() {
                var company = $(this).data('id');
                var page = $('#hidden_page').val() || 1;
                var query = $('#query').val();
                var int_pipeline = $('.interview-active').data('val');
                var job_id = $('select[name="job_id[]"]').val();
                
                fetch_data(page, query, company, int_pipeline, job_id);

                $('select[name="job_id[]"]').val('null');
                $('.job_select').next('.select2-container').find('.select2-selection__rendered').html('Search Position');
            });

            $(document).on('click', '.filter-select', function() {
                var company = $('.filter-company.active').data('id');
                var page = $('#hidden_page').val() || 1;
                var query = $('#query').val();
                var int_pipeline = $(this).data('val');
                // active this div and remove other active
               
                $('.filter-select').removeClass('interview-active');
                $(this).addClass('interview-active');
                var job_id = $('select[name="job_id[]"]').val();
                fetch_data(page, query, company, int_pipeline, job_id);
            });

            $(document).on('change', 'select[name="job_id[]"]', function() {
                
                var job_id = $(this).val();
                var company = $('.filter-company.active').data('id');
                var int_pipeline = $('.interview-active').data('val');
                var query = $('#query').val();
                var page = $('#hidden_page').val() || 1;

                fetch_data(page, query, company, int_pipeline, job_id);
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
                            $('#job-edit').html(response.view);
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


        });
    </script>


    <script>
        $('.job_select').select2({
            closeOnSelect: false,
            placeholder: "Search Positions",
            allowClear: false,
            tags: true
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
                $selection.html('Status'); // Set placeholder text manually
            }
        });
    </script>

    <script>
        //food-box active
        document.addEventListener('DOMContentLoaded', function() {
            const foodBoxes = document.querySelectorAll('.food-box');
            foodBoxes.forEach(box => {
                box.addEventListener('click', function() {
                    foodBoxes.forEach(otherBox => {
                        otherBox.classList.remove('active');
                    });

                    this.classList.add('active');
                });
            });
        });

    </script>
@endpush
