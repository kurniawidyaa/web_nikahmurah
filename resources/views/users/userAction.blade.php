<div class="modal-content">
    <form id="formAction" action="{{ $customer->id ? route('customers.update', $customer->id) : route('customers.store')}}" method="post">
        @csrf
        @if ($customer->id)
            @method('PUT')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Customers</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Nama</label>
                        <input type="text" placeholder="Nama" value="{{ $customer->name }}" name="name" class="form-control" id="userName">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" placeholder="Email" value="{{ $customer->email }}" name="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Whatsapp</label>
                        <input type="text" placeholder="Nomor Whatsapp" value="{{ $customer->phone }}" name="phone" class="form-control" id="phone">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" id="alamat" rows="2" value="{{ $customer->address }}">{{ $customer->address }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <div class="input-group mb-3">
                            <input name="photo" type="file" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @if ($customer->photo)
                        <img src="{{ asset('assets/images/user/' . $customer->photo) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    @endif
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