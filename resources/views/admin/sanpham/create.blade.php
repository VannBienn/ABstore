@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Thêm Sản Phẩm</h2>

    <form action="{{ route('san-pham.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Cột bên trái -->
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="ten_san_pham" class="form-label">Tên Sản Phẩm</label>
                    <input type="text" name="ten_san_pham" class="form-control" id="ten_san_pham" value="{{ old('ten_san_pham') }}" required>
                    @error('ten_san_pham')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="chi_tiet" class="form-label">Chi Tiết</label>
                    <textarea name="chi_tiet" class="form-control" id="chi_tiet" rows="4">{{ old('chi_tiet') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="gia" class="form-label">Giá</label>
                    <input type="number" name="gia" class="form-control" id="gia" value="{{ old('gia') }}" required>
                    @error('gia')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="hinh_anh" class="form-label">Hình Ảnh Chính</label>
                    <input type="file" name="hinh_anh" class="form-control" id="hinh_anh">
                    @error('hinh_anh')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="khuyen_mai" class="form-label">Khuyến Mãi (%)</label>
                    <input type="number" name="khuyen_mai" class="form-control" id="khuyen_mai" value="{{ old('khuyen_mai') }}">
                </div>
            </div>

            <!-- Cột bên phải -->
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="anh_phu_1" class="form-label">Ảnh Phụ 1</label>
                    <input type="file" name="anh_phu_1" class="form-control" id="anh_phu_1">
                </div>

                <div class="form-group mb-3">
                    <label for="anh_phu_2" class="form-label">Ảnh Phụ 2</label>
                    <input type="file" name="anh_phu_2" class="form-control" id="anh_phu_2">
                </div>

                <div class="form-group mb-3">
                    <label for="anh_phu_3" class="form-label">Ảnh Phụ 3</label>
                    <input type="file" name="anh_phu_3" class="form-control" id="anh_phu_3">
                </div>

                <div class="form-group mb-3">
                    <label for="danh_muc_id" class="form-label">Danh Mục</label>
                    <select name="danh_muc_id" class="form-select" id="danh_muc_id" required>
                        @foreach($danhMucs as $danhMuc)
                            <option value="{{ $danhMuc->id }}" {{ old('danh_muc_id') == $danhMuc->id ? 'selected' : '' }}>
                                {{ $danhMuc->ten_danh_muc }}
                            </option>
                        @endforeach
                    </select>
                    @error('danh_muc_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tinh_trang" class="form-label">Tình Trạng</label>
                    <select name="tinh_trang" class="form-select" id="tinh_trang" required>
                        <option value="còn hàng" {{ old('tinh_trang') == 'còn hàng' ? 'selected' : '' }}>Còn hàng</option>
                        <option value="hết hàng" {{ old('tinh_trang') == 'hết hàng' ? 'selected' : '' }}>Hết hàng</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="noi_bat" class="form-label">Nổi Bật</label>
                    <select name="noi_bat" class="form-select" id="noi_bat" required>
                        <option value="0" {{ old('noi_bat') == '0' ? 'selected' : '' }}>Không</option>
                        <option value="1" {{ old('noi_bat') == '1' ? 'selected' : '' }}>Có</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success">+ Thêm Sản Phẩm</button>
        </div>
    </form>
</div>
@endsection
