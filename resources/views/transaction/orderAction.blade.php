<div class="modal-content">
    <form id="formAction" action="{{ route('order.update', $order->id) }}" method="post">
        @csrf
        @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="smallModalLabel">Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="col-md-12">
            <div class="mb-3" data-date-format="dd-mm-yyyy">
                <label for="datepicker" class="form-label">Tanggal Acara</label>
                <input class="form-control date" name="event_date" value="{{ $cart->event_date }}" type="text" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
    </form>
</div>
<script>
    $('.date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy'
    }).on('changeDate', function (e) {
        console.log(e.target.value);
    });
</script>