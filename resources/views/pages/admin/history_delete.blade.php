@extends('layouts.main_dashboard')

@section('content')
    <h3 class="mb-3">Riwayat Hapus</h3>

    @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pasien-tab" data-bs-toggle="tab" data-bs-target="#pasien" type="button" role="tab" aria-controls="pasien" aria-selected="true">Pasien</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="doctor-tab" data-bs-toggle="tab" data-bs-target="#doctor" type="button" role="tab" aria-controls="doctor" aria-selected="false">Dokter</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="petugas-tab" data-bs-toggle="tab" data-bs-target="#petugas" type="button" role="tab" aria-controls="petugas" aria-selected="false">Petugas</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        {{-- Trash Patient Tab --}}
        <div class="tab-pane fade show active" id="pasien" role="tabpanel" aria-labelledby="pasien-tab">
            <div class="row-list-user">
                <div class="table-responsive p-3">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal dihapus</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trashPatient as $item)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->deleted_at->format('d F Y') }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-restore" data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                        <i class='bx bx-share'></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $item->id }}" data-name="{{ $item->name }}"><i class='bx bx-trash'></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                        Riwayat hapus data pasien kosong.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $trashPatient->links() }}
                </div>
            </div>
        </div>
        {{-- Doctor Tab --}}
        <div class="tab-pane fade" id="doctor" role="tabpanel" aria-labelledby="doctor-tab">
            <div class="row-list-user">
                <div class="table-responsive p-3">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal dihapus</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trashDoctor as $item)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->deleted_at->format('d F Y') }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success">
                                        <i class='bx bx-share'></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-delete" data-id="" data-name=""><i class='bx bx-trash'></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                        Riwayat hapus data dokter kosong.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Pharmacist Tab --}}
        <div class="tab-pane fade" id="petugas" role="tabpanel" aria-labelledby="petugas-tab">
            <div class="row-list-user">
                <div class="table-responsive p-3">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal dihapus</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trashPharmacist as $item)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->deleted_at->format('d F Y') }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success">
                                        <i class='bx bx-share'></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-delete" data-id="" data-name=""><i class='bx bx-trash'></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                        Riwayat hapus data apoteker kosong.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>

        const btnRestore = document.querySelectorAll(".btn-restore");
        btnRestore.forEach(btnRestore => {
            btnRestore.addEventListener("click", () => {
                const attName = btnRestore.getAttribute("data-name");
                const attId = btnRestore.getAttribute("data-id");
                swal({
                    title: "Data akan dikembalikan ?",
                    text: "User "+ attName + " akan dihapus pada database",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willRestore) => {
                    if (willRestore) {
                        swal("Selamat! user "+ attName +" berhasil dikembalikan", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/dashboard/admin/trash/restore/"+attId+"";
                        },1200);

                    } else {
                        swal("User "+ attName +" batal dikembalikan", {
                            icon: "info",
                        });

                    }
                });
            })
        })

        // Force delete / permanent delete
        const btnDelete = document.querySelectorAll(".btn-delete");
        btnDelete.forEach(btnDelete => {
            btnDelete.addEventListener("click", () => {
                const attName = btnDelete.getAttribute("data-name");
                const attId = btnDelete.getAttribute("data-id");
                swal({
                    title: "Data dihapus permanen ?",
                    text: "User "+ attName + " akan dihapus dari sistem",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willRestore) => {
                    if (willRestore) {
                        swal("Selamat! user "+ attName +" berhasil dihapus secara permanen dari sistem", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/dashboard/admin/force/delete/"+attId+"";
                        },1200);

                    } else {
                        swal("User "+ attName +" batal dihapus permanen", {
                            icon: "info",
                        });

                    }
                });
            })
        })
    </script>
@endpush