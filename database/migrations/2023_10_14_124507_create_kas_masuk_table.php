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
        Schema::create('kas_masuk_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_kas_masuk')->nullable();
            $table->string('no_piutang')->nullable();
            $table->string('id_transfer')->nullable();
            $table->date('tanggal_rincian_tagihan')->nullable();
            $table->string('kd_area')->nullable();
            $table->string('kd_outlet')->nullable();
            $table->Integer('nominal')->nullable();
            $table->string('pembayaran_via')->nullable();
            $table->string('no_bg')->nullable();
            $table->date('jatuh_tempo_bg')->nullable();
            $table->enum('flag_transfer_masuk', ['Y', 'N'])->default('N');
            $table->string('bank')->nullable();
            $table->enum('flag_potong_bonus', ['Y', 'N'])->default('N');
            $table->Integer('nominal_bonus')->default(0);
            $table->enum('flag_kas_manual', ['Y', 'N'])->default('N');
            $table->string('terima_dari')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['C', 'O'])->default('O');
            $table->enum('flag_batal', ['Y', 'N'])->default('N');
            $table->datetime('trx_date')->nullable();
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
        Schema::dropIfExists('kas_masuk_header');
    }
};
