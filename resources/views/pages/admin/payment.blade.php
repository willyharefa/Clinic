@extends('layouts.dashboard_admin')
@section('content')
    <section class="section-payment">
        <div class="row gx-0">
            @if ($checkup->paid == 0)
            <div class="wrapper-info-payment">
                <div class="headline-info">
                    <h3>Informasi Pembayaran</h3>
                    <p>Berikut merupakan sejumlah informasi pembayaran</p>
                </div>

                <div class="col-sm-12 col-md-7 content-payment-list">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>#item</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prescription as $item)
                                <tr style="font-size: 13px; font-style:italic" class="text-muted">
                                    <td class="ps-5">{{ '@'.$item->medicine->name }}</td>
                                    <td class="text-end">{{ $item->amount }}</td>
                                    <td class="text-end" style="width: 150px">{{ 'Rp '.number_format($item->total_cost, 0, ",", ".") }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">Biaya Obat</td>
                                    <td class="text-end">{{ 'Rp '.number_format($prescription->sum('total_cost'), 0, ",", ".") }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Jasa Dokter</td>
                                    <td class="text-end">{{ 'Rp '.number_format($checkup->service_price, 0, ",", ".") }}</td>
                                </tr>
                                <tr style="border-bottom: 2px solid black">
                                    <th colspan="2">Total Bayar</th>
                                    <th class="text-end">{{ 'Rp '.number_format($checkup->service_price+$prescription->sum('total_cost'), 0, ",", ".") }}</th>
                                </tr>
                                <form action="{{ route('insertPayment', $checkup->id) }}" method="POST" id="form_payment">
                                    @csrf
                                    <tr class="align-middle">
                                        <td colspan="2">Masukan pembayaran</td>
                                        <td>
                                            <input type="hidden" name="total_payment" value="{{ $checkup->service_price+$prescription->sum('total_cost') }}" id="total_payment">
                                            <input type="number" name="cash" id="cash" class="form-control text-end">
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td colspan="2">Kembalian</td>
                                        <td>
                                            <input type="text" readonly class="form-control text-end" name="refund" id="refund">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" disabled class="btn btn-primary" id="btn-payment">Bayar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="text-decoration-none" href="{{ route('dashboard_admin') }}">Kembali ke Dashboard</a>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <p>Anda tidak dapat mengulang pembayaran lagi. Silahkan klik <a href="{{ route('dashboard_admin') }}">disini</a> untuk kembali.</p>
            @endif
        </div>
    </section>
@endsection

@push('script')
    <script>
        const totalPay = document.getElementById('total_payment');
        const cash = document.getElementById('cash');
        const refundCash = document.getElementById('refund');
        const btnPayment = document.getElementById('btn-payment');
        const formPayment = document.getElementById('form_payment');
        cash.addEventListener('input', (e) => {
            let cashPayment = parseInt(e.target.value)
            if(totalPay.value > cashPayment) {
                refundCash.value = 'Uang kurang';
                btnPayment.disabled = true;
            } 
            if(totalPay.value <= cashPayment){
                btnPayment.disabled = false;
                totalRefund = parseInt(totalPay.value - cashPayment);
                refundCash.value = parseInt(Math.abs(totalRefund));
            }
        })

        btnPayment.addEventListener('click', (e) => {
            e.preventDefault();
            swal({
                title: "Ingin Bayar?",
                text: "Pembayaran ini akan disimpan",
                icon: "info",
                buttons: true,
                dangerMode: true,
                })
                .then((confirmPay) => {
                if (confirmPay) {
                    swal("Selamat, pembayaran berhasil", {
                    icon: "success",
                    
                    });
                    setTimeout(() => {
                        formPayment.submit();
                    }, 1000);
                    
                }
            });
        })


    </script>
@endpush