<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'IJAGO MUTU')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
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

        table thead th {
            vertical-align: middle !important;
        }
    </style>
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('image/app/logo.png') }}" alt="AdminLTELogo" height="250"
                width="200">
        </div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">0</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">0 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 0 new messages
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 0 friend requests
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 0 new reports
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post" class="form-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark border-0"><i
                                class="nav-icon fas fa-power-off"></i>
                        </button>
                    </form>
                </li>
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('image/app/user.png') }}" class="user-image img-circle elevation-2"
                            alt="User Image">
                        {{-- <span class="d-none d-md-inline">Alexander Pierce</span> --}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-dark" style="height: 100%">
                            <img src="{{ asset('image/app/user.png') }}" class="img-circle elevation-2"
                                alt="User Image">
                            <p>
                                <span>{{ auth()->user()->nama }}</span>
                                <small>{{ auth()->user()->unit_master->nm_unit }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{ route('profile') }}" class="btn btn-sm btn-dark btn-flat">Profile</a>
                            <form action="{{ route('logout') }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger btn-flat float-right">Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}

            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="#" class="brand-link">
                <img src="{{ asset('image/app/dashboard.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light"><b>SI-IMUT APPS.</b></span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">ADMIN MASTER</li>

                        @can('super_admin')
                            <li class="nav-item">
                                <a href="{{ route('data_master') }}" class="nav-link">
                                    <i class="nav-icon fa fa-copy"></i>
                                    <p>
                                        Data Master
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tree"></i>
                                    <p>
                                        Master SPMI
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('sistem_mutu.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Sistem Mutu</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('kategori_mutu.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kategori Mutu</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('dokumen_mutu.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dokumen Mutu</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link">
                                    <i class="nav-icon far fa-clock"></i>
                                    <p>
                                        Siklus SPMI
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('periode_mutu.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Periode Mutu</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('master_versi.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Versi Dokumen Mutu</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('standar_master.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-gears"></i>
                                <p>
                                    Standar SPMI
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">
                                <i class="nav-icon fas fa-crosshairs"></i>
                                <p>
                                    Instrumen Akreditasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('super_admin')
                                    <li class="nav-item">
                                        <a href="{{ route('monev_kategori.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kriteria Akreditasi</p>
                                        </a>
                                    </li>
                                @endcan
                                <li class="nav-item">
                                    <a href="{{ route('akreditasi_kategori.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kategori Akreditasi</p>
                                    </a>
                                </li>
                                @can('super_admin')
                                    <li class="nav-item">
                                        <a href="{{ route('monev_master.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Monev Akreditasi</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        @can('admin')
                            <li class="nav-item">
                                <a href="{{ route('kuesioner.index') }}" class="nav-link">
                                    <i class="nav-icon far fa-question-circle"></i>
                                    <p>
                                        Kuesioner Mutu
                                    </p>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-header">PUSAT DOKUMEN</li>
                        <li class="nav-item">
                            <a href="{{ route('spmi.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Buku SPMI
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('induk_master_dokumen.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-table-cells-large"></i>
                                <p>
                                    Dokumen Induk
                                </p>
                            </a>
                        </li>
                        @can('admin')
                            <li class="nav-item">
                                <a href="{{ route('mutu_master_dokumen.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chart-simple"></i>
                                    <p>
                                        Dokumen Kinerja
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('monev_master_dokumen.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chart-column"></i>
                                    <p>
                                        Dokumen Kinerja SPMI
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('unit_dokumen_akreditasi') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chart-line"></i>
                                    <p>
                                        Dokumen Akreditasi
                                    </p>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-header">PENJAMINAN MUTU</li>
                        @can('admin')
                            <li class="nav-item">
                                <a href="{{ route('survey_periode.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Survey Kinerja SPMI
                                    </p>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Audit Mutu Internal
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('super_admin')
                                    <li class="nav-item">
                                        <a href="{{ route('ami_periode.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Periode AMI</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('admin')
                                    <li class="nav-item">
                                        <a href="{{ route('ami_master.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Audite</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('user')
                                    <li class="nav-item">
                                        <a href="{{ route('ami_detail') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Auditor</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-check-double"></i>
                                <p>
                                    Audit Akreditasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('super_admin')
                                    <li class="nav-item">
                                        <a href="{{ route('akreditasi_periode') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Periode Akreditasi</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('admin')
                                    <li class="nav-item">
                                        <a href="{{ route('akreditasi_audite') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Audite Akreditasi</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('user')
                                    <li class="nav-item">
                                        <a href="{{ route('akreditasi_asesor') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Asesor Akreditasi</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="nav-header">MANAJEMEN SYSTEM</li>
                        @can('super_admin')
                            <li class="nav-item">
                                <a href="{{ route('index_unit_kerja') }}" class="nav-link">
                                    <i class="nav-icon fas fa-building-columns"></i>
                                    <p>
                                        Manajemen Institusi
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Manajemen User
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('data_user.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>User Account</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('data_dosen.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Stakeholder</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('data_mahasiswa.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Mahasiswa</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('data_alumni.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Alumni</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-gear"></i>
                                <p>
                                    Profile Account
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    @yield('heading')
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer text-sm text-center">
            <strong>&copy; IJAGO SOFT.</strong> Powerade by LTE.
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <script type="text/javascript" src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app/adminlte.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app/demo.js') }}"></script>
    @yield('js')
</body>

</html>
