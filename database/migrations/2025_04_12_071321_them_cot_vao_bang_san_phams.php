<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->string('tinh_trang')->default('còn hàng');
            $table->boolean('noi_bat')->default(0);
            $table->integer('khuyen_mai')->nullable();
    
            $table->string('anh_phu_1')->nullable();
            $table->string('anh_phu_2')->nullable();
            $table->string('anh_phu_3')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('san_phams', function (Blueprint $table) {
            $table->dropColumn([
                'tinh_trang',
                'noi_bat',
                'khuyen_mai',
                'anh_phu_1',
                'anh_phu_2',
                'anh_phu_3'
            ]);
        });
    }
    
};
