<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/css/main.css') }}">
</head>
<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('auth-assets/images/bg-02.jpg') }}');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="{{ route('register.submit') }}">
                    @csrf
                    <img src="{{asset('images/logo/aquaterra-transparent.png')}}" alt="logo" class="img-fluid">

                    <span class="login100-form-title p-b-34 p-t-27">
                        Register
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Enter your name">
                        <input class="input100" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter your email">
                        <input class="input100" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Confirm password">
                        <input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>

                    <div class="text-center p-t-30">
                        <a class="txt1" href="{{ route('login.form') }}">
                            Already have an account? Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

    <script src="{{ asset('auth-assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('auth-assets/vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('auth-assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('auth-assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth-assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('auth-assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('auth-assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('auth-assets/vendor/countdowntime/countdowntime.js') }}"></script>
    <script src="{{ asset('auth-assets/js/main.js') }}"></script>

</body>
</html>