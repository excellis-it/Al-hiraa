@extends('layouts.master')
@section('title')
    {{ env('APP_NAME') }} - Jobs
@endsection
@push('styles')
    <style>
        .accordion-button:not(.collapsed) {
            background-color: #fff !important;
        }

        .accordion-item {
            border: none !important;
            border-bottom: 1px solid black
        }

        .accordion-button {
            border: 1px solid #0000001f;
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
                                                <img src="{{ $company->company_logo ? Storage::url($company->company_logo) : asset('assets/images/company.png') }}"
                                                    alt="">
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
                                                    <h4>{{ Str::limit($company->company_website, 15) }}</h4>
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
                                                        <option value="">Search job</option>
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
                    <form id="send-job-sms" action="{{ route('jobs.send-job-sms') }}" method="POST">
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
                    <form id="send-job-whatsapp" action="{{ route('jobs.send-job-whatsapp') }}" method="POST">
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
        $(".interview-slide").slick({
            @if (auth()->user()->hasRole('RECRUITER'))
                slidesToShow: 3,
            @elseif (auth()->user()->hasRole('PROCESS MANAGER'))
                slidesToShow: 5,
            @else
                slidesToShow: 7,
            @endif
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            speed: 300,
            centerPadding: "20px",
            infinite: true,
            autoplaySpeed: 5000,
            autoplay: false,
            prevArrow: '<div class="slick-nav prev-arrow"><i class="fa-solid fa-angle-left"></i></div>',
            nextArrow: '<div class="slick-nav next-arrow"><i class="fa-solid fa-angle-right"></i></div>',
            responsive: [{
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false,
                    },
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ],
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('submit', '#send-job-sms', function(e) {
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

            $(document).on('submit', '#send-job-whatsapp', function(e) {
                e.preventDefault();
                var message = $('#whatsappMessage').val();

                //  get the candidate id which checkbox is checked
                var candidate_ids = [];
                var job_ids = [];
                $('.checkd-row:checked').each(function() {
                    candidate_ids.push($(this).data('id'));
                    job_ids.push($(this).data('jobid'));
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
                                    candidate_ids: candidate_ids,
                                    job_ids: job_ids
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
                        job_id: job_id,
                        interestedType: '{{ request()->interested_type }}',
                        interviewId: '{{ request()->interview_id }}',
                        medical_type: '{{ request()->medical_type }}',
                        company_id: '{{ request()->company_id }}',
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
                $('.job_select').next('.select2-container').find('.select2-selection__rendered').html(
                    'Search Position');
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
            placeholder: "Search Job",
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
        $(document).on('submit', '#candidate-job-form-import', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('#loading').addClass('loading');
            $('#loading-content').addClass('loading-content');
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success('Candidates imported successfully');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);

                },
                error: function(xhr) {
                    // Handle errors (e.g., display validation errors)
                    //clear any old errors
                    $('#loading').removeClass('loading');
                    $('#loading-content').removeClass('loading-content');

                    $('.text-danger').html('');
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        // console.log(key);
                        // Assuming you have a div with class "text-danger" next to each input
                        // $('[name="file"]').next('.text-danger').html(value[
                        //     0]);

                        // append all error messages
                        $('[name="file"]').siblings('.text-danger').append('<p>' + value +
                            '</p>');
                    });
                }
            });
        });
    </script>
@endpush
