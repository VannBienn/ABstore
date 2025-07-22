@extends('layouts.app')

@section('tieude', $sanPham->ten_san_pham)

@section('noidung')
<link rel="stylesheet" href="{{ asset('css/chitietsanpham.css') }}">
<div class="chitiet-container">
    <div class="anh-sanpham">
        <img src="{{ asset('uploads/' . $sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}">
        <div class="anh-phu">
            @if ($sanPham->anh_phu_1)
            <img src="{{ asset('uploads/' . $sanPham->anh_phu_1) }}" alt="">
            @endif
            @if ($sanPham->anh_phu_2)
            <img src="{{ asset('uploads/' . $sanPham->anh_phu_2) }}" alt="">
            @endif
            @if ($sanPham->anh_phu_3)
            <img src="{{ asset('uploads/' . $sanPham->anh_phu_3) }}" alt="">
            @endif
        </div>
    </div>

    <div class="noidung-sanpham">
        <h1>{{ $sanPham->ten_san_pham }}</h1>
        <p class="thuong-hieu">Thương hiệu: <span>{{ $sanPham->thuong_hieu ?? 'Chưa có thông tin' }}</span> | Tình trạng: <span class="{{ $sanPham->tinh_trang == 'còn hàng' ? 'con-hang' : 'het-hang' }}">{{ $sanPham->tinh_trang }}</span></p>

        <div class="gia-sanpham">
            @php
            $giaMoi = $sanPham->gia - ($sanPham->gia * $sanPham->khuyen_mai / 100);
            @endphp
            <span class="gia-moi">{{ number_format($giaMoi, 0, ',', '.') }}đ</span>
            @if ($sanPham->khuyen_mai > 0)
            <span class="gia-cu">{{ number_format($sanPham->gia, 0, ',', '.') }}đ</span>
            @endif
        </div>

        <div class="mota-sanpham">
            <strong>{{ $sanPham->ten_san_pham }}</strong> - {!! nl2br(e($sanPham->chi_tiet)) !!}
        </div>

        <div class="chon-so-luong">
            <label for="soluong">Số lượng:</label>
            <div class="so-luong-input">
                <button type="button" id="decrease">-</button>
                <input type="number" id="quantity" value="1" min="1">
                <button type="button" id="increase">+</button>
            </div>
        </div>

        <button class="nut-giohang" data-id="{{ $sanPham->id }}">Cho vào giỏ hàng</button>

        <p class="goi-dat">Gọi đặt mua: <span>19006750</span> để nhanh chóng đặt hàng</p>
    </div>
</div>

<!-- Sản phẩm liên quan -->
<div class="sanpham-lienquan">
    <h2>Sản phẩm liên quan</h2>
    <div class="ds-lienquan">
        @forelse ($sanPhamLienQuan as $sp)
        <a href="{{ route('sanpham.show', $sp->id) }}" class="item-lienquan">
            <img src="{{ asset('uploads/' . $sp->hinh_anh) }}" alt="{{ $sp->ten_san_pham }}">
            <h4>{{ $sp->ten_san_pham }}</h4>
            <p class="gia">{{ number_format($sp->gia, 0, ',', '.') }}đ</p>
        </a>
        @empty
        <p>Không có sản phẩm liên quan nào.</p>
        @endforelse
    </div>
</div>

<script>
    // Tăng giảm số lượng
    document.getElementById('increase').addEventListener('click', function() {
        var input = document.getElementById('quantity');
        input.value = parseInt(input.value) + 1;
    });

    document.getElementById('decrease').addEventListener('click', function() {
        var input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    });

    // Thêm giỏ hàng bằng Ajax
    document.querySelector('.nut-giohang').addEventListener('click', function() {
        var sanpham_id = this.getAttribute('data-id');
        var so_luong = document.getElementById('quantity').value;

        fetch("{{ route('giohang.them.ajax') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    sanpham_id: sanpham_id,
                    so_luong: so_luong
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert("Đã thêm vào giỏ hàng!");
                } else {
                    alert("Thêm vào giỏ thất bại!");
                }
            })
            .catch(err => {
                console.error(err);
                alert("Lỗi khi thêm sản phẩm vào giỏ.");
            });
    });
</script>
@endsection