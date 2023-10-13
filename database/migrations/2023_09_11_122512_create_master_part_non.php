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
        Schema::create('master_part_non', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('part_no');
            $table->string('part_nama');
            $table->float('diskon');
            $table->Integer('id_supplier');
            $table->Integer('id_kategori_part')->nullable();
            $table->Integer('id_group_part')->nullable();
            $table->Integer('id_produk_part')->nullable();
            $table->Integer('id_kelompok_part')->nullable();
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
        Schema::dropIfExists('master_part_non');
    }
};
