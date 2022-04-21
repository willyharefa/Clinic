<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/doctor/doctor.css') }}">
    <title>Resep_obat_{{ $dateNow->format('dmyH') }}</title>
    <style>
        @page {
            size: a4 portrait;
            margin:-22.2;
        } 
        body {
            padding: 30px;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <section class="section-data-laboratory-checkups">
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
            <div class="wrapper-title">
                <h1>Informasi Resep Obat</h1>
                <p><strong>NO RM :</strong> {{ $checkup->no_medical_record }}</p>
            </div>
        </div>
        <div class="row-content-medic">
            <div class="row-detail">
                <div class="col-detail-patient">
                    <h4>Data Pasien</h4>
                    <table>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>{{ $checkup->patient->name }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>{{ $checkup->patient->gender }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>{{ $dateNow->diffInYears($checkup->patient->birthday) }} Tahun</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $checkup->patient->address }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-detail-checkup">
                    <table>
                        <tr>
                            <td>Dokter</td>
                            <td>{{ $checkup->doctor->name }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal periksa</td>
                            <td>{{ $checkup->date_checkup->format('d F Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row-result-labs">
            <table>
                <thead>
                    <tr>
                        <th>NAMA OBAT</th>
                        <th>SATUAN</th>
                        <th>PEMAKAIAN</th>
                        <th>QTY</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prescription as $item)
                    <tr>
                        <td>{{ $item->medicine->name }}</td>
                        <td>{{ $item->medicine->unit }}</td>
                        <td>{{ $item->recipe }}</td>
                        <td>{{ $item->amount }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row-noticed-by">
            <h3>Pekanbaru, {{ $dateNow->format('d F Y') }}</h3>
            <p>Mengetahui</p>
            <img src="{{ asset('/img/signiture.png') }}" width="120px" alt="">
            <h5>{{ $checkup->doctor->name }}</h5>
        </div>
    </section>
</body>
</html>