<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMucSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SanPhamController extends Controller
{
    public function index(Request $request)
{
    $query = SanPham::with('danhMuc');

    if ($request->has('keyword') && $request->keyword != '') {
        $query->where('ten_san_pham', 'like', '%' . $request->keyword . '%');
    }

    $sanPhams = $query->orderBy('id', 'desc')->paginate(10)->appends($request->all());

    return view('admin.sanpham.index', compact('sanPhams'));
}


    public function create()
{
    $danhMucs = DanhMucSanPham::all();
    return view('admin.sanpham.create', compact('danhMucs'));
}

public function store(Request $request)
{
    $data = $request->validate([
        'ten_san_pham' => 'required|string|max:255',
        'chi_tiet' => 'nullable|string',
        'gia' => 'required|numeric|min:0',
        'hinh_anh' => 'nullable|image|mimes:jpg,jpeg,png',
        'anh_phu_1' => 'nullable|image|mimes:jpg,jpeg,png',
        'anh_phu_2' => 'nullable|image|mimes:jpg,jpeg,png',
        'anh_phu_3' => 'nullable|image|mimes:jpg,jpeg,png',
        'danh_muc_id' => 'required|exists:danh_muc_san_phams,id',
        'tinh_trang' => 'required|in:còn hàng,hết hàng',
        'noi_bat' => 'required|in:0,1',
        'khuyen_mai' => 'nullable|numeric|min:0|max:100',
    ]);

    // Xử lý ảnh chính
    if ($request->hasFile('hinh_anh')) {
        $file = $request->file('hinh_anh');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $data['hinh_anh'] = $filename;
    }

    // Ảnh phụ
    foreach (['anh_phu_1', 'anh_phu_2', 'anh_phu_3'] as $anhPhu) {
        if ($request->hasFile($anhPhu)) {
            $file = $request->file($anhPhu);
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data[$anhPhu] = $filename;
        }
    }

    try {
        SanPham::create($data);
        return redirect()->route('san-pham.index')->with('success', 'Thêm sản phẩm thành công!');
    } catch (\Exception $e) {
        Log::error('Lỗi thêm sản phẩm: ' . $e->getMessage());
        return back()->with('error', 'Lỗi xảy ra khi thêm sản phẩm!');
    }
}


    public function edit($id)
    {
        $sanPham = SanPham::findOrFail($id);
        $danhMucs = DanhMucSanPham::all();
        return view('admin.sanpham.edit', compact('sanPham', 'danhMucs'));
    }

    public function update(Request $request, $id)
    {
        $sanPham = SanPham::findOrFail($id);
    
        $data = $request->validate([
            'ten_san_pham' => 'required|string|max:255',
            'chi_tiet' => 'nullable|string',
            'gia' => 'required|numeric|min:0',
            'hinh_anh' => 'nullable|image|mimes:jpg,jpeg,png',
            'anh_phu_1' => 'nullable|image|mimes:jpg,jpeg,png',
            'anh_phu_2' => 'nullable|image|mimes:jpg,jpeg,png',
            'anh_phu_3' => 'nullable|image|mimes:jpg,jpeg,png',
            'danh_muc_id' => 'required|exists:danh_muc_san_phams,id',
            'tinh_trang' => 'required|in:còn hàng,hết hàng',
            'noi_bat' => 'required|in:0,1',
            'khuyen_mai' => 'nullable|numeric|min:0|max:100',
        ]);
    
        // Cập nhật ảnh chính nếu có
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['hinh_anh'] = $filename;
        } else {
            $data['hinh_anh'] = $sanPham->hinh_anh; // Giữ ảnh cũ
        }
    
        // Cập nhật ảnh phụ nếu có
        foreach (['anh_phu_1', 'anh_phu_2', 'anh_phu_3'] as $anhPhu) {
            if ($request->hasFile($anhPhu)) {
                $file = $request->file($anhPhu);
                $fileName = $anhPhu . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $fileName);
                $data[$anhPhu] = $fileName;
            } else {
                $data[$anhPhu] = $sanPham[$anhPhu]; // Giữ ảnh cũ
            }
        }
    
        try {
            $sanPham->update($data);
            return redirect()->route('san-pham.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật sản phẩm: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi cập nhật sản phẩm!');
        }
    }
    

    public function destroy($id)
    {
        $sanPham = SanPham::findOrFail($id);
        $sanPham->delete();
        return redirect()->route('san-pham.index')->with('success', 'Xóa sản phẩm thành công!');
    }
    public function show($id)
    {
        $sanPham = SanPham::findOrFail($id); // Lấy sản phẩm theo ID
        
        // Tính giá mới sau khi áp dụng khuyến mãi
        $giaMoi = $sanPham->gia - ($sanPham->gia * $sanPham->khuyen_mai / 100);
    
        // Lấy sản phẩm liên quan (cùng danh mục, loại trừ sản phẩm hiện tại)
        $sanPhamLienQuan = \App\Models\SanPham::where('danh_muc_id', $sanPham->danh_muc_id)
            ->where('id', '!=', $sanPham->id)
            ->take(4)
            ->get();
    
        // Truyền $giaMoi vào view
        return view('chitietsanpham', compact('sanPham', 'sanPhamLienQuan', 'giaMoi'));
    }
    
    

}