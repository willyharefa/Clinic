@extends('layouts.main_dashboard')

@section('content')
    <div class="container-add-user">
        <h3>Tambah User</h3>

        @if ($errors->has('username'))
            <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                <strong>{{ $errors->first('username') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->has('password'))
            <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->has('email'))
            <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row-add-user p-3">
            {{-- Button Trigger --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user">Tambah User</button>
            <div class="modal fade" id="add-user" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Informasi Pengguna Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('insert_patient') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <h5>Data Diri</h5>
                                        <p class="text-muted form-text">Lengkapi data diri pengguna</p>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required autocomplete="off" spellcheck="false" value="{{ old('name') }}">
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" name="gender" required>
                                                <option selected disabled value="">Pilih jenis kelamin</option>
                                                <option value="Pria">Pria</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-text">Masukan tanggal lahir</div>
                                            <input type="date" class="form-control" name="birthday" required value="{{ old('birthday') }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="address" placeholder="Alamat" required autocomplete="off" spellcheck="false" value="{{ old('address') }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="phoneNumber" placeholder="No. Telepon / WhatsApp" required autocomplete="off" spellcheck="false" value="{{ old('phoneNumber') }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" required autocomplete="off" spellcheck="false" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col px-4">
                                        <h3 class="fw-light heading-information-account"><i class='bx bx-lock'></i> informasi Akun</h3>
                                        <div class="mb-3">
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username" required autocomplete="off" spellcheck="false" value="{{ old('username') }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Konfirmasi Password" required>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" name="role" required>
                                                <option selected disabled value="">Role / Sebagai </option>
                                                <option value="Dokter">Dokter</option>
                                                <option value="Pasien">Pasien</option>
                                                <option value="Apoteker">Apoteker</option>
                                            </select>
                                        </div>
                                        <div class="alert alert-success" role="alert">
                                            <h6 class="alert-heading">Perhatian !</h6>
                                            <p class="form-text alert-success mb-0">Password akan di enkripsi dengan kode acak sehingga tidak bisa liat dan diubah demi keamanan data.</p>
                                        </div>
                                    </div>
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
        </div>

        <h3>List User</h3>

        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->has('field_phone'))
        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
            <strong>{{ $errors->first('field_phone') }}</strong>
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
            {{-- Patient Tab --}}
            <div class="tab-pane fade show active" id="pasien" role="tabpanel" aria-labelledby="pasien-tab">
                <div class="row-list-user">
                    <div class="col-md-4 col-sm-12 p-3">
                        <form action="{{ route('list_patient') }}">
                            <input type="search" class="form-control input-search" name="search_by" placeholder="Cari data" autocomplete="off" spellcheck="false">
                        </form>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor Telepon</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($patient as $key => $item)
                                <tr class="align-middle">
                                    <td>{{ $key + $patient->firstItem() }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#data-{{ $item->id }}">
                                            <i class='bx bx-edit'></i>
                                        </button>
                                        <div class="modal fade" id="data-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('update_patient', $item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Data {{ $item->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row text-start">
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="field_name" class="form-label">Nama Lengkap</label>
                                                                        <input type="text" class="form-control" id="field_name" name="field_name" value="{{ $item->name }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_gender" class="form-label">Jenis Kelamin</label>
                                                                        <select class="form-select" name="field_gender" required>
                                                                            <option selected value="{{ $item->gender }}">{{ $item->gender }}</option>
                                                                            <option value="Pria">Pria</option>
                                                                            <option value="Perempuan">Perempuan</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_birthday" class="form-label">Tanggal Lahir</label>
                                                                        <input type="date" class="form-control" id="field_birthday" name="field_birthday" value="{{ $item->birthday->format('Y-m-d') }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_address" class="form-label">Alamat</label>
                                                                        <input type="text" class="form-control" id="field_address" name="field_address" value="{{ $item->address }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="email" name="email" value="{{ $item->email }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_phone" class="form-label">No. Telepon / WA</label>
                                                                        <input type="text" class="form-control @error('field_phone') is-invalid @enderror" id="field_phone" name="field_phone" value="{{ $item->phone }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_username" class="form-label">Username</label>
                                                                        <input type="text" class="form-control" id="field_username" name="field_username" value="{{ $item->username }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                </div>
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
                                        <button type="button" class="btn btn-danger btn-delete" data-id="{{ $item->id }}" data-name="{{ $item->name }}"><i class='bx bx-trash'></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                            Data yang anda cari kosong
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $patient->onEachSide(1)->links() }}
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
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor Telepon</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doctor as $item)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#data-doctor-{{ $item->id }}">
                                            <i class='bx bx-edit'></i>
                                        </button>
                                        <div class="modal fade" id="data-doctor-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('update_doctor', $item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Data {{ $item->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row text-start">
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="field_name" class="form-label">Nama Lengkap</label>
                                                                        <input type="text" class="form-control" id="field_name" name="field_name" value="{{ $item->name }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_gender" class="form-label">Jenis Kelamin</label>
                                                                        <select class="form-select" name="field_gender" required>
                                                                            <option selected value="{{ $item->gender }}">{{ $item->gender }}</option>
                                                                            <option value="Pria">Pria</option>
                                                                            <option value="Perempuan">Perempuan</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_birthday" class="form-label">Tanggal Lahir</label>
                                                                        <input type="date" class="form-control" id="field_birthday" name="field_birthday" value="{{ $item->birthday->format('Y-m-d') }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_address" class="form-label">Alamat</label>
                                                                        <input type="text" class="form-control" id="field_address" name="field_address" value="{{ $item->address }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="email" name="email" value="{{ $item->email }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_phone" class="form-label">No. Telepon / WA</label>
                                                                        <input type="text" class="form-control @error('field_phone') is-invalid @enderror" id="field_phone" name="field_phone" value="{{ $item->phone }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_username" class="form-label">Username</label>
                                                                        <input type="text" class="form-control" id="field_username" name="field_username" value="{{ $item->username }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                </div>
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
                                        <button type="button" class="btn btn-danger btn-delete-doctor" data-id="{{ $item->id }}" data-name="{{ $item->name }}"><i class='bx bx-trash'></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                                            Data dokter masih kosong.
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
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor Telepon</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pharmacist as $item)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#data-pharmacist-{{ $item->id }}">
                                            <i class='bx bx-edit'></i>
                                        </button>
                                        <div class="modal fade" id="data-pharmacist-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('update_pharmacist', $item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Data {{ $item->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row text-start">
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="field_name" class="form-label">Nama Lengkap</label>
                                                                        <input type="text" class="form-control" id="field_name" name="field_name" value="{{ $item->name }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_gender" class="form-label">Jenis Kelamin</label>
                                                                        <select class="form-select" name="field_gender" required>
                                                                            <option selected value="{{ $item->gender }}">{{ $item->gender }}</option>
                                                                            <option value="Pria">Pria</option>
                                                                            <option value="Perempuan">Perempuan</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_birthday" class="form-label">Tanggal Lahir</label>
                                                                        <input type="date" class="form-control" id="field_birthday" name="field_birthday" value="{{ $item->birthday->format('Y-m-d') }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_address" class="form-label">Alamat</label>
                                                                        <input type="text" class="form-control" id="field_address" name="field_address" value="{{ $item->address }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" id="email" name="email" value="{{ $item->email }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_phone" class="form-label">No. Telepon / WA</label>
                                                                        <input type="text" class="form-control @error('field_phone') is-invalid @enderror" id="field_phone" name="field_phone" value="{{ $item->phone }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="field_username" class="form-label">Username</label>
                                                                        <input type="text" class="form-control" id="field_username" name="field_username" value="{{ $item->username }}" required autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                </div>
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
                                        <button type="button" class="btn btn-danger btn-delete-pharmacist" data-id="{{ $item->id }}" data-name="{{ $item->name }}"><i class='bx bx-trash'></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                                            Data Apoteker masih kosong.
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
    </div>
@endsection


@push('script')
    
    <script>
        const btnDelete = document.querySelectorAll(".btn-delete");
        const btnDeleteDoctor = document.querySelectorAll(".btn-delete-doctor");
        const btnDeletePharmacist = document.querySelectorAll(".btn-delete-pharmacist");

        btnDelete.forEach(btnDelete => {
            btnDelete.addEventListener('click', ()=> {
                const attNama = btnDelete.getAttribute("data-name");
                const attId = btnDelete.getAttribute("data-id");

                swal({
                    title: "Data akan dihapus ?",
                    text: "User "+ attNama + " akan dihapus pada database",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willRestore) => {
                    if (willRestore) {
                        swal("Selamat! user "+ attNama +" berhasil dihapus", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/dashboard/admin/delete/patient/"+attId+"";
                        },1200);

                    } else {
                        swal("User "+ attNama +" batal dihapus", {
                            icon: "info",
                        });

                    }
                });
            })
        })
        btnDeleteDoctor.forEach(btnDeleteDoctor => {
            btnDeleteDoctor.addEventListener('click', ()=> {
                console.log('oke');
                const attNama = btnDeleteDoctor.getAttribute("data-name");
                const attId = btnDeleteDoctor.getAttribute("data-id");

                swal({
                    title: "Data akan dihapus ?",
                    text: attNama + " akan dihapus pada database",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Selamat! dokter "+ attNama +" berhasil dihapus", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/dashboard/admin/delete/doctor/"+attId+"";
                        },1200);

                    } else {
                        swal(attNama +" batal dihapus", {
                            icon: "info",
                        });

                    }
                });
            })
        })
        btnDeletePharmacist.forEach(btnDeletePharmacist => {
            btnDeletePharmacist.addEventListener('click', ()=> {
                const attNama = btnDeletePharmacist.getAttribute("data-name");
                const attId = btnDeletePharmacist.getAttribute("data-id");

                swal({
                    title: "Data akan dihapus ?",
                    text: "Data " +attNama + " akan dihapus pada database",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Selamat! user "+ attNama +" berhasil dihapus", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/dashboard/admin/delete/pharmacist/"+attId+"";
                        },1200);

                    } else {
                        swal("Data "+ attNama +" batal dihapus", {
                            icon: "info",
                        });

                    }
                });
            })
        })
    </script>
@endpush