@extends('layouts.app')

@section('noidung')
<div class="donhang-container">
    <h2>📦 Chi tiết đơn hàng #{{ $donHang->id }}</h2>
    <div class="order-info">
        <p><strong>🗓 Ngày đặt:</strong> {{ $donHang->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>📌 Trạng thái:</strong> {{ $donHang->trang_thai }}</p>
        <p><strong>📝 Ghi chú:</strong> {{ $donHang->ghi_chu ?? 'Không có' }}</p>
    </div>

    <h3>🛒 Danh sách sản phẩm:</h3>
    <div class="order-table-wrapper">
        <table class="order-table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donHang->chiTietDonHang as $item)
                    <tr>
                        <td class="product-name">
                            <span>{{ $item->sanPham->ten_san_pham }}</span>
                        </td>
                        <td>{{ number_format($item->don_gia) }}đ</td>
                        <td>{{ $item->so_luong }}</td>
                        <td>{{ number_format($item->don_gia * $item->so_luong) }}đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('profile.edit') }}" class="btn-back">⬅ Quay lại</a>
</div>
@endsection
