<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\GioHang;
use App\Models\SanPham;

class ChuyenSessionSangGioHangDB
{
    public function handle(Login $event)
    {
        $user = $event->user;
        $sessionCart = session('giohang', []);

        foreach ($sessionCart as $productId => $item) {
            $sanPham = SanPham::find($productId);
            if (!$sanPham) continue;

            $gioHang = GioHang::firstOrNew([
                'user_id' => $user->id,
                'san_pham_id' => $productId
            ]);

            $gioHang->so_luong += $item['so_luong'];

            $gia = $sanPham->gia;
            $giaKM = $gia - ($gia * $sanPham->khuyen_mai / 100);

            $gioHang->ten_san_pham = $sanPham->ten_san_pham;
            $gioHang->gia = $gia;
            $gioHang->gia_khuyen_mai = $giaKM;
            $gioHang->hinh_anh = $sanPham->hinh_anh;

            $gioHang->save();
        }

        session()->forget('giohang');
    }
}
