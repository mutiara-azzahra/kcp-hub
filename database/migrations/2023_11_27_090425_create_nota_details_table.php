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
        Schema::create('nota_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_non');
            $table->string('part_no');
            $table->string('part_nama');
            $table->Integer('qty');
            $table->Integer('harga');
            $table->Integer('diskon_persen');
            $table->Integer('diskon_nominal');
            $table->Integer('total_harga');
            $table->Integer('ppn_persen');
            $table->Integer('total_ppn');
            $table->Integer('total_diskon_persen');
            $table->Integer('total_amount');
            $table->Integer('amount_nota');
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
        Schema::dropIfExists('nota_details');
    }
};
