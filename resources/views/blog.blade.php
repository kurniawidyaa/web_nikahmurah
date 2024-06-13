<x-front-layout title="Blog">
  <!-- ======= Blog Section ======= -->
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
</section><!-- End Blog Section -->

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">

    <div class="row">

      <div class="col-lg-8 entries" style="border-radius: 16px;">
        @if ($posts->count() != null)
          @foreach ($posts as $post) 
          <article class="entry">

            <div class="entry-img">
              @if ($post->thumbnail != null)
                  <img src="{{ asset('assets/' . $post->thumbnail) }}" alt="" class="img-fluid">
              @else
                  <img src="https://source.unsplash.com/1000x500?" alt="" class="img-fluid">
              @endif
            </div>

            <h2 class="entry-title">
              <a href="">{{ $post->title }}</a>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="" value="{{ $post->author_id }}">{{$post->user->name}}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href=""><time>{{ $post->created_at->diffForHumans() }}</time></a></li>
                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="/blog?kategori={{$post->kategori->slug}}}">{{$post->kategori->name}}</a></li>
              </ul>
            </div>

            <div class="entry-content">
              <p>
                {{$post->excerpt}}
              </p>
              <div class="read-more">
                <a href="{{ route('post.show', $post->id) }}">Read More</a>
              </div>
            </div>

          </article><!-- End blog entry -->
          @endforeach
          <div class="blog-pagination">
            <div class="d-flex justify-content-end">{{ $posts->links() }}</div>
          </div>
        @else
        <h3 class="text-center mt-5">Posts Not Found.</h3>
        @endif


      </div><!-- End blog entries list -->

      <div class="col-lg-4">
        <div class="sidebar">
          <h3 class="sidebar-title">Search</h3>
          <div class="sidebar-item search-form">
            <form action="">
              @if (request('kategori') != null)
                  <input type="hidden" name="kategori" value="{{ request('kategori') }}">
              @endif
              <input type="text" name="search" value="{{ request('search') }}">
              <button type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div><!-- End sidebar search formn-->

          <h3 class="sidebar-title">Kategori</h3>
          <div class="sidebar-item categories">
            <ul>
              @foreach ($kategoris as $item)
              {{-- /blog?kategori={{ $item->slug }} --}}
              <li><a href="blog?kategori={{$item->slug}}">{{ $item->name}} <span></span></a></li>  
              @endforeach 
            </ul>
          </div><!-- End sidebar categories-->

          {{-- <h3 class="sidebar-title">Recent Posts</h3>
          <div class="sidebar-item recent-posts">
            <div class="post-item clearfix">
              <img src="/img/blog/blog-recent-1.jpg" alt="">
              <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
              <time datetime="2020-01-01">Jan 1, 2020</time>
            </div>

            <div class="post-item clearfix">
              <img src="/img/blog/blog-recent-2.jpg" alt="">
              <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
              <time datetime="2020-01-01">Jan 1, 2020</time>
            </div>

            <div class="post-item clearfix">
              <img src="/img/blog/blog-recent-3.jpg" alt="">
              <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
              <time datetime="2020-01-01">Jan 1, 2020</time>
            </div>

            <div class="post-item clearfix">
              <img src="/img/blog/blog-recent-4.jpg" alt="">
              <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
              <time datetime="2020-01-01">Jan 1, 2020</time>
            </div>

            <div class="post-item clearfix">
              <img src="/img/blog/blog-recent-5.jpg" alt="">
              <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
              <time datetime="2020-01-01">Jan 1, 2020</time>
            </div>

          </div><!-- End sidebar recent posts-->

          <h3 class="sidebar-title">Tags</h3>
          <div class="sidebar-item tags">
            <ul>
              <li><a href="#">App</a></li>
              <li><a href="#">IT</a></li>
              <li><a href="#">Business</a></li>
              <li><a href="#">Mac</a></li>
              <li><a href="#">Design</a></li>
              <li><a href="#">Office</a></li>
              <li><a href="#">Creative</a></li>
              <li><a href="#">Studio</a></li>
              <li><a href="#">Smart</a></li>
              <li><a href="#">Tips</a></li>
              <li><a href="#">Marketing</a></li>
            </ul>
          </div><!-- End sidebar tags--> --}}

        </div><!-- End sidebar -->

      </div><!-- End blog sidebar -->

    </div>
  </div>
</section><!-- End Blog Section -->
</x-front-layout>