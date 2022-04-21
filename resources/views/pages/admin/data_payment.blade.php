@extends('layouts.main_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
@endpush

@section('content')
    <section class="section-data-payment">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h5 class="card-header">Data Pembayaran</h5>
                    <div class="card-body">
                        <div class="row gx-0 row-headline-filter">
                            <label class="form-text fst-italic mb-2">Cari berdasarkan nama atau no. antrian</label>
                            <div class="col-sm-12 col-md-4">
                                <form action="{{ route('payment_list') }}">
                                    <input type="search" class="form-control" name="search_data" placeholder="Cari data" value="{{ request('search_data') }}" autocomplete="off" spellcheck="false">
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless text-nowrap align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">No. Bayar</th>
                                        <th scope="col">Nama Pasien</th>
                                        <th scope="col">Total Bayar</th>
                                        <th scope="col">Uang Pasien</th>
                                        <th scope="col">Kembalian</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payment as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_payment }}</td>
                                        <td>{{ $item->name_patient }}</td>
                                        <td>{{ $item->total_cost }}</td>
                                        <td>{{ $item->paid }}</td>
                                        <td>{{ $item->refund }}</td>
                                        <td>
                                            <a href="{{ route('download_invoice', $item->id) }}" class="btn btn-success">Download Invoice</a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Data tidak tersedia</div>
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
    </section>
@endsection