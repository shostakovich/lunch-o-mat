<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCirclesTable extends Migration
{
	public function up()
	{
		Schema::create('circles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->text('description')->nullable();
            $table->unsignedInteger('founder_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('circles');
	}

}
