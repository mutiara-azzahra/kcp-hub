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
        Schema::create('barang_masuk_gudang_details', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('invoice_non');
            $table->string('part_no');
            $table->Integer('qty');
            $table->Integer('id_rak');
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
        Schema::dropIfExists('barang_masuk_gudang_details');
    }
};
