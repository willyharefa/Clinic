@extends('layouts.pharmacist_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/pharmacist/pharmacist.css') }}">
@endpush

@section('content')
    <section class="section-report">
        <div class="row gx-0 row-headline-report">
            <h2>Cetak Laporan</h2>
            <p class="form-text text-muted">Silahkan cetak stok masuk berdasarkan tanggal maupun nama obat</p>
        </div>
        <div class="row gx-0 row-action align-items-end">
                <div class="col">
                    <form action="{{ route('report_stock_in') }}" class="row gx-0 align-items-end">
                        <div class="col me-md-1 me-sm-0">
                            <p class="form-text text-muted mb-1">Nama obat</p>
                            <input type="text" class="form-control" name="medicine" placeholder="Cari data" value="{{ request('medicine') }}" autocomplete="off" spellcheck="false">
                        </div>
                        <div class="col me-md-1 me-sm-0">
                            <p class="form-text text-muted mb-1">Tanggal awal</p>
                            <input type="date" class="form-control" name="start" value="{{ request('start') }}">
                        </div>
                        <div class="col me-md-1 me-sm-0">
                            <p class="form-text text-muted mb-1">Tanggal akhir</p>
                            <input type="date" class="form-control" name="end" value="{{ request('end') }}">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <button type="submit" class="btn btn-primary me-3">Filter</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 col-sm-12">
                    @if (!$stock_in->isEmpty())
                    <form action="{{ route('download_stock_in') }}" method=""s>
                        @csrf
                        <input type="hidden" name="name_filter" value="{{ request('medicine') }}">
                        <input type="hidden" name="start_filter" value="{{ request('start') }}">
                        <input type="hidden" name="end_filter" value="{{ request('end') }}">
                        <button type="submit" class="btn btn-success">
                            <i class='bx bx-printer'></i> Cetak Laporan
                        </button>
                    </form>
                    @endif
                </div>
        </div>
        <div class="row gx-0 row-data-list">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama obat</th>
                            <th>QTY</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Expired</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stock_in as $key => $item)
                        <tr>
                            <td>{{ $key + $stock_in->firstItem() }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->date_of_entry->format('d F Y') }}</td>
                            <td>{{ $item->date_expired->format('d F Y') }}</td>
                            <td>{{ $item->supplier }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                    <strong>Data yang anda filter tidak tersedia.</strong>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $stock_in->links() }}
            </div>
        </div>
    </section>
@endsection