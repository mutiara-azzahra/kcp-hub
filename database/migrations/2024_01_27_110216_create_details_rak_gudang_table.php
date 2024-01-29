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
        Schema::create('details_rak_gudang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_non');
            $table->string('part_no');
            $table->Integer('id_rak');
            $table->string('keterangan');
            $table->Integer('qty_awal');
            $table->Integer('qty_masuk');
            $table->Integer('qty_keluar');
            $table->Integer('qty_akhir');
            $table->Integer('qty_akhir');
            $table->datetime('tanggal_barang_masuk');
            $table->datetime('tanggal_barang_keluar');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_rak_gudang');
    }
};
