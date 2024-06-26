@extends('layouts.master')
@push('css')
    <link href="{{asset('')}}vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="{{asset('')}}vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="main-content">
    <div class="title">
        Galeri
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tabel Galeri</h4>
                    </div>
                    <div class="card-body">
                        @if (request()->user()->can('create store/galeris'))
                            <button type="button" class="btn mb-2 btn-primary btn-sm mb-3 btn-add">Tambah Data</button>
                        @endif
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="modalAction" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            
        </div>                   
    </div>
</div>
@endsection
@push('js')
<script src="{{asset('')}}vendor/jquery/jquery.min.js"></script>
<script src="{{asset('')}}vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('')}}vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('')}}vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('')}}vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
{{ $dataTable->scripts() }}
<script src="{{asset('')}}vendor/sweetalert2/sweetalert2.all.min.js"></script>

<script>
    const modal = new bootstrap.Modal($('#modalAction'))
    $('.btn-add').on('click', function(){
        $.ajax({
            method:'get',
            url: `{{ url('store/galeris/create') }}`,
            success:function(res){
                $('#modalAction').find('.modal-dialog').html(res)
                modal.show()
                store()
            }
        })
    })

    function store() {
            $('#formAction').on('submit', function(e){
            e.preventDefault()
            // console.log(this);
            const _form = this
            const formData = new FormData(_form)
            const url = this.getAttribute('action')

            $.ajax({
                method:'POST',
                url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(res){
                    window.LaravelDataTables["galeri-table"].ajax.reload()
                    $('#modalAction').find('.modal-dialog').html(res)
                    modal.hide()
                },
                error: function(res){
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove()
                    if (errors) {
                        for(const [key, value] of Object.entries(errors)){
                            $(`[name='${key}']`).parent().append(`<span class="text-danger text-small">'${value}'</span>`)
                        }
                    }
                    console.log(errors);
                }
            })
            })
        }
    
    $('#galeri-table').on('click','.action', function(){
        let data = $(this).data()
        let id = data.id
        let jenis = data.jenis

        if(jenis == 'delete')
        {
            Swal.fire({
            title: "Apakah anda yakin?",
            text: "Anda akan menghapus data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method:'DELETE',
                    url: `{{ url('store/galeris/') }}/${id}`,
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                    success:function(res){
                        window.LaravelDataTables["galeri-table"].ajax.reload()
                        Swal.fire({
                        title: "Deleted!",
                        text: res.message,
                        icon: res.status
                        });

                    }
                })
            }
            });
            return
        }  

        $.ajax({
            method:'get',
            url: `{{ url('store/galeris/') }}/${id}/edit`,
            success:function(res){
                $('#modalAction').find('.modal-dialog').html(res)
                modal.show()
                store()

            }
        })
        
    })
</script>
@endpush