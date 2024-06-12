     <!-- ======= Header ======= -->
     <header id="header" class="fixed-top d-flex align-items-center ">
        <div class="container d-flex justify-content-between align-items-center">
    
          <div class="logo">
            {{-- <h1 class="text-light"><a href="index.html"><span>Moderna</span></a></h1> --}}
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="{{ route('home') }}"><img src="{{ asset('storage/images/logo.jpg') }}" alt="" class="img-fluid"></a>
          </div>
    
          <nav id="navbar" class="navbar">
            <ul>
              @foreach ($navbar as $name => $url)
              <li><a href={{ $url }}>{{ $name }}</a></li>
              @endforeach
              <li><a href="{{ route('cart.index') }}"><i class="bi bi-cart2" style="font-size: 20px"></i></a></li>
              {{-- login untuk user --}}
              @auth
              <li class="dropdown"><a href=""><span>Welcome, {{ Auth::user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  @if (Auth::user()->hasRole(['owner', 'admin']))
                    <li><a href="{{ route('dashboard')}}">Dashboard</a></li>
                  @endif
                  <li><a href="{{ route('order.index')}}">Riwayat Pesanan</a></li>
                  <form action="{{ route('logout') }}" method="POST" id="logout-form">
                  <li>
                      @csrf
                      <a :href="route('logout')"
                      onclick="event.preventDefault();
                                  this.closest('form').submit();">{{ __('Log Out') }}</a>
                  </li>
                </form>
                </ul>
              </li>
              @else   
              <li><a href="{{route('login')}}"><i class="bi bi-box-arrow-in-right" style="font-size:18px"></i>&nbsp; Login</a></li> 
              @endauth
            </ul> 
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
    
        </div>
    </header>
      <!-- End Header -->
    

      {{-- 
        bedanya agar transparant :
        ditambahkan didalam class -> header-transparent
        --}}