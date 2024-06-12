<div class="modal-content">
    <form id="formAction" action="{{ $kategoriLayanan->id ? route('kategori_layanans.update', $kategoriLayanan->id) : route('kategori_layanans.store') }}" method="POST">
        @csrf
        @if ($kategoriLayanan->id)
            @method( 'PUT' )  
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Kategori layanan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kategoriLayananName" class="form-label">Name</label>
                        <input type="text" placeholder="Kategori Layanan Name" value="{{ $kategoriLayanan->name }}" name="name" class="form-control" id="kategoriLayananName">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="identifierName" class="form-label">Identifier</label>
                        <input type="text" placeholder="Identifier Name" value="{{ $kategoriLayanan->identifier }}" name="identifier" class="form-control" id="identifierName">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>