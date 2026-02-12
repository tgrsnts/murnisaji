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
        Schema::create('alamats', function (Blueprint $table) {
            $table->id('alamat_id');

            $table->unsignedBigInteger('id_user');
            $table->string('nama_penerima');
            $table->string('no_telepon');
            $table->string('label_alamat');
            $table->string('detail');

            $table->string('provinsi');
            $table->integer('province_id');

            $table->string('kabupaten');
            $table->integer('city_id');

            $table->string('kecamatan');
            $table->string('kodepos');

            $table->boolean('isPrimary')->default(false);
            $table->string('catatan_kurir')->nullable();

            $table->timestamps();

            $table->foreign('id_user')
                ->references('user_id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamats');
    }
};
