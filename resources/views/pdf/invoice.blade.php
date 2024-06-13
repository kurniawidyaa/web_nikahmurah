<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('../css/pdf.css') }}"> --}}
    <link rel="stylesheet" href="../public/css/pdf.css">
</head>
<body>
    <div class="invoice-box">
        <h1 class="mb-5" style="text-align: center">INVOICE</h1>
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title" style="justify-content:left; display:flex; padding:0px">
                                {{-- <img src="{{ asset('assets/images/logo.jpg') }}" > --}}
                                <img src="../public/assets/images/logo.jpg" >
                            </td>
                            <td>
                                
                                Order Id                : {{ $payment->order->transaction_id}}  <br>
                                Tanggal Layanan         : {{ $payment->order->cart->event_date}}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Nikah Murah Tangerang.<br>
                                Jl. Dasana Indah Ruko RF 1 no 21 dan 22<br>
                                Kabupaten Tangerang, Banten
                            </td>

                            <td>
                                Nikahmurahtangerang@gmail.com
                            </td>
                        </tr>
                    </table>
                    <p>Invoice ini merupakan bukti pembayaran yang sah, dan diterbitkan atas nama :</p>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="2">
                    Datar Pelanggan
                </td>
            </tr>

            <tr>
                <td>Nama</td>
                <td>{{ $payment->order->cart->user->name}}</td>
            </tr> 
            <tr>
                <td>Alamat</td>
                <td>{{ $payment->order->cart->address }}</td>
            </tr>   
            <tr>
                <td>Nomor Telepon</td>
                <td>{{ $payment->order->cart->user->phone }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $payment->order->cart->user->email }}</td>
            </tr>
            <tr>
                <td>Catatan order</td>
                <td></td>
            </tr>

            <tr class="heading">
                <td>
                    Pesanan
                </td>

                <td>
                    Harga
                </td>
            </tr>
            
            @foreach ($payment->order->cart->cartItems as $order)
            <tr class="item">
                <td>
                  {{ $order->layanans->name }}
                </td>
                    
                <td>
                    @currency($order->subtotal)
                </td>
            </tr>
            @endforeach

            <tr>
                <td> Sub Total</td>
                <td>@currency($payment->order->cart->subtotal)</td>
            </tr>
            <tr>
                <td>Biaya Layanan</td>
                <td></td>
            </tr>
            <tr class="total">
                <td>Total</td>
                <td>@currency($payment->order->cart->total)</td>
            </tr>
            <tr>
                <td>Jumlah Angsuran</td>
                <td>{{ $payment->order->jml_cicilan }} Kali</td>
            </tr>
            <tr class="heading">
                <td>Jenis Pembayaran</td>
                <td>Keterangan</td>
            </tr>
            <tr>
                <td>{{ $payment->type }}</td>
                <td>{{ $payment->status }}</td>
            </tr>
        </table>
    </div>
</body>
</html>