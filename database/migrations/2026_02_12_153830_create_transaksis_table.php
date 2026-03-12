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

            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_alamat')->nullable();

            // Data penerima dan alamat lengkap
            $table->string('nama_penerima');
            $table->string('no_telepon');
            $table->string('email')->nullable();
            $table->string('label_alamat');
            $table->string('detail');

            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');

            $table->string('desa')->nullable();
            $table->bigInteger('village_id')->nullable();
            $table->string('kodepos');
            $table->string('catatan_kurir')->nullable();

            // Data harga dan kurir
            $table->integer('total_harga_produk');
            $table->integer('ongkir');
            $table->integer('total_bayar');
            $table->string('kurir');
            $table->string('layanan_kurir');

            // Status dan resi
            $table->string('status')->default('pending');
            $table->string('resi')->nullable();

            $table->timestamps();

            $table->foreign('id_user')->references('user_id')->on('users')->onDelete('set null');
            $table->foreign('id_alamat')->references('alamat_id')->on('alamats')->onDelete('set null');
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
