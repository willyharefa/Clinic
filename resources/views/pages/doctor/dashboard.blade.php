@extends('layouts.dashboard_doctor')

@section('content')
    <section class="section-dashboard-doctor">
        <div class="row-greetings-dashboard">
            <h4 class="fw-light">Selamat datang kembali, <strong class="fw-normal">Dokter</strong></h4>
        </div>
        <div class="row-statistic">
            <div class="insight">
                <i class='bx bx-user icon'></i>
                <div class="wrapper-desc-insight ms-3">
                    <h3 class="mb-0">Pasien</h3>
                    <p class="mb-0 text-muted"><strong class="statistic">{{ $countCheckup }}</strong> telah diperiksa</p>
                </div>
            </div>
            <div class="insight">
                <i class='bx bx-timer bx-tada icon bg-warning text-black'></i>
                <div class="wrapper-desc-insight ms-3">
                    <h3 class="mb-0">Antrian</h3>
                    <p class="mb-0 text-muted"><strong class="statistic">{{ $countRequest }}</strong> Sedang menunggu</p>
                </div>
            </div>
        </div>

        <div class="row row-news">
            <h3>Informasi Terkini</h3>
            @if (empty($countRequest))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                Informasi masih belum tersedia saat ini.
            </div>
            @else
                @if (!empty($countRequest))
                    <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                        Hai dok, ada pasien yang ingin berobat. Klik <strong><a href="{{ route('patient_in') }}" class="text-decoration-none">disini</a></strong> untuk melihat.
                    </div>
                @endif
            @endif
            @if (!empty($schedule))
                <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                    Hai dok, ada {{ $schedule }} jadwal anda yang sudah lewat hari. Klik <strong><a href="{{ route('schedule') }}" class="text-decoration-none">disini</a></strong> untuk melihat.
                </div>
            @endif
        </div>
    </section>
@endsection