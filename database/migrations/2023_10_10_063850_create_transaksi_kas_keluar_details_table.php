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
        Schema::create('transaksi_kas_keluar_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_keluar')->nullable();
            $table->string('perkiraan')->nullable();
            $table->string('akuntansi_to')->nullable();
            $table->Integer('total')->default(0);
            $table->enum('status', ['C', 'O'])->default('O');
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
        Schema::dropIfExists('transaksi_kas_keluar_details');
    }
};
