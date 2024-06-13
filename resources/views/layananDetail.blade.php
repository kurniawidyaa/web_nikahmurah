<x-front-layout title="Layanan Detail">
      <!-- ======= Our Portfolio Section ======= -->
      <section class="breadcrumbs">
        <div class="container">
  
          <div class="d-flex justify-content-between align-items-center">
            <h2></h2>
            <ol>
              <li><a href="">Home</a></li>
              <li><a>Layanan</a></li>
              <li></li>
            </ol>
          </div>
  
        </div>
      </section><!-- End Our Portfolio Section -->
  
      <!-- ======= Portfolio Details Section ======= -->
      <section id="portfolio-details" class="portfolio-details">
        <div class="container">
  
          <div class="row gy-4">
            <div class="col-lg-6">
              <div class="portfolio-details">
                <div class="align-items-center">   
                  <div class="">
                    @if ($layanan->thumbnail != null)
                    <img src="{{ asset('assets/' . $layanan->thumbnail) }}"> 
                    @else
                    <img src="https://source.unsplash.com/500x300?{{ $layanan->name }}" class="card-img-top">
                    @endif
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
  
            <div class="col-lg-6">
              <div class="portfolio-info">
                <h2>{{ $layanan->name }}</h2>
                <p class="price">@currency($layanan->price)</p>
                <ul>
                  <div class="serv-note">
                    <p>{{ $layanan->note }}</p>
                  </div>
                  {{-- <li> --}}
                    {{-- yang dikirim ke orderDetails --}}
                  <form action="{{ route('cart_item.store') }}" method="POST" name="order">
                      @csrf
                    {{-- <input type="text" name="qyt" class="form-control"></li> --}}
                </ul>
  
                    <div style="text-align:center;">  
                      <input type="hidden" name="layanan_id" value={{ $layanan->id }}> 
                      <button type="submit" class="btn btn-primary"><i class="bi bi-cart2" style="font-size: 20px"></i>&nbsp;{{ $submit }}</button>
                    </div>
                  </form>
              {{-- keterangan pesanan --}}
              <div class="detail-items">
                <table>
                  <tr>
                    <th><h5>Keterangan Paket :</h6></th>
                  </tr>
                  <tr>
                    <td><p>{!! $layanan->description !!}</p></td>
                  </tr>
                </table>
              </div>
            </div>
            </div> 
          </div>
  
        </div>
      </section><!-- End Portfolio Details Section -->
</x-front-layout>