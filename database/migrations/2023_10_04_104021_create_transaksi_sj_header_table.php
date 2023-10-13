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
        Schema::create('transaksi_sj_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nosj')->nullable();
            $table->enum('flag_cetak', ['Y', 'N'])->default('N');
            $table->datetime('flag_cetak_date')->nullable();
            $table->enum('status', ['O', 'C'])->default('O');
            $table->string('ket_status')->nullable();
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
        Schema::dropIfExists('transaksi_sj_header');
    }
};
