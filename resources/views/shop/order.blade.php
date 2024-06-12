<x-front-layout>
  @push('css')
    <link href="{{asset('')}}vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="{{asset('')}}vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
  @endpush
    <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">
                    Riwayat Pesanan
                  </h3>
              </div>
              <div class="card-body">
                <!-- digunakan untuk menampilkan pesan error atau sukses -->
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
                <div class="table-responsive container">
                  <div class="col-md-12">
                    {{ $dataTable->table() }}
                  </div>
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
  {{ $dataTable->scripts() }}
  <script src="{{asset('')}}vendor/sweetalert2/sweetalert2.all.min.js"></script>
@endpush
</x-front-layout>