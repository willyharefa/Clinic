@extends('layouts.dashboard_doctor')
@section('content')
    <section class="section-detail-doctor">
        <div class="container-detail">
            <div class="head-detail">
                <img class="image-profile" src="{{ asset('img/user.png') }}" alt="">
                <div class="wrapper-name">
                    <p class="m-0 p-0 text-muted">Nama Lengkap</p>
                    <h4 class="m-0 p-0">{{ $data->name }}</h4>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" disabled value="{{ $data->name }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jenis kelamin</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" disabled value="{{ $data->gender }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" disabled value="{{ $data->birthday->format('Y-m-d') }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" disabled value="{{ $data->address }}">
                </div>
            </div>
            <div class="row mb-5">
                <label class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" disabled value="{{ $data->phone }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" disabled value="{{ $data->username }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" disabled value="{{ $data->email }}">
                </div>
            </div>
            <div class="row g-0">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Perhatian!</h4>
                    <p>Untuk saat ini anda tidak dapat mengunggah foto. Password anda selalu ingat, karna anda tidak dapat memperbaharuinya kembali.</p>
                    <hr>
                    <p class="mb-0">Jika anda ingin memperbaharui password, silahkan hubungi <strong>admin</strong> kami.</p>
                </div>
            </div>
        </div>
    </section>
@endsection