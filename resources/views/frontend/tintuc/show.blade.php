@extends('layouts.app')

@section('title', $tinTuc->tieu_de)

@section('noidung')
<section class="py-5">
    <div class="container">
        <h1 class="news-detail-title">{{ $tinTuc->tieu_de }}</h1>
        <img src="{{ asset('uploads/tintuc/' . $tinTuc->hinh_anh) }}"
             alt="{{ $tinTuc->tieu_de }}"
             class="news-detail-image">
        <div class="news-detail-content">
            {!! nl2br(e($tinTuc->noi_dung)) !!}
        </div>
        <a href="{{ route('tintuc.fe') }}" class="btn-back">← Quay lại danh sách</a>
    </div>
</section>
@endsection
