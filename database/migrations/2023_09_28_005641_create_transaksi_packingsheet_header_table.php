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
        Schema::create('transaksi_packingsheet_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nops')->nullable();
            $table->string('area_ps')->nullable();
            $table->string('noso')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('nm_outlet')->nullable();
            $table->string('flag_cetak')->nullable();
            $table->datetime('flag_cetak_date')->nullable();
            $table->enum('flag_cetak_label', ['Y', 'N'])->default('N');
            $table->datetime('flag_cetak_label_date')->nullable();
            $table->Integer('koli')->nullable();
            $table->enum('flag_lkh', ['Y', 'N'])->default('N');
            $table->Integer('no_lkh')->nullable();
            $table->datetime('date_lkh')->nullable();
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
        Schema::dropIfExists('transaksi_packingsheet_header');
    }
};
