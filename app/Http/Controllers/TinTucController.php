<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;

class TinTucController extends Controller
{
    public function index()
    {
        $dsTinTuc = TinTuc::latest()->get();
        return view('admin.tintuc.index', compact('dsTinTuc'));
    }

    public function indexFrontend()
    {
        $dsTinTuc = TinTuc::orderBy('ngay_dang', 'desc')->get();
        return view('frontend.tintuc.index', compact('dsTinTuc'));
    }

    public function create()
    {
        return view('admin.tintuc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg',
            'ngay_dang' => 'required|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tintuc'), $name);
            $data['hinh_anh'] = $name;
        }

        TinTuc::create($data);

        return redirect()->route('tin-tuc.index')->with('success', 'Đã thêm tin tức mới!');
    }

    public function edit($id)
    {
        $tinTuc = TinTuc::findOrFail($id);
        return view('admin.tintuc.edit', compact('tinTuc'));
    }

    public function update(Request $request, $id)
    {
        $tinTuc = TinTuc::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tintuc'), $name);
            $data['hinh_anh'] = $name;
        }

        $tinTuc->update($data);

        return redirect()->route('tin-tuc.index')->with('success', 'Đã cập nhật tin tức!');
    }

    public function show($id)
    {
       $tinTuc = TinTuc::findOrFail($id);
    return view('frontend.tintuc.show', compact('tinTuc'));
    }

    public function destroy($id)
    {
        $tinTuc = TinTuc::findOrFail($id);
        $tinTuc->delete();

        return redirect()->route('tin-tuc.index')->with('success', 'Đã xóa tin tức!');
    }
}
