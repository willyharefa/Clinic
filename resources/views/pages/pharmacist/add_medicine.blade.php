@extends('layouts.pharmacist_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/pharmacist/pharmacist.css') }}">
@endpush

@section('content')
    <section class="section-add-medicine">
        <div class="row gx-0 mb-2">
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="wrapper-input">
            <h5 class="mb-0 text-muted">Daftar obat baru</h5>
            <form action="{{ route('insert_data') }}" method="POST" class="row gx-0">
                @csrf
                <button type="button" class="btn btn-primary px-3 py-2" data-bs-toggle="modal" data-bs-target="#input">Tambah Obat</button>
                
                <div class="modal fade" id="input" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data obat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row gx-0 mb-3">
                                    <div class="col-8 me-1">
                                        <p class="form-text text-muted mb-2">Nama obat</p>
                                        <input type="text" class="form-control" name="name" required autocomplete="off" spellcheck="false">
                                    </div>
                                    <div class="col">
                                        <p class="form-text text-muted mb-2">Satuan / Unit</p>
                                        <input type="text" class="form-control" name="unit" required autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                                <div class="row gx-0 mb-3">
                                    <div class="col me-2">
                                        <p class="form-text text-muted mb-2">Harga Jual</p>
                                        <input type="number" class="form-control" name="cost" required>
                                    </div>
                                    <div class="col">
                                        <p class="form-text text-muted mb-2">QTY</p>
                                        <input type="number" class="form-control" name="quantity" required>
                                    </div>
                                </div>
                                <div class="row gx-0 mb-3">
                                    <div class="col me-2">
                                        <p class="form-text text-muted mb-2">Tanggal masuk</p>
                                        <input type="date" class="form-control" name="date_of_entry" required>
                                    </div>
                                    <div class="col">
                                        <p class="form-text text-muted mb-2">Tanggal Expired</p>
                                        <input type="date" class="form-control" name="date_expired" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="form-text text-muted mb-2">Nama supplier</p>
                                    <input type="text" class="form-control" name="supplier" required autocomplete="off" spellcheck="false">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
            

        <div class="row gx-0 row-list-drugs">
            <div class="headline-list">
                <legend>List obat terdaftar</legend>
                <p class="form-text text-muted">Dibawah ini adalah daftar obat terdaftar pada database.</p>
            </div>
            <div class="table-responsive">
                <div class="row row-search mb-4 align-items-end">
                    <div class="col-md-5 col-sm-12 col-filter-date">
                        <p class="mb-2 form-text text-muted fst-italic">Filter berdasarkan tanggal masuk</p>
                        <form action="{{ route('entry_data') }}">
                            <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                            <button type="submit" class="btn btn-secondary">Filter</button>
                        </form>
                    </div>
                    <div class="col-md-3 col-sm-12 text-end ms-auto">
                        <form action="{{ route('entry_data') }}">
                            <input type="search" name="search_data" class="form-control" placeholder="Cari data" value="{{ request('search_data') }}" autocomplete="off" spellcheck="false">
                        </form>
                    </div>
                </div>
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama obat</th>
                            <th>QTY</th>
                            <th>Harga Jual</th>
                            <th>Tanggal masuk</th>
                            <th>Tanggal Expired</th>
                            <th>Supplier</th>
                            <th>Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @if ($medicine->isEmpty())
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                    Data yang anda cari kosong.
                                </div>
                            </td>
                        </tr>
                        @else
                        @forelse ($medicine as $key => $item)
                        <tr>
                            <td>{{ $key + $medicine->firstItem() }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->cost }}</td>
                            <td>{{ $item->date_of_entry->format('d F Y') }}</td>
                            <td>{{ $item->date_expired->format('d F Y') }}</td>
                            <td>{{ $item->supplier }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-{{ $item->id }}"><i class='bx bx-edit bx-tada' ></i></button>
                                <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit data obat</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('update_stock', $item->id) }}" method="POST">
                                                @csrf
                                            <div class="modal-body">
                                                <div class="row gx-0 mb-3">
                                                    <div class="col-8 me-1">
                                                        <p class="form-text text-muted mb-2">Nama obat</p>
                                                        <input type="text" class="form-control" name="new_name" value="{{ $item->name }}">
                                                    </div>
                                                    <div class="col">
                                                        <p class="form-text text-muted mb-2">Satuan / Unit</p>
                                                        <input type="text" class="form-control" name="new_unit" value="{{ $item->unit }}">
                                                    </div>
                                                </div>
                                                <div class="row gx-0 mb-3">
                                                    <div class="col me-2">
                                                        <p class="form-text text-muted mb-2">Harga Jual</p>
                                                        <input type="number" class="form-control" name="new_cost" value="{{ $item->cost }}">
                                                    </div>
                                                    <div class="col">
                                                        <p class="form-text text-muted mb-2">QTY</p>
                                                        <input type="number" class="form-control" name="new_quantity" value="{{ $item->quantity }}">
                                                    </div>
                                                </div>
                                                <div class="row gx-0 mb-3">
                                                    <div class="col me-2">
                                                        <p class="form-text text-muted mb-2">Tanggal masuk</p>
                                                        <input type="date" class="form-control" name="new_date_entry" value="{{ $item->date_of_entry->format('Y-m-d') }}">
                                                    </div>
                                                    <div class="col">
                                                        <p class="form-text text-muted mb-2">Tanggal Expired</p>
                                                        <input type="date" class="form-control" name="new_date_expired" value="{{ $item->date_expired->format('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <p class="form-text text-muted mb-2">Nama supplier</p>
                                                    <input type="text" class="form-control" name="new_supplier" value="{{ $item->supplier }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger btn-delete" data-name="{{ $item->name }}" data-id="{{ $item->id }}">
                                    <i class='bx bx-trash bx-tada' ></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                    Data obat masih kosong
                                </div>
                            </td>
                        </tr>
                        @endforelse
                        @endif
                    </tbody>
                </table>
                {{ $medicine->links() }}
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        const btnDelete = document.querySelectorAll(".btn-delete");

        btnDelete.forEach(btnDelete => {
            btnDelete.addEventListener("click", () => {
                const attNama = btnDelete.getAttribute("data-name");
                const attId = btnDelete.getAttribute("data-id");
                swal({
                    title: "Ingin Hapus ?",
                    text: "Obat "+ attNama + " akan dihapus dari database",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willPull) => {
                    if (willPull) {
                        swal("Selamat! obat "+ attNama +" berhasil dihapus dari database", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/stock/delete/"+attId+"";
                        },1200);

                    } else {
                        swal("Obat "+ attNama +" batal dihapus.", {
                            icon: "info",
                        });

                    }
                });
            })
        })
    </script>
@endpush