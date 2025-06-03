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
        Schema::create('review_keuangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelaporan_id');
            $table->string('catatan');
            $table->string('status');
            $table->string('auditor');
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
        Schema::dropIfExists('review_keuangan');
    }
};
