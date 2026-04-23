<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking_resi', function (Blueprint $table) {
            $table->id('tracking_id');
            $table->string('no_resi');
            $table->string('kurir');
            $table->string('status_terakhir')->nullable();
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->json('raw_response')->nullable();
            $table->timestamps();
            $table->unique(['no_resi', 'kurir']);
            $table->index('last_checked_at');
            $table->index('delivered_at');
        });

        Schema::create('tracking_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tracking_id');
            $table->string('status');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->timestamp('waktu');
            $table->timestamps();
            $table->unique(['tracking_id', 'waktu']);
            $table->index(['tracking_id', 'waktu']);
            $table->foreign('tracking_id')->references('tracking_id')->on('tracking_resi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['tracking_id']);
            $table->dropColumn('tracking_id');
        });
        Schema::dropIfExists('tracking_history');
        Schema::dropIfExists('tracking_resi');
    }
};
