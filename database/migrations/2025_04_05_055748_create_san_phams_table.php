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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_san_pham');
            $table->text('chi_tiet')->nullable();
            $table->decimal('gia', 10, 2);
            $table->string('hinh_anh')->nullable();
    
            $table->unsignedBigInteger('danh_muc_id');
            $table->foreign('danh_muc_id')->references('id')->on('danh_muc_san_phams')->onDelete('cascade');
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
