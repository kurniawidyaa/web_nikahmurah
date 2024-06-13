<x-front-layout>
  @push('css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  @endpush
  
   <!-- ======= Hero Section ======= -->
   <section id="hero" class="d-flex justify-cntent-center align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Nikah Murah Tangerang</span></h2>
          {{-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a> --}}
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Nikah Murah Tangerang</h2>
          <p class="animate__animated animate__fadeInUp">Merupakan vendor wedding organizer yang berlokasi wilayah cipondoh kota tangerang, banten. Kami berdiri sejak tahun 2020.</p>
          {{-- <a href="" class="btn-get-started animate__animated animate__fadeInUp">Read More</a> --}}
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->
   <!-- ======= Why Us Section ======= -->
   <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
     <div class="container" style="padding: 3rem 2rem 3rem 2rem; border-radius:20px;">
       <div class="about-us">
         <h1 class="title">Tentang Kami</h1>
         <div class="about-us-content">
             <article class="text">
                 <p>Nikah Murah Tangerang adalah pilihan tepat bagi pasangan yang menginginkan pernikahan impian tanpa menguras kantong. Dengan sentuhan indah dan penuh perhatian, kami menyediakan layanan terbaik yang memenuhi setiap kebutuhan pernikahan Anda. Dari pemilihan venue yang menakjubkan hingga dekorasi yang memukau, kami hadir untuk mengubah impian pernikahan Anda menjadi kenyataan yang indah. Bergabunglah dengan kami dan nikmati perjalanan menuju kebahagiaan tanpa stres finansial yang berlebihan.</p>
             </article>
             <aside class="video">
                 <div class="">
                     <div class="item-1"></div>
                     <div class="item-2"></div>
                 </div>
                 <div id="cover-video"></div>
                 <button class="play-btn"><i class="fa-solid fa-play fa-3x"></i></button>
             </aside>
         </div>
       </div>
     </div>
   </section><!-- End Why Us Section -->

   <!-- ======= Features Section ======= -->
   <section class="features">
     <div class="container">

       <div class="row" data-aos="fade-up">
         <div class="gallery">
           <h1 class="title">Galeri</h1>
           <div class="gallery-box">
               <div class="gallerybox-1">
                   <div class="gallerybox-row-1">
                       <img src="{{ asset('assets/images/galeri/mua.jpg') }}" alt="">
                   </div>
                   <div class="gallerybox-row-1 column">
                       <div class="gallerybox-column-2">
                           <img src="{{ asset('assets/images/galeri/4.jpeg') }}" alt="">
                       </div>
                       <div class="gallerybox-column-2">
                           <img src="{{ asset('assets/images/galeri/mua-2.jpg') }}" alt="">
                       </div>
                   </div>
               </div>
               <div class="gallerybox-1 column">
                   <div class="gallerybox-column-1" style="flex-direction: row;">
                       <div class="gallerybox-row-2">
                           <img src="{{ asset('assets/images/galeri/pelaminan-2.jpg') }}" alt="">
                       </div>
                       <div class="gallerybox-row-2" style="margin: 0;">
                         <img src="{{ asset('assets/images/galeri/photobooth-1.jpg') }}" alt=""></div>
                       </div>
                   <div class="gallerybox-column-1">
                       <img src="{{ asset('assets/images/galeri/pelaminan.jpg') }}" alt="">
                   </div>
               </div>
               <div class="gallerybox-1">
                   <div class="gallerybox-row-1">
                       <div class="gallerybox-column-2">
                           <img src="{{ asset('assets/images/galeri/wed-2.jpg') }}" alt="">
                       </div>
                       <div class="gallerybox-column-2">
                           <img src="{{ asset('assets/images/galeri/wed-3.jpg') }}" alt="">
                       </div>
                   </div>
                   <div class="gallerybox-row-1">
                       <img src="{{ asset('assets/images/galeri/wed-1.jpg') }}" alt="">
                   </div>
               </div>
           </div>
       </div>
       </div>

       {{-- <div class="row" data-aos="fade-up"> --}}
         <!-- Swiper -->
 <div class="service">
   <h1 class="title">Layanan</h1>
   <div class="swiper mySwiper">
       <div class="swiper-wrapper">
         @if ($layanan->count())
             @foreach ($layanan as $layanan)
             <div class="swiper-slide">
               <div class="box">
                 @if ($layanan->thumbnail)
                     <img src="{{ asset('assets/'.$layanan->thumbnail) }}">
                     {{-- alt="{{ $serv->ServiceCategory->name }}/img/galeri/mua.jpg" --}}
                 @else
                     <img src="https://source.unsplash.com/500x300?{{ $layanan->name }}" alt="{{ $layanan->name }}">
                 @endif
                 <a class="" href="{{ route('layanan.detail', $layanan->identifier) }}">{{ $layanan->name }}</a>
               </div>
             </div>
             @endforeach
         @endif
       </div>
       <div class="swiper-pagination"></div>
     </div>
 </div>
       {{-- </div> --}}

<!-- ======= Tetstimonials Section ======= -->
<section class="testimonials" data-aos="fade-up">
  {{-- <div class="container"> --}}

    <div class="section-title">
      <h1 class="title">Testimonial</h1>
      {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
    </div> --}}

    <div class="testimonials-carousel swiper">
      <div class="swiper-wrapper">
        @foreach ($testimoni as $testi)
        <div class="testimonial-item swiper-slide justify-content-center" style="display: flex">
          <img src="{{ asset('assets/images/testimoni/'.$testi->thumbnail) }}" class="testimoni-img" alt="">
          {{-- <h3>Saul Goodman</h3>
          <h4>Ceo &amp; Founder</h4> --}}
          {{-- <p>
            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
            Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
          </p> --}}
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
    </div>

  </div>
</section><!-- End Ttstimonials Section -->


  @push('js')
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  @endpush
</x-front-layout>