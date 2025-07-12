@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/tintuc/create.css') }}">

<div class="form-container">
    <h2>Thêm tin tức mới</h2>

    <form action="{{ route('tin-tuc.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Tiêu đề:</label>
        <input type="text" name="tieu_de" required>

        <label>Mô tả ngắn:</label>
        <textarea name="mo_ta_ngan"></textarea>

        <label>Nội dung:</label>
        <textarea name="noi_dung"></textarea>

        <label>Ngày đăng:</label>
        <input type="date" name="ngay_dang" required>

        <label>Hình ảnh:</label>
        <input type="file" name="hinh_anh">

        <button type="submit">Lưu tin</button>
    </form>
</div>
@endsection
