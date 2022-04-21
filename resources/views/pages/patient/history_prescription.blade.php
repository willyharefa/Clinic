@extends('layouts.patient_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/patient/schedule_doctor.css') }}">
@endpush

@section('content')
    <section class="section-history-prescription">
        <div class="col-md-6 col-sm-12 wrapper-of-container">
            <div class="card">
                <div class="card-header">
                    Data resep obat anda
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama obat</th>
                                    <th>QTY</th>
                                    <th>Aturan pakai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPrescription as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->medicine->name }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->recipe }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
        </div>
    </section>
@endsection

{{-- @push('script')
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
@endpush   --}}