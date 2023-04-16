<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_events', function (Blueprint $table) {
            $table->id();
            $table->string('exam_title');
            $table->string('slug');
            $table->string('exam_date');
            $table->integer('exam_duration');
            $table->integer('exam_fee');
            $table->integer('total_participants')->nullable();
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
        Schema::dropIfExists('exam_events');
    }
}
