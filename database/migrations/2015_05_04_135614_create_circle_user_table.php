<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircleUserTable extends Migration {
	public function up()
	{
		Schema::create('circle_user', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('circle_id');
			$table->unsignedInteger('user_id');
			$table->timestamps();

			$table->foreign('circle_id')->references('id')->on('circles');
			$table->foreign('user_id')->references('id')->on('users');

		});

	}

	public function down()
	{
		Schema::drop('circle_user');
	}
}
