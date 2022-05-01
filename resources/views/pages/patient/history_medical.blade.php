@extends('layouts.dashboard_patient')
@section('content')
    <section class="section-history-medical">
        <div class="row gx-0 row-wrapper-headline">
            <h3>Riwayat berobat</h3>
            <p class="form-text text-muted mb-0">Dibawah ini merupakan riwayat berobat anda</p>
        </div>
        <div class="row gx-0 row-wrapper-table">
            <div class="table-responsive">
                <table class="table align-middle table-borderless text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Antrian</th>
                            <th>No RM</th>
                            <th>Tanggal diperiksa</th>
                            <th>Oleh Dokter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medicalHistory as $key => $item)
                        <tr>
                            <th>{{ $key + $medicalHistory->firstItem() }}</th>
                            <td>{{ $item->appointmen->no_order }}</td>
                            <td>{{ $item->no_medical_record }}</td>
                            <td>{{ $item->date_checkup->format('d F Y') }}</td>
                            <td>{{ $item->doctor->name }}</td>
                            <td>
                                <a href="{{ route('history_prescription', $item->id) }}" class="btn btn-success">Lihat Resep</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                                    <strong>Data masih kosong</strong>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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