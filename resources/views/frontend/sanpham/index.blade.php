@extends('layouts.app')
@section('tieude', 'Sản phẩm')

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
                    <a href="{{ route('sanpham.fe', ['danh_muc' => $danhMuc->id]) }}"
                        class="{{ request('danh_muc') == $danhMuc->id ? 'active-dm' : '' }}">
                        {{ $danhMuc->ten_danh_muc }}
                    </a>
                </li>
                @endforeach
            </ul>

            <!-- Lọc theo giá -->
            <h5 class="mb-3 mt-4">Lọc theo giá</h5>
            <form method="GET" action="{{ route('sanpham.fe') }}">
                @if(request('danh_muc'))
                <input type="hidden" name="danh_muc" value="{{ request('danh_muc') }}">
                @endif

                @foreach([
                1 => 'Dưới 100.000đ',
                2 => '100.000đ - 200.000đ',
                3 => '200.000đ - 500.000đ',
                4 => 'Trên 500.000đ'
                ] as $val => $label)
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="gia" value="{{ $val }}"
                        id="gia{{ $val }}" {{ request('gia') == $val ? 'checked' : '' }}>
                    <label class="form-check-label" for="gia{{ $val }}">{{ $label }}</label>
                </div>
                @endforeach

                <button type="submit" class="btn btn-primary btn-sm">Lọc</button>
            </form>

            <!-- Sản phẩm nổi bật -->
            <div class="sidebar-widget mt-5">
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
                            <p class="gia-noi-bat">
                                @if($sp->khuyen_mai > 0)
                                <span class="text-danger fw-bold">{{ number_format($sp->gia_moi, 0, ',', '.') }} đ</span>
                                <del class="text-muted ms-1">{{ number_format($sp->gia_cu, 0, ',', '.') }} đ</del>
                                @else
                                <span class="text-danger fw-bold">{{ number_format($sp->gia_moi, 0, ',', '.') }} đ</span>
                                @endif
                            </p>
                        </div>
                    </a>
                </div>
                @endforeach

                @if($hienNutXemThem)
                <div class="text-end mt-2">
                    <a href="{{ route('sanpham.fe', ['noi_bat' => 1]) }}" class="btn btn-sm btn-outline-primary">Xem thêm</a>
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
            @if(request('tu_khoa'))
            <p>Kết quả tìm kiếm cho: <strong>{{ request('tu_khoa') }}</strong></p>
            @endif
            <div class="product-list row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @forelse($sanPhams as $sanPham)
                <div class="col">
                    <div class="product-card">
                        <div class="card w-100 h-100">
                            <a href="{{ route('sanpham.show', $sanPham->id) }}">
                                <div class="position-relative">
                                    @if($sanPham->khuyen_mai > 0)
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                        -{{ $sanPham->khuyen_mai }}%
                                    </span>
                                    @endif
                                    <img src="{{ $sanPham->hinh_anh ? asset('uploads/' . $sanPham->hinh_anh) : 'https://via.placeholder.com/300x300?text=No+Image' }}"
                                        class="card-img-top" alt="{{ $sanPham->ten_san_pham }}">
                                </div>
                            </a>
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $sanPham->ten_san_pham }}</h5>
                                <div class="card-text">
                                    <span class="gia-moi text-danger fw-bold">
                                        {{ number_format($sanPham->gia_moi, 0, ',', '.') }} đ
                                    </span>
                                    @if($sanPham->khuyen_mai > 0)
                                    <del class="gia-cu text-muted ms-2">
                                        {{ number_format($sanPham->gia_cu, 0, ',', '.') }} đ
                                    </del>
                                    @endif
                                </div>
                            </div>
                            <div class="hover-links">
                                <a href="{{ route('sanpham.show', $sanPham->id) }}" class="btn-xemchitiet">Xem chi tiết</a>
                                <a href="javascript:void(0);" class="btn-xemnhanh" data-id="{{ $sanPham->id }}">Xem nhanh</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p>Không có sản phẩm nào để hiển thị.</p>
                @endforelse
            </div>
         <!-- Phân trang -->
            @if($sanPhams->hasPages())
            <div class="d-flex justify-content mt-4">
                {{ $sanPhams->links('vendor.pagination.bootstrap-4') }}
            </div>
            @endif
        </div>   
    </div>
    @endsection
    <!-- Quick View Modal -->
    <div id="quickview-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="quickview-content"></div>
        </div>
    </div>

    @push('scripts')
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
    @endpush