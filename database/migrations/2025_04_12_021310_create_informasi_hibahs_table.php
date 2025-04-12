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
        Schema::create('informasi_hibah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hibah')->nullable();
            $table->string('prodi_terlibat')->nullable();
            $table->string('kriteria')->nullable();
            $table->string('mitra')->nullable();
            $table->string('skema_hibah')->nullable();
            $table->date('periode_pengajuan_awal')->nullable();
            $table->date('periode_pengajuan_akhir')->nullable();
            $table->integer('status')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_hibah');
    }
};
