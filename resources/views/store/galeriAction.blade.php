<div class="modal-content">
    <form id="formAction" action="{{ $galeri->id ? route('galeris.update', $galeri->id) : route('galeris.store') }}" method="POST">
        @csrf
        @if ($galeri->id)
            @method( 'PUT' )  
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Galeri</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="" class="form-label">Kategori Layanan</label>
                    <select class="form-select form-select-sm mb-3" aria-label="Default select example" name="category_id">
                        <option selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                        @if (old('category_id') == $item->id)
                            <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <div class="mb-3">
                        <input name="thumbnail" type="file" class="form-control" >
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