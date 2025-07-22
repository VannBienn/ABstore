<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị - Biên Store</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @yield('css')
</head>

<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <h4>🛒 Biên Store</h4>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('danh-muc.index') }}" class="{{ request()->routeIs('danh-muc.*') ? 'active' : '' }}">📁 Quản lý Danh Mục</a></li>
                <li><a href="{{ route('admin.san-pham.index') }}" class="{{ request()->routeIs('admin.san-pham.*') ? 'active' : '' }}"> 🧴 Quản lý Sản Phẩm </a>  </li>
                <li><a href="{{ route('tin-tuc.index') }}" class="{{ request()->routeIs('tin-tuc.*') ? 'active' : '' }}">📰 Quản lý Tin Tức</a></li>
                <li><a href="{{ route('khachhang.index') }}" class="{{ request()->routeIs('khachhang.*') ? 'active' : '' }}">👤 Quản lý Khách Hàng</a></li>
                <li><a href="{{ route('admin.donhang.index') }}" class="{{ request()->routeIs('admin.donhang.*') ? 'active' : '' }}">📦 Quản lý Đơn Hàng</a></li>
            </ul>
            <div class="sidebar-bottom">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">🚪 Đăng xuất</button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <main class="admin-main">
            <header class="admin-header d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('trangchu') }}" class="btn btn-success">🏠 Về trang chủ</a>
            </header>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('js')
</body>

</html>