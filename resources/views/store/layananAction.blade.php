<div class="modal-content">
    <form id="formAction" action="{{ $layanan->id ? route('layanans.update', $layanan->id) : route('layanans.store') }}" method="POST">
        @csrf
        @if ($layanan->id)
            @method( 'PUT' )  
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Layanan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="layananName" class="form-label">Name</label>
                        <input type="text" placeholder="Nama Layanan" value="{{ $layanan->name }}" name="name" class="form-control" id="layananName">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="identifierName" class="form-label">Kategori Layanan</label>
                    <select name="category_id" class="form-select form-select-sm mb-3">
                        <option selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                        @if ($layanan->category_id === $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                        @endif
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="layananDescription" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="layananDescription" name="description" rows="6" value="{{ $layanan->description }}">{{ $layanan->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="layananNote" class="form-label">Catatan</label>
                        <textarea name="note" class="form-control" id="layananNote" rows="2" value="{{ $layanan->note }}">{{ $layanan->note }}</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="layananQty" class="form-label">Qty</label>
                        <input type="text" placeholder="Qty" value="{{ $layanan->qty }}" name="qty" class="form-control" id="layananQty">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="layananPrice" class="form-label">Harga</label>
                        <input type="text" placeholder="Harga Layanan" value="{{ $layanan->price }}" name="price" class="form-control" id="layananPrice">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="layananName" class="form-label">Thumbnail</label>
                <div class="input-group mb-3">
                    <input name="thumbnail" type="file" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                @if ($layanan->thumbnail)
                    <img src="{{ asset('assets/' . $layanan->thumbnail) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    @endif
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>