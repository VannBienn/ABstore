@extends('layouts.app')

@section('tieude', $tinTuc->tieu_de)

@section('noidung')
<div class="tintuc-wrapper">
    <div class="container">
        <h1 class="tieude-chinh">{{ $tinTuc->tieu_de }}</h1>

        <div class="hinhanh-tintuc">
            @if($tinTuc->hinh_anh)
                <img src="{{ asset('uploads/tintuc/' . $tinTuc->hinh_anh) }}" alt="{{ $tinTuc->tieu_de }}">
            @else
                <img src="https://via.placeholder.com/800x400?text=No+Image" alt="Không có hình">
            @endif
        </div>

        <p class="ngaydang">Ngày đăng: {{ \Carbon\Carbon::parse($tinTuc->ngay_dang)->format('d/m/Y') }}</p>
        <div class="noidung-tintuc">
            <p>{!! $tinTuc->noi_dung !!}</p>
        </div>
    </div>
</div>
@endsection
