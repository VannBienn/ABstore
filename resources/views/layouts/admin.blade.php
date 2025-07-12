<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biên Store</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @yield('css')

</head>

<body>
    <div class="admin-container">
        <div class="sidebar">
            <ul>
                <li><a href="{{ route('danh-muc.index') }}">Quản Lý Danh Mục</a></li>
                <li><a href="{{ route('san-pham.index') }}">Quản Lý Sản Phẩm</a></li> 
                <li><a href="{{ route('tin-tuc.index') }}">Quản Lý Tin Tức</a></li>
                <li><a href="{{ route('khachhang.index') }}">Quản Lý Khách Hàng</a></li>
                <li><a href="">Quản Lý Đơn Hàng</a></li> 
            </ul>
        </div>

        <div class="main-content">
                    @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <a href="{{ route('trangchu') }}" class="go-home-btn">🏠 Về trang chủ</a>
            @yield('content')
 
        </div>
    </div>
<script src="{{ asset('js/app.js') }}"></script> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
@yield('js') 

</body>

</html>
