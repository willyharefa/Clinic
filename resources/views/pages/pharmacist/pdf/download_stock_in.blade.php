<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/pharmacist/pharmacist.css') }}">
    <title>Laporan_Stock_Masuk_{{ $mark }}</title>
    <style>
        /* @page { */
            /* margin:0; */
        /* } */
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
                <h1>Laporan Stok Masuk</h1>
                <p><strong>NO :</strong> &nbsp; {{ 'R-'.$mark }}</p>
            </div>
        </div>

        <div class="footer">
            
            Page <span class="pagenum"></span>
        </div>
        
        <div class="row-wrapper-table">
            <div class="wrapper-headline">
                <h5>Berikut adalah daftar laporan stok masuk</h5>

            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Cost</th>
                            <th>QTY</th>
                            <th>Date Entry</th>
                            <th>Date Expired</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stock_in as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ 'Rp. '. number_format($item->cost, 0, ",", ".") }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->date_of_entry->format('d-m-Y') }}</td>
                            <td>{{ $item->date_expired->format('d-m-y') }}</td>
                            <td>{{ $item->supplier }}</td>
                        </tr>
                        @endforeach
                        <tr class="total_qty">
                            <td colspan="5"></td>
                            <th>Total Obat</th>
                            <th>{{ $stock_in->sum('quantity') }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>