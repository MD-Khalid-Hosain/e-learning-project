<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('amount');
            $table->text('billing_address');
            $table->string('status');
            $table->string('transaction_id');
            $table->string('currency');
            $table->text('delivery_address')->nullable();
            $table->string('city');
            $table->string('post_code')->nullable();
            $table->string('country');
            $table->string('discount_code')->nullable();
            $table->string('payment_method');
            $table->string('privacy_policy');
            $table->string('terms_and_conditions');
            $table->text('cancel_note')->nullable();
            $table->string('year');
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
        Schema::dropIfExists('orders');
    }
}
