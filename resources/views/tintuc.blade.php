@extends('layouts.app')

@section('tieude', 'Tin tức')

@section('noidung')
<div class="tintuc-wrapper">
    <div class="container">
        <div class="duongdan">
            <a href="{{ url('/') }}">Trang chủ</a> &raquo; <span>Tin tức</span>
        </div>
        <h1 class="tieude-chinh">Tin Tức</h1>
        <div class="ds-tintuc">
            @foreach ($tinTuc as $tin)
            <div class="item-tintuc">
                <a href="{{ route('tin-tuc.show', $tin->id) }}">
                    <div class="hinhanh-tintuc">
                        @if($tin->hinh_anh)
                        <img src="{{ asset('uploads/tintuc/' . $tin->hinh_anh) }}" alt="{{ $tin->tieu_de }}">
                        @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" alt="Không có hình">
                        @endif
                    </div>
                    <div class="noidung-tintuc">
                        <h3>{{ $tin->tieu_de }}</h3>
                        <p class="ngaydang">Ngày đăng: {{ \Carbon\Carbon::parse($tin->ngay_dang)->format('d/m/Y') }}</p>
                        <p class="mota">{{ $tin->mo_ta_ngan }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection