<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table = 'tin_tucs';

    protected $fillable = [
        'tieu_de', 'mo_ta_ngan', 'noi_dung', 'hinh_anh', 'ngay_dang',
    ];

}
