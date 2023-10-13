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
        Schema::create('persediaan_stok_gudang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_no');
            $table->Integer('stok_masuk');
            $table->Integer('harga_beli_per_pcs');
            $table->string('no_invoice');
            $table->Integer('jual_stok');
            $table->Integer('on_hand_persediaan'); // stok masuk - jual stok
            $table->Integer('nominal_persediaan_stok'); // stok masuk - jual stok * beli_pcs
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
        Schema::dropIfExists('persediaan_stok_gudang');
    }
};
