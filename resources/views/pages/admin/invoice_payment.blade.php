<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/payment.css') }}">
    <title>{{ $payment->no_payment }}</title>
</head>
<body>
    <section class="section-invoice-payment">
        <div class="row-headline-info">
            <div class="wrapper-head">
                <div class="col-image">
                    <img src="{{ asset('/img/icon_tab.png') }}" width="100px" alt="">
                </div>
                <div class="col-desc-company">
                    <div class="head-name-company">
                        <h5 class="name-company">PRAKTIK DR. AKMAL</h5>
                        <H5>Jl. Jendral sudirman</H5>
                        <h5>Pekanbaru, Riau</h5>
                    </div>
                    <div class="contact-company">
                        <h5 class="headline-info">OUR CONTACT</h5>
                        <h5>dr_akmal@yahoo.com</h5>
                        <h5>(+62) 920 00010</h5>
                    </div>
                </div>
            </div>
            <div class="row-title-foot">
                <h1>Invoice Pembayaran</h1>
                <p>NO INVOICE : {{ $payment->no_payment }}</p>
            </div>
        </div>
        <div class="row-description-payment">
            <table>
                <thead>
                    <tr>
                        <th>ITEM DESCRIPTION</th>
                        <th>QTY</th>
                        <th>BIAYA</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Medicine --}}
                    @foreach ($prescription as $item)
                    <tr>
                        <td>{{ $item->medicine->name }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ 'Rp '.number_format($item->total_cost, 0, ",", ".") }}</td>
                    </tr>
                    @endforeach
                    <tr class="service_doctor">
                        <td colspan="2">Jasa Dokter</td>
                        <td>{{ 'Rp '.number_format($checkup->service_price, 0, ",", ".") }}</td>
                    </tr>
                    
                    <tr class="total_payment">
                        <td></td>
                        <td>TOTAL</td>
                        <td>{{ 'Rp '.number_format($payment->total_cost, 0, ",", ".") }}</td>
                    </tr>
                    
                    <tr class="cash_payment">
                        <td></td>
                        <td>DIBAYAR</td>
                        <td>{{ 'Rp '.number_format($payment->paid, 0, ",", ".") }}</td>
                    </tr>
                    
                    <tr class="refund">
                        <td></td>
                        <td>KEMBALIAN</td>
                        <td colspan="1">{{ 'Rp '.number_format($payment->refund, 0, ",", ".") }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="status">
            <h3 >LUNAS</h3>
            <p>Pembayaran berobat pasien telah lunas.</p>
        </div>
    </section>
</body>
</html>