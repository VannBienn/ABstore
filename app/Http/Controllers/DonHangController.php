<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\GioHang;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    public function hienThiFormThanhToan()
    {
        if (Auth::check()) {
            $giohang = GioHang::where('user_id', Auth::id())->get();
        } else {
            $giohang = collect(session()->get('giohang', []))->map(function ($item, $id) {
                return (object) array_merge($item, ['san_pham_id' => $id]);
            });
        }

        return view('frontend.donhang.thanhtoan', compact('giohang'));
    }

    public function datHang(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đặt hàng.');
        }

        $user = Auth::user();
        $giohang = GioHang::where('user_id', $user->id)->get();

        if ($giohang->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng trống');
        }

        $tongTien = $giohang->reduce(function ($carry, $item) {
            return $carry + $item->gia_khuyen_mai * $item->so_luong;
        }, 0);

        $donHang = DonHang::create([
            'user_id' => $user->id,
            'tong_tien' => $tongTien,
            'trang_thai' => 'chờ xử lý',
            'dia_chi' => $request->input('dia_chi'),
            'ghi_chu' => $request->input('ghi_chu'),
        ]);

        foreach ($giohang as $item) {
            ChiTietDonHang::create([
                'don_hang_id' => $donHang->id,
                'san_pham_id' => $item->san_pham_id,
                'so_luong' => $item->so_luong,
                'don_gia' => $item->gia_khuyen_mai,
            ]);
        }

        GioHang::where('user_id', $user->id)->delete();

        return redirect()->route('donhang.thanhcong')->with('success', 'Đặt hàng thành công');
    }
}
