<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 

class ThanhToanController extends Controller
{
    public function index()
    {
        $giohang = Session::get('giohang', []);
        return view('thanhtoan', compact('giohang'));
    }
}
