<x-front-layout>
    @push('css')
      <link href="{{asset('')}}vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
      <link href="{{asset('')}}vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    @endpush
    
    <div class="container">
      <div class="p-3">
        <h1>Riwayat</h1>
      </div>
      {{ $dataTable->table() }}
        {{-- <div class="row">
          <div class="col col-md-12">
          </div>
        </div> --}}
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