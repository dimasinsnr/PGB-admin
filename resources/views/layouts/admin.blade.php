<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-confirm.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{url}custom/css/jquery-confirm.css" rel="stylesheet" type="text/css" /> --}}

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Link CSS DataTables -->
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.PNG') }}" rel="icon" type="image/png">

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Script JavaScript DataTables -->
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>

    <style>
        /* CSS untuk dropdown */
        .custom-dropdown {
            position: relative;
            display: inline-block;
        }

        /* Styling dropdown */
        .custom-dropdown-menu {
            display: none;
            position: absolute;
            z-index: 1000;
            min-width: 160px;
            margin: 0;
            font-size: 14px;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.2);
            right: 0; /* Menggeser elemen ke kanan layar */
        }

        .custom-dropdown-menu a {
            display: block;
            padding: 8px 15px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .custom-dropdown-menu a:hover {
            background-color: #f2f3f8;
        }

        .custom-dropdown-menu.show {
            display: block;
            background-color: white;
            border-radius: 5px;
        }
        .custom-dropdown-toggle:focus,
        .custom-dropdown-toggle:active {
            outline: none;
            border: none; /* Menghilangkan border saat tombol dalam keadaan aktif/di-klik */
        }

        .custom-dropdown-menu a:hover {
            background-color: #f0f0f0; /* Warna latar belakang saat tautan dihover */
        }

        td {
            vertical-align: middle !important;
        }

        .swal2-popup {
            width: 28em;
        }
        .swal2-confirm {
            background-color: #0D2A0D !important;
            color: white;
        }
        .dropdown-menu.static {
            position: static !important;
        }
        #tableUnitLatihan_paginate span a {
            background-color: white !important;
            border-radius: 8px;
        }
        #tableAnggota_paginate span a {
            background-color: white !important;
            border-radius: 8px;
        }
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 8px;
        }
        .dataTables_wrapper .tableUnitLatihan_info {
            padding-top: 10px;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 16px;
            padding-left: 10px;
        }
        .image-input {
            position: relative;
            display: inline-block;
            border-radius: 0.475rem;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .image-input .image-input-wrapper {
            width: 120px;
            height: 120px;
            border-radius: 0.475rem;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Gaya tambahan untuk ikon */
        .image-input .editProfile {
            background-color: white;
            z-index: 1; /* Pastikan ikon ada di atas gambar */
            transition: all 0.3s ease; /* Animasi transisi yang halus */
            color: #78829D; /* Warna ikon */
            cursor: pointer; /* Ubah kursor saat diarahkan ke ikon */
            width: 25px;
            height: 25px;
        }

        .image-input .change {
            left: 100%;
            top: 0;
            transform: translate(-100%,0);
        }

        .image-input .downloadProfile {
            background-color: white;
            z-index: 1; /* Pastikan ikon ada di atas gambar */
            transition: all 0.3s ease; /* Animasi transisi yang halus */
            color: #78829D; /* Warna ikon */
            cursor: pointer; /* Ubah kursor saat diarahkan ke ikon */
            width: 35px;
            height: 35px;
        }

        .image-input .cancel {
            left: 100%;
            top: 100%;
            transform: translate(-100%,-100%);
        }

        .image-input .download {
            left: 50%;
            top: 85%;
            transform: translate(-100%,-100%);
            color: white;
            background-color: rgba(255, 255, 255, 0.3); /* Ubah nilai opacity di sini (0-1) */
            border: 2px solid white; /* Border putih 1px */
        }

        .image-input [data-kt-image-input-action] {
            cursor: pointer;
            position: absolute;
            transform: translate(-50%,-50%);
        }

        .badge-corner {
            position: relative;
        }

        .badge-text {
            position: absolute;
            bottom: 0;
            left: 0;
            font-size: smaller;
            display: none;
        }
    </style>

    @stack('css')
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion shadow" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" style="height: 5.375rem !important;" href="{{ route('home') }}">
            {{-- <div class="sidebar-brand-icon rotate-n-15"> --}}
                <img src="{{ asset('img/logo_pgb.png') }}" width="50px" alt="">
                {{-- <i class="fas fa-laugh-wink"></i> --}}
            {{-- </div> --}}
            {{-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> --}}
        </a>

        <!-- Divider -->
        {{-- <hr class="sidebar-divider my-0"> --}}

        <!-- Nav Item - Dashboard -->
        <li class="mt-3 pl-3 nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span style="font-size: 15px;">{{ __('Overview') }}</span></a>
        </li>

        {{-- <!-- Divider -->
        <hr class="sidebar-divider"> --}}

        {{-- <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Settings') }}
        </div> --}}

        <!-- Nav Item -->
        <li class="pl-3 nav-item {{ Nav::isRoute('unit_latihan.index') }}">
            <a class="nav-link" href="{{ route('unit_latihan.index') }}">
                <i class="fas fa-fw fa-plus"></i>
                <span style="font-size: 15px;">{{ __('Unit Latihan') }}</span>
            </a>
        </li>

        <!-- Nav Item -->
        <li class="pl-3 nav-item {{ Nav::isRoute('anggota.index') }}">
            <a class="nav-link" href="{{ route('anggota.index') }}">
                <i class="fas fa-fw fa-plus"></i>
                <span style="font-size: 15px;">{{ __('Anggota PGB') }}</span>
            </a>
        </li>

        <li class="pl-3 nav-item {{ Nav::isRoute('dokumen_kesehatan.index') }}">
            <a class="nav-link" href="{{ route('dokumen_kesehatan.index') }}">
                <i class="fas fa-fw fa-plus"></i>
                <span style="font-size: 15px;">{{ __('Dokumen Kesehatan') }}</span>
            </a>
        </li>

        <!-- Nav Item -->
        <li class="pl-3 nav-item {{ Nav::isRoute('datakesehatan.index') }}">
            <a class="nav-link" href="{{ route('datakesehatan.index') }}">
                <i class="fas fa-fw fa-plus"></i>
                <span style="font-size: 15px;">{{ __('Data Kesehatan') }}</span>
            </a>
        </li>

        <!-- Nav Item -->
        {{-- <li class="pl-3 nav-item {{ Nav::isRoute('basic.index') }}">
            <a class="nav-link" href="{{ route('basic.index') }}">
                <i class="fas fa-fw fa-plus"></i>
                <span style="font-size: 15px;">{{ __('Basic CRUD') }}</span>
            </a>
        </li> --}}

        <!-- Nav Item - Profile -->
        {{-- <li class="pl-3 nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span style="font-size: 15px;">{{ __('Profile') }}</span>
            </a>
        </li> --}}

        <!-- Nav Item - About -->
        {{-- <li class="pl-3 nav-item {{ Nav::isRoute('about') }}">
            <a class="nav-link" href="{{ route('about') }}">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span style="font-size: 15px;">{{ __('About') }}</span>
            </a>
        </li> --}}

        <!-- Nav Item -->
        <li class="pl-3 nav-item {{ Nav::isRoute('blank') }}">
            <a class="nav-link" href="{{ route('blank') }}">
                <i class="fas fa-fw fa-book"></i>
                <span style="font-size: 15px;">{{ __('Blank Page') }}</span>
            </a>
        </li>

        <!-- Divider -->
        {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

        <!-- Sidebar Toggler (Sidebar) -->
        {{-- <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div> --}}

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        {{-- <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a> --}}
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    {{-- <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li> --}}

                    {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <figure class="mr-2 img-profile rounded-circle avatar font-weight-bold" style="background-color: #0D2A0D !important;" data-initial="{{ Auth::user()->name[0] }}"></figure>
                            <span class="d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('user.index') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('User') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Profile') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @stack('notif')
                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // APP_URL = "{url}manages/";
    BASE_URL = "{{ env('APP_URL') }}";
</script>

<!-- Scripts -->
{{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}

<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('js/helper.js') }}"></script>
<script src="{{ asset('js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.js') }}"></script>
{{-- <script src="{{ asset('js/select2.full.min.js') }}"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>z

@stack('js')
</body>
</html>

<?php

// Fungsi Tujuan
function fungsiTujuan($koefisien, $variabel) {
    $hasil = 0;
    for ($i = 0; $i < count($koefisien); $i++) {
        $hasil += $koefisien[$i] * $variabel[$i];
    }
    return $hasil;
}

// Fungsi Batasan
function fungsiBatasan($koefisienBatasan, $variabel) {
    $hasil = 0;
    for ($i = 0; $i < count($koefisienBatasan); $i++) {
        $hasil += $koefisienBatasan[$i] * $variabel[$i];
    }
    return $hasil;
}

// Pemrograman Linier
function pemrogramanLinier($koefisienTujuan, $batasan, $batasanNilai) {
    $nVariabel = count($koefisienTujuan);
    $nBatasan = count($batasan);

    // Inisialisasi variabel
    $variabel = array_fill(0, $nVariabel, 0);

    do {
        // Hitung nilai fungsi tujuan
        $nilaiTujuan = fungsiTujuan($koefisienTujuan, $variabel);

        // Hitung nilai batasan
        $nilaiBatasan = array();
        for ($i = 0; $i < $nBatasan; $i++) {
            $nilaiBatasan[$i] = fungsiBatasan($batasan[$i], $variabel);
        }

        // Cek apakah nilai variabel memenuhi batasan
        $memenuhiBatasan = true;
        for ($i = 0; $i < $nBatasan; $i++) {
            if ($nilaiBatasan[$i] > $batasanNilai[$i]) {
                $memenuhiBatasan = false;
                break;
            }
        }

        // Jika memenuhi batasan, kita selesai
        if ($memenuhiBatasan) {
            break;
        }

        // Jika tidak memenuhi batasan, lakukan iterasi untuk mengoptimalkan variabel
        for ($i = 0; $i < $nVariabel; $i++) {
            $variabel[$i]++;
            if (fungsiBatasan($batasan[0], $variabel) <= $batasanNilai[0]) {
                break;
            }
            $variabel[$i] = 0;
        }
    } while (true);

    return $variabel;
}

// Contoh implementasi
$koefisienTujuan = array(5, 3); // Koefisien fungsi tujuan
$batasan = array(array(2, 1), array(1, 3)); // Koefisien batasan
$batasanNilai = array(8, 6); // Nilai batasan

$hasil = pemrogramanLinier($koefisienTujuan, $batasan, $batasanNilai);

// Tampilkan hasil
echo "Jumlah barang 1: " . $hasil[0] . "<br>";
echo "Jumlah barang 2: " . $hasil[1] . "<br>";

?>
