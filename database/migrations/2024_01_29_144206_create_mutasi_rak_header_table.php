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
        Schema::create('mutasi_rak_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_mutasi');
            $table->string('rak_asal');
            $table->string('rak_tujuan');
            $table->string('approval_head_gudang');
            $table->datetime('tanggal_cetak_sj_mutasi');
            $table->string('status');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_rak_header');
    }
};
