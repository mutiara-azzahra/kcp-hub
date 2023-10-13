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
        Schema::create('transaksi_pembayaran_piutang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('noinv')->nullable();
            $table->string('no_piutang')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('nm_outlet')->nullable();
            $table->Integer('nominal')->nullable();
            $table->string('pembayaran_via')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('no_bg')->nullable();
            $table->date('jatuh_tempo_bg')->nullable();
            $table->Integer('id_bank')->nullable();
            $table->enum('flag_cetak_kwitansi', ['Y', 'N'])->default('N');
            $table->datetime('flag_cetak_kwitansi_date')->nullable();
            $table->datetime('no_kas_masuk')->nullable();
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
        Schema::dropIfExists('transaksi_pembayaran_piutang');
    }
};
