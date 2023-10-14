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
        Schema::create('kas_masuk_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_kas_masuk')->nullable();
            $table->string('perkiraan')->nullable();
            $table->enum('akuntansi_to', ['K', 'D'])->nullable();
            $table->Integer('total')->nullable();
            $table->enum('status', ['C', 'O'])->default('O');
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
        Schema::dropIfExists('kas_masuk_details');
    }
};
