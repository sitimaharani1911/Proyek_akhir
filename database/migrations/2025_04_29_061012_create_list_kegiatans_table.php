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
        Schema::create('list_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id');
            $table->string('jenis_aktivitas');
            $table->string('nama_kegiatan');
            $table->string('ketua_pelaksana_kegiatan');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->string('rentang_pengerjaan');
            $table->string('panitia_pengerjaan');
            $table->string('tempat_pelaksanaan');
            $table->string('surat_keputusan');
            $table->string('surat_tugas');
            $table->string('template_laporan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('proposal_id')->references('id')->on('proposal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_kegiatan');
    }
};
