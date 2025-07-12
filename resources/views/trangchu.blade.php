@extends('layouts.app')

@section('tieude', 'Trang chủ')

@section('noidung')
<!-- Banner -->
<div class="banner">
    <div class="container">
        <div class="noidung-banner">
            <h1 class="tieude-banner">Sản phẩm làm đẹp</h1>
            <p class="mota-banner">Đa dạng sản phẩm chất lượng cao cấp với khuyến mãi hấp dẫn đang đón chờ bạn.</p>
            <div class="nut-banner">
                <a href="{{ route('sanpham.fe') }}">Mua ngay</a>
            </div>
        </div>
        <div class="hinh-banner">
            <img src="{{ asset('images/banner-img.png') }}" alt="Banner">
        </div>
    </div>
</div>

<!-- Giới thiệu -->
<div class="gioithieu">
    <div class="container">
        <div class="cot-gioithieu">
            <div class="hinhanh-gioithieu">
                <img src="{{ asset('images/about-img.png') }}" alt="Tin tức">
            </div>
            <div class="noidung-gioithieu">
                <h2>Tin tức</h2>
                <p>Cập nhật các xu hướng làm đẹp, mẹo chăm sóc da và thông tin hữu ích từ BIENstore.</p>
                <div class="nut-gioithieu">
                    <a href="/tin-tuc">Xem tin tức</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sản phẩm nổi bật -->
<div class="container mt-5">
    <h2 class="tieude-chinh">Sản phẩm nổi bật</h2>
    <p class="mota">Những sản phẩm được nhiều người yêu thích</p>

    <div class="product-slider-wrapper" id="wrapper-noi-bat">
        <button class="slider-btn prev-btn">&#10094;</button>

        <div class="product-slider" id="slider-noi-bat">
            @foreach($sanPhamNoiBat as $sanPham)
            <div class="slider-item">
                @include('components.sanpham_card', ['sanPham' => $sanPham])
            </div>
            @endforeach
        </div>

        <button class="slider-btn next-btn">&#10095;</button>
    </div>
</div>

<!-- Sản phẩm khuyến mãi -->
<div class="container mt-5">
    <h2 class="tieude-chinh">Sản phẩm khuyến mãi</h2>
    <p class="mota">Săn sale giá tốt nhất hôm nay!</p>

    <div class="product-slider-wrapper" id="wrapper-khuyen-mai">
        <button class="slider-btn prev-btn">&#10094;</button>

        <div class="product-slider" id="slider-khuyen-mai">
            @foreach($sanPhamKhuyenMai as $sanPham)
            <div class="slider-item">
                @include('components.sanpham_card', ['sanPham' => $sanPham])
            </div>
            @endforeach
        </div>

        <button class="slider-btn next-btn">&#10095;</button>
    </div>
</div>

@endsection
<!-- Modal xem nhanh -->
<div id="quickview-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="quickview-content"></div>
    </div>
</div>
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-quickview').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/sanpham/quickview/' + id,
                method: 'GET',
                success: function(res) {
                    $('#quickview-content').html(res);
                    $('#quickview-modal').fadeIn();
                },
                error: function() {
                    alert('Không thể tải dữ liệu sản phẩm.');
                }
            });
        });

        $(document).on('click', '.close', function() {
            $('#quickview-modal').fadeOut();
        });

        $(window).on('click', function(e) {
            if ($(e.target).is('#quickview-modal')) {
                $('#quickview-modal').fadeOut();
            }
        });
    });

    function setupSlider(wrapperSelector, sliderSelector, itemSelector) {
        const wrapper = document.querySelector(wrapperSelector);
        const slider = wrapper.querySelector(sliderSelector);
        const items = wrapper.querySelectorAll(itemSelector);
        const prevBtn = wrapper.querySelector('.prev-btn');
        const nextBtn = wrapper.querySelector('.next-btn');

        let currentIndex = 0;
        let itemsPerPage = getVisibleItems();

        function getVisibleItems() {
            if (window.innerWidth <= 576) return 1;
            if (window.innerWidth <= 768) return 2;
            return 3;
        }

        function updateSlider() {
            const itemWidth = items[0].offsetWidth + 20; // khoảng cách giữa các item
            const offset = currentIndex * itemWidth;
            slider.style.transform = `translateX(-${offset}px)`;
        }

        function updateItemsPerPage() {
            itemsPerPage = getVisibleItems();
            const maxIndex = Math.max(0, items.length - itemsPerPage);
            if (currentIndex > maxIndex) {
                currentIndex = maxIndex;
            }
            updateSlider();
        }

        nextBtn.addEventListener('click', () => {
            const maxIndex = Math.max(0, items.length - itemsPerPage);
            if (currentIndex < maxIndex) {
                currentIndex += itemsPerPage;
                if (currentIndex > maxIndex) currentIndex = maxIndex;
                updateSlider();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex -= itemsPerPage;
                if (currentIndex < 0) currentIndex = 0;
                updateSlider();
            }
        });

        window.addEventListener('resize', () => {
            updateItemsPerPage();
        });

        updateItemsPerPage();
    }

    setupSlider('#wrapper-noi-bat', '#slider-noi-bat', '.slider-item');
    setupSlider('#wrapper-khuyen-mai', '#slider-khuyen-mai', '.slider-item');
</script>
@endsection

@push('styles')
<style>
    /* Modal Quick View */
    .modal {
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        padding: 20px;
        width: 80%;
        max-width: 900px;
        position: relative;
        border-radius: 10px;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 25px;
        cursor: pointer;
    }

    /* Slider layout fix */
    .product-slider-wrapper {
        position: relative;
        overflow: hidden;
        width: 100%;
        margin-top: 20px;
    }

    .product-slider {
        display: flex;
        transition: transform 0.5s ease;
        gap: 20px;
    }

    .slider-item {
        flex: 0 0 calc(33.333% - 13.33px);
        box-sizing: border-box;
    }

    /* Slider button */
    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(145deg, #f48fb1, #ec407a);
        color: white;
        border: none;
        padding: 10px;
        font-size: 22px;
        border-radius: 50%;
        z-index: 1;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .slider-btn:hover {
        background-color: #d81b60;
    }

    .prev-btn {
        left: 0;
    }

    .next-btn {
        right: 0;
    }

    @media (max-width: 768px) {
        .slider-item {
            flex: 0 0 48%;
        }
    }

    @media (max-width: 576px) {
        .slider-item {
            flex: 0 0 100%;
        }
    }
</style>
@endpush