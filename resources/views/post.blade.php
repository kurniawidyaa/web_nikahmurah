<x-front-layout title="Artikel">
      <!-- ======= Blog Section ======= -->
      <section class="breadcrumbs">
        <div class="container">
  
          <div class="d-flex justify-content-between align-items-center">
            <h2>Blog</h2>
  
            <ol>
              <li><a href="">Home</a></li>
              <li><a href="">Blog</a></li>
              <li>{{ $post->title }}</li>
            </ol>
          </div>
  
        </div>
    </section><!-- End Blog Section -->
  
      <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
  
          <div class="row">
  
            <div class="col-lg-8 entries">
  
              <article class="entry entry-single">
  
                <div class="entry-img">
                  <img src="{{  asset('assets/'. $post->thumbnail) }}" alt="" class="img-fluid">
                </div>
  
                <h2 class="entry-title">
                  <a href="">{{$post->title}}</a>
                </h2>
  
                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i><a href="blog?author={{$post->user->name}}">{{ $post->user->name }}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i><a href=""><time>{{ $post->created_at->diffForHumans()}}</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog?kategori={{$post->kategori->slug}}">{{ $post->kategori->name }}</a></li>
                  </ul>
                </div>
  
                <div class="entry-content">
                  <p>
                    {!! $post->body !!}
                  </p>
                </div>
  
                <div class="entry-footer">
                  <i class="bi bi-tags"></i>
                  <ul class="tags">
                    <li><a href="#">{{ $post->kategori->name }}</a></li>
                  </ul>
                </div>
  
              </article><!-- End blog entry -->   
            </div><!-- End blog entries list -->
  
            <div class="col-lg-4">
  
              <div class="sidebar">
  
                <h3 class="sidebar-title">Search</h3>
                <div class="sidebar-item search-form">
                  <form action="">
                    <input type="text">
                    <button type="submit"><i class="bi bi-search"></i></button>
                  </form>
                </div><!-- End sidebar search formn-->
  
                <h3 class="sidebar-title">Categories</h3>
                <div class="sidebar-item categories">
                  <ul>
                      @foreach ($kategori as $cat)
                      <li><a name="select" href="#">{{ $cat->name }} <span>({{ $cat->count() }})</span></a></li>
                      @endforeach
                    {{-- <li><a href="#">Educaion <span>(14)</span></a></li> --}}
                  </ul>
                </div><!-- End sidebar categories-->
  
              </div><!-- End sidebar -->
  
            </div><!-- End blog sidebar -->
  
          </div>
  
        </div>
    </section><!-- End Blog Single Section -->
</x-front-layout>