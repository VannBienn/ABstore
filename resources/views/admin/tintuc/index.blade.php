@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Quản lý tin tức</h1>
        <a href="{{ route('tin-tuc.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> + Thêm Tin Tức
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th width="5%">STT</th>
                    <th width="20%">Tiêu đề</th>
                    <th width="25%">Mô tả ngắn</th>
                    <th width="10%">Ngày đăng</th>
                    <th width="20%">Hình ảnh</th>
                    <th width="20%">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dsTinTuc as $index => $tin)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $tin->tieu_de }}</td>
                        <td>{{ $tin->mo_ta_ngan }}</td>
                        <td class="text-center">{{ $tin->ngay_dang }}</td>
                        <td class="text-center">
                            @if ($tin->hinh_anh)
                                <img src="{{ asset('uploads/tintuc/' . $tin->hinh_anh) }}" width="100" class="img-thumbnail">
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('tin-tuc.edit', $tin->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="{{ route('tin-tuc.destroy', $tin->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa tin tức này?')">
                                    <i class="fas fa-trash-alt"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Không có tin tức nào!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
