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
        Schema::create('transaksi_lkh_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_lkh')->nullable();
            $table->string('area_lkh')->nullable();
            $table->Integer('no_urut')->nullable();
            $table->string('kd_gudang')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('nm_outlet')->nullable();
            $table->Integer('koli')->nullable();
            $table->string('no_packingsheet')->nullable();
            $table->text('expedisi')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['O', 'C'])->default('O');
            $table->string('ket_status')->nullable();
            $table->string('terima_ar')->nullable();
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
        Schema::dropIfExists('transaksi_lkh_details');
    }
};
