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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_berkas');
            $table->string('nomor_berkas');
            $table->enum('kategori_berkas', ['Surat Masuk', 'Surat Keluar', 'Surat SK', 'Surat Penting', 'Surat Arsip'])->default('Surat Masuk');
            $table->date('tanggal_berkas')->nullable();
            $table->string('file_berkas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
