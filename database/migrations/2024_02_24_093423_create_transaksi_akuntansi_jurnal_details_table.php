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
        Schema::create('transaksi_akuntansi_jurnal_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_header');
            $table->string('perkiraan')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('kategori')->nullable();
            $table->decimal('debet')->nullable();
            $table->decimal('kredit')->nullable();
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
        Schema::dropIfExists('transaksi_akuntansi_jurnal_details');
    }
};
