<x-front-layout title="Galeri">
      <!-- ======= Our Portfolio Section ======= -->
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

  <!-- ======= Portfolio Section ======= -->
  <section class="portfolio">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <ul id="portfolio-flters">
            <li onclick="location.href='galeri'">All</li>
            @foreach ($galeri_kategori as $kategori )    
            <li onclick="location.href='galeri?kategori={{$kategori->identifier}}'" style="cursor:pointer;">{{$kategori->name}}</li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

        @foreach ($galeri as $item)
        <div class="col-lg-3 col-md-6 portfolio-wrap">
          <div class="portfolio-item">
            <img src="{{ asset('assets/'. $item->thumbnail) }}" class="imgPort img-fluid" alt="">
            <div class="portfolio-info">
              <h3>{{ $item->kategori->name }}</h3>
              <div>
                <a href="{{ asset('assets/'. $item->thumbnail) }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>
                <a href="layanan?kategori={{$item->kategori->identifier}}"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="blog-pagination">
        <div class="d-flex justify-content-end">{{ $galeri->links() }}</div>
      </div>
    </div>
  </section><!-- End Portfolio Section -->


</x-front-layout>