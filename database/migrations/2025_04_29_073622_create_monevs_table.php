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
            $table->text('catatan_pengajuan_dana')->nullable();
            $table->string('status_penggunaan_dana');
            $table->text('catatan_penggunaan_dana')->nullable();
            $table->string('status_sisa_dana');
            $table->text('catatan_sisa_dana')->nullable();
            $table->string('status_surat_keputusan');
            $table->text('catatan_surat_keputusan')->nullable();
            $table->string('status_surat_tugas');
            $table->text('catatan_surat_tugas')->nullable();
            $table->string('status_laporan_kegiatan');
            $table->text('catatan_laporan_kegiatan')->nullable();
            $table->string('status_laporan_keuangan');
            $table->text('catatan_laporan_keuangan')->nullable();
            $table->string('status_luaran');
            $table->text('catatan_luaran')->nullable();
            $table->string('status_dampak');
            $table->text('catatan_dampak')->nullable();
            $table->string('status_dokumentasi');
            $table->text('catatan_dokumentasi')->nullable();
            $table->string('status_lainnya');
            $table->text('catatan_lainnya')->nullable();
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
        Schema::dropIfExists('monev');
    }
};
