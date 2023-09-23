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
            $table->id();
            $table->string('payment_id');
            $table->foreignId('user_id');
            $table->string('order_id');
            $table->string('email');
            $table->string('contact');
            $table->integer('amount');
            $table->string('status');
            $table->json('notes')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('method');
            $table->integer('amount_refunded');
            $table->string('refund_status')->nullable();
            $table->boolean('captured');
            $table->text('description');
            $table->string('bank');
            $table->string('wallet')->nullable();
            $table->string('vpa')->nullable();
            $table->integer('fee');
            $table->integer('tax');
            $table->string('error_code')->nullable();
            $table->string('error_description')->nullable();
            $table->string('error_source')->nullable();
            $table->string('error_step')->nullable();
            $table->string('error_reason')->nullable();
            $table->json('acquirer_data')->nullable();
            $table->timestamps();
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
