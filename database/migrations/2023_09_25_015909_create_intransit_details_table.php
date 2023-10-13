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
        Schema::create('intransit_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_packingsheet')->nullable();
            $table->string('no_doos')->nullable();
            $table->string('part_no')->nullable();
            $table->Integer('qty')->nullable();
            $table->Integer('harga_pcs')->nullable();
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
        Schema::dropIfExists('intransit_details');
    }
};
