<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DanhMucSanPhamController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TrangChuController;
use App\Http\Controllers\SanPhamFEController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\ThanhToanController;
use App\Http\Controllers\DonHangController;
use App\Models\TinTuc;
use App\Http\Controllers\AuthController;

// Trang quản trị
Route::middleware('auth')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::middleware('auth')->group(function () {
    Route::get('/thanh-toan', [ThanhToanController::class, 'index'])->name('thanh-toan');
});

});
// Quản lý danh mục
Route::resource('danh-muc', DanhMucSanPhamController::class);

// Quản lý sản phẩm
Route::resource('san-pham', SanPhamController::class);

// Quản lý khách hàng
Route::resource('khachhang', KhachHangController::class);

// Trang chủ
Route::get('/', [TrangChuController::class, 'index'])->name('trangchu');

// Xem sản phẩm theo danh mục
Route::get('/xem-danh-muc/{id}', [SanPhamController::class, 'theoDanhMuc'])->name('danhmuc'); // ✅ KHÔNG trùng

// Sản phẩm fe
Route::get('/san-phamfe', [SanphamFEController::class, 'index'])->name('sanpham.fe');

//Liên hệ
Route::get('/lien-he', function () {
    return view('lienhe');
})->name('lienhe');

//chi tiết sp
Route::get('/sanpham/{id}', [SanPhamController::class, 'show'])->name('sanpham.show');

// xem nhanh sản phẩm
Route::get('/sanpham/quickview/{id}', [SanphamFEController::class, 'quickView'])->name('sanpham.quickview');

//Tin tức
Route::prefix('admin')->group(function () {
    Route::resource('tin-tuc', TinTucController::class);
});

//tin tức chi tiết
Route::get('/tin-tuc', function () {
    $tinTuc = TinTuc::orderBy('ngay_dang', 'desc')->get();
    return view('tintuc', compact('tinTuc'));
})->name('tintuc');

// // Dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Đăng ký , đăng nhập , đăng xuất
Route::get('dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('dang-nhap', [AuthController::class, 'login']);

Route::get('dang-ky', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('dang-ky', [AuthController::class, 'register']);

Route::post('dang-xuat', [AuthController::class, 'logout'])->name('logout');

// Giỏ hàng
Route::get('/gio-hang', [GioHangController::class, 'index'])->name('giohang.index');
Route::post('/gio-hang/them', [GioHangController::class, 'them'])->name('giohang.them');
Route::get('/gio-hang/xoa/{id}', [GioHangController::class, 'xoa'])->name('giohang.xoa');
Route::post('/gio-hang/ajax-them', [App\Http\Controllers\GioHangController::class, 'themBangAjax'])->name('giohang.them.ajax');
//Đơn hàng
Route::get('/thanh-toan', [DonHangController::class, 'hienThiFormThanhToan'])->name('donhang.form');
Route::post('/dat-hang', [DonHangController::class, 'datHang'])->name('donhang.dat');
Route::get('/thanh-toan/thanh-cong', fn () => view('frontend.donhang.thanhcong'))->name('donhang.thanhcong');

// require __DIR__.'/auth.php';
