@extends('layouts.app')

@section('noidung')
<div class="container my-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="duongdan">
                <a href="{{ url('/') }}">Trang chủ</a> &raquo; <span>Sản phẩm</span>
            </div>
            <h5 class="mb-3">Danh mục</h5>
            <ul class="list-group mb-4 list-danhmuc">
                <li class="list-group-item">
                    <a href="{{ route('sanpham.fe') }}" class="{{ request('danh_muc') ? '' : 'active-dm' }}">
                        Tất cả sản phẩm
                    </a>
                </li>
                @foreach($danhMucSanPham as $danhMuc)
                <li class="list-group-item">
                    <a href="{{ route('sanpham.fe', ['danh_muc' => $danhMuc->id]) }}" class="{{ request('danh_muc') == $danhMuc->id ? 'active-dm' : '' }}">
                        {{ $danhMuc->ten_danh_muc }}
                    </a>
                </li>
                @endforeach
            </ul>

            <!-- Sản phẩm nổi bật -->
            <div class="sidebar-widget">
                <h5 class="widget-title">Sản phẩm nổi bật</h5>
                @if(count($sanPhamNoiBat) > 0)
                @foreach($sanPhamNoiBat as $sp)
                <div class="featured-product">
                    <a href="{{ route('sanpham.show', $sp->id) }}">
                        <div class="featured-img">
                            <img src="{{ asset('uploads/' . $sp->hinh_anh) }}" alt="{{ $sp->ten_san_pham }}">
                        </div>
                        <div class="featured-info">
                            <h6>{{ $sp->ten_san_pham }}</h6>
                            <p class="gia-noi-bat">{{ number_format($sp->gia, 0, ',', '.') }} đ</p>
                        </div>
                    </a>
                </div>
                @endforeach

                @if($hienNutXemThem)
                <div class="text-end mt-2">
                    <a href="{{ route('sanpham.fe', ['noi_bat' => 1]) }}" class="btn btn-sm btn-outline-primary">
                        Xem thêm
                    </a>
                </div>
                @endif
                @else
                <p>Chưa có sản phẩm nổi bật nào.</p>
                @endif
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="col-md-9">
            <h3 class="mb-4">Tất cả sản phẩm</h3>
            <div class="row">
                @forelse($tatCaSanPham as $sanPham)
                @php
                $giaMoi = $sanPham->gia - ($sanPham->gia * $sanPham->khuyen_mai / 100);
                @endphp
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100 h-100 product-card">
                        <a href="{{ route('sanpham.show', $sanPham->id) }}">
                            <div class="position-relative">
                                @if($sanPham->khuyen_mai > 0)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">-{{ $sanPham->khuyen_mai }}%</span>
                                @endif
                                <img src="{{ $sanPham->hinh_anh ? asset('uploads/' . $sanPham->hinh_anh) : 'https://via.placeholder.com/300x300?text=No+Image' }}" class="card-img-top" alt="{{ $sanPham->ten_san_pham }}">
                            </div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $sanPham->ten_san_pham }}</h5>
                            <div class="card-text">
                                @if($sanPham->khuyen_mai > 0)
                                <span class="gia-moi text-danger fw-bold">
                                    {{ number_format($sanPham->gia, 0, ',', '.') }} đ
                                </span>
                                <del class="gia-cu text-muted ms-2">
                                    {{ number_format($sanPham->gia_cu, 0, ',', '.') }} đ
                                </del>
                                @else
                                <span class="gia-moi text-danger fw-bold">
                                    {{ number_format($sanPham->gia, 0, ',', '.') }} đ
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- Nút Xem chi tiết và Xem nhanh -->
                        <div class="hover-links">
                            <a href="{{ route('sanpham.show', $sanPham->id) }}" class="btn-xemchitiet">Xem chi tiết</a>
                            <a href="javascript:void(0);" class="btn-xemnhanh" data-id="{{ $sanPham->id }}">Xem nhanh</a>
                        </div>
                    </div>
                </div>

                @empty
                <p>Không có sản phẩm nào để hiển thị.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Quick View Modal -->
<div id="quickview-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="quickview-content">
            <!-- Dữ liệu sản phẩm sẽ được render ở đây -->
        </div>
    </div>
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.btn-xemnhanh', function(e) {
            e.preventDefault();
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
</script>
@endsection

<style>
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
</style>

@endsection