@extends('layouts.index')

@section('container')
    <section class="section-login">
        <div class="container container-login">
            <form class="row g-0 justify-content-center needs-validation" novalidate action="{{ route('authenticate') }}" method="POST">
                @csrf
                <div class="col-8 px-0">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row wrapper-login g-0">
                        <div class="col-md-6 image-login">
                            <h1 class="mb-5">Autentikasi</h1>
                            <p class="paragpraph-login">Selalu lindungi akun anda dari pihak yang tidak bertanggun jawab. Password anda dienkripsi dengan kode acak, jika anda lupa hubungi admin kami.</p>
                        </div>
                        <div class="col-md-6 field-login">
                            <div class="mb-3 text-center">
                                <h3>Form Login</h3>
                                <p class="text-muted">Silahkan login terlebih dahulu</p>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                                <div class="invalid-feedback">Data masih kosong</div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
                                <div class="invalid-feedback">Data masih kosong</div>
                            </div>
                            <div class="row mx-0 mb-4">
                                <button class="btn btn-primary py-3" type="submit">Login</button>
                            </div>
                            <p class="text-center text-muted fw-light">Belum punya akun ?<br><a href="{{ route('register') }}" class="text-decoration-none fw-normal">Registrasi Disini</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection