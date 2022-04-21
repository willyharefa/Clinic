@extends('layouts.main_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
@endpush

@section('content')
    <div class="container-statistic">
        <div class="row gap-3 mx-0">
            <div class="col col-user insight">
                <i class='bx bx-user-pin icon'></i>
                <div class="wrapper-desc-insight ms-3">
                    <h3 class="mb-0">User</h3>
                    <p class="mb-0 text-muted"><strong class="statistic">{{ $countPatient }}</strong> Pengguna</p>
                </div>
            </div>
            <div class="col col-doctor insight">
                <i class='bx bx-user-pin icon'></i>
                <div class="wrapper-desc-insight ms-3">
                    <h3 class="mb-0">Dokter</h3>
                    <p class="mb-0 text-muted"><strong class="statistic">{{ $countDoctor }}</strong> Dokter</p>
                </div>
            </div>
            <div class="col col-medicane insight">
                <i class='bx bx-capsule icon'></i>
                <div class="wrapper-desc-insight ms-3">
                    <h3 class="mb-0">Obat</h3>
                    <p class="mb-0 text-muted"><strong class="statistic">{{ $countMedicine }}</strong> Obat terdaftar</p>
                </div>
            </div>
            <div class="col col-queue insight">
                <i class='bx bx-timer icon'></i>
                <div class="wrapper-desc-insight ms-3">
                    <h3 class="mb-0">Antrian</h3>
                    <p class="mb-0 text-muted"><strong class="statistic">{{ $countBook }}</strong> Sedang antrian</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-patient-in">
        <h4 class="mb-3 px-0">Antrian masuk </h4>
        @if($message = Session::get('call'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row gx-0 mx-0">
            <form action="{{ route('dashboard_admin') }}" class="form-search">
                <div class="col-md-2 col-sm-12 me-md-2 me-sm-0">
                    <p>Berdasarkan Nama</p>
                    <input type="text" class="form-control" placeholder="Cari Data" name="name" autocomplete="off" spellcheck="false" value="{{ request('name') }}">
                </div>
                <div class="col-md-3 col-sm-12 me-md-2 me-sm-0">
                    <p>Berdasarkan Tanggal</p>
                    <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                </div>
                <div class="btn-submit">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-sm table-borderless">
                    <thead>
                        <tr class="py-2">
                            <th scope="col">#</th>
                            <th scope="col">No Antrian</th>
                            <th scope="col">Nama</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Tanggal Booking</th>
                            <th scope="col">Diperiksa oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($patientIn))
                        @forelse ($patientIn as $key => $item)
                        <tr class="align-middle">
                            <td >{{ $key + $patientIn->firstItem() }}</td>
                            <td>{{ $item->no_order }}</td>
                            <td>{{ $item->patient->name }}</td>
                            <td>{{ $item->patient->phone }}</td>
                            <td>{{ $item->date_book->format('d F Y') }}</td>
                            <td>{{ $item->doctor->name }}</td>
                            <td style="display: flex">
                                <form action="{{ route('call', $item->id) }}" id="form-call-{{ $item->id }}" method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-primary btn-call" data-name="{{ $item->patient->name }}" data-id="{{ $item->id }}">Panggil</button>        
                                </form>
                                <button type="button" class="btn btn-danger ms-2 btn-cancel-request" data-no-order="{{ $item->no_order }}" data-name="{{ $item->patient->name }}" data-id="{{ $item->id }}">Cancel</button>
                            </td>
                                
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Tidak ada aktivitas dari pasien masuk.</div>
                            </td>
                        </tr>
                        @endforelse
                        @else
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Data yang anda masukan tidak dikenali.</div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $patientIn->links() }}
            </div>
        </div>
    </div>

    <div class="row gx-0 row-payment-list">
        
        <div class="headline-row">
            <h4>Pembayaran</h4>
        </div>
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="table-responsive bg-white">
            <table class="table table-sm table-borderless table-hover table-hover">
                <thead>
                    <tr class="py-2 text-muted">
                        <th scope="col">#</th>
                        <th scope="col">No. Antrian</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Tanggal Diperiksa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($checkup as $key => $item)
                    <tr class="align-middle">
                        <td >{{ $key + $checkup->firstItem() }}</td>
                        <td>{{ $item->appointmen->no_order }}</td>
                        <td>{{ $item->patient->name }}</td>
                        <td>{{ $item->date_checkup->format('d F Y') }}</td>
                        <td>
                            <a href="{{ route('payment', $item->id) }}" type="button" class="btn btn-success py-2 px-3">Input Pembayaran</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">Tidak ada aktivitas pembayaran.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $checkup->links()}}
        </div>
    </div>

@endsection

@push('script')
    <script>
        const btnCancelRequest = document.querySelectorAll('.btn-cancel-request');
        btnCancelRequest.forEach( btnCancelRequest => {
            btnCancelRequest.addEventListener('click', ()=> {
                const attName = btnCancelRequest.getAttribute("data-name");
                const attId = btnCancelRequest.getAttribute("data-id");
                const attNoOrder = btnCancelRequest.getAttribute("data-no-order");
                swal({
                    title: "Antrian akan dicancel ?",
                    text: attNoOrder +" akan dicancel dari sistem",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        swal("Oke! antrian "+ attName +" berhasil dicancel", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/dashboard/admin/cancel/book/"+attId+"";
                        },1200);

                    } else {
                        swal("Antrian "+ attName +" batal dicancel.", {
                            icon: "info",
                        });

                    }
                });
            })
        })

        // Button Call Patient
        const btnCall = document.querySelectorAll('.btn-call');
        btnCall.forEach( btnCall => {
            btnCall.addEventListener('click', ()=> {
                const attName = btnCall.getAttribute("data-name");
                const attId = btnCall.getAttribute("data-id");
                const formCall = document.getElementById('form-call-'+attId);
                swal({
                    title: "Panggil Pasien ?",
                    text: attName +" keruang dokter sesuai no urut.",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCall) => {
                    if (willCall) {
                        swal("Oke! pasien "+ attName +" dipersilahkan keruangan dokter", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            formCall.submit();
                        },500);

                    } else {
                        swal("Pasien "+ attName +" batal dipanggil", {
                            icon: "info",
                        });

                    }
                });
            })
        })
    </script>
@endpush