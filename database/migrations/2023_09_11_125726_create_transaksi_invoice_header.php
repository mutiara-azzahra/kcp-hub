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
            $table->datetime('trx_date');
            $table->text('trx_from');
            $table->text('keterangan')->nullable();
            $table->text('catatan')->nullable();
            $table->text('kategori')->nullable();
            $table->enum('flag_batal', ['A', 'N'])->default('N');
            $table->string('keterangan_batal')->nullable();
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
