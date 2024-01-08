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
        Schema::create('retur_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_retur');
            $table->string('part_no');
            $table->Integer('qty_invoice');
            $table->Integer('qty_retur');
            $table->string('keterangan');
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
        Schema::dropIfExists('retur_details');
    }
};
