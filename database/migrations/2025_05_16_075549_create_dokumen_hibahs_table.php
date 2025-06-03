<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumen_hibah', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kontrak');
            $table->string('berita_acara');
            $table->string('verifikasi_kelayakan');
            $table->string('kerangka_acuan_kerja');
            $table->string('sk_tim_hibah'); 
            $table->softDeletes();
            $table->unsignedBigInteger('informasi_hibah_id');
            $table->foreign('informasi_hibah_id')->references('id')->on('informasi_hibah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_hibah');
    }
};
