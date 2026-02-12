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
        Schema::create('transaksi_items', function (Blueprint $table) {
            $table->id('transaksi_item_id');

            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_produk');

            $table->integer('quantity');
            $table->integer('harga_saat_beli');
            $table->boolean('israted')->default(false);

            $table->timestamps();

            $table->foreign('id_transaksi')
                ->references('transaksi_id')->on('transaksis')
                ->onDelete('cascade');

            $table->foreign('id_produk')
                ->references('produk_id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_items');
    }
};
