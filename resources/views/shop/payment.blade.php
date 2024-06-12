<x-front-layout title="invoice">
    @push('css')
      <link href="{{asset('')}}vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
      <link href="{{asset('')}}vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    @endpush
    @section('content')
    <section class="breadcrumbs mb-5">
        <div class="container">
    
          <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $title }}</h2>
            <ol>
              <li><a href="#">Home</a></li>
              <li>{{ $title }}</li>
            </ol>
          </div>
          {{ $dataTable->table() }}

        </div>
      </section><!-- End Our Portfolio Section -->
      @push('js')
      <script src="{{asset('')}}vendor/jquery/jquery.min.js"></script>
      <script src="{{asset('')}}vendor/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="{{asset('')}}vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
      <script src="{{asset('')}}vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
      <script src="{{asset('')}}vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
      {{ $dataTable->scripts() }}
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