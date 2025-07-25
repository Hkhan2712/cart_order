<!DOCTYPE html>
<html lang="en">
<head>
    <title>AquaTerra - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth-assets/css/main.css') }}">
</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('auth-assets/images/bg-02.jpg') }}');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <img src="{{asset('images/logo/aquaterra-transparent.png')}}" alt="logo" class="img-fluid">

                    <span class="login100-form-title p-b-34 p-t-27">
                        Log in
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    <div class="text-center mt-4">
                        <p class="text-white mb-2">Or sign in using</p>
                        <a href="{{ route('auth.google') }}" class="btn btn-light rounded-circle p-2">
                            <img src="{{ asset('storage/icons/google-icon.svg') }}" alt="Google" style="width: 32px; height: 32px;">
                        </a>
                    </div>


                    <div class="text-center p-t-90">
                        <a class="txt1" href="">
                            Forgot Password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

    <script src="{{ asset('auth-assets/js/main.js') }}"></script>

</body>
</html>
