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
        Schema::create('lss_stok', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('bulan');
            $table->Integer('tahun');
            $table->string('sub_kelompok_part');
            $table->string('produk_part');
            $table->Integer('awal_stok');
            $table->Integer('beli');
            $table->Integer('jual');
            $table->Integer('akhir_stok');
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
        Schema::dropIfExists('lss_stok');
    }
};
