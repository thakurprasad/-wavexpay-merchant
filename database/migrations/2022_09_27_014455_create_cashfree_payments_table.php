<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashfreePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashfree_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->float('order_amount');
            $table->string('reference_id', 255);
            $table->string('txstatus', 64);
            $table->string('payment_mode', 64);
            $table->string('refund_id', 64)->nullable();
            $table->string('txmsg', 255);
            $table->dateTime('txtime');
            $table->string('sign', 255);
            $table->timestamps();
 		    $table->foreign('order_id')->references('id')->on('cashfree_orders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashfree_payments');
    }
}
