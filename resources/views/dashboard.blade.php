@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="{{asset('')}}vendor/chart.js/Chart.min.css">
@endpush
@section('content')
<div class="main-content">
    <div class="title">
        Dashboard
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
           {{-- users --}}
           <div class="col-md-3">
            <div class="card text-info border-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <h2 class="card-text">{{ $user->count() }}</h2>
                </div>
            </div>
        </div>
        {{-- order --}}
        <div class="col-md-3">
            <div class="card text-info border-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Order</h5>
                    <h6>( Belum Selesai )</h6>
                    <h2 class="card-text">{{ $order->count() }}</h2>
                </div>
            </div>
        </div>
        {{-- order --}}
        <div class="col-md-3">
            <div class="card text-info border-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Order</h5>
                    <h6>( Selesai )</h6>
                    <h2 class="card-text">{{ $order->count() }}</h2>
                </div>
            </div>
        </div>
        {{-- Payment --}}
        <div class="col-md-3">
            <div class="card text-info border-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Pembayaran</h5>
                    <h6>( Lunas )</h6>
                    <h2 class="card-text">{{ $paid->count() }}</h2>
                </div>
            </div>
        </div>
        {{-- Payment --}}
        <div class="col-md-3">
            <div class="card text-info border-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Pembayaran</h5>
                    <h6>( Belum Lunas )</h6>
                    <h2 class="card-text">{{ $unpaid->count() }}</h2>
                </div>
            </div>
        </div>
        </div>
    </div>
    

</div>
@endsection
@push('js')
    <script src="{{ asset('') }}vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('') }}assets/js/pages/index.min.js"></script>
@endpush