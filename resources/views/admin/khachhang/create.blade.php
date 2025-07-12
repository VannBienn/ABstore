@extends('layouts.admin')
@section('tieude', 'Thêm khách hàng')
@section('content')
<div class="container mt-4">
    <h2>Thêm khách hàng</h2>
    <form action="{{ route('khachhang.store') }}" method="POST">@csrf
        <div class="mb-3">
            <label>Tên</label><input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label><input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mật khẩu</label><input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Vai trò</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user">Người dùng</option>
                <option value="admin">Quản trị viên</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="{{ route('khachhang.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection