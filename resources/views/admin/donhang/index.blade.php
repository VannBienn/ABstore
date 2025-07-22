@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách đơn hàng</h2>

    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donHangs as $don)
            <tr>
                <td>{{ $don->id }}</td>
                <td>{{ $don->user->name ?? 'Không rõ' }}</td>
                <td>{{ number_format($don->tong_tien) }} đ</td>
                <td><span class="badge bg-info">{{ $don->trang_thai }}</span></td>
                <td>{{ $don->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.donhang.show', $don->id) }}" class="btn btn-sm btn-primary">Xem Chi Tiết</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $donHangs->links() }}
</div>
@endsection
