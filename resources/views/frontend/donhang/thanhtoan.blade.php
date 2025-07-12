@extends('layouts.app')

@section('noidung')
<div class="checkout-container">
    <h2 class="checkout-title">Thanh toán đơn hàng</h2>

    <form action="{{ route('donhang.dat') }}" method="POST" class="checkout-form">
        @csrf

        <div class="form-section">
            <h3>Thông tin khách hàng</h3>
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" id="name" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ giao hàng:</label>
                <textarea id="address" name="dia_chi" rows="3" placeholder="Nhập địa chỉ cụ thể" required></textarea>
            </div>

            <div class="form-group">
                <label for="note">Ghi chú (nếu có):</label>
                <textarea id="note" name="ghi_chu" rows="2" placeholder="Ghi chú thêm..."></textarea>
            </div>
        </div>

        <div class="order-summary">
            <h3>Đơn hàng của bạn</h3>
            <ul class="order-items">
                @php $tongTien = 0; @endphp
                @foreach ($giohang as $sp)
                    @php
                        $gia = $sp->gia_khuyen_mai ?? $sp->gia;
                        $thanhTien = $gia * $sp->so_luong;
                        $tongTien += $thanhTien;
                    @endphp
                    <li>
                        <span>{{ $sp->ten_san_pham }} x {{ $sp->so_luong }}</span>
                        <span>{{ number_format($thanhTien, 0, ',', '.') }}₫</span>
                    </li>
                @endforeach
            </ul>
            <p class="total">Tổng cộng: <strong>{{ number_format($tongTien, 0, ',', '.') }}₫</strong></p>

            <button type="submit" class="btn-order">Xác nhận đặt hàng</button>
        </div>
    </form>
</div>
@endsection
