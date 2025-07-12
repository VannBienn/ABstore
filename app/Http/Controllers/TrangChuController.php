<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;
use App\Models\SanPham;

class TrangChuController extends Controller
{
    public function index()
    {
        $sanPhamNoiBat = SanPham::where('noi_bat', true)->paginate(6);
        $sanPhamKhuyenMai = SanPham::where('khuyen_mai', '>', 0)->paginate(6);
        return view('trangchu', compact('sanPhamNoiBat', 'sanPhamKhuyenMai'));
    }
}
