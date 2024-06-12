<x-front-layout title="Layanan">
       <!-- ======= Our Services Section ======= -->
       <section class="breadcrumbs">
        <div class="container">
  
          <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $title }}</h2>
            <ol>
              <li><a href="{{ route('home') }}">Home</a></li>
              <li>{{ $title }}</li>
            </ol>
          </div>
  
        </div>
      </section><!-- End Our Services Section -->
  
       <!-- ======= Service Details Section ======= -->
    <section class="service-details">
      <div class="container">
        {{-- Service Category --}}
        <div>
          <div class="col-lg-12 portfolio">
            <ul id="portfolio-flters">
              <li data-filter="#" class=""><a href="{{ route('layanan.display') }}">All</a></li>
              @foreach ($kategoris as $item)
                  <li><a href="layanan?kategori={{$item->identifier}}" class="filter-active" >{{$item->name}}</a></li>
              @endforeach
              {{-- @foreach ($layanan->category_id as $kategori)
              <li ><a href="/layanan?kategori={{ $ktg->identifier }}" name="kategori" value="{{$ktg->identifier}}">{{ $ktg->name }}</a></li>
              @endforeach --}}
            </ul>
          </div>
        </div>
        <div class="row">
          @if ($layanan->count())
          @foreach ($layanan as $serv)
          <div class="col-md-4 d-flex align-items-stretch" data-aos="fade-up">
            <div class="card">
              <div class="card-img">
                @if ($serv->thumbnail != null)
                {{-- {{ $serv->kategori->name }} --}}
                <img src="{{ asset('storage/'.$serv->thumbnail) }}" class="imgServices img-fluid"> 
                @else
                <img src="https://source.unsplash.com/500x300?{{ $serv->name }}" class="card-img-top" alt="{{ $serv->name }}">
                @endif
              </div>
              <div class="card-body">
                <h4 class="card-title"><a href="">{{ $serv->name }}</a></h4><br>
                <div class="pricing row">
                  <h4>@currency($serv->price)</h4>
                  {{-- <h4><span>Discount</span>@currency($serv->servicePromo->final_price)</h4> --}}
                  {{-- <button type="button" class="btn btn-primary text-white text-center btn-add">{{ $submit }}</button> --}}
                  <a href="{{ route('layanan.detail', $serv->identifier) }}" class="btn btn-primary text-white text-center btn-show">{{ $submit }}</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
      </div>
      <div class="blog-pagination">
        <div class="d-flex justify-content-end">{{ $layanan->links() }}</div>
      </div>
      @endif
    </section><!-- End Service Details Section -->
</x-front-layout>