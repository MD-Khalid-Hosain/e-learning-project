<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('category_slug');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('product_name');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('updated_admin_id')->nullable();
            $table->string('slug');
            $table->string('main_image')->default('khalid.jpg');
            $table->string('product_multiple_image')->nullable();//json data
            $table->integer('price');
            $table->tinyInteger('status');
            $table->text('product_description');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_mpn')->nullable();
            $table->integer('regular_price')->nullable();
            $table->unsignedBigInteger('component_id')->nullable();
            $table->string('product_stock');
            $table->string('support')->nullable();
            $table->string('processor')->nullable();
            $table->string('previous_price')->nullable();
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->string('offer_percent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     *
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
