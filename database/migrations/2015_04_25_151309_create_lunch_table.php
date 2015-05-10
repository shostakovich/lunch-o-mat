<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunchTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lunches', function (Blueprint $table) {
			$table->increments('id');
            $table->unsignedInteger('circle_id');
			$table->dateTime('starts_at');
			$table->tinyInteger('duration_in_minutes')->unsigned();
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
		Schema::drop('lunches');
	}

}
