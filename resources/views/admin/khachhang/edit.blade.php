@extends('layouts.admin')
@section('tieude', 'Sửa khách hàng')
@section('content')
<div class="container mt-4">
    <h2>Sửa khách hàng</h2>
    <form action="{{ route('khachhang.update', $khachhang->id) }}" method="POST">@csrf @method('PUT')
        <div class="mb-3">
            <label>Tên</label><input type="text" name="name" value="{{ $khachhang->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label><input type="email" name="email" value="{{ $khachhang->email }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu mới (nếu muốn đổi)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Vai trò</label>
            <select name="role" class="form-control" required>
                <option value="">-- Chọn vai trò --</option>
                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('khachhang.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection