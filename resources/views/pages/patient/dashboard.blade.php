@extends('layouts.patient_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/patient/schedule_doctor.css') }}">
@endpush

@section('content')
    <section class="section-dashboard-patient">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h3><span class="fw-light">Selamat datang kembali, </span> user</h3>
            
        <div class="row gx-0 row-information-patient">
            <h5>Aktivitas anda</h5>
            @if (!empty($requestAppointment))
                <div class="row gx-0 text-wrap">
                    @foreach ($requestAppointment as $item)
                        <div class="col-md-5 col-sm-12 me-md-4 wrapper-no-order">
                            <p>NO ANTRIAN</p>
                            <p class="date_book">{{ $item->date_book->format('d F Y') }}</p>
                            <H4>{{ $item->no_order }}</H4>
                            <button class="btn btn-success btn-print" data-id="{{ $item->id }}">
                                <i class='bx bx-download'></i> Cetak Antrian
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
            <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                Hai <strong>{{ $data->name }}</strong>, belum ada aktivitas anda
            </div>
            @endif
            
        </div>

        <div class="row mt-5 gx-0 row-information-checkup">
            <h4>Informasi Terkini</h4>
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                Hai user, yuk lihat riwayat berobat anda. Klik <a href="{{ route('history_medical') }}" class="text-decoration-none">disini</a> untuk melihat
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        const btnPrint = document.querySelectorAll(".btn-print");
        btnPrint.forEach(btnPrint => {
            btnPrint.addEventListener("click", () => {
                const attId = btnPrint.getAttribute("data-id"); 
                swal({
                    title: "Ingin mencetak ?",
                    text: "No antrian anda akan cetak sendiri",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willPrint) => {
                    if (willPrint) {
                        swal("Oke, silahkan unduh no antrian anda", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/dashbaord/patient/print/no/order/"+attId+"";
                        },1200);

                    } else {
                        swal("No antrian batal anda cetak", {
                            icon: "info",
                        });

                    }
                });
            })
        })
    </script>
@endpush  