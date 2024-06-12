<x-front-layout title="invoice">
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

    </div>
  </section><!-- End Our Portfolio Section -->
  <div class="pdfbutton d-flex justify-content-end" style="margin-right: 200px; margin-bottom:30px">
    <a href="{{ route('pdf', $payment->payment_id) }}" class="btn btn-primary">Download</a>
  </div>

  @include('pdf.invoice')
</x-front-layout>