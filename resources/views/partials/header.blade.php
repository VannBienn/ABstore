<div class="phandautrang">
    <div class="container">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Trang chủ</a></li>
                <li><a href="{{ route('sanpham.fe') }}" class="{{ request()->is('san-pham*') ? 'active' : '' }}">Sản phẩm</a></li>
                <li><a href="{{ route('tintuc') }}" class="{{ request()->is('tin-tuc*') ? 'active' : '' }}">Tin tức</a></li>
                <li><a href="{{ route('lienhe') }}" class="{{ request()->is('lien-he*') ? 'active' : '' }}">Liên hệ</a></li>
            </ul>
        </div>
        <div class="tienich">
            <a href="#"><i class="fas fa-search"></i></a>
            @auth
            <span style="margin-right: 10px; color: #fff;">👋 Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
            <a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i></a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @else
            <a href="{{ route('login') }}"><i class="fas fa-user"></i> Đăng nhập</a>
            <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Đăng ký</a>
            @endauth

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <a href="{{ route('giohang.index') }}">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </div>
    </div>
</div>
