<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/pharmacist.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="container-layout">
        <div class="wrapper-nav">
            <nav id="navbar-side">
                <div class="navbar-headline">
                    <img src="/img/user.png" alt="image">
                    <h6>APOTEKER</h6>
                    <h4>{{ Auth::guard('pharmacist')->user()->name }}</h4>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="navbar-content">
                    <li class="mb-2 {{ $title === 'Dashboard Apoteker' ? 'active' : '' }}">
                        <a href="{{ route('dashboard_pharmacist') }}">
                            <i class='bx bx-home-alt-2 bx-sm icon'></i>
                            <span class="label-icon">Dashboard</span>
                        </a>
                    </li>
                    <div class="btn-navlink-collapse mb-2 wrapper-collapse">
                        <a data-bs-toggle="collapse" class="nav-collapse" href="#dataObat" role="button" aria-expanded="false">
                            <i class='bx bx-layer bx-sm icon'></i>
                            <span class="label-icon">Data Obat</span>
                            <i class='bx bx-chevron-down ms-auto me-2 arrow-down'></i>
                        </a>
                    </div>

                    <div class="collapse" id="dataObat">
                        <div class="card card-body pt-2 px-0 pb-0 content-collapse">
                            <li class="mb-2 {{ $title === 'Tambah Data Obat' ? 'active' : '' }}">
                                <a href="{{ route('entry_data') }}">
                                    <i class='bx bx-cart-download bx-sm icon'></i>
                                    <span class="label-icon">Input Obat</span>
                                </a>
                            </li>
                            <li class="mb-2 {{ $title == 'Tambah Stock Obat' ? 'active' : '' }}">
                                <a href="{{ route('input_stock') }}">
                                    <i class='bx bx-cloud-upload bx-sm icon'></i>
                                    <span class="label-icon">update Stok</span>
                                </a>
                            </li>
                        </div>
                    </div>
                    <div class="btn-navlink-collapse wrapper-collapse">
                        <a data-bs-toggle="collapse" class="nav-collapse" href="#navlinkCollapse" role="button" aria-expanded="false">
                            <i class='bx bx-printer bx-sm icon'></i>
                            <span class="label-icon">Cetak Laporan</span>
                            <i class='bx bx-chevron-down ms-auto me-2 arrow-down'></i>
                        </a>
                    </div>

                    <div class="collapse" id="navlinkCollapse">
                        <div class="card card-body pt-2 px-0 pb-0 content-collapse">
                            <li class="mb-2 {{ $title == 'Laporan Stok Masuk' ? 'active' : '' }}">
                                <a href="{{ route('report_stock_in') }}">
                                    <i class='bx bx-cart-download bx-sm icon'></i>
                                    <span class="label-icon">Stok Masuk</span>
                                </a>
                            </li>
                            <li class="mb-2 {{ $title == 'Laporan Stok Keluar' ? 'active' : '' }}">
                                <a href="{{ route('report_stock_out') }}">
                                    <i class='bx bx-cloud-upload bx-sm icon'></i>
                                    <span class="label-icon">Stok Keluar</span>
                                </a>
                            </li>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <main id="main-content">
            <section class="section-top-navbar">
                <button class="btn btn-minimize">
                    <i class='bx bx-menu bx-sm'></i>
                </button>
                <div class="wrapper-toggle">
                    <i class='bx bx-moon bx-sm moon'></i>
                    <i class='bx bx-sun bx-sm sun'></i>
                    <button class="btn btn-mode-toggle">
                        <span class="icon-switch"></span>
                    </button>
                </div>
                <div class="btn-group ms-auto wrapper-settings">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('/img/user.png') }}" alt="">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end wrapper-dropdown">
                        <li>
                            <button class="dropdown-item" type="button">
                                <i class='bx bx-street-view bx-sm me-2'></i> My Profile
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="form-logout">
                                @csrf
                                <button class="dropdown-item btn-logout" type="button" data-name="{{ Auth::guard('pharmacist')->user()->name }}">
                                    <i class='bx bx-log-out bx-rotate-180 bx-sm me-2'></i> Log out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="section-content">
                @yield('content')
            </section>
        </main>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/dashboard.js') }}"></script>
</body>
</html>