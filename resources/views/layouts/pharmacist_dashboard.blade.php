<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    @stack('style')
    <link rel="stylesheet" href="/css/index.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>{{ $title }}</title>
</head>
<body style="background:#f9f9f9;">

    
    <section class="section section-main-dashboard">
        <div class="container-fluid">
            <div class="row-wrapper">
                <div class="container-navbar">
                    <div class="wrapper-navbar">
                        <div class="col text-center headline-navbar py-4">
                            @if ($data->image == null)
                                <img src="/img/avatar.png" class="image-user"  alt="image-user">
                            @else
                                <img src="{{ asset('img/'. $data->image) }}" class="image-user"  alt="image-user">
                            @endif
                            <div class="row">
                                <label class="text-muted">Apoteker</label>
                                <p class="greetings-dashboard">Hi, {{ $data->name }}</p>
                            </div>
                        </div>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item {{ $title == 'Dashboard Apoteker' ? 'active' : '' }}">
                                <a class="nav-link py-0" href="{{ route('dashboard_pharmacist') }}">
                                    <i class='bx bx-home-alt-2 icon'></i>
                                    <div class="nav-name">Dashboard</div>
                                </a>
                            </li>
                            <li class="nav-item {{ $title == 'Tambah Data Obat' ? 'active' : '' }}">
                                <a class="nav-link py-0" href="{{ route('entry_data') }}">
                                    <i class='bx bx-capsule icon'></i>
                                    <div class="nav-name">Input Obat</div>
                                </a>
                            </li>
                            <li class="nav-item {{ $title == 'Tambah Stock Obat' ? 'active' : '' }}">
                                <a class="nav-link py-0" href="{{ route('input_stock') }}">
                                    <i class='bx bx-layer icon'></i>
                                    <div class="nav-name">Tambah Stok</div>
                                </a>
                            </li>
                            <li class="nav-item {{ $title == 'Laporan Stok Masuk' ? 'active' : '' }}">
                                <a class="nav-link py-0" href="{{ route('report_stock_in') }}">
                                    <i class='bx bx-calendar icon'></i>
                                    <div class="nav-name">Stok Masuk</div>
                                </a>
                            </li>
                            
                            <li class="nav-item {{ $title == 'Laporan Stok Keluar' ? 'active' : '' }}">
                                <a class="nav-link py-0" href="{{ route('report_stock_out') }}">
                                    <i class='bx bx-calendar icon'></i>
                                    <div class="nav-name">Stok Keluar</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="container-main-content">
                    <div class="wrapper-navbar px-4">
                        <button class="btn btn-humberger" type="button">
                            <i class='bx bx-menu icon'></i>
                        </button>
                        <div class="dropdown ms-auto">
                            <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
                                <div class="nav-name">
                                    Profil Saya
                                    @if ($data->image == null)
                                        <img src="/img/avatar.png" class="image-user"  alt="image-user">
                                    @else
                                        <img src="{{ asset('img/'. $data->image) }}" class="image-user"  alt="image-user">
                                    @endif
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('profile_patient') }}">
                                        <i class='bx bxs-user-rectangle icon'></i>
                                        <div class="nav-name">Pengaturan</div>
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item btn d-flex align-items-center">
                                            <i class='bx bx-log-in-circle icon'></i>
                                            <div class="nav-name">Keluar</div>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="wrapper-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/typeit@8.4.0/dist/index.umd.js"></script>
    <script src="https://unpkg.com/boxicons@2.0.9/dist/boxicons.js"></script>
    @stack('script')

</body>
</html>