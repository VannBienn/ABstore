@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Danh Sách Danh Mục</h2>
                <a href="{{ route('danh-muc.create') }}" class="btn btn-primary">+ Thêm Danh Mục</a>
            </div>

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Tên Danh Mục</th>
                            <th scope="col" style="width: 180px;">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($danhMucs as $danhMuc)
                        <tr>
                            <td>{{ $danhMuc->ten_danh_muc }}</td>
                            <td class="admin-action-buttons">
                                <a href="{{ route('danh-muc.edit', $danhMuc->id) }}" class="btn-sua">Sửa</a>
                                <form action="{{ route('danh-muc.destroy', $danhMuc->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-xoa"
                                        onclick="return confirm('Xóa danh mục sẽ xóa toàn bộ sản phẩm thuộc danh mục này?')">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection