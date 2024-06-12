<x-front-layout>
  <div class="no-item-bg p-5 text-center">
    <h1>Keranjang Belanja</h1>
    <img src="{{ asset('/storage/images/noitem-cart.gif') }}" alt="" class="p-5">
    <h3 class="mb-5">Opsss... keranjangmu kosong</h3>
    <a href="{{ route('layanan.display') }}" class="chart btn-primary">Yuk Belanja</a>
  </div>
</x-front-layout>