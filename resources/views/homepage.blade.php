@extends('layouts.index')

@section('navbar')
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-expanded="false">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-light navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a href="/" class="nav-link">Beranda</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Lokasi</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Layanan</a>
        </li>
    </ul>
    @if (Auth::guard('patient')->user())
    <div class="dropdown ms-auto">
        <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
            <div class="nav-name">
                Hai, {{ auth()->guard('patient')->user()->name }}
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard_patient') }}">
                    <i class='bx bxs-user-rectangle icon'></i>
                    <div class="nav-name">Dashboard</div>
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
    @elseif(Auth::guard('web')->user())
    <div class="dropdown ms-auto">
        <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
            <div class="nav-name">
                Hai, {{ auth()->guard('web')->user()->name }}
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard_admin') }}">
                    <i class='bx bxs-user-rectangle icon'></i>
                    <div class="nav-name">Dashboard</div>
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
    @elseif(Auth::guard('doctor')->user())
    <div class="dropdown ms-auto">
        <a class="btn dropdown-toggle d-flex align-items-center" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
            <div class="nav-name">
                Hai, {{ auth()->guard('doctor')->user()->name }}
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
            <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard_doctor') }}">
                    <i class='bx bxs-user-rectangle icon'></i>
                    <div class="nav-name">Dashboard</div>
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
    @else
    <div class="btn-group">
        <a type="button" href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>
    @endif
    
</div>
@endsection

@section('container')
<main>
    <section class="section-hero">
        <div class="container py-4">
            <div class="row align-items-center row-hero">
                <div class="col-md-8 col-sm-12 headline-hero">
                    <h1 class="heading-hero"><span id="typing-headline"></span><br>Prioritas Kami</h1>
                    <p class="paragraph-hero">Dapatkan pelayanan secara online melalui website kami tanpa berkunjung terlebih dahulu. Anda dapat mendaftar sebagai pasien baru pada tombol dibawah ini.</p>
                    <a href="{{ route('register') }}" class="btn p-3 btn-register">Daftar Sekarang</a>
                </div>
                <div class="col-md-4 col-sm-12 text-center">
                    <img src="/img/Doctor_Profile.png" class="img-fluid" alt="Doctor">
                </div>
            </div>
        </div>
    </section>

    <section class="section-greetings">
        <div class="container container-greetings">
            <div class="row heading-head text-center">
                <h2>Selamat datang di <br>ONPraktik</h2>
            </div>
            <div class="row content-greetings">
                <div class="col-md-6 col-sm-12 image-greetings">
                    <img src="/img/greetings-image.png" class="img-fluid" alt="Greetings-image">
                </div>
                <div class="col-md-6 col-sm-12">
                    <p class="greetings-paragraph">Kepedulian kami akan kesehatan masyarakat merupakan fokus utama kami dalam memberikan pelayanan yang aman, nyaman dan cepat. Dengan mengakses laman website kami, anda dapat mendaftar sebagai pasien baru tanpa terlebih dahulu ke lokasi.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-schedule">
        <div class="container">
            <div class="row py-3 row-schedule">
                <div class="col-md-5 col-sm-12 wrapper-schedule">
                    <div class="table-responsive py-4">
                        <table class=" table text-center table-borderless mb-0">
                            <tr>
                                <th>Senin</th>
                                <td>17:00 - 20:00</td>
                            </tr>
                            <tr>
                                <th>Selasa</th>
                                <td>17:00 - 20:00</td>
                            </tr>
                            <tr>
                                <th>Rabu</th>
                                <td>17:00 - 20:00</td>
                            </tr>
                            <tr>
                                <th>Kamis</th>
                                <td>17:00 - 20:00</td>
                            </tr>
                            <tr>
                                <th>Jumat</th>
                                <td>17:00 - 20:00</td>
                            </tr>
                            <tr>
                                <th>Sabtu</th>
                                <td>17:00 - 20:00</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 bg-primary text-white headline-schedule">
                    <h4>Jam Operasional</h4>
                    <p class="paragraph-headline">Anda dapat berobat sesuai jam operasi kami pada tabel disamping. Kami libur di hari minggu/tanggal merah.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-questions">
        <div class="container container-questions py-5">
            <div class="row text-center mb-5">
                <h2>Sedang Kebingungan ?</h2>
                <p>Anda mungkin menanyakan hal yang sama</p>
            </div>
            <div class="row">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Berapa dokter yang melayani di ONPraktik ?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="text-muted">
                                    Pada praktik kami saat ini, hanya dilayani oleh satu dokter saja. Dikarenakan banyaknya pasien yang mengantri, diusahakan agar berobat lebih awal.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Pembayaran dapat dilakukan secara online ?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="text-muted">
                                    Pembayaran masih dilakukan secara manual kepetugas.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Apakah melayani BPJS ?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="text-muted">
                                    Penggunaan BPJS saat ini masih belum tersedia.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-page">
        <div class="container container-footer">
            <div class="row heading-footer mb-5">
                <h1>ONPraktik</h1>
            </div>
            <div class="row content-footer">
                <div class="col-md-4 col-sm-12">
                    <h6 class="text-muted mb-3">LOKASI KAMI</h6>
                    <p class="heading-address">Jl. Jendral Sudirman No. 32 - Pekanbaru, Riau</p>
                </div>
                <div class="col-md-8 col-sm-12">
                    <h6 class="text-muted mb-3">HUBUNGI KAMI</h6>
                    <a href="#" class="nav-link m-0 p-0">onpraktik@gmail.com</a>
                </div>
            </div>
            <div class="row copyright-heading">
                <p class="copyright-text">Copyright © 2022 ONPraktik | www.onpraktik.com</p>
            </div>
        </div>
    </footer>
</main>
@endsection


@push('script')
    <script src="/js/index.js"></script>
@endpush