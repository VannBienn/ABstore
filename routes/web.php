<?php

use App\Http\Controllers\Admin\DonHangAdminController;
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
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

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
// Quản lý đơn hàng
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('don-hang', [DonHangAdminController::class, 'index'])->name('donhang.index');
    Route::get('don-hang/{id}', [DonHangAdminController::class, 'show'])->name('donhang.show');
    Route::post('don-hang/{id}/cap-nhat-trang-thai', [DonHangAdminController::class, 'updateTrangThai'])->name('donhang.updateTrangThai');
});

// Trang chủ
Route::get('/', [TrangChuController::class, 'index'])->name('trangchu');

// Xem sản phẩm theo danh mục
Route::get('/xem-danh-muc/{id}', [SanPhamController::class, 'theoDanhMuc'])->name('danhmuc');

// Sản phẩm fe
Route::get('/san-phamfe', [SanphamFEController::class, 'index'])->name('sanpham.fe');
Route::get('/san-pham', [SanphamFEController::class, 'index'])->name('sanpham.index');

//Liên hệ
Route::get('/lien-he', function () {
    return view('lienhe');
})->name('lienhe');

//chi tiết sp
Route::get('/sanpham/{id}', [SanPhamController::class, 'show'])->name('sanpham.show');

// xem nhanh sản phẩm
Route::get('/sanpham/quickview/{id}', [SanphamFEController::class, 'quickView'])->name('sanpham.quickview');

// Tin tức (ADMIN)
Route::prefix('admin')->group(function () {
    Route::resource('tin-tuc', TinTucController::class);
});

// Tin tức FRONTEND
Route::get('/bai-viet', [TinTucController::class, 'indexFrontend'])->name('tintuc.fe');
Route::get('/bai-viet/{id}', [TinTucController::class, 'show'])->name('tintuc.fe.show');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/donhang/{id}', [DonHangController::class, 'show'])->name('donhang.chitiet');
});
// Đăng ký , đăng nhập , đăng xuất
Route::get('dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('dang-nhap', [AuthController::class, 'login']);

Route::get('dang-ky', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('dang-ky', [AuthController::class, 'register']);

Route::post('dang-xuat', [AuthController::class, 'logout'])->name('logout');

// Quên mật khẩu
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Giỏ hàng
Route::get('/gio-hang', [GioHangController::class, 'index'])->name('giohang.index');
Route::post('/gio-hang/them', [GioHangController::class, 'them'])->name('giohang.them');
Route::get('/gio-hang/xoa/{id}', [GioHangController::class, 'xoa'])->name('giohang.xoa');
Route::post('/gio-hang/ajax-them', [App\Http\Controllers\GioHangController::class, 'themBangAjax'])->name('giohang.them.ajax');
//Đơn hàng
Route::middleware('auth')->group(function () {
Route::get('/thanh-toan', [DonHangController::class, 'hienThiFormThanhToan'])->name('donhang.form');
Route::post('/dat-hang', [DonHangController::class, 'datHang'])->name('donhang.dat');});
Route::get('/thanh-toan/thanh-cong', fn() => view('frontend.donhang.thanhcong'))->name('donhang.thanhcong');

Route::get('/don-hang/{id}', [DonHangController::class, 'show'])->name('donhang.show');

// require __DIR__.'/auth.php';
Route::get('/chinh-sach-doi-tra', function () {
    return view('pages.chinh_sach_doi_tra');
})->name('chinh_sach_doi_tra');

// // Dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');