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
        Schema::create('transaksi_rincian_account_receiveable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kd_toko');
            $table->string('noinv');
            $table->string('keterangan');
            $table->enum('flag_terima', ['Y', 'N'])->default('N');
            $table->enum('status', ['Y', 'N'])->default('Y');
            $table->timestamps();
            $table->datetime('created_by')->nullable();
            $table->datetime('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_rincian_account_receiveable');
    }
};
