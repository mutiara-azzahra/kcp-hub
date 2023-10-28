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
        Schema::create('barang_masuk_gudang_header', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_non');
            $table->string('customer_to')->nullable();
            $table->string('supplier')->nullable();
            $table->datetime('tanggal_nota')->nullable();
            $table->enum('status', ['Y', 'N'])->default('Y');
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
        Schema::dropIfExists('barang_masuk_gudang_header');
    }
};
