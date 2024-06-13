<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/pdf.css">
    <title>Data Order</title>
     <style>
      @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');
        * {
            box-sizing: border-box;
            font-family: 'Roboto';
        }
        .card-body{
            display: grid;
            grid-auto-flow: column;
        }
        .card-title {
            text-align: center;
            margin: 50px 0 0 50px;
        }
        table {
            border-collapse: collapse;
            max-width: 100%;
        }
        th {
            background-color: #b9e1e3;
        }
        th, td {
            border: 1px solid #525151;
            padding: 10px;
        }
     </style>
</head>
<body>
        <div class="card-title">
            <img src="../public/storage/images/logo.jpg" >
            <h1>Laporan Penjualan</h1>
            {{-- <h3>Periode {{ $bulan != "" ? $bulan: "" }} {{ $tahun }}</h3> --}}
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
                        <th>Pelanggan</th>
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
                          <td>{{$od->user_id}}</td>
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
</body>
</html>