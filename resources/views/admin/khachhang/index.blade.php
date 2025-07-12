@extends('layouts.admin')

@section('tieude', 'Quản lý khách hàng')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Danh Sách Khách Hàng</h2>
                <a href="{{ route('khachhang.create') }}" class="btn btn-primary">+ Thêm Khách Hàng</a>
            </div>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col" style="width: 180px;">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="admin-action-buttons">
                                <a href="{{ route('khachhang.edit', $user->id) }}" class="btn-sua">Sửa</a>
                                <form action="{{ route('khachhang.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-xoa" onclick="return confirm('Xóa khách hàng này?')">Xóa</button>
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