@extends('layouts.index')

@section('container')
    <main>
        <section class="section-register">
            <div class="container container-register">
                <form class="needs-validation" novalidate action="{{ route('registration_patient') }}" method="POST">
                    @csrf
                    <div class="row gx-4">
                        <div class="col-md-6 col-sm-12">
                            <div class="user-information mb-3">
                                <h4 class="text-muted">Informasi Data Diri</h4>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required autocomplete="off" value="{{ old('name') }}">
                                <div class="invalid-feedback">Nama masih kosong</div>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option selected disabled>Pilih jenis kelamin</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="invalid-feedback">Silahkan pilih jenis kelamin</div>
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" required value="{{ old('birthday') }}">
                                <div class="invalid-feedback">Tanggal lahir masih kosong</div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address" required value="{{ old('address') }}" autocomplete="off">
                                <div class="invalid-feedback">Alamat kosong</div>
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">No. Telepon / WhatsApp</label>
                                <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber" name="phoneNumber" required value="{{ old('phoneNumber') }}" autocomplete="off">
                                @error('phoneNumber')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="user-information mb-3">
                                <h4 class="text-muted">Detail Akun</h4>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autocomplete="off" value="{{ old('username') }}">
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required autocomplete="off" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required >
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                    <button class="btn btn-primary btn-registration" type="submit">Daftar</button>
                    <p class="d-inline-block text-muted">Sudah punya akun ? <a href="{{ route('login') }}" class="text-decoration-none">Login disini</a></p>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection

@push('script')
    <script src="/js/validation.js"></script>
    
@endpush