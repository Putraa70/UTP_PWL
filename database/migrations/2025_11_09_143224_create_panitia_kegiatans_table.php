<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('panitia_kegiatan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('kegiatan_id');
            $table->string('jabatan')->nullable(); // contoh: Ketua Pelaksana
            $table->text('catatan')->nullable();   // terenkripsi
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')->cascadeOnDelete();
            $table->unique(['user_id', 'kegiatan_id']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('panitia_kegiatan');
    }
};
