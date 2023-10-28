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
        Schema::create('invoice_non_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_non');
            $table->string('txt_invoice')->nullable();
            $table->string('customer_to')->nullable();
            $table->string('supplier')->nullable();
            $table->Integer('total_harga')->nullable();
            $table->enum('flag_ppn', ['Y', 'N'])->default('N');
            $table->Integer('total_ppn')->nullable();
            $table->Integer('total_disc_persen')->nullable();
            $table->Integer('total_disc_nominal')->nullable();
            $table->Integer('total_amount')->nullable();
            $table->datetime('tanggal_nota')->nullable();
            $table->datetime('tanggal_jatuh_tempo')->nullable();
            $table->enum('status', ['Y', 'N'])->default('A');
            $table->string('grup_pembayaran')->default('-');
            $table->enum('flag_pembayaran', ['Y', 'N'])->default('N');
            $table->datetime('flag_pembayaran_date')->nullable();
            $table->string('flag_pembayaran_by')->nullable();
            $table->string('flag_pembayaran_via')->nullable();
            $table->string('trx_from')->nullable();
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
        Schema::dropIfExists('invoice_non_header');
    }
};
