<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_id');
            $table->integer('venue_id');
            $table->integer('event_id');
            $table->timestamp('book_date');
            $table->unsignedInteger('students_count');
            $table->string('gender');
            $table->integer('special_needs');
            $table->integer('need_food_meal');
            $table->json('students_grade');
            $table->string('file_uploads');
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
        Schema::dropIfExists('bookings');
    }
}
