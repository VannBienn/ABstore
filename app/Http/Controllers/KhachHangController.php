<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.khachhang.index', compact('users'));
    }

    public function create()
    {
        return view('admin.khachhang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'nullable|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // <-- mã hóa
            'role' => $request->role
        ]);

        return redirect()->route('khachhang.index')->with('success', 'Thêm khách hàng thành công');
    }

    public function edit(User $khachhang)
    {
        return view('admin.khachhang.edit', compact('khachhang'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'nullable|string'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password); 
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('khachhang.index')->with('success', 'Cập nhật khách hàng thành công');
    }
    public function destroy(User $khachhang)
    {
        $khachhang->delete();
        return redirect()->route('khachhang.index')->with('success', 'Xóa thành công');
    }
}
