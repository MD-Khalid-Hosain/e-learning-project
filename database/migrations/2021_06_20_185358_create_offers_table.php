<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_name');
            $table->string('slug');
            $table->string('offer_type');
            $table->string('offer_title');
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('description');
            $table->json('product_id');
            $table->string('status');
            $table->text('meta_title');
            $table->text('meta_description');
            $table->string('image');
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
        Schema::dropIfExists('offers');
    }
}
