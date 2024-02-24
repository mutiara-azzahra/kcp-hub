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
        Schema::create('transaksi_akuntansi_jurnal_header', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('trx_date')->nullable();
            $table->string('trx_from')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('catatan')->nullable();
            $table->string('kategori')->nullable();
            $table->enum('flag_batal', ['Y', 'N'])->default('N');
            $table->text('keterangan_batal');
            $table->enum('status', ['Y', 'N'])->default('Y');
            $table->timestamps();
            $table->datetime('created_by')->nullable();
            $table->datetime('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_akuntansi_jurnal_header');
    }
};
