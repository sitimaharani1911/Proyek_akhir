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
        Schema::create('pelaporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('list_kegiatan_id');
            $table->date('tanggal');
            $table->integer('jumlah_peserta');
            $table->string('absensi_peserta');
            $table->integer('pengajuan_dana');
            $table->integer('sisa_dana');
            $table->string('surat_kerja');
            $table->string('surat_tugas');
            $table->string('laporan_kegiatan');
            $table->string('laporan_keuangan');
            $table->string('luaran');
            $table->string('dampak');
            $table->string('dokumentasi');
            $table->string('lainnya');
            $table->string('bukti_pembayaran');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('list_kegiatan_id')->references('id')->on('list_kegiatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporans');
    }
};
