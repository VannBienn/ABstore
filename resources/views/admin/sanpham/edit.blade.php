@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<h2>Sửa Sản Phẩm</h2>
<form class="form-container" action="{{ route('admin.san-pham.update', $sanPham->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Tên sản phẩm -->
    <label for="ten_san_pham">Tên sản phẩm:</label>
    <input type="text" name="ten_san_pham" value="{{ $sanPham->ten_san_pham }}" required>

    <!-- Chi tiết sản phẩm -->
    <label for="chi_tiet">Chi tiết:</label>
    <textarea name="chi_tiet">{{ $sanPham->chi_tiet }}</textarea>

    <!-- Giá -->
    <label for="gia">Giá:</label>
    <input type="number" name="gia" value="{{ $sanPham->gia }}" required>

    <!-- Danh mục -->
    <label for="danh_muc_id">Danh mục:</label>
    <select name="danh_muc_id" required>
        @foreach($danhMucs as $danhMuc)
            <option value="{{ $danhMuc->id }}" {{ $sanPham->danh_muc_id == $danhMuc->id ? 'selected' : '' }}>
                {{ $danhMuc->ten_danh_muc }}
            </option>
        @endforeach
    </select>

    <!-- Ảnh chính (nếu muốn thay đổi) -->
    <label for="hinh_anh">Ảnh chính (nếu muốn thay):</label>
    <input type="file" name="hinh_anh">

    @if($sanPham->hinh_anh)
        <div class="current-image">
            <label>Ảnh hiện tại:</label>
            <img src="{{ asset('uploads/' . $sanPham->hinh_anh) }}" alt="Ảnh hiện tại" width="100">
        </div>
    @endif

    <!-- Ảnh phụ 1 -->
    <label for="anh_phu_1">Ảnh phụ 1 (nếu muốn thay):</label>
    <input type="file" name="anh_phu_1">
    @if($sanPham->anh_phu_1)
        <div class="current-image">
            <label>Ảnh phụ 1 hiện tại:</label>
            <img src="{{ asset('uploads/' . $sanPham->anh_phu_1) }}" alt="Ảnh phụ 1" width="100">
        </div>
    @endif

    <!-- Ảnh phụ 2 -->
    <label for="anh_phu_2">Ảnh phụ 2 (nếu muốn thay):</label>
    <input type="file" name="anh_phu_2">
    @if($sanPham->anh_phu_2)
        <div class="current-image">
            <label>Ảnh phụ 2 hiện tại:</label>
            <img src="{{ asset('uploads/' . $sanPham->anh_phu_2) }}" alt="Ảnh phụ 2" width="100">
        </div>
    @endif

    <!-- Ảnh phụ 3 -->
    <label for="anh_phu_3">Ảnh phụ 3 (nếu muốn thay):</label>
    <input type="file" name="anh_phu_3">
    @if($sanPham->anh_phu_3)
        <div class="current-image">
            <label>Ảnh phụ 3 hiện tại:</label>
            <img src="{{ asset('uploads/' . $sanPham->anh_phu_3) }}" alt="Ảnh phụ 3" width="100">
        </div>
    @endif

    <!-- Tình trạng -->
    <label for="tinh_trang">Tình trạng:</label>
    <select name="tinh_trang" required>
        <option value="còn hàng" {{ $sanPham->tinh_trang == 'còn hàng' ? 'selected' : '' }}>Còn hàng</option>
        <option value="hết hàng" {{ $sanPham->tinh_trang == 'hết hàng' ? 'selected' : '' }}>Hết hàng</option>
    </select>

    <!-- Nổi bật -->
    <label for="noi_bat">Nổi bật:</label>
    <select name="noi_bat" required>
        <option value="0" {{ $sanPham->noi_bat == 0 ? 'selected' : '' }}>Không</option>
        <option value="1" {{ $sanPham->noi_bat == 1 ? 'selected' : '' }}>Có</option>
    </select>

    <!-- Khuyến mãi -->
    <label for="khuyen_mai">Khuyến mãi (%)</label>
    <input type="number" name="khuyen_mai" value="{{ $sanPham->khuyen_mai }}" min="0" max="100">

    <button type="submit">Cập nhật</button>
</form>
@endsection
