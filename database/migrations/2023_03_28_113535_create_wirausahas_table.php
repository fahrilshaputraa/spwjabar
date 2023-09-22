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
        Schema::create('wirausahas', function (Blueprint $table) {
            $table->string('nisn', 20)->primary();
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->bigInteger('id_kcd');
            $table->bigInteger('id_kab');
            $table->string('npsn_sekolah', 20);
            $table->string('jurusan');
            $table->string('kelas');
            $table->string('nama_kepsek');
            $table->string('jenis_usaha');
            $table->string('merk_brand');
            $table->bigInteger('omset');
            $table->string('tempat_berjualan');
            $table->string('nib', 11)->nullable();
            $table->year('tahun_rekap');
            $table->string('laporan_keuangan')->nullable();
            $table->string('foto_produk')->nullable();
            $table->text('deskripsi_produk')->nullable();
            $table->text('link_produk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wirausahas');
    }
};
