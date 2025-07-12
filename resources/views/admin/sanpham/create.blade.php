@extends('layouts.admin')

@section('content')
<div class="form-container">
    <h2>Thêm Sản Phẩm</h2>

    <form action="{{ route('san-pham.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tên sản phẩm -->
        <div class="form-group">
            <label for="ten_san_pham">Tên Sản Phẩm</label>
            <input type="text" name="ten_san_pham" id="ten_san_pham" value="{{ old('ten_san_pham') }}" required>
            @error('ten_san_pham')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Chi tiết -->
        <div class="form-group">
            <label for="chi_tiet">Chi Tiết</label>
            <textarea name="chi_tiet" id="chi_tiet">{{ old('chi_tiet') }}</textarea>
        </div>

        <!-- Giá -->
        <div class="form-group">
            <label for="gia">Giá</label>
            <input type="number" name="gia" id="gia" value="{{ old('gia') }}" required>
            @error('gia')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Hình ảnh chính -->
        <div class="form-group">
            <label for="hinh_anh">Hình Ảnh Chính</label>
            <input type="file" name="hinh_anh" id="hinh_anh">
            @error('hinh_anh')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Ảnh phụ -->
        <div class="form-group">
            <label for="anh_phu_1">Ảnh Phụ 1</label>
            <input type="file" name="anh_phu_1" id="anh_phu_1">
        </div>

        <div class="form-group">
            <label for="anh_phu_2">Ảnh Phụ 2</label>
            <input type="file" name="anh_phu_2" id="anh_phu_2">
        </div>

        <div class="form-group">
            <label for="anh_phu_3">Ảnh Phụ 3</label>
            <input type="file" name="anh_phu_3" id="anh_phu_3">
        </div>

        <!-- Danh mục -->
        <div class="form-group">
            <label for="danh_muc_id">Danh Mục</label>
            <select name="danh_muc_id" id="danh_muc_id" required>
                @foreach($danhMucs as $danhMuc)
                    <option value="{{ $danhMuc->id }}" {{ old('danh_muc_id') == $danhMuc->id ? 'selected' : '' }}>
                        {{ $danhMuc->ten_danh_muc }}
                    </option>
                @endforeach
            </select>
            @error('danh_muc_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tình trạng -->
        <div class="form-group">
            <label for="tinh_trang">Tình Trạng</label>
            <select name="tinh_trang" id="tinh_trang" required>
                <option value="còn hàng" {{ old('tinh_trang') == 'còn hàng' ? 'selected' : '' }}>Còn hàng</option>
                <option value="hết hàng" {{ old('tinh_trang') == 'hết hàng' ? 'selected' : '' }}>Hết hàng</option>
            </select>
        </div>

        <!-- Sản phẩm nổi bật -->
        <div class="form-group">
            <label for="noi_bat">Nổi Bật</label>
            <select name="noi_bat" id="noi_bat" required>
                <option value="0" {{ old('noi_bat') == '0' ? 'selected' : '' }}>Không</option>
                <option value="1" {{ old('noi_bat') == '1' ? 'selected' : '' }}>Có</option>
            </select>
        </div>

        <!-- Khuyến mãi -->
        <div class="form-group">
            <label for="khuyen_mai">Khuyến Mãi (%)</label>
            <input type="number" name="khuyen_mai" id="khuyen_mai" value="{{ old('khuyen_mai') }}">
        </div>

        <!-- Nút gửi -->
        <button type="submit">Thêm Sản Phẩm</button>
    </form>
</div>
@endsection
