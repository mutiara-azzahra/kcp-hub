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
        Schema::create('transaksi_bo_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nobo')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('nm_outlet')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('status', ['O', 'C'])->default('O');
            $table->string('ket_status')->nullable();
            $table->string('ket_batal')->nullable();
            $table->string('noso_out')->nullable();
            $table->string('noso_in')->nullable();
            $table->string('user_sales')->nullable();
            $table->string('gudang_bo')->nullable();
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
        Schema::dropIfExists('transaksi_bo_header');
    }
};
