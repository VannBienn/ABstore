@extends('layouts.auth')

@section('noidung')
<div class="container">
    <h2>Đăng Ký</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Ký</button>
    </form>
    <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
</div>
@endsection
