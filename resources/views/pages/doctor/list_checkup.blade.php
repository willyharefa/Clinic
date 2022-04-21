@extends('layouts.doctor_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/doctor/doctor.css') }}">
@endpush

@section('content')
<section class="section-list-checkups">
    <div class="row">
        <div class="col">
            <div class="card">
                <h5 class="card-header">Riwayat Pemeriksaan</h5>
                <div class="card-body">
                    <div class="row gx-0 row-headline-filter justify-content-between mb-5 align-items-end">
                        <div class="col-sm-12 col-md-4 col-filter mb-sm-3 mb-md-0">
                            <label class="form-text fst-italic mb-2">Filter berdasarkan tanggal</label>
                            <form action="{{ route('checkup_history') }}">
                                <input type="date" class="form-control" name="filter_with_date" placeholder="Cari data" value="{{ request('filter_with_date') }}">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <form action="{{ route('checkup_history') }}">
                                <input type="search" class="form-control" name="search_data" placeholder="Cari data" value="{{ request('search_data') }}" spellcheck="false" autocomplete="off">
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No. Rekam Medis</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Tanggal diperiksa</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($checkup == null)
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Data tidak tersedia</div>
                                    </td>
                                </tr>
                                @else
                                @forelse ($checkup as $key => $item)
                                <tr>
                                    <td>{{ $key + $checkup->firstItem() }}</td>
                                    <td>{{ $item->no_medical_record }}</td>
                                    <td>{{ $item->patient->name }}</td>
                                    <td>{{ $item->date_checkup->format('d F Y') }}</td>
                                    <td>
                                        <a href="{{ route('checkup', $item->appointmen_id) }}" class="btn btn-warning fs-5">
                                            <i class='bx bx-show-alt bx-flashing'></i>
                                        </a>
                                        <a href="{{ route('download_file_checkups', $item->id) }}" class="btn btn-success fs-5">
                                            <i class='bx bx-printer'></i> 
                                        </a>
                                        <a href="{{ route('download_recipe_doctor', $item->id) }}" class="btn btn-primary fs-5">
                                            <i class='bx bx-task'></i> 
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Data tidak tersedia</div>
                                    </td>
                                </tr>
                                @endforelse
                                @endif
                            </tbody>
                        </table>
                        {{ $checkup->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection