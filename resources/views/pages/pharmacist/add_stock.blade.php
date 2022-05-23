@extends('layouts.dashboard_pharmacist')
@section('content')
    <section class="section-add-stock">
        <div class="row row-headline">
            <h2>Tambah Stok</h2>
            <p class="form-text text-muted">Silahkan tambah stok obat dibawah ini</p>
        </div>
        <div class="col-sm-12 col-md-6 col-form-add">
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('insert_stock') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-text text-muted">Nama Obat</label>
                    <select name="medicine_id" class="form-select" required onfocus="this.size=3;" onblur="this.size=1;" onchange="this.size=1; this.blur();">
                        <option selected value="">Pilih nama obat</option>
                        @forelse ($medicine as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                        <option selected disabled>Daftar obat masih kosong</option>
                        @endforelse
                    </select>
                </div>
                <div class="row gx-0 mb-3">
                    <div class="col-8 me-2">
                        <label class="form-text text-muted">Satuan / Unit</label>
                        <input type="text" class="form-control" name="unit" placeholder="Masukan satuan/unit" required autocomplete="off" spellcheck="false">
                    </div>
                    <div class="col">
                        <label class="form-text text-muted">Stok masuk</label>
                        <input type="number" class="form-control" name="quantity" required>
                    </div>
                </div>
                <div class="row gx-0 mb-3">
                    <div class="col me-2">
                        <label class="form-text text-muted">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="date_entry" required>
                    </div>
                    <div class="col">
                        <label class="form-text text-muted">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" name="date_expired" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-text text-muted">Supplier</label>
                    <input type="text" class="form-control" name="supplier" placeholder="Masukan supplier" required autocomplete="off" spellcheck="false">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </section>
@endsection
