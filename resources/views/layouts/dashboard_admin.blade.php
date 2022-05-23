<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/admin.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="container-layout">
        <div class="wrapper-nav">
            <nav id="navbar-side">
                <div class="navbar-headline">
                    <img src="/img/profile.jpeg" alt="image">
                    <h6>ADMIN</h6>
                    <h4>{{ Auth::guard('web')->user()->name }}</h4>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="navbar-content">
                    <li class="mb-2 {{ $title === 'Dashboard Saya' ? 'active' : '' }}">
                        <a href="{{ route('dashboard_admin') }}">
                            <i class='bx bx-home-alt-2 bx-sm {{ $title === 'Dashboard Saya' ? 'bx-flashing' : '' }} icon'></i>
                            <span class="label-icon">Dashboard Saya</span>
                        </a>
                    </li>
                    <li class="mb-2 {{ $title === 'Data Pengguna' ? 'active' : '' }}">
                        <a href="{{ route('list_user') }}">
                            <i class='bx bx-user bx-sm {{ $title === 'Data Pengguna' ? 'bx-flashing' : '' }} icon'></i>
                            <span class="label-icon">Data Pengguna</span>
                        </a>
                    </li>
                    <li class="mb-2 {{ $title === 'Riwayat Hapus User' ? 'active' : '' }}">
                        <a href="{{ route('trash') }}">
                            <i class='bx bx-layer bx-sm {{ $title === 'Riwayat Hapus User' ? 'bx-flashing' : '' }} icon'></i>
                            <span class="label-icon">Riwayat Hapus</span>
                        </a>
                    </li>
                    <li class="mb-2 {{ $title === 'Daftar Pembayaran' ? 'active' : '' }}">
                        <a href="{{ route('payment_list') }}">
                            <i class='bx bx-wallet bx-sm {{ $title === 'Daftar Pembayaran' ? 'bx-flashing' : '' }} icon'></i>
                            <span class="label-icon">Pembayaran</span>
                        </a>
                    </li>
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
                        <img src="{{ asset('/img/profile.jpeg') }}" alt="">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end wrapper-dropdown">
                        <li>
                            <a class="dropdown-item" type="button" href="#">
                                <i class='bx bx-street-view bx-sm me-2'></i> Profil Saya
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="form-logout">
                                @csrf
                                <button class="dropdown-item btn-logout" type="button" data-name="{{ Auth::guard('web')->user()->name }}">
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
    <script src="{{ asset('/js/modal.js') }}"></script>
    @stack('script')
</body>
</html>