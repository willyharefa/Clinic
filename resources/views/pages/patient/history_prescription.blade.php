@extends('layouts.dashboard_patient')
@section('content')
    <section class="section-history-prescription">
        <div class="wrapper-of-container mb-2">
            <div class="card">
                <div class="card-header">
                    Data resep obat anda
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama obat</th>
                                    <th>QTY</th>
                                    <th>Aturan pakai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPrescription as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->medicine->name }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->recipe }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('history_medical') }}"><strong>Ke halaman sebelumnya</strong></a>
    </section>
@endsection