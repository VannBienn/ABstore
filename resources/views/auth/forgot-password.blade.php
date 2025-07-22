<div class="forgot-password-container">
    <h2>Quên mật khẩu</h2>

    @if (session('status'))
        <div class="status-message">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Nhập email để lấy lại mật khẩu" required>
        <button type="submit">Gửi yêu cầu đặt lại mật khẩu</button>
    </form>
</div>
<style>
.forgot-password-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fefefe;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    font-family: 'Segoe UI', sans-serif;
    text-align: center;
}

.forgot-password-container h2 {
    margin-bottom: 20px;
    color: #333;
    font-size: 24px;
}

.forgot-password-container input[type="email"] {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
}

.forgot-password-container button {
    width: 100%;
    padding: 12px;
    background-color: #ff5e57;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.forgot-password-container button:hover {
    background-color: #e74c3c;
}

.forgot-password-container .status-message {
    background-color: #d1f7d6;
    color: #2e7d32;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    font-size: 15px;
}

</style>
