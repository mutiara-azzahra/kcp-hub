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
        Schema::create('transaksi_kas_keluar_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_keluar')->nullable();
            $table->string('divisi')->nullable();
            $table->text('pembayaran')->nullable();
            $table->text('keterangan')->nullable();
            $table->Integer('amount_total')->default(0);
            $table->enum('flag_cetak', ['Y', 'N'])->default('N');
            $table->enum('flag_batal', ['Y', 'N'])->default('N');
            $table->datetime('trx_date')->nullable();
            $table->enum('status', ['A', 'N'])->default('A');
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
        Schema::dropIfExists('transaksi_kas_keluar_header');
    }
};
