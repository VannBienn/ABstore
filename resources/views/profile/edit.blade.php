@extends('layouts.app')

@section('noidung')
<div class="profile-container">
    <h2>Thông tin cá nhân</h2>

    @if (session('status'))
        <div class="alert-success">{{ session('status') }}</div>
    @endif

    <!-- Form cập nhật thông tin -->
    <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Họ tên</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}">
        </div>

        <button type="submit" class="btn-primary">Cập nhật</button>
    </form>
    <h3 class="section-title">📦 Danh sách đơn hàng đã đặt</h3>

<div class="order-history">
    @if($donHangs->count() > 0)
        <table class="order-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donHangs as $don)
                    <tr>
                        <td>{{ $don->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($don->created_at)->format('d/m/Y') }}</td>
                        <td>{{ $don->trang_thai }}</td>
                        <td>{{ number_format($don->tong_tien, 0, ',', '.') }} đ</td>
                        <td><a href="{{ route('donhang.chitiet', $don->id) }}">Xem chi tiết đơn hàng</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Bạn chưa có đơn hàng nào.</p>
    @endif
</div>

    <!-- Nút đổi mật khẩu -->
    <button id="toggle-password-form" class="btn-secondary">Đổi mật khẩu</button>

    <!-- Form đổi mật khẩu -->
    <form method="POST" action="{{ route('profile.password.update') }}" id="password-form" class="profile-form hidden">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="current_password">Mật khẩu hiện tại</label>
            <input type="password" name="current_password" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu mới</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu mới</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn-warning">Xác nhận đổi mật khẩu</button>
    </form>
</div>

<!-- Script ẩn/hiện form -->
<script>
    document.getElementById('toggle-password-form').addEventListener('click', function () {
        const form = document.getElementById('password-form');
        form.classList.toggle('hidden');
        this.textContent = form.classList.contains('hidden') ? 'Đổi mật khẩu' : 'Ẩn đổi mật khẩu';
    });
</script>
@endsection
