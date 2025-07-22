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
                <li><a href="{{ route('tintuc.fe') }}" class="{{ request()->is('tin-tuc*') ? 'active' : '' }}">Tin tức</a></li>
                <li><a href="{{ route('lienhe') }}" class="{{ request()->is('lien-he*') ? 'active' : '' }}">Liên hệ</a></li>
            </ul>
        </div>

        <div class="tienich">
            <!-- Tìm kiếm -->
            <div class="search-container">
                <a href="#" id="toggle-search"><i class="fas fa-search"></i></a>
                <form id="search-form" action="{{ route('sanpham.index') }}" method="GET" style="display: none;">
                    <input type="text" name="tu_khoa" placeholder="Tìm sản phẩm..." />
                    <button type="submit"><i class="fas fa-arrow-right"></i></button>
                </form>
            </div>

            @auth
            <div class="user-logged-in">
                <span>👋 Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
                <a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i></a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @else
            <div class="user-dropdown-container">
                <div class="user-icon">
                    <img src="{{ asset('images/user.png') }}" alt="user" style="width: 33px; height: 33px;" />
                </div>
                <div class="user-dropdown-menu">
                    <a href="{{ route('login') }}" class="btn-login">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn-register">Đăng ký</a>
                </div>
            </div>
            @endauth

            @php
            use App\Models\GioHang;

            $tongSoLuong = 0;

            if (Auth::check()) {
            $tongSoLuong = GioHang::where('user_id', Auth::id())->sum('so_luong');
            } else {
            $giohang = session('giohang', []);
            foreach ($giohang as $item) {
            $tongSoLuong += $item['so_luong'];
            }
            }
            @endphp
            <a href="{{ route('giohang.index') }}" class="giohang-icon">
                <img src="{{ asset('images/giohang.png') }}" alt="Giỏ hàng" style="width: 36px; height: 36px;">
                <span class="giohang-count">{{ $tongSoLuong }}</span>
            </a>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggle-search');
        const form = document.getElementById('search-form');

        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            form.style.display = form.style.display === 'none' ? 'flex' : 'none';
        });
    });
</script>
<script>
    function themVaoGioHang(sanPhamId) {
        fetch("{{ route('giohang.them.ajax') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    sanpham_id: sanPhamId,
                    so_luong: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cart-count').innerText = data.count;
                }
            });
    }
</script>