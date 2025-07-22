@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin_donhang.css') }}">

<div class="order-container">
    <h2>🧾 Đơn hàng #{{ $donHang->id }}</h2>
     <a href="{{ route('admin.donhang.index') }}" class="btn btn-outline-primary mb-4">← Danh sách đơn hàng</a>
    <div class="order-info">
        <p><strong>👤 Khách hàng:</strong> {{ $donHang->user->name ?? 'Không rõ' }}</p>
        <p><strong>📍 Địa chỉ:</strong> {{ $donHang->dia_chi }}</p>
        <p><strong>📝 Ghi chú:</strong> {{ $donHang->ghi_chu }}</p>
        <p><strong>🚚 Trạng thái:</strong> <span class="status-badge {{ Str::slug($donHang->trang_thai) }}">{{ $donHang->trang_thai }}</span></p>
    </div>

    <form action="{{ route('admin.donhang.updateTrangThai', $donHang->id) }}" method="POST" class="status-form">
        @csrf
        <select name="trang_thai">
            <option value="chờ xử lý" {{ $donHang->trang_thai == 'chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
            <option value="đang giao" {{ $donHang->trang_thai == 'đang giao' ? 'selected' : '' }}>Đang giao</option>
            <option value="hoàn tất" {{ $donHang->trang_thai == 'hoàn tất' ? 'selected' : '' }}>Hoàn tất</option>
            <option value="đã huỷ" {{ $donHang->trang_thai == 'đã huỷ' ? 'selected' : '' }}>Đã huỷ</option>
        </select>
        <button type="submit">✔ Cập nhật</button>
    </form>

    <h3>📦 Chi tiết đơn hàng</h3>
    <table class="order-table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donHang->chiTietDonHang as $ct)
            <tr>
                <td>{{ $ct->sanPham->ten_san_pham ?? '[Đã xoá]' }}</td>
                <td>{{ $ct->so_luong }}</td>
                <td>{{ number_format($ct->don_gia) }} đ</td>
                <td>{{ number_format($ct->so_luong * $ct->don_gia) }} đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
