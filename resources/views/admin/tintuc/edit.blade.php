@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tintuc/edit.css') }}">

<div class="form-container">
    <h2>Sửa tin tức</h2>

    <form action="{{ route('tin-tuc.update', $tinTuc->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Tiêu đề:</label>
        <input type="text" name="tieu_de" value="{{ $tinTuc->tieu_de }}" required>

        <label>Mô tả ngắn:</label>
        <textarea name="mo_ta_ngan">{{ $tinTuc->mo_ta_ngan }}</textarea>

        <label>Nội dung:</label>
        <textarea name="noi_dung">{{ $tinTuc->noi_dung }}</textarea>

        <label>Ngày đăng:</label>
        <input type="date" name="ngay_dang" value="{{ $tinTuc->ngay_dang }}" required>

        <label>Hình ảnh hiện tại:</label>
        <img src="{{ asset('uploads/tintuc/' . $tinTuc->hinh_anh) }}" height="80"><br>

        <label>Thay đổi hình ảnh:</label>
        <input type="file" name="hinh_anh">

        <button type="submit">Cập nhật</button>
    </form>
</div>
@endsection
