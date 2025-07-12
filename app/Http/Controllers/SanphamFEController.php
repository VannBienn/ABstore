<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMucSanPham;

class SanphamFEController extends Controller
{

    public function quickView($id)
    {
        $sanPham = SanPham::findOrFail($id);

        $sanPham->gia_cu = $sanPham->gia;
        if ($sanPham->khuyen_mai > 0) {
            $sanPham->gia = $sanPham->gia - ($sanPham->gia * $sanPham->khuyen_mai / 100);
        }

        return view('frontend.sanpham.quickview', compact('sanPham'));
    }

    public function index(Request $request)
    {
        $tatCaSanPhamNoiBat = SanPham::where('noi_bat', 1)->get(); // tất cả sản phẩm nổi bật
        $sanPhamNoiBat = $tatCaSanPhamNoiBat->take(5); // chỉ lấy 5 cái đầu
        $hienNutXemThem = $tatCaSanPhamNoiBat->count() > 5;

        $danhMucSanPham = DanhMucSanPham::all();

        // Xử lý giá gốc và giá khuyến mãi cho sản phẩm nổi bật
        foreach ($sanPhamNoiBat as $sp) {
            $sp->gia_cu = $sp->gia;
            if ($sp->khuyen_mai > 0) {
                $sp->gia = $sp->gia - ($sp->gia * $sp->khuyen_mai / 100);
            }
        }

        // Lọc sản phẩm theo danh mục nếu có
        if ($request->has('danh_muc')) {
            $tatCaSanPham = SanPham::where('danh_muc_id', $request->danh_muc)->get();
        } else {
            $tatCaSanPham = SanPham::all();
        }

        // Xử lý giá gốc và giá khuyến mãi cho tất cả sản phẩm
        foreach ($tatCaSanPham as $sp) {
            $sp->gia_cu = $sp->gia;
            if ($sp->khuyen_mai > 0) {
                $sp->gia = $sp->gia - ($sp->gia * $sp->khuyen_mai / 100);
            }
        }

        return view('frontend.sanpham.index', compact('danhMucSanPham', 'tatCaSanPham', 'sanPhamNoiBat', 'hienNutXemThem'));
    }
}
