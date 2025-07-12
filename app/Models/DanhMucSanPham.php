<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucSanPham extends Model
{
    use HasFactory;

    protected $table = 'danh_muc_san_phams';

    protected $fillable = [
        'ten_danh_muc',
    ];

    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'danh_muc_id');
    }

    public function danhMucCon()
    {
        return $this->hasMany(DanhMucSanPham::class, 'parent_id');
    }

}
