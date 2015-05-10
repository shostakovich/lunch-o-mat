<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRsvpTable extends Migration
{
	public function up()
	{
		Schema::create('rsvps', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('lunch_id');
            $table->enum('rsvp', array('yes', 'no'))->default('yes');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('rsvps');
	}
}
