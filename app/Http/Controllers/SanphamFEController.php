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
        return view('frontend.sanpham.quickview', compact('sanPham'));
    }

    public function index(Request $request)
    {
        $query = SanPham::query();

        // Tìm kiếm theo tên
        if ($request->filled('tu_khoa')) {
            $keyword = $request->tu_khoa;
            $query->where('ten_san_pham', 'LIKE', '%' . $keyword . '%');
        }

        // Lọc theo danh mục
        if ($request->filled('danh_muc')) {
            $query->where('danh_muc_id', $request->danh_muc);
        }

        // Lấy toàn bộ sản phẩm (tạm thời)
        $sanPhams = $query->get();

        // Lọc theo giá
        if ($request->filled('gia')) {
            $gia = $request->gia;
            $sanPhams = $sanPhams->filter(function ($sp) use ($gia) {
                switch ($gia) {
                    case 1:
                        return $sp->gia_moi < 100000;
                    case 2:
                        return $sp->gia_moi >= 100000 && $sp->gia_moi <= 200000;
                    case 3:
                        return $sp->gia_moi > 200000 && $sp->gia_moi <= 500000;
                    case 4:
                        return $sp->gia_moi > 500000;
                    default:
                        return true;
                }
            })->values();
        }
        
        $perPage = 9;
        $page = $request->input('page', 1);
        $pagedSanPhams = $sanPhams->slice(($page - 1) * $perPage, $perPage)->all();
        $sanPhams = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedSanPhams,
            $sanPhams->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $danhMucSanPham = DanhMucSanPham::all();
        $sanPhamNoiBat = SanPham::where('noi_bat', 1)->take(5)->get();
        $hienNutXemThem = SanPham::where('noi_bat', 1)->count() > 5;

        return view('frontend.sanpham.index', compact(
            'sanPhams',
            'danhMucSanPham',
            'sanPhamNoiBat',
            'hienNutXemThem'
        ));
    }
}
