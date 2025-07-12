<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\GioHang;
use Illuminate\Support\Facades\Auth;

class GioHangController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $giohang = GioHang::where('user_id', $userId)->get(); // Collection các object -> OK
        } else {
            $giohang = collect(session()->get('giohang', []))->map(function ($item, $id) {
                return (object) array_merge($item, ['san_pham_id' => $id]);
            });
            // Giờ mỗi item là object -> dùng ->property được
        }

        return view('frontend.giohang.index', compact('giohang'));
    }

    public function them(Request $request)
    {
        $id = $request->input('sanpham_id');
        $soLuong = (int) $request->input('so_luong', 1);
        $sanPham = SanPham::findOrFail($id);

        $giaGoc = $sanPham->gia;
        $giaSauKM = $giaGoc - ($giaGoc * $sanPham->khuyen_mai / 100);

        if (Auth::check()) {
            $userId = Auth::id();
            $gioHang = GioHang::where('user_id', $userId)->where('san_pham_id', $id)->first();

            if ($gioHang) {
                $gioHang->so_luong += $soLuong;
            } else {
                $gioHang = new GioHang([
                    'user_id' => $userId,
                    'san_pham_id' => $id,
                    'ten_san_pham' => $sanPham->ten_san_pham,
                    'gia' => $giaGoc,
                    'gia_khuyen_mai' => $giaSauKM,
                    'hinh_anh' => $sanPham->hinh_anh,
                    'so_luong' => $soLuong,
                ]);
            }

            $gioHang->save();
        } else {
            $giohang = session()->get('giohang', []);
            if (isset($giohang[$id])) {
                $giohang[$id]['so_luong'] += $soLuong;
            } else {
                $giohang[$id] = [
                    'ten_san_pham' => $sanPham->ten_san_pham,
                    'gia' => $giaGoc,
                    'gia_khuyen_mai' => $giaSauKM,
                    'hinh_anh' => $sanPham->hinh_anh,
                    'so_luong' => $soLuong
                ];
            }
            session()->put('giohang', $giohang);
        }

        return redirect()->route('giohang.index')->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function themBangAjax(Request $request)
    {
        $id = $request->input('sanpham_id');
        $soLuong = (int) $request->input('so_luong', 1);
        $sanPham = SanPham::find($id);

        if (!$sanPham) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm.']);
        }

        $giaGoc = $sanPham->gia;
        $giaSauKM = $giaGoc - ($giaGoc * $sanPham->khuyen_mai / 100);

        if (Auth::check()) {
            $userId = Auth::id();
            $gioHang = GioHang::where('user_id', $userId)->where('san_pham_id', $id)->first();

            if ($gioHang) {
                $gioHang->so_luong += $soLuong;
            } else {
                $gioHang = new GioHang([
                    'user_id' => $userId,
                    'san_pham_id' => $id,
                    'ten_san_pham' => $sanPham->ten_san_pham,
                    'gia' => $giaGoc,
                    'gia_khuyen_mai' => $giaSauKM,
                    'hinh_anh' => $sanPham->hinh_anh,
                    'so_luong' => $soLuong,
                ]);
            }

            $gioHang->save();
        } else {
            $giohang = session()->get('giohang', []);
            if (isset($giohang[$id])) {
                $giohang[$id]['so_luong'] += $soLuong;
            } else {
                $giohang[$id] = [
                    'ten_san_pham' => $sanPham->ten_san_pham,
                    'gia' => $giaGoc,
                    'gia_khuyen_mai' => $giaSauKM,
                    'hinh_anh' => $sanPham->hinh_anh,
                    'so_luong' => $soLuong
                ];
            }
            session()->put('giohang', $giohang);
        }

        return response()->json(['success' => true, 'message' => 'Đã thêm vào giỏ hàng']);
    }

    public function xoa($id)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            GioHang::where('user_id', $userId)->where('san_pham_id', $id)->delete();
        } else {
            $gioHang = session()->get('giohang', []);
            if (isset($gioHang[$id])) {
                unset($gioHang[$id]);
                session()->put('giohang', $gioHang);
            }
        }

        return redirect()->route('giohang.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
}
