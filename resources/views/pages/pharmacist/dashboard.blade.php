@extends('layouts.dashboard_pharmacist')
@section('content')
    <section class="section-dashboard">
        <div class="row gx-0 heading-greetings">
            <h3 class="fw-light">Selamat datang kembali, <strong class="fw-bold">{{ $data->name }}</strong></h3>
        </div>

        <div class="row gx-0 row-statistic justify-content-between">
            <div class="insight">
                <i class='bx bx-capsule icon'></i>
                <div class="wrapper-desc-insight ms-3">
                    <h3 class="mb-0">Obat</h3>
                    <p class="mb-0 text-muted"><strong class="statistic">{{ $countMedicine }}</strong> Obat terdaftar</p>
                </div>
            </div>
            <div class="insight">
                <i class='bx bx-layer icon'></i>
                <div class="wrapper-desc-insight ms-3">
                    <h3 class="mb-0">Stok</h3>
                    <p class="mb-0 text-muted"><strong class="statistic">{{ $sumMedicine }}</strong> Stok obat</p>
                </div>
            </div>
            <div class="insight">
                <i class='bx bx-cloud-upload icon'></i>
                <div class="wrapper-desc-insight ms-3">
                    <h3 class="mb-0">Obat Keluar</h3>
                    <p class="mb-0 text-muted"><strong class="statistic">{{ $sumStockOut }}</strong> Obat keluar</p>
                </div>
            </div>
        </div>

        <div class="row gx-0 row-information">
            <legend>Informasi Terkini</legend>
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($medicine->isEmpty() && $stockLess->isEmpty())
            <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                Saat ini belum ada informasi yang tersedia.
            </div>
            @endif

            @if(!$stockLess->isEmpty())
            <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                Ada stok obat yang hampir habis.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(!$medicine->isEmpty())
            <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                Ada stok obat yang sudah kadaluarsa.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            {{-- Data Medicine Expired --}}
            @if (!$medicine->isEmpty())
            <div class="wrapper-data-expired">
                <p class="form-text text-muted">List daftar obat yang kadaluarsa</p>
                <div class="table-responsive">
                    <table class="table align-middle table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama obat</th>
                                <th>Jumlah</th>
                                <th>Tanggal Expired</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicine as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-danger"><strong>{{ $item->date_expired->format('d F Y') }}</strong></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-pull" data-name="{{ $item->name }}" data-id="{{ $item->id }}">
                                        <i class='bx bx-share bx-flip-horizontal' ></i>
                                    </button>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#update-{{ $item->id }}">
                                        <i class='bx bx-rename bx-flip-horizontal' ></i>
                                    </button>
                                    <form action="{{ route('update_expired', $item->id) }}" method="post" class="">
                                        @csrf
                                        <div class="modal fade" id="update-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateLabel">Perbaharui Tanggal</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggal baru</label>
                                                                <input type="date" class="form-control" name="new_date">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            {{-- Data Medicine Stock Less --}}
            @if (!$stockLess->isEmpty())
            <div class="wrapper-data-stock-less">
                <p class="form-text text-muted">Daftar stok obat kurang dari <strong>10</strong></p>
                <div class="table-responsive">
                    <table class="table align-middle table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama obat</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stockLess as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    <form action="{{ route('update_stock_less', $item->id) }}" method="post">
                                        @csrf
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert-stock-{{ $item->id }}">Tambah Stok</button>
                                    <div class="modal fade" id="insert-stock-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="insert-stockLabel">Tambah Stok obat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="">
                                                        <div class="mb-3">
                                                            <label class="form-label">Stok baru</label>
                                                            <input type="number" class="form-control" name="new_stock">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </section>
@endsection

@push('script')
    <script>
        const btnPull = document.querySelectorAll(".btn-pull");

        btnPull.forEach(btnPull => {
            btnPull.addEventListener('click', ()=> {
                const attNama = btnPull.getAttribute("data-name");
                const attId = btnPull.getAttribute("data-id");

                swal({
                    title: "Tarik obat ?",
                    text: "Obat "+ attNama + " akan ditarik dari database",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willPull) => {
                    if (willPull) {
                        swal("Selamat! obat "+ attNama +" berhasil ditarik dari database", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/stock/expired/pull/"+attId+"";
                        },1200);

                    } else {
                        swal("Obat "+ attNama +" batal ditarik.", {
                            icon: "info",
                        });

                    }
                });
            });
        });
    </script>
@endpush