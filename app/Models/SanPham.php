<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'san_phams';

    protected $fillable = [
        'ten_san_pham', 'chi_tiet', 'gia', 'hinh_anh',
        'anh_phu_1', 'anh_phu_2', 'anh_phu_3',
        'danh_muc_id', 'tinh_trang', 'noi_bat', 'khuyen_mai'
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMucSanPham::class, 'danh_muc_id');
    }

    // Giá cũ
    public function getGiaCuAttribute()
    {
        return $this->gia;
    }

    // Giá sau khuyến mãi
    public function getGiaMoiAttribute()
    {
        if ($this->khuyen_mai > 0) {
            return $this->gia - ($this->gia * $this->khuyen_mai / 100);
        }
        return $this->gia;
    }
}
