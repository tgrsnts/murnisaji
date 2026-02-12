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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('transaksi_id');

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_alamat');

            $table->integer('total_harga_produk');
            $table->integer('ongkir');
            $table->integer('total_bayar');

            $table->string('kurir');
            $table->string('layanan_kurir');

            $table->string('status')->default('PENDING'); // PENDING, PAID, PACKED, SHIPPED, DONE, CANCEL
            $table->string('resi')->nullable();

            $table->longText('snaptoken')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('user_id')->on('users');
            $table->foreign('id_alamat')->references('alamat_id')->on('alamats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
