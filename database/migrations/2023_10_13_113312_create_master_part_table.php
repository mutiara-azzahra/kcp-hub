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
        Schema::create('master_part', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_no')->nullable();
            $table->string('part_nama')->nullable();
            $table->Integer('het')->nullable();
            $table->Integer('satuan_dus')->nullable();
            $table->Integer('id_grup')->nullable();
            $table->Integer('id_rak')->nullable();
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
        Schema::dropIfExists('master_part');
    }
};
