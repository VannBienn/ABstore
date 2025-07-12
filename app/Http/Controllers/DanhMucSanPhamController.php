<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMucSanPham;

class DanhMucSanPhamController extends Controller
{
    public function index()
    {
        $danhMucs = DanhMucSanPham::all();
        return view('admin.danhmuc.index', compact('danhMucs'));
    }

    public function create()
    {
        return view('admin.danhmuc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
        ]);

        DanhMucSanPham::create($request->only('ten_danh_muc'));
        return redirect()->route('danh-muc.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function edit($id)
    {
        $danhMuc = DanhMucSanPham::findOrFail($id);
        return view('admin.danhmuc.edit', compact('danhMuc'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_danh_muc' => 'required|string|max:255',
        ]);

        $danhMuc = DanhMucSanPham::findOrFail($id);
        $danhMuc->update($request->only('ten_danh_muc'));

        return redirect()->route('danh-muc.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        DanhMucSanPham::destroy($id);
        return redirect()->route('danh-muc.index')->with('success', 'Xóa thành công!');
    }
}
