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
        Schema::create('transaksi_lkh_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_lkh')->nullable();
            $table->string('area_lkh')->nullable();
            $table->string('kd_gudang')->nullable();
            $table->string('driver')->nullable();
            $table->string('helper')->nullable();
            $table->string('plat_mobil')->nullable();
            $table->datetime('jam_berangkat')->nullable();
            $table->datetime('jam_kembali')->nullable();
            $table->float('km_berangkat_mobil')->nullable();
            $table->float('km_kembali_mobil')->nullable();
            $table->enum('flag_siap_kirim', ['Y', 'N'])->default('N');
            $table->enum('flag_batal', ['Y', 'N'])->default('N');
            $table->datetime('flag_batal_date')->nullable();
            $table->string('flag_batal_by')->nullable();
            $table->enum('status', ['O', 'C'])->default('O');
            $table->string('ket_status')->nullable();
            $table->string('terima_ar')->nullable();
            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_lkh_header');
    }
};
