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
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cart->cartItems as $item)
                    <tr>
                      <td>
                        {{ $item->layanans->name }}
                      </td>
                      <td>
                        @currency( $item->price )
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <form action="{{ route('cart_item.update', $item->id) }}" method="post">
                          @method('patch')
                          @csrf()
                            <input type="hidden" name="kurang" value="{{ $item->qty }}">
                            <button class="btn btn-primary btn-sm">
                            -
                            </button>
                          </form>
                          <button class="btn btn-outline-primary btn-sm" style="margin: 0 3px 0 3px" disabled="true">
                            {{ $item->qty }}
                          {{-- {{ number_format($detail->qty, 2) }} --}}
                          </button>
                          <form action="{{ route('cart_item.update', $item->id) }}" method="post">
                          @method('patch')
                          @csrf()
                            <input type="hidden" name="tambah" value="{{ $item->qty }}">
                            <button class="btn btn-primary btn-sm">
                            +
                            </button>
                          </form>
                        </div>
                      </td>
                      <td>
                        @currency($item->subtotal)
                      </td>
                      <td>
                        <form action="{{ route('cart_item.destroy', $item->id) }}" method="post" style="display:inline;">
                          @csrf
                          {{ method_field('delete') }}
                          <button type="submit" class="btn btn-sm btn-danger mb-2">
                            Hapus
                          </button>                    
                        </form>
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
              <form action="{{ route('cart.store') }}" method="POST">
                @csrf
              <table class="table">
                <tr>
                  <td>Tanggal Layanan</td>
                    <td class="text-right">
                      <input type="date" id="txtDate" name="event_date">
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
                    @currency($cart->subtotal)
                  </td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td class="text-right">
                      @currency($cart->total)
                  </td>
                </tr>
                <tr>
                  <td>DP (30%)</td>
                  <td class="text-right">
                      @currency($cart->total * (30/100))
                  </td>
                </tr>
                <tr>
                  <td>Jumlah Cicilan</td>
                  <td>
                    <select name="cicilan" class="form-select">
                      @for ($i = 0; $i < 13; $i++)
                        @if ($i == 0 || $i == 1 || $i == 3 || $i == 6 || $i == 12)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                      @endfor
                    </select>
                  </td>
                  {{-- <td><button class="btn btn-primary">kirim</button></td>
                  </form> --}}
                </tr>
              </table>
            </div>
            <div class="card-footer" style="justify-content: center; display: flex;">
              <div class="row"style="justify-content: center;">
                <div class="col" style="margin-right: 10px">
                    <button type="submit" class="btn-primary btn-block"> Checkout </button>
                  </form>
                </div>
                <div class="col">
                  <form action="{{ route('cart.destroy', $cart->id)}}" method="POST">
                    @method('DELETE')
                    @csrf()
                    <button type="submit" class="btn btn-danger btn-block">Kosongkan</button>
                  </form>
                </div>
            </div>
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

      //membatasi bulan
      $(function(){
          var dtToday = new Date();

          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();
          if(month < 10)
              month = '0' + month.toString();
          if(day < 10)
              day = '0' + day.toString();

          var minDate= year + '-' + month + '-' + day;

          $('#txtDate').attr('min', minDate);
      });
    </script>
  @endpush        
</x-front-layout>