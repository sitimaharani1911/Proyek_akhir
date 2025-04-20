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
        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->integer('informasi_hibah_id')->nullable();
            $table->string('judul_proposal')->nullable();
            $table->text('abstrak')->nullable();
            $table->string('ketua_hibah')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('nilai')->nullable();
            $table->integer('persetujuan_piu')->nullable();
            $table->integer('persetujuan_direktur')->nullable();
            $table->integer('status_internal')->nullable();
            $table->integer('status_eksternal')->nullable();
            $table->integer('status_progres')->nullable();
            $table->string('file_proposal')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->string('bukti_ss')->nullable();
            $table->string('file_sk')->nullable();
            $table->string('file_st')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal');
    }
};
