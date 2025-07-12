<div class="row">
    <div class="col-md-5 text-center">
        <!-- Ảnh chính -->
        <img src="{{ asset('uploads/' . $sanPham->hinh_anh) }}"
            class="img-fluid mb-3 border rounded"
            style="max-height: 280px; object-fit: contain;"
            alt="{{ $sanPham->ten_san_pham }}">

        <!-- Ảnh phụ -->
        <div class="d-flex justify-content-center gap-2">
            @foreach (['anh_phu_1', 'anh_phu_2', 'anh_phu_3'] as $img)
            @if ($sanPham->$img)
            <img src="{{ asset('uploads/' . $sanPham->$img) }}"
                class="border"
                style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
            @endif
            @endforeach
        </div>
    </div>

    <div class="col-md-7">
        <h5 class="fw-bold mb-2">{{ $sanPham->ten_san_pham }}</h5>

        <p class="mb-2">
            <strong>Thương hiệu:</strong> {{ $sanPham->thuong_hieu ?? 'Đang cập nhật' }} |
            <strong>Loại:</strong> {{ $sanPham->danh_muc ?? 'Đang cập nhật' }}
        </p>

        <div class="mb-2">
    @if($sanPham->khuyen_mai > 0)
        <span class="text-danger fw-bold fs-5">
            {{ number_format($sanPham->gia, 0, ',', '.') }}₫
        </span>
        <del class="text-muted ms-2">
            {{ number_format($sanPham->gia_cu, 0, ',', '.') }}₫
        </del>
    @else
        <span class="text-danger fw-bold fs-5">
            {{ number_format($sanPham->gia, 0, ',', '.') }}₫
        </span>
    @endif
</div>

        <form action="{{ route('giohang.them') }}" method="POST">
            @csrf
            <input type="hidden" name="sanpham_id" value="{{ $sanPham->id }}">

            <div class="mb-3">
                <strong>Số lượng:</strong>
                <div class="quantity-wrapper">
                    <button type="button" class="quantity-btn minus">-</button>
                    <input type="number" name="so_luong" class="quantity-input" value="1" min="1">
                    <button type="button" class="quantity-btn plus">+</button>
                </div>
            </div>

            <button type="submit" class="btn btn-danger w-100 mt-3">Mua hàng</button>
        </form>

    </div>
</div>

<style>
    .quantity-wrapper {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 6px;
        margin-bottom: 6px;
    }

    .quantity-btn {
        width: 32px;
        height: 32px;
        font-size: 16px;
        background-color: #b13ab2;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s;
    }

    .quantity-btn:hover {
        background-color: #972a9c;
    }

    .quantity-input {
        width: 48px;
        height: 32px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
    }
</style>

<script>
    document.querySelectorAll('.btn-minus, .quantity-btn.minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            let value = parseInt(input.value) || 1;
            if (value > 1) input.value = value - 1;
        });
    });

    document.querySelectorAll('.btn-plus, .quantity-btn.plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            let value = parseInt(input.value) || 1;
            input.value = value + 1;
        });
    });
</script>