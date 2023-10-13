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
        Schema::create('transaksi_sj_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nosj')->nullable();
            $table->string('area_sj')->nullable();
            $table->string('nops')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('nm_outlet')->nullable();
            $table->Integer('koli')->nullable();
            $table->enum('status', ['O', 'C'])->default('O');
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
        Schema::dropIfExists('transaksi_sj_details');
    }
};
