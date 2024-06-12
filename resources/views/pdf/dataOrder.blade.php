<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    background-color: #7ABDC1;
}
th, td {
    border: 1px solid #ddd;
    padding: 10px;
}

     </style>
</head>

<body>
    <div class="card-title">
        <img src="{{ public_path("/img/logo.jpg") }}" alt="">
        <h1>Laporan Penjualan</h1>
        <h3>Periode {{ $bulan != "" ? "Bulan ".$bulan: "" }} {{ $tahun }}</h3>
    </div>
    <div class="card-body">
        
    </div>
</body>

</html>