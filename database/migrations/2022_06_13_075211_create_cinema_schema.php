<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /**
    # Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different locations

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
		Schema::create('locations', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
		Schema::create('cinemas', function($table) {
            $table->increments('id');
            $table->string('flim_name');
            $table->timestamps();
        });
		Schema::create('cinema_locations', function($table) {
            $table->integer('cinema_id');
            $table->string('location_id');
            $table->timestamps();
        });
		Schema::create('cinema_location_slots', function($table) {
            $table->integer('cinema_location_id');
			$table->date('slot_date');
            $table->time('slot_time');
			$table->integer('available_seat')->default(100);
            $table->timestamps();
        });
		Schema::create('cinema_location_slots_tickets', function($table) {
            $table->integer('cinema_location_slot_id');
			$table->string('ticket_type');
            $table->integer('ticket_price');
            $table->timestamps();
        });
		Schema::create('cinema_bookings', function($table) {
            $table->integer('cinema_location_slot_id');
            $table->integer('cinema_location_slots_ticket_id)');
			$table->integer('user_id');
			// seat no in array format
			$table->text('seat_no');
			$table->integer('total_seat');
			$table->integer('total_amount');
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
		Schema::dropIfExists('locations');
		Schema::dropIfExists('cinemas');
		Schema::dropIfExists('cinema_locations');
		Schema::dropIfExists('cinema_location_slots');
		Schema::dropIfExists('cinema_location_slots_tickets');
		Schema::dropIfExists('cinema_bookings');
    }
}
