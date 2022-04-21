@extends('layouts.pharmacist_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/pharmacist/pharmacist.css') }}">
@endpush

@section('content')
    <section class="section-data-medicine">
        <div class="row gx-0 row-headline">
            <h3>Data Obat</h3>
            <p>Dibawah ini merupakan data-data obat masuk maupun keluar.</p>
        </div>

        <div class="row gx-0 row-wrapper-content">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="obat-masuk-tab" data-bs-toggle="tab" data-bs-target="#obat-masuk" type="button" role="tab" aria-controls="obat-masuk" aria-selected="true">Obat Masuk</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="obat-keluar-tab" data-bs-toggle="tab" data-bs-target="#obat-keluar" type="button" role="tab" aria-controls="obat-keluar" aria-selected="false">Obat Keluar</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="obat-masuk" role="tabpanel" aria-labelledby="obat-masuk-tab">
                    <div class="row gx-0 p-3 row-medicine bg-white">
                        <form action="{{ route('data_medicine') }}">
                            <div class="col-sm-12 col-md-4 col-search">
                                <input type="date" class="form-control" name="search_data_in" value="{{ request('search_data_in') }}">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Obat</th>
                                        <th>Satuan</th>
                                        <th>QTY</th>
                                        <th>Harga Jual</th>
                                        <th>Supplier</th>
                                        <th class="text-end">Tanggal Masuk</th>
                                        <th class="text-end">Tanggal Expired</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($medicine as $key => $item)
                                    <tr>
                                        <td>{{ $key + $medicine->firstItem() }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->unit }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ 'Rp '. number_format($item->cost, 0, ",", ".") }}</td>
                                        <td>{{ $item->supplier }}</td>
                                        <td class="text-end">{{ $item->date_of_entry->format('d-m-Y') }}</td>
                                        <td class="text-end">{{ $item->date_expired->format('d-m-Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8">
                                        <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Data obat masuk masih kosong.</div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $medicine->links() }}
                        </div>
                    </div>
                </div>
                {{-- Obat keluar --}}
                <div class="tab-pane fade" id="obat-keluar" role="tabpanel" aria-labelledby="obat-keluar-tab">
                    <div class="row gx-0 p-3 row-medicine bg-white">
                        <form action="">
                            <div class="col-sm-12 col-md-4 col-search">
                                <input type="date" class="form-control" name="search-data">
                                <button type="button" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Obat</th>
                                        <th>Satuan</th>
                                        <th>QTY</th>
                                        <th>Harga Jual</th>
                                        <th>Tanggal Expired</th>
                                        <th>Supplier</th>
                                        <th>Tanggal Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Paramex</td>
                                        <td>Strip</td>
                                        <td>90</td>
                                        <td>Rp. 2000</td>
                                        <td>1 Januari 2024</td>
                                        <td>PT. Kimia Farma</td>
                                        <td>1 Januari 2022</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection