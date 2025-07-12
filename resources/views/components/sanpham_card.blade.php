@php
$giaMoi = $sanPham->gia - ($sanPham->gia * $sanPham->khuyen_mai / 100);
@endphp

<div class="sanpham-card">
    <div class="img-wrapper">
        @if($sanPham->khuyen_mai > 0)
        <div class="giamgia-badge">-{{ $sanPham->khuyen_mai }}%</div>
        @endif
        <a href="{{ route('sanpham.show', $sanPham->id) }}">
            <img src="{{ $sanPham->hinh_anh ? asset('uploads/' . $sanPham->hinh_anh) : 'https://via.placeholder.com/300x300?text=No+Image' }}" alt="{{ $sanPham->ten_san_pham }}">
        </a>
    </div>
    <h3>{{ $sanPham->ten_san_pham }}</h3>

    <div class="gia">
        @if($sanPham->khuyen_mai > 0)
        <span class="gia-cu">{{ number_format($sanPham->gia, 0, ',', '.') }} đ</span>
        <span class="gia-moi">{{ number_format($giaMoi, 0, ',', '.') }} đ</span>
        @else
        <span class="gia-moi">{{ number_format($sanPham->gia, 0, ',', '.') }} đ</span>
        @endif
    </div>
    <div class="hover-links">
        <a href="{{ route('sanpham.show', $sanPham->id) }}" class="btn-detail">Xem chi tiết</a>
        <a href="javascript:void(0);" class="btn-quickview" data-id="{{ $sanPham->id }}">Xem nhanh</a>
    </div>
</div>