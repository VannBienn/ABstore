@extends('layouts.admin')

@section('content')
<div class="form-container">
    <h2>Thêm Danh Mục</h2>
    <form action="{{ route('danh-muc.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ten_danh_muc">Tên Danh Mục</label>
            <input type="text" name="ten_danh_muc" id="ten_danh_muc" value="{{ old('ten_danh_muc') }}" required>
            @error('ten_danh_muc') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <button type="submit">Thêm Danh Mục</button>
    </form>
</div>
@endsection
