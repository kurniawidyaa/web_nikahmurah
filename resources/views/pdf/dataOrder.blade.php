<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('../css/pdf.css') }}"> --}}
    <link rel="stylesheet" href="../public/css/pdf_laporan.css">
</head>
<body>
    <div class="box">
        <div class="title mb-5" style="text-align: center">
            <img src="../public/assets/images/logo.jpg">
            <h1>Laporan Penjualan</h1>
             <h3>Periode {{ $bulan != "" ? $bulan: "" }} {{ $tahun }}</h3>
        </div>
        <div class="card-body">
            <div class="ringkasan">
                <h2>Ringkasan Transaksi</h2>
                <!-- cetak totalnya -->
                <?php
                $total = 0;
                foreach ($order as $k) {
                  $total += $k->cart->total;
                }
                ?>
                  <!-- end cetak totalnya -->
                <table>
                    <tr>
                        <th>Total Penjualan</th>
                        <td>@currency($total)</td>
                    </tr>
                    <tr>
                        <th>Total Transaksi</th>
                        <td>{{ count($order) }} Transaksi</td>
                    </tr>
                </table>
            </div>
            <div class="data">
                <h2>Rincian Transaksi</h2>
                <table>
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Id Transaksi</th>
                        {{-- <th>Pelanggan</th> --}}
                        <th>Tanggal Acara</th>
                        <th>Status</th>
                        <th>Jumlah Cicilan</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($order as $od)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $od->transaction_id }}</td>
                          {{-- <td>{{$od->user_id}}</td> --}}
                          <td>{{ $od->cart->event_date}}</td>
                          <td>{{ $od->cart->status }}</td> 
                          <td>{{ $od->jml_cicilan }}</td> 
                          <td>@currency($od->cart->total)</td> 
                           
                        </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>