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
		});

	}

	public function down()
	{
		Schema::drop('circle_user');
	}
}
