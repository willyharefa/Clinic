@extends('layouts.doctor_dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/doctor/doctor.css') }}">
@endpush

@section('content')
    <section class="section-checkup-patient">
        <div class="row gx-0 mx-0 mb-3">
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="headline-checkup-patient">
            <div class="col col-no-order me-3">
                <label class="text-muted form-text mb-1">No Urut</label>
                <h4>{{ $appointment->no_order }}</h4>
            </div>
            <div class="col col-name-patient">
                <label class="text-muted form-text mb-1">Nama Pasien</label>
                <h4>{{ $appointment->patient->name }}</h4>
            </div>
        </div>

        <div class="row gx-0 mb-5">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-6">
                            <h5 class="mb-0 text-muted">Data Pemeriksaan</h5>
                        </div>
                        <div class="col-sm-12 col-md-6 text-sm-start text-md-end">
                            @if ($checkup == null)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkup">
                                Isi Pemeriksaan
                            </button>
                            @endif

                            <form action="{{ route('checkup_result',[$appointment->id, $appointment->patient_id, $data->id]) }}" method="post">
                                @csrf
                                <div class="modal fade" id="checkup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-muted">Data Pemeriksaan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col text-start">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal periksa</label>
                                                    <input type="date" class="form-control" name="date_checkup" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Keluhan pasien</label>
                                                    <input type="text" class="form-control" name="grievance" required autocomplete="off" spellcheck="false">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Hasil Diagnosa</label>
                                                    <input type="text" class="form-control" name="result_diagnoses" required autocomplete="off" spellcheck="false">
                                                </div>
                                                <hr>
                                                <div class="">
                                                    <label class="form-label"><Strong>Biaya Pemeriksaan</Strong></label>
                                                    <input type="number" class="form-control" name="service_price" required autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gx-0">
                        @if ($checkup == null)
                            <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                Data pemeriksaan masih kosong.
                            </div>
                        @else
                        <div class="col-sm-12 col-md-6 me-md-3 me-sm-0">
                            <div class="mb-3">
                                <label class="form-label">Tanggal periksa</label>
                                <input type="date" disabled class="form-control" value="{{ $checkup->date_checkup->format('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keluhan pasien</label>
                                <input type="text" disabled class="form-control" value="{{ $checkup->grievance }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Hasil Diagnosa</label>
                                <input type="text" disabled class="form-control" value="{{ $checkup->result_diagnoses }}">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-0 row-checkups">
            {{-- Form hasil lab --}}
            <div class="col-6">
                @if (!$checkup == null)
                    @if ($checkup->paid == 0)
                    <a class="btn mb-3 px-0 text-primary" data-bs-toggle="modal" data-bs-target="#labs_result"><strong> + Hasil Lab</strong></a>
                    <form action="{{ route('result_lab') }}" method="post">
                        @csrf
                        <div class="modal fade" id="labs_result" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-muted">Hasil Laboratorium</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col text-start">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Pemeriksaan</label>
                                            <input type="text" class="form-control" name="name_lab" required autocomplete="off" spellcheck="false">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nilai</label>
                                            <input type="text" class="form-control" name="grade" required autocomplete="off" spellcheck="false">
                                        </div>
                                        @if (!$laboratory == null)
                                            <input type="hidden" name="checkup_id" value="{{ $checkup->id }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                    @endif
                @endif
                <div class="table-responsive">
                    <table class="table table-sm align-middle table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nilai</th>
                                {{-- @if (!$checkup == 0)
                                <th>Aksi</th>
                                @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$laboratory == null)
                                @forelse ($laboratory as $item)
                                <tr>
                                    <td>{{ $item->name_lab }}</td>
                                    <td>{{ $item->grade }}</td>
                                    {{-- @if (!$checkup == 0)
                                    <td>
                                        <button type="button" class="btn btn-warning">
                                            <i class='bx bx-edit'></i>
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </td>
                                    @endif --}}
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">
                                        <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Hasil lab belum tersedia</div>
                                    </td>
                                </tr>
                                @endforelse
                            @else
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Data pemeriksaan belum terisi</div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Form obat --}}
            <div class="col-6 mb-5">
                @if(!$checkup == null)
                    @if ($checkup->paid == 0)
                    <a class="btn mb-3 px-0 text-primary" data-bs-toggle="modal" data-bs-target="#prescription"><strong> + Resep Obat</strong></a>
                
                    <form action="{{ route('prescription', $checkup->id) }}" method="post">
                        @csrf
                        <div class="modal fade" id="prescription" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-muted">Tambah Resep Obat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col text-start">
                                        <div class="mb-3">
                                            <label class="form-text">Nama Obat</label>
                                            <select name="medicine_id" id="medicine_id" class="form-select" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                <option selected disabled>Silahkan pilih obat</option>
                                                @forelse ($medicine as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @empty
                                                    <option selected disabled>Data obat masih kosong</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-text">Jumlah</label>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <label class="form-text text-end">Stok</label>
                                                </div>
                                            </div>
                                            <div class="input-group mb-1">
                                                <input type="number" class="form-control" name="amount" id="amount" min="0">
                                                <span class="input-group-text" id="unit_medicine">Satuan</span>
                                                <span class="input-group-text px-1" id="stok">Stok</span>
                                            </div>
                                            <p class="fst-italic text-muted m-0 p-0" style="font-size: 12px">1 Strip berisi 10 kaplet</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-text">Aturan Pemakaian</label>
                                            <input type="text" class="form-control" name="recipe" required autocomplete="off" spellcheck="false">
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="form-label"><strong>Biaya</strong></label>
                                            <input type="hidden" id="cost">
                                            <input type="number" class="form-control" readonly name="total_cost" id="total_cost" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                    @endif
                @endif
                <div class="table-responsive">
                    <table class="table table-sm align-middle table-borderless">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>QTY</th>
                                <th>Pemakaian</th>
                                @if (!empty($checkup) && $checkup->paid == 0)
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$prescription == null)
                                @forelse ($prescription as $item)
                                <tr>
                                    <td>{{ $item->medicine->name }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->recipe }}</td>
                                    @if (!empty($checkup) && $checkup->paid == 0)
                                    <td>
                                        <button type="button" class="btn btn-success btn-pull-back" data-name="{{ $item->medicine->name }}" data-id="{{ $item->id }}">
                                            <i class='bx bx-share bx-flip-horizontal'></i>  Tarik
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Resep obat masih kosong.</div>
                                    </td>
                                </tr>
                                @endforelse
                            @else 
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info alert-dismissible fade show my-2" role="alert">Pemeriksaan belum dilakukan.</div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        const select = document.getElementById('medicine_id');
        const unit = document.getElementById('unit_medicine');
        const cost = document.getElementById('cost');
        const stok = document.getElementById('stok');
        const btnPullBack = document.querySelectorAll(".btn-pull-back");
        select.addEventListener('change', () => {
            const getValue = select.options[select.selectedIndex].value;
            (fetch('/medicine/unit/'+getValue))
            .then(response => response.json())
            .then(data =>  [
                unit.textContent = data.unit,
                cost.value = data.cost,
                stok.textContent = data.quantity
            ])
        })
        // Get Total Cost when field amount input
        const amount = document.getElementById('amount');
        const total_cost = document.getElementById('total_cost');
        amount.addEventListener('input', () => {
            let a = parseInt(amount.value);
            let b = parseInt(cost.value)
            let totalPayment = a * b;
            total_cost.value = totalPayment;
        })

        btnPullBack.forEach(btnPullBack => {
            btnPullBack.addEventListener("click", () => {
                const attName = btnPullBack.getAttribute("data-name");
                const attId = btnPullBack.getAttribute("data-id");
                swal({
                    title: "Resep obat ditarik kembali ?",
                    text: "Obat "+ attName + " akan ditarik kembali",
                    icon: "info",
                    html: true,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willPullBack) => {
                    if (willPullBack) {
                        swal("Oke! obat "+ attName +" sudah ditarik kembali", {
                            icon: "success",
                        });
                        setTimeout(()=> {
                            location.href = "/dashboard/doctor/recipe/pullback/"+attId+"";
                        },1200);

                    } else {
                        swal("Obat "+ attName +" batal ditarik", {
                            icon: "info",
                        });

                    }
                });
            })
        })

    </script>
@endpush