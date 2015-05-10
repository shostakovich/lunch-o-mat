<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFounderToCircles extends Migration {
	public function up()
	{
		Schema::table('circles', function(Blueprint $table)
		{
			$table->unsignedInteger('founder_id');
		});
	}

	public function down()
	{
		Schema::table('circles', function(Blueprint $table)
		{
			$table->dropColumn('founder_id');
		});
	}

}
