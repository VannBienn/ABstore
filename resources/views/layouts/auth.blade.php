<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('tieude', 'Đăng nhập')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS riêng cho trang đăng nhập -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @yield('css')
</head>
<body>
    <main>
        @yield('noidung')
    </main>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
