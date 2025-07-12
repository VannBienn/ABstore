@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Danh sách tin tức</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tin-tuc.create') }}" class="btn btn-primary">+ Thêm Tin Tức</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Mô tả ngắn</th>
                <th>Ngày đăng</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dsTinTuc as $index => $tin)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $tin->tieu_de }}</td>
                <td>{{ $tin->mo_ta_ngan }}</td>
                <td>{{ $tin->ngay_dang }}</td>
                <td>
                    @if ($tin->hinh_anh)
                    <img src="{{ asset('uploads/tintuc/' . $tin->hinh_anh) }}" width="100">
                    @else
                    Không có
                    @endif
                </td>
                <td>
                    <a href="{{ route('tin-tuc.edit', $tin->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('tin-tuc.destroy', $tin->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa tin tức này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($dsTinTuc->isEmpty())
            <tr>
                <td colspan="6" class="text-center">Không có tin tức nào!</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection