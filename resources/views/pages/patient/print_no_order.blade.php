<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/patient/schedule_doctor.css') }}">
    <title>no_antrian_001</title>
    <style>
        @page {
            padding: 0;
            margin:0;
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

    <section class="section-print-no-order">
        <div class="container">
            <img src="{{ asset('/img/icon_tab.png') }}" width="70px" alt="">
            <div class="row">
                <div class="content">
                    <table>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $data->patient->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal pesan</th>
                            <td>{{ $data->date_book->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Diperiksa oleh</th>
                            <td>{{ $data->doctor->name }}</td>
                        </tr>
                    </table>
                </div>
                <div class="head">
                    <p class="small-title">NO ANTRIAN</p>
                    <h4>{{ $data->no_order }}</h4>
                </div>
            </div>
            
        </div>
    </section>
</body>
</html>