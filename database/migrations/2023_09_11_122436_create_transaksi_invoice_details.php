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
        Schema::create('transaksi_invoice_details', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('no_invoice');
            $table->string('area_invoice');
            $table->string('kode_outlet');
            $table->string('part_no');
            $table->Integer('qty');
            $table->Integer('harga_per_pcs');
            $table->float('diskon');
            $table->Integer('nominal');
            $table->Integer('nominal_diskon');
            $table->Integer('nominal_diskon_ppn');
            $table->Integer('nominal_total');
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
        Schema::dropIfExists('transaksi_invoice_details');
    }
};
