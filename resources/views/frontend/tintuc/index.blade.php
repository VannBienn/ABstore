@extends('layouts.app')

@section('title', 'Tin tức mỹ phẩm')

@section('noidung')
<section class="py-5">
    <div class="container">
        <h2 class="text-center news-detail-title">Tin Tức Mỹ Phẩm</h2>
        <div class="news-list mt-5">
            @foreach ($dsTinTuc as $tin)
                <div class="news-card">
                    <img src="{{ asset('uploads/tintuc/' . $tin->hinh_anh) }}" alt="{{ $tin->tieu_de }}">
                    <div class="news-card-body">
                        <h3>{{ $tin->tieu_de }}</h3>
                        <p class="news-date">{{ \Carbon\Carbon::parse($tin->ngay_dang)->format('d/m/Y') }}</p>
                        <p>{{ Str::limit($tin->mo_ta_ngan, 100) }}</p>
                        <a href="{{ route('tintuc.fe.show', $tin->id) }}" class="btn-read mt-3">Xem chi tiết</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection