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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('id_transaksi');

            $table->string('provider')->default('midtrans');
            $table->string('order_id')->unique();
            $table->longText('snap_token')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('transaction_status')->default('pending');
            $table->string('midtrans_transaction_id')->nullable();
            $table->integer('gross_amount');
            $table->string('fraud_status')->nullable();
            $table->string('status_code')->nullable();
            $table->string('status_message')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->longText('raw_response')->nullable();

            $table->timestamps();

            $table->foreign('id_transaksi')
                  ->references('transaksi_id')
                  ->on('transaksis')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};