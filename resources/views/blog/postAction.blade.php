<div class="modal-content">
    <form id="formAction" action="{{ $post->id ? route('posts.update', $post->id) : route('posts.store') }}" method="POST">
        @csrf
        @if ($post->id != null)
            @method( 'PUT' )  
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Artikel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="titlePost" class="form-label">Judul</label>
                        <input type="text" placeholder="Judul post" value="{{ $post->title }}" name="title" class="form-control" id="titlePost">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="kategori" class="form-label">Kategori post</label>
                    <select name="category_id" class="form-select form-select-sm mb-3">
                        <option selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                        @if ($post->category_id === $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                        @endif
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="postBody" class="form-label">Body</label>
                        <textarea class="form-control" id="postBody" name="body" rows="6" value="{{ $post->body }}">{{ $post->body }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea name="excerpt" class="form-control" id="postexcerpt" rows="2" value="{{ $post->excerpt }}">{{ $post->excerpt }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <div class="input-group mb-3">
                    <input name="thumbnail" type="file" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                @if ($post->thumbnail)
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
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