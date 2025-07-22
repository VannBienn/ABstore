<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangAdminController extends Controller
{
    public function index()
    {
        $donHangs = DonHang::with('chiTietDonHang.sanPham', 'user')->latest()->paginate(10);
        return view('admin.donhang.index', compact('donHangs'));
    }

    public function show($id)
    {
        $donHang = DonHang::with('chiTietDonHang.sanPham', 'user')->findOrFail($id);
        return view('admin.donhang.show', compact('donHang'));
    }

    public function updateTrangThai(Request $request, $id)
    {
        $request->validate([
            'trang_thai' => 'required|string',
        ]);

        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = $request->trang_thai;
        $donHang->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }
}
