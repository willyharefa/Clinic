@extends('layouts.dashboard_doctor')
@section('content')
    <section class="section-patient-in">
        <div class="row row-headline-patient-in">
            <legend>Daftar Pasien</legend>
            <p class="text-muted">Berikut data-data pasien masuk</p>
        </div>
    
        <div class="row gx-0 row-patient-in">
            <form action="{{ route('patient_in') }}">
                <div class="col-4 wrapper-search">
                        <input type="date" class="form-control" name="search_data" value="{{ request('search_data') }}">
                        <button type="submit" class="btn btn-secondary px-3">Filter</button>
                </div>
            </form>
            <div class="table-responsive mt-3">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Urut</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($patientRequest as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_order }}</td>
                            <td>{{ $item->patient->name}}</td>
                            <td>{{ $item->date_book->format('d F Y') }}</td>
                            <td>
                                <a href="{{ route('checkup', $item->id) }}" class="btn btn-primary">Periksa</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Pasien masuk belum tersedia</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> 
    </section>

@endsection