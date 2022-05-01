@extends('layouts.dashboard_patient')

@section('content')
    <section class="section-dashboard-patient">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h3 class="greetings">Selamat datang kembali, <span class="name-user">Willy Harefa</span></h3>
            
        <div class="row gx-0 row-information-patient">
            <h4>Aktivitas anda</h4>
            @if (!empty($requestAppointment))
                <div class="row gx-0 wrapper-card">
                    @forelse ($requestAppointment as $item)
                        <div class="col wrapper-no-order">
                            <H3>{{ $item->no_order }}</H3>
                            <div class="wrapper-action">
                                <p>VALID UNTIL</p>
                                <h6 class="date_book">{{ $item->date_book->format('d F Y') }}</h6>
                                <button class="btn btn-success btn-print" data-id="{{ $item->id }}">
                                    <i class='bx bx-printer bx-sm me-2'></i> Download
                                </button>
                            </div>
                        </div>
                    @empty
                    <div class="alert alert-activity" role="alert">
                        Hai <strong>{{ $data->name }}</strong>, belum ada aktivitas anda.
                    </div>
                    @endforelse
                </div>
            @endif
            
        </div>

        <div class="row mt-5 gx-0 row-information-checkup">
            <h4>Informasi Terkini</h4>
            <div class="alert alert-news" role="alert">
                Hai {{ $data->name }}, yuk lihat riwayat berobat anda. Klik <strong><a href="{{ route('history_medical') }}" class="text-decoration-none">disini</a></strong> untuk melihat
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