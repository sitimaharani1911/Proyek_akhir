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
            $table->string('jumlah_peserta');
            $table->string('absensi_peserta');
            $table->integer('pengajuan_dana');
            $table->integer('penggunaan_dana');
            $table->integer('sisa_dana');
            $table->string('surat_keputusan');
            $table->string('surat_tugas');
            $table->string('laporan_kegiatan');
            $table->string('laporan_keuangan');
            $table->string('luaran_kegiatan');
            $table->integer('jumlah_luaran');
            $table->string('satuan_luaran');
            $table->string('link_luaran');
            $table->string('status_pelaksanaan');
            $table->string('dampak');
            $table->string('dokumentasi');
            $table->string('lainnya')->nullable();
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
        Schema::dropIfExists('pelaporan');
    }
};
