@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Danh Sách Sản Phẩm</h2>
        <a href="{{ route('admin.san-pham.create') }}" class="btn btn-primary">+ Thêm Sản Phẩm</a>
    </div>

    <form action="{{ route('admin.san-pham.index') }}" method="GET" class="form-timkiem">
        <input type="text" name="keyword" class="form-nhap" placeholder="Tìm kiếm sản phẩm..."
            value="{{ request('keyword') }}">
        <button type="submit" class="nut-timkiem">Tìm</button>
    </form>
    
    @if(request('keyword'))
        <div class="alert alert-info">
            Kết quả cho từ khóa: <strong>{{ request('keyword') }}</strong>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark text-center">
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Danh Mục</th>
                    <th>Khuyến Mãi (%)</th>
                    <th>Nổi Bật</th>
                    <th>Ảnh Chính</th>
                    <th>Tình Trạng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sanPhams as $sp)
                <tr>
                    <td>{{ $sp->ten_san_pham }}</td>
                    <td>{{ number_format($sp->gia, 0, ',', '.') }} đ</td>
                    <td>{{ $sp->danhMuc->ten_danh_muc ?? 'Không có' }}</td>
                    <td>{{ $sp->khuyen_mai ?? 0 }}%</td>
                    <td>
                        <span class="badge bg-{{ $sp->noi_bat ? 'success' : 'secondary' }}">
                            {{ $sp->noi_bat ? 'Có' : 'Không' }}
                        </span>
                    </td>
                    <td>
                        @if ($sp->hinh_anh)
                        <img src="{{ asset('uploads/' . $sp->hinh_anh) }}" alt="Ảnh chính" width="60">
                        @else
                        <span class="text-muted">Không có</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-info">{{ $sp->tinh_trang }}</span>
                    </td>
                    <td class="admin-action-buttons">
                        <a href="{{ route('admin.san-pham.edit', $sp->id) }}" class="btn-sua">Sửa</a>
                        <form action="{{ route('admin.san-pham.destroy', $sp->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-xoa" onclick="return confirm('Xác nhận xóa sản phẩm này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-muted text-center">Không tìm thấy sản phẩm nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

      <!-- Phân trang  -->
        @if($sanPhams->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $sanPhams->links('vendor.pagination.bootstrap-4') }}
        </div>
        @endif
    </div>
</div>
@endsection
