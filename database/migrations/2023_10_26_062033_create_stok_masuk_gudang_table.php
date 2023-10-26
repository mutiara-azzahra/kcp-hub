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
        Schema::create('stok_masuk_gudang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_surat_pesanan')->nullable();
            $table->string('part_no')->nullable();
            $table->Integer('jumlah_barang')->nullable();
            $table->Integer('harga_per_pcs')->nullable();
            $table->Integer('total_harga')->nullable();
            $table->datetime('tanggal_barang_diterima')->nullable();
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
        Schema::dropIfExists('stok_masuk_gudang');
    }
};
