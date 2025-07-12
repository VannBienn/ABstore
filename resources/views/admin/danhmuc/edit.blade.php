@extends('layouts.admin')

@section('content')
    <div class="form-container">
        <h2>Sửa Danh Mục</h2>

        <form action="{{ route('danh-muc.update', $danhMuc->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ten_danh_muc">Tên Danh Mục</label>
                <input type="text" name="ten_danh_muc" value="{{ $danhMuc->ten_danh_muc }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
@endsection
