<x-front-layout title="Keranjang">
    @push('css')
      <link href="{{asset('')}}vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
      <link href="{{asset('')}}vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    @endpush
    
    <div class="container">
      <div class="p-3">
        <h1>{{ $title }}</h1>
      </div>
        <div class="row">
          <div class="col col-md-8">
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-warning">{{ $error }}</div>
            @endforeach
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="card card-table">
              <div class="card-header">
                Item
              </div>
              <div class="card card-body">
                <table class="table table-stripped">
                  <thead>
                    <tr>
                      <th>Layanan</th>
                      <th>Harga</th>
                      {{-- <th>Diskon</th> --}}
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order->cart->cartItems as $item)
                      <tr>
                        <td>
                          {{ $item->layanans->name }}
                        </td>
                        <td>
                          @currency( $item->price )
                        </td>
                        <td>
                          <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary btn-sm" style="margin: 0 3px 0 3px" disabled="true">
                              {{ $item->qty }}
                            {{-- {{ number_format($detail->qty, 2) }} --}}
                            </button>
                          </div>
                        </td>
                        <td>
                          @currency($item->subtotal)
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col col-md-4">
            <div class="card">
              <div class="card-header">
                Ringkasan
              </div>
              <div class="card-body">
                {{-- <form action="{{ route('payment.store') }}" method="POST">
                  @csrf
                  <input type="hidden" name="status"> --}}
                <table class="table">
                  {{-- @foreach ($order as $get)
                  <tr>
                    <td>No. Pesanan</td>
                    <td class="text-right">
                      {{ $get->transaction_id }}
                    </td>
                  </tr>     
                  @endforeach --}}
                  <tr>
                    <td>Tanggal acara</td>
                      <td class="text-right">
                        <input type="date" name="tgl_acara" value="{{ old('event_date', $order->cart->event_date ) }}" disabled>
                        @error('event_date')
                          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                      </td>
                  </tr>
                  {{-- <tr>
                    <td>Alamat</td>
                      <td class="text-right">
                        <textarea name="address" id="" cols="25" rows="5"></textarea>
                        @error('address')
                          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                      </td>
                  </tr> --}}
                  <tr>
                    <td>Subtotal</td>
                    <td class="text-right">
                      @currency($order->cart->subtotal)
                    </td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td class="text-right">
                        @currency($order->cart->total)
                    </td>
                  </tr>
                  <tr>
                    <td>Jumlah Cicilan</td>
                  <td>
                    <p>{{ $order->jml_cicilan }}</p>
                  </td>
                  </tr>
                </table>
              </div>
              <div class="card-footer">
                <div class="justify-content-center">
                  @if ($order->jml_cicilan != 0)
                    <a href="{{ $payment->link }}" class="btn btn-primary text-white text-center btn-show">Bayar DP @currency($order->cart->total * (30/100))</a>
                  @else
                    <a href="{{ $payment->link }}" class="btn btn-primary text-white text-center btn-show">Bayar Lunas</a>
                  @endif
            </div>
          </div>
        </div>
    </div>
    @push('js')
      <script src="{{asset('')}}vendor/jquery/jquery.min.js"></script>
      <script src="{{asset('')}}vendor/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="{{asset('')}}vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
      <script src="{{asset('')}}vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
      <script src="{{asset('')}}vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
      {{-- {{ $dataTable->scripts() }} --}}
      <script src="{{asset('')}}vendor/sweetalert2/sweetalert2.all.min.js"></script>
  
      <script>
        $('#cart-table').on('click','.action', function(){
          let data = $(this).data()
          let id = data.id
          let jenis = data.jenis
  
          if(jenis == 'delete')
          {
            Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  method: 'DELETE',
                  url: `{{ url('cart')}}/${id}`,
                  headers: 
                  {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success:function(res){
                    window.LaravelDataTables["cart-table"].ajax.reload()
                    Swal.fire({
                    title: "Deleted!",
                    text: res.message,
                    icon: res.status
                    });
                  }
                })
                // Swal.fire({
                //   title: "Deleted!",
                //   text: res.message,
                //   icon: res.status
                // });
              }
            });
          } //end if
        });
      </script>
    @endpush        
  </x-front-layout>