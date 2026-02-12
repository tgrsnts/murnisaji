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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('rating_id');

            $table->unsignedBigInteger('id_transaksi_item');
            $table->integer('rating'); // 1-5
            $table->string('comment')->nullable();
            $table->longText('gambar')->nullable();

            $table->timestamps();

            $table->foreign('id_transaksi_item')
                ->references('transaksi_item_id')->on('transaksi_items')
                ->onDelete('cascade');

            $table->unique('id_transaksi_item'); // 1 item = 1 rating
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
