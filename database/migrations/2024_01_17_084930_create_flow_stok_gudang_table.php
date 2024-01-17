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
        Schema::create('flow_stok_gudang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_no');
            $table->datetime('tanggal_barang_masuk');
            $table->datetime('tanggal_barang_keluar');
            $table->Integer('stok_awal');
            $table->Integer('stok_masuk');
            $table->Integer('stok_keluar');
            $table->Integer('stok_akhir');
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
        Schema::dropIfExists('flow_stok_gudang');
    }
};
