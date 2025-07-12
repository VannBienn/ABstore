@extends('layouts.app')

@section('noidung')
<div class="success-container">
    <h2>✅ Cảm ơn bạn đã đặt hàng!</h2>
    <p>Chúng tôi sẽ xử lý đơn hàng và giao đến bạn sớm nhất có thể.</p>
    <a href="{{ url('/') }}" class="btn">Về trang chủ</a>
</div>
@endsection
