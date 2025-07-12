<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $fillable = ['user_id', 'tong_tien', 'trang_thai', 'dia_chi', 'ghi_chu'];

    public function chiTiet()
    {
        return $this->hasMany(ChiTietDonHang::class, 'don_hang_id');
    }
}
