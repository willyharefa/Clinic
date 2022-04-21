@extends('layouts.patient_dashboard')

@section('content')
    <form action="{{ route('update_profile_patient', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row px-0">
            <div class="col-md-4 col-sm-12">
                <div class="mb-3">
                    <label class="form-label">Nama lengkap</label>
                    <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="gender" required>
                        <option selected value="{{ $data->gender }}">{{ $data->gender }}</option>
                        <option value="Pria">Pria</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="birthday" value="{{ $data->birthday }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="address" value="{{ $data->address }}">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label class="form-label">Foto Profile</label>
                    <input type="file" class="form-control" name="image" value="{{ $data->picture }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $data->username }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $data->email }}">
                </div>
            </div>
        </div>

        <div class="col-5">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('dashboard_patient') }}" class="btn">Kembali</a>
        </div>
    </form>
@endsection