@extends('layouts.dashboard_doctor')
@section('content')
    <section class="section-schedule">
        <div class="row gx-0 mx-0 mb-2">
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="row gx-0 row-schedule">
            <div class="col btn-create-schedule">
                <button type="button" class="btn btn-primary btn-input" data-bs-toggle="modal" data-bs-target="#schedule">Buat Jadwal</button>
                <div class="modal fade" id="schedule" tabindex="-1" aria-labelledby="schedule" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="schedule">Jadwal Baru</h5>
                            </div>
                            <form action="{{ route('create_schedule', $data->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-3">
                                                <label>Tanggal</label>
                                                <input type="date" class="form-control" min="" name="date" required>
                                                
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Waktu Mulai</label>
                                                <input type="time" class="form-control" name="start" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Waktu Selesai</label>
                                                <input type="time" class="form-control" name="end" required value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-cancel-create" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="title-list-schedule mb-2">
            <h3>List Jadwal</h3>
            <p class="form-text">Berikut adalah list jadwal anda :</p>
        </div>

        <div class="row gx-0 row-list-schedule">
            <div class="table-responsive">
                <table class="table align-middle table-borderless">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Mulai</th>
                            <th>Berakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedule as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->date->format('d F Y') }}</td>
                            <td>{{ $item->start->format('H:i') }}</td>
                            <td>{{ $item->end->format('H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-input" data-bs-toggle="modal" data-bs-target="#edit-{{ $item->id }}">
                                    <i class='bx bx-edit'></i>
                                </button>
                                    <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" aria-labelledby="schedule" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="schedule">Edit Jadwal</h5>
                                                </div>
                                                <form action="{{ route('update_schedule', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group mb-3">
                                                                    <label>Tanggal</label>
                                                                    <input type="date" class="form-control" min="" name="new_date" required value="{{ $item->date->format('Y-m-d') }}">
                                                                    
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label>Waktu Mulai</label>
                                                                    <input type="time" class="form-control" name="new_start" required value="{{ $item->start->format('H:i') }}">
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label>Waktu Selesai</label>
                                                                    <input type="time" class="form-control" name="new_end" required value="{{ $item->end->format('H:i') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-cancel-create" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-delete" data-id="{{ $item->id }}"><i class='bx bx-trash'></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Jadwal anda masih kosong</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        const btnDelete = document.querySelectorAll(".btn-delete");
        btnDelete.forEach(btnDelete => {
            btnDelete.addEventListener('click', ()=> {
                const attId = btnDelete.getAttribute("data-id");
                swal({
                    title: "Jadwal akan dihapus ?",
                    text: "Jadwal akan dihapus pada database",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willRestore) => {
                    if (willRestore) {
                        swal("Selamat! jadwal berhasil dihapus", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/schedule/delete/"+attId+"";
                        },1200);

                    } else {
                        swal("Jadwal batal dihapus", {
                            icon: "info",
                        });

                    }
                });
            })
        })
    </script>

@endpush