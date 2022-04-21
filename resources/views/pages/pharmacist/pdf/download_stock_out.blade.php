<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/pharmacist/pharmacist.css') }}">
    <title>Laporan_Stock_Keluar_{{ $mark }}</title>
    <style>
        @page { margin: 100px 0px; }
        .footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 50px;text-align: center;}
        .footer .pagenum:before { 
            content: counter(page);
        }
        @font-face {
            font-family: 'Poppins';
            src: url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <section class="section-file-report">
        <div class="row-headline-form">
            <div class="wrapper-headline">
                <div class="col-img">
                    <img src="{{ asset('/img/icon_tab.png') }}" width="120px" alt="">
                </div>
                <div class="heading">
                    <h2>PRAKTIK DR AKMAL</h2>
                    <h5>Jln. Sudirman no. 21</h5>
                    <h5>Pekanbaru, Riau</h5>
                </div>
            </div>
            <div class="wrapper-heading">
                <h1>Laporan Stok Keluar</h1>
                <p><strong>NO :</strong> &nbsp; {{ 'RO-'.$mark }}</p>
            </div>
        </div>
        
        <div class="row-wrapper-table">
            <div class="wrapper-headline">
                <h5>Berikut adalah daftar laporan stok keluar</h5>

            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Cost</th>
                            <th>QTY</th>
                            <th>Date Out</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stock_out as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->medicine->name }}</td>
                            <td>{{ 'Rp. '. number_format($item->medicine->cost, 0, ",", ".") }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>{{ $item->medicine->supplier }}</td>
                        </tr>
                        @endforeach
                        <tr class="total_qty">
                            <td colspan="4"></td>
                            <th>Total Obat Keluar</th>
                            <th>{{ $stock_out->sum('amount') }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>