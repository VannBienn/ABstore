@extends('layouts.app')

@section('noidung')

<div class="cart-page">
    <h2 class="cart-title">Giỏ hàng của bạn
        <span class="count">({{ count($giohang) }} sản phẩm)</span>
    </h2>

    @if (count($giohang) === 0)
    <p class="cart-empty">Giỏ hàng hiện đang trống.</p>
    @else
    <div class="cart-content">
        <div class="cart-items">
            <div class="cart-header">
                <span>Sản phẩm</span>
                <span>Giá</span>
                <span>Số lượng</span>
                <span>Thành tiền</span>
            </div>

            @php $tongTien = 0; @endphp
            @foreach ($giohang as $sp)
            @php
            $giaApDung = $sp->gia_khuyen_mai > 0 ? $sp->gia_khuyen_mai : $sp->gia;
            $thanhTien = $giaApDung * $sp->so_luong;
            $tongTien += $thanhTien;
            @endphp
            <div class="cart-item" data-id="{{ $sp->san_pham_id }}" data-price="{{ $giaApDung }}">
                <div class="item-info">
                    <img src="{{ asset('uploads/' . $sp->hinh_anh) }}" alt="{{ $sp->ten_san_pham }}">
                    <div class="details">
                        <p class="name">{{ $sp->ten_san_pham }}</p>
                        <a href="{{ route('giohang.xoa', $sp->san_pham_id) }}" class="remove">🗑️ Xóa sản phẩm</a>
                    </div>
                </div>
                <div class="item-price">{{ number_format($giaApDung, 0, ',', '.') }}₫</div>
                <div class="item-qty">
                    <div class="qty-controls">
                        <button class="qty-btn minus">−</button>
                        <input type="text" value="{{ $sp->so_luong }}" class="qty-input" readonly>
                        <button class="qty-btn plus">+</button>
                    </div>
                </div>
                <div class="item-total">{{ number_format($thanhTien, 0, ',', '.') }}₫</div>
            </div>
            @endforeach


            <a href="{{ route('trangchu') }}" class="continue-shopping">← Tiếp tục mua hàng</a>
        </div>

        <div class="cart-summary">
            <p class="subtotal">
                Tạm tính: <strong id="subtotal">{{ number_format($tongTien, 0, ',', '.') }}₫</strong>
            </p>
            <p class="total">
                Thành tiền: <strong class="highlight" id="total">{{ number_format($tongTien, 0, ',', '.') }}₫</strong>
            </p>
            <a href="{{ route('donhang.form') }}" class="checkout-btn">Tiến hành thanh toán</a>

        </div>
    </div>
    @endif
</div>

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const formatMoney = (number) => {
            return number.toLocaleString('vi-VN') + '₫';
        };

        function updateTotals() {
            let total = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const qty = parseInt(item.querySelector('.qty-input').value);
                const price = parseInt(item.dataset.price);
                const itemTotal = price * qty;
                item.querySelector('.item-total').textContent = formatMoney(itemTotal);
                total += itemTotal;
            });

            document.getElementById('subtotal').textContent = formatMoney(total);
            document.getElementById('total').textContent = formatMoney(total);
        }

        document.querySelectorAll(".cart-item").forEach(item => {
            const minusBtn = item.querySelector(".qty-btn.minus");
            const plusBtn = item.querySelector(".qty-btn.plus");
            const qtyInput = item.querySelector(".qty-input");

            minusBtn.addEventListener("click", () => {
                let value = parseInt(qtyInput.value);
                if (value > 1) {
                    qtyInput.value = value - 1;
                    updateTotals();
                }
            });

            plusBtn.addEventListener("click", () => {
                let value = parseInt(qtyInput.value);
                if (value < 99) {
                    qtyInput.value = value + 1;
                    updateTotals();
                }
            });
        });
    });
</script>