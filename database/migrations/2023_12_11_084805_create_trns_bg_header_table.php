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
        Schema::create('trns_bg_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_bg');
            $table->string('status_bg')->nullable();
            $table->string('from_bg')->nullable();
            $table->string('keterangan')->nullable();
            $table->Integer('nominal')->nullable();
            $table->enum('status', ['O', 'C'])->default('O');
            $table->enum('flag_balik', ['Y', 'N'])->default('N');
            $table->enum('flag_batal', ['Y', 'N'])->default('N');
            $table->string('flag_batal_keterangan')->nullable();
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
        Schema::dropIfExists('trns_bg_header');
    }
};
