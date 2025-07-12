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
        Schema::create('gio_hangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('san_pham_id')->constrained('san_phams')->onDelete('cascade');
            $table->string('ten_san_pham');
            $table->decimal('gia', 10, 2);
            $table->decimal('gia_khuyen_mai', 10, 2)->nullable();
            $table->string('hinh_anh')->nullable();
            $table->integer('so_luong')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('gio_hangs');
    }
};
