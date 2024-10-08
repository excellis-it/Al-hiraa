<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <!-- Simplebar -->
    <link type="text/css" href="{{ asset('assets/css/simplebar.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/bootstrap-5.3.2/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- App CSS -->
    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('assets/css/vendor-material-icons.css') }}" rel="stylesheet">
    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="{{ asset('assets/css/vendor-fontawesome-free.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
</head>

<body class="layout-login-centered-boxed">
    <div class="layout-login-centered-boxed__form">
       <div class=" mb-3 ">
        <a href="javascript:void(0);" class="navbar-brand main_logo">
            <img class="navbar-brand-icon img-fluid" src="{{ asset('assets/images/logo.png') }}" width=""
                alt="">
        </a>
       </div>
        <div class="card p-5">
            <form method="POST" action="{{ route('login.check') }}">
                @csrf
                <div class="form-group mb-3">
                    <label class="text-label" for="email_2">Email</label>
                    <div class="input-group input-group-merge">
                        <input id="email_2" type="email" class="form-control form-control-prepended" name="email"
                            placeholder="">
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label class="text-label" for="password_2">Password</label>
                    <div class="input-group input-group-merge">
                        <input id="password_2" type="password" name="password"
                            class="form-control form-control-prepended" placeholder="">
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {{-- <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" value="" id="invalidCheck01">
                                <label class="custom-control-label" for="invalidCheck01">
                                    Keep me logged in
                                </label>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group text-end">
                            <a href="{{route('forget.password.show')}}" class="forgot_password">Forgot password?</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-login" type="submit">Sign in</button>
                </div>

            </form>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/bootstrap-5.3.2/js/bootstrap.bundle.js') }}"></script>
    <!-- Simplebar -->
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <!-- App -->
    <script src="{{ asset('assets/js/toggle-check-all.js') }}"></script>
    <script src="{{ asset('assets/js/check-selected-row.js') }}"></script>
    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-mini.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- App Settings (safe to remove) -->
    <script src="{{ asset('assets/js/app-settings.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>

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

</body>

</html>
