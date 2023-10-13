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
        Schema::create('transaksi_bo_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nobo')->nullable();
            $table->string('area_bo')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('part_no')->nullable();
            $table->string('nm_part')->nullable();
            $table->Integer('qty')->nullable();
            $table->Integer('hrg_pcs')->nullable();
            $table->Integer('disc')->nullable();
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
        Schema::dropIfExists('transaksi_bo_details');
    }
};
