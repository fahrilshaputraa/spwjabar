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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id('id_rekap');
            $table->string('email');
            $table->string('nama_guru');
            $table->string('nip', 45);
            $table->string('no_hp', 15);
            $table->string('npsn_sekolah');
            $table->string('no_hp_sekolah');
            $table->string('nama_kepsek');
            $table->bigInteger('jml_siswa_dibina');
            $table->bigInteger('jml_siswa_konsisten');
            $table->bigInteger('jml_siswa_nib');
            $table->bigInteger('jmls_omset1');
            $table->bigInteger('jmls_omset2');
            $table->bigInteger('jmls_omset3');
            $table->bigInteger('jmls_omset4');
            $table->bigInteger('jmls_almni_pengusaha');
            $table->bigInteger('jmls_almni_pirt');
            $table->string('data_excel');
            $table->bigInteger('tahun_rekap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
