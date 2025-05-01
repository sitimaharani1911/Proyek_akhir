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
        Schema::create('monev', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelaporan_id');
            $table->string('status_pengajuan_dana');
            $table->string('catatan_pengajuan_dana');
            $table->string('status_sisa_dana');
            $table->string('catatan_sisa_dana');
            $table->string('status_surat_kerja');
            $table->string('catatan_surat_kerja');
            $table->string('status_surat_tugas');
            $table->string('catatan_surat_tugas');
            $table->string('status_laporan_kegiatan');
            $table->string('catatan_laporan_kegiatan');
            $table->string('status_laporan_keuangan');
            $table->string('catatan_laporan_keuangan');
            $table->string('status_luaran');
            $table->string('catatan_luaran');
            $table->string('status_dampak');
            $table->string('catatan_dampak');
            $table->string('status_dokumentasi');
            $table->string('catatan_dokumentasi');
            $table->string('status_lainnya');
            $table->string('catatan_lainnya');
            $table->integer('nilai');
            $table->integer('persentase_capaian');
            $table->string('status');
            $table->string('laporan_monev');
            $table->string('tim_monev');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pelaporan_id')->references('id')->on('pelaporan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monevs');
    }
};
