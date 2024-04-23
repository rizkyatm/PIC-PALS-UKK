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
        Schema::create('report_foto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foto_id');
            $table->unsignedBigInteger('jenis_laporan_id');
            $table->unsignedBigInteger('pelapor_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('foto_id')->references('id')->on('fotos')->onDelete('cascade');
            $table->foreign('jenis_laporan_id')->references('id')->on('jenislaporans')->onDelete('cascade');
            $table->foreign('pelapor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_foto');
    }
};
