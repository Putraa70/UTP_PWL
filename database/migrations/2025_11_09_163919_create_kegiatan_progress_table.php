<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kegiatan_progress', function (Blueprint $t) {
            $t->uuid('id')->primary();
            $t->uuid('kegiatan_id');
            $t->uuid('user_id'); // pembuat progres
            $t->string('judul', 120);
            $t->text('deskripsi')->nullable();
            $t->unsignedTinyInteger('persen')->default(0); // 0..100
            $t->enum('status', ['PLANNED', 'ONGOING', 'BLOCKED', 'DONE'])->default('ONGOING');
            $t->string('lampiran_path')->nullable(); // kalau mau upload file nanti
            $t->timestamps();

            $t->foreign('kegiatan_id')->references('id')->on('kegiatans')->cascadeOnDelete();
            $t->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_progress');
    }
};
