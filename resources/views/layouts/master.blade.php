<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <!-- Simplebar -->
    <link type="text/css" href="{{ asset('assets/css/simplebar.min.css') }}" rel="stylesheet">
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        rel="stylesheet">
    <!-- Slider -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link type="text/css" href="{{ asset('assets/bootstrap-5.3.2/css/bootstrap.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('styles')
</head>

<body class="layout-default">
    {{-- import model start --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('candidates.import') }}" method="POST" id="candidate-form-import"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            {{-- <label for="recipient-name" class="col-form-label">Excel:</label> --}}

                            <div class="row mb-3">
                                <div class="col-md-12 mb-6">
                                    <label class="form-label">Download sample candidate CSV file</label>
                                    <a href="{{ route('candidates.download.sample') }}"
                                        class="btn btn-sm btn-primary rounded">
                                        <i class="ti ti-download"></i> Download
                                    </a>
                                </div>
                            </div>

                            <input type="file" class="form-control" id="file" name="file"
                                style="height: auto">
                            <span class="text-danger" id="file-err"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Import model end --}}
    {{-- show remarks --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">History</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="show-details">

                </div>
            </div>
        </div>
    </div>

    {{-- end show --}}
    <!-- <div class="preloader"></div> -->
    <!-- Header Layout -->
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="mdk-header-layout js-mdk-header-layout">
        <div id="header" class="mdk-header js-mdk-header m-0 d-block d-lg-none">
            <div class="mdk-header__content">
                <div class="navbar navbar-expand-sm navbar-main mdk-header--fixed" id="navbar"
                    data-primary="data-primary">
                    <div class="container-fluid p-0">
                        <div class="d-flex justify-content-between w-100 ps-3">
                            <a href="javascript:void(0);" class="">
                                <img class="navbar-brand-icon" src="{{ asset('assets/images/logo.png') }}"
                                    width="100" alt="">
                            </a>
                            <button class="navbar-toggler navbar-toggler-right d-block d-xl-none" type="button">
                                <span class="navbar-toggler-icon">

                                </span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- // END Header -->
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">
            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push="" data-responsive-width="992px">
                @yield('content')
                <!-- // END drawer-layout__content -->
                @include('includes.sidebar')
            </div>
            <!-- // END drawer-layout -->
        </div>
        <!-- // END header-layout__content -->
    </div>
    <!-- // END header-layout -->
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-5.3.2/js/bootstrap.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    {{-- laravel echo with websockets --}}
    <script>
        Echo.join("status-update")
            .here((users) => {
                // console.log(users);
            })

            .joining((user) => {
                console.log('joining' + user.first_name + ' ' + user.last_name);
            })

            .leaving((user) => {
                // call ajax to update is called status to null
                $.ajax({
                    url: "{{ route('candidates.iscalled.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: user.id
                    },
                    success: function(response) {
                        console.log(response.message);
                        var candidate_ids = response.candidate;
                        candidate_ids.forEach(candidate_id => {
                            $('#candidate-' + candidate_id).removeClass('disabled-row');
                        });

                    }
                });
            })

            .listen("UserStatusEvent", (e) => {
                // console.log(e);
            });

        Echo.private("call-candidate").listen(
            ".callCandidate", (data) => {
                var candidate_id = data.candidate_id;

                $('#candidate-' + candidate_id).addClass('disabled-row');
            } // end of getChatRequestAccepted
        );

        Echo.private("call-candidate-end").listen(
            ".callCandidateEnd", (data) => {
                var candidate_id = data.candidate_id;

                $('#candidate-' + candidate_id).removeClass('disabled-row');
            } // end of getChatRequestAccepted
        );
    </script>
    @stack('scripts')
</body>

</html>
