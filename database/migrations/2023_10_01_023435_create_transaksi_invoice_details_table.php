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
        Schema::create('transaksi_invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('noinv')->nullable();
            $table->string('area_inv')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->string('part_no')->nullable();
            $table->string('nm_part')->nullable();
            $table->Integer('qty')->nullable();
            $table->Integer('hrg_pcs')->nullable();
            $table->Integer('disc')->nullable();
            $table->Integer('nominal')->nullable();
            $table->Integer('nominal_disc')->nullable();
            $table->Integer('nominal_disc_ppn')->nullable();
            $table->Integer('nominal_total')->nullable();
            $table->enum('status', ['A', 'N'])->default('N');
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
        Schema::dropIfExists('transaksi_invoice_details');
    }
};
