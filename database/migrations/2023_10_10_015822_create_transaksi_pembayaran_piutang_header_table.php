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
        Schema::create('transaksi_pembayaran_piutang_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_piutang')->nullable();
            $table->string('area_piutang')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('nm_outlet')->nullable();
            $table->Integer('nominal_potong')->nullable();
            $table->Integer('nominal_total')->nullable();
            $table->string('pembayaran_via')->nullable();
            $table->string('no_bg')->nullable();
            $table->date('jatuh_tempo_bg')->nullable();
            $table->string('id_bank')->nullable();
            $table->enum('flag_cetak_penerimaan', ['Y', 'N'])->default('N');
            $table->datetime('flag_cetak_penerimaan_date')->nullable();
            $table->enum('flag_terima_kasir', ['Y', 'N'])->default('N');
            $table->datetime('flag_terima_kasir_date')->nullable();
            $table->string('no_kasir_masuk')->nullable();
            $table->enum('flag_batal', ['Y', 'N'])->default('N');
            $table->datetime('flag_batal_date')->nullable();
            $table->text('flag_batal_keterangan')->nullable();
            $table->enum('status', ['C', 'O'])->default('O');
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
        Schema::dropIfExists('transaksi_pembayaran_piutang_header');
    }
};
