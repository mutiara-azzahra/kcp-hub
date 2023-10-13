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
        Schema::create('transaksi_packingsheet_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nops')->nullable();
            $table->string('area_ps')->nullable();
            $table->string('noso')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('part_no')->nullable();
            $table->Integer('qty')->nullable();
            $table->string('dus')->nullable();
            $table->Integer('no_dus')->nullable();
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
        Schema::dropIfExists('transaksi_packingsheet_details');
    }
};
