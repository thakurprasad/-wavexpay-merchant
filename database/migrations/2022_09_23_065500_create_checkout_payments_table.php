<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_payments_razorpay', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->double('amount');
            $table->string('currency')->nullable();
            $table->string('status')->nullable();
            $table->string('order_id')->nullable();
            $table->string('method')->nullable();
            $table->string('amount_refunded')->nullable();
            $table->string('bank')->nullable();
            $table->string('wallet')->nullable();
            $table->string('entity')->nullable();
            $table->string('refund_Date')->nullable();
            $table->string('bank_transaction_id')->nullable();
            $table->string('refund_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout_payments');
    }
}
