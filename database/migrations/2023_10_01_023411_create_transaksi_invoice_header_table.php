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
        Schema::create('transaksi_invoice_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('noinv')->nullable();
            $table->string('noso')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('nm_outlet')->nullable();
            $table->Integer('amount_dpp')->nullable();
            $table->Integer('amount_ppn')->nullable();
            $table->Integer('amount')->nullable();
            $table->Integer('amount_disc')->nullable();
            $table->Integer('amount_dpp_disc')->nullable();
            $table->Integer('amount_ppn_disc')->nullable();
            $table->Integer('amount_total')->nullable();
            $table->enum('status', ['O', 'C'])->default('O');
            $table->string('ket_status')->nullable();
            $table->string('catatan')->nullable();
            $table->string('user_sales')->nullable();
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->Integer('count_cetak')->default(0);
            $table->enum('flag_batal', ['Y', 'N'])->default('N');
            $table->datetime('flag_batal_date')->nullable();
            $table->enum('flag_pembayaran_lunas', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('transaksi_invoice_header');
    }
};
