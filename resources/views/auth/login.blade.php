<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-IMUT | Login</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="hold-transition login-page">
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('image/app/logo.png') }}" alt="AdminLTELogo" height="250"
            width="200">
    </div>
    <div class="login-box">
        <div class="login-logo">
            <strong>Welcome</strong>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login untuk melakukan banyak hal.</p>
                <p></p>

                <form action="{{ route('request_login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="nomor" class="form-control @error('nomor') is-invalid @enderror"
                            value="{{ old('nomor') }}" placeholder="Nomor Identitas">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('nomor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        {{-- <div class="col-4"> --}}
                        <button type="submit" class="btn btn-primary btn-block"> <i
                                class="fa fa-right-to-bracket mr-2"></i> Log In</button>
                        {{-- </div> --}}
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                </div>

                <p class="mb-1">
                    <a href="{{ route('register') }}">Register Akun</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('home') }}" class="text-center">Home Page</a>
                </p>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app/adminlte.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('layouts.message')
</body>

</html>
