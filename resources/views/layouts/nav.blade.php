<nav class="main-sidebar ps-menu">
    <!-- <div class="sidebar-toggle action-toggle">
        <a href="#">
            <i class="fas fa-bars"></i>
        </a>
    </div> -->
    <!-- <div class="sidebar-opener action-toggle">
        <a href="#">
            <i class="ti-angle-right"></i>
        </a>
    </div> -->
    <div class="sidebar-header">
        <div class="text">Nikah Murah Tangerang</div>
        {{-- <div class="text"><img src="" alt=""></div> --}}
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="{{ request()->segment(1) == 'dashboard' ? 'active' : ''}}">
                <a href="{{ route('dashboard') }}" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->segment(1) == 'home' ? 'active' : ''}}">
                <a href="{{ route('home') }}" class="link">
                    <i class="ti-home"></i>
                    <span>Home</span>
                </a>
            </li>
            {{-- <li class="menu-category">
                <span class="text-uppercase">Menu</span>
            </li> --}}
            {{-- @can('read konfigurasi')
            <li class="{{ request()->segment(1) == 'konfigurasi' ? 'active open' : ''}}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-desktop"></i>
                    <span>Konfigurasi</span>
                </a>
                <ul class="sub-menu {{ request()->segment(1) == 'dashboard' ? 'expand' : ''}}">
                    @can('read role')
                    <li class="{{ request()->segment(1) == 'dashboard' && request()->segment(2) == 'roles' ? 'active' : ''}}"><a href="{{ route('roles.index') }}" class="link"><span>Role</span></a></li>
                    @endcan
                </ul>
            </li>  
            @endcan --}}
            @foreach (getMenus() as $menu)
                {{-- @can('read '.$menu->url) --}}
                    <li class="{{ request()->segment(1) == $menu->url ? 'active open' : ''}}">
                        <a href="{{ url($menu->url) }}" class="main-menu has-dropdown">
                            <i class="{{ $menu->icon }}"></i>
                            <span>{{ $menu->name }}</span>
                        </a>
                        @if (isset($menu->subMenus) && $menu->subMenus->isNotEmpty())
                        <ul class="sub-menu {{ request()->segment(1) == $menu->url ? 'expand' : ''}}">
                            @foreach ($menu->subMenus as $submenu)
                                {{-- @can('read '.$submenu->url) --}}
                                    {{-- <li class="{{ request()->segment(1) == explode('/', $submenu->url)[0] && request()->segment(2) == explode('/', $submenu->url)[1] ? 'active' : ''}}"><a href="{{ url($submenu->url) }}" class="link"><span>{{ $submenu->name }}</span></a></li> --}}
                                    <li class="{{ request()->is($submenu->url) ? 'active' : ''}}"><a href="{{ url($submenu->url) }}" class="link"><span>{{ $submenu->name }}</span></a></li>
                                {{-- @endcan --}}
                            @endforeach
                        </ul>
                        @endif
                    </li>
                {{-- @endcan --}}
            @endforeach
        </ul>
    </div>
</nav>  