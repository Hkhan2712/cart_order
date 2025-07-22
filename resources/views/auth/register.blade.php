<!DOCTYPE html>
<html lang="en">
<head>
    <title>AquaTerra - Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('auth-assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('auth-assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('auth-assets/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('auth-assets/css/main.css') }}">
</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('auth-assets/images/bg-02.jpg') }}');">
            <div class="wrap-login100">

                {{-- Form gửi OTP bằng số điện thoại --}}
                <form class="login100-form validate-form" method="POST" action="">
                    @csrf

                    <img src="{{ asset('images/logo/aquaterra-transparent.png') }}" alt="logo" class="img-fluid">

                    <span class="login100-form-title p-b-34 p-t-27">
                        Register
                    </span>

                    @if(session('status'))
                        <div class="alert alert-success text-center">{{ session('status') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger text-center">
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Số điện thoại --}}
                    <div class="wrap-input100 validate-input" data-validate="Enter your phone number">
                        <input class="input100" type="text" name="phone" placeholder="Phone number" value="{{ old('phone') }}" required>
                        <span class="focus-input100" data-placeholder="&#xf2be;"></span>
                    </div>

                    {{-- Google reCAPTCHA --}}
                    <div class="wrap-input100 mb-3 mt-3">
                        {{-- {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!} --}}
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">Next</button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-white mb-2">Or register using</p>
                        <a href="{{ route('auth.google') }}" class="btn btn-light rounded-circle p-2">
                            <img src="{{ asset('storage/icons/google-icon.svg') }}" alt="Google" style="width: 32px; height: 32px;">
                        </a>
                    </div>

                    <div class="text-center p-t-90">
                        <a class="txt1" href="{{ route('login.form') }}">
                            Already have an account? Login
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