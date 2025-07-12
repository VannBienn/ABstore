<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    protected $fillable = [
        'user_id',
        'san_pham_id',
        'ten_san_pham',
        'gia',
        'gia_khuyen_mai',
        'hinh_anh',
        'so_luong',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}

