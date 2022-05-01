@extends('layouts.dashboard_patient')

@section('content')
    <section class="section-appointment-schedule">
        <div class="col">
            <h3>Daftar Jadwal Dokter</h3>
            <p class="form-text">Berikut ini adalah daftar jadwal dokter yang tersedia :</p>
        </div>
    
        <div class="row gx-0 mx-0">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        </div>
    
        <div class="row gx-0 row-schedule-doctor">
            <div class="row mx-0 gx-0 row-search">
                <form action="{{ route('schedule_doctor') }}">
                    <div class="col-4 wrapper-search">
                            <input type="date" class="form-control me-2" name="search_data" value="{{ request('search_data') }}">
                            <button type="submit" class="btn btn-secondary px-3">Cari</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Dokter</th>
                            <th>Jadwal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedule as $key => $item)
                        <tr>
                            <td>{{ $key + $schedule->firstItem() }}</td>
                            <td>{{ $item->doctor->name }}</td>
                            <td>{{ $item->date->format('d F Y') }}</td>
                            <td>
                                <form action="{{ route('appointment') }}" method="POST">
                                    @csrf
                                        <input type="hidden" value="{{ $data->id }}" name="patient_id">
                                        <input type="hidden" value="{{ $item->doctor->id }}" name="doctor_id">
                                        <input type="hidden" value="{{ $item->date }}" name="date_book">
                                    <button class="btn btn-primary">Buat Janji</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Jadwal dokter belum tersedia</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $schedule->onEachSide(1)->links() }}
            </div>
        </div>
    </section>
@endsection