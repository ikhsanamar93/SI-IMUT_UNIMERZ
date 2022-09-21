<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-IMUT | IJAGO MUTU</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <script type="text/javascript" src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app/adminlte.min.js') }}"></script>


    @yield('css')
    <style>
        .card-footer {
            border-top-width: 1px !important;
            background-color: white !important;
        }

        .select2-container .select2-selection--single {
            height: 34px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            margin-top: -5px !important;
            margin-left: -10px !important;
        }

        select.form-control-sm~.select2-container--default {
            font-size: .875rem !important;
        }

        .text-sm .select2-container--default .select2-selection--single .select2-selection__arrow,
        select.form-control-sm~.select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 0.2rem !important;
        }

        .table {
            text-transform: capitalize !important;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('image/app/logo.png') }}" alt="AdminLTELogo" height="250"
                width="200">
        </div>
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <img src="{{ asset('image/app/home.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light"><strong> SI-IMUT APPS.</strong></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Navigasi Menu</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="{{ route('home') }}" class="dropdown-item">Home Page</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('index') }}" class="dropdown-item">Dashboard</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('buku_spmi') }}" class="dropdown-item">Buku SPMI</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('dokumen_induk') }}" class="dropdown-item">Dokumen Induk</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('standar_spmi') }}" class="dropdown-item">Standar SPMI</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Survey/Monev</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li><a href="{{ route('survey_mahasiswa') }}" class="dropdown-item">Mahasiswa </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('survey_dosen') }}" class="dropdown-item">Dosen</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('survey_tendik') }}" class="dropdown-item">Tendik</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('survey_alumni') }}" class="dropdown-item">Alumni</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('survey_mitra') }}" class="dropdown-item">Stakeholder</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">Tracer Study</a>
                        </li>
                    </ul>
                </div>

                @auth
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn nav-link">Logout
                                    <i class="fas fa-right-from-bracket"></i></button>
                            </form>
                        </li>
                    </ul>
                @else
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" role="button">
                                <i class="fas fa-right-to-bracket"></i>
                                Login
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu3" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Register</a>
                            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                <li><a href="{{ route('register') }}" class="dropdown-item">Dosen/Tendik </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('register_mahasiswa') }}" class="dropdown-item">Mahasiswa</a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('register_alumni') }}" class="dropdown-item">Alumni</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="{{ route('register_mitra') }}" class="dropdown-item">Stakeholder</a></li>
                            </ul>
                        </li>
                    </ul>
                @endauth
            </div>
        </nav>

        @yield('body')

        <aside class="control-sidebar control-sidebar-dark">
        </aside>

        <footer class="main-footer text-sm text-center">
            <strong>&copy; IJAGO SOFT.</strong> Powerade by LTE.
        </footer>
    </div>

    @yield('js')

</body>

</html>
