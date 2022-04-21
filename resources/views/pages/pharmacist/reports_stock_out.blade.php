@extends('layouts.pharmacist_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/pharmacist/pharmacist.css') }}">
@endpush

@section('content')
    <section class="section-report">
        <div class="row gx-0 row-headline-report">
            <h2>Cetak Laporan</h2>
            <p class="form-text text-muted">Silahkan cetak stok keluar berdasarkan tanggal maupun nama obat</p>
        </div>
        <div class="row gx-0 row-action align-items-end">
            <div class="col-sm-12 col-md-9">
                <form action="{{ route('report_stock_out') }}" class="row gx-0 align-items-end">
                    <div class="col me-md-1 me-sm-0">
                        <p class="form-text text-muted mb-1">Nama obat</p>
                        <select name="medicine" class="form-select" onfocus="this.size=3;" onblur="this.size=1;" onchange="this.size=1; this.blur();">
                            <option selected  value="">Pilih Obat</option>
                            @forelse ($medicine as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @empty
                            <option selected disabled>Data obat masih kosong</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col me-md-1 me-sm-0">
                        <p class="form-text text-muted mb-1">Tanggal awal</p>
                        <input type="date" class="form-control" name="start" value="{{ request('start') }}">
                    </div>
                    <div class="col me-md-1 me-sm-0">
                        <p class="form-text text-muted mb-1">Tanggal akhir</p>
                        <input type="date" class="form-control" name="end" value="{{ request('end') }}">
                    </div>
                    <div class="col col-md-3">
                        <button type="submit" class="btn btn-primary me-3">Filter</button>
                    </div>
                </form>
            </div>
            {{-- @if(request('medicine'))
                @dd(!$prescription->isEmpty() ? 'ya' : 'tidak')
            @endif --}}
            @if (!$prescription->isEmpty())
            <div class="col-md-3 col-sm-12">
                <form action="{{ route('download_stock_out') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name_filter" value="{{ request('medicine') }}">
                    <input type="hidden" name="start_filter" value="{{ request('start') }}">
                    <input type="hidden" name="end_filter" value="{{ request('end') }}">
                    
                    <button type="submit" class="btn btn-success">
                        <i class='bx bx-printer'></i> Cetak Laporan
                    </button>
                </form>
            </div>
            @endif
        </div>
        <div class="row gx-0 row-data-list">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama obat</th>
                            <th>QTY</th>
                            <th>Tanggal Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prescription as $key => $item)
                        <tr>
                            <th>{{ $key + $prescription->firstItem() }}</th>
                            <td>{{ $item->medicine->name }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->created_at->format('d F Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                    <strong>Data yang anda filter tidak tersedia.</strong>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $prescription->links() }}
            </div>
        </div>
    </section>
@endsection