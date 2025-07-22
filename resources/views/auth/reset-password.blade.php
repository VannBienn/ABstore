<div class="reset-password-container">
    <h2>Đặt lại mật khẩu</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <input type="password" name="password" placeholder="Mật khẩu mới">
        <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">

        <button type="submit">Cập nhật mật khẩu</button>
    </form>
</div>
<style>
.reset-password-container {
    max-width: 400px;
    margin: 80px auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', sans-serif;
}

.reset-password-container h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 24px;
    color: #333;
}

.reset-password-container form {
    display: flex;
    flex-direction: column;
}

.reset-password-container input[type="password"] {
    padding: 12px 15px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
}

.reset-password-container button {
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.reset-password-container button:hover {
    background-color: #e74c3c;
}

</style>