<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLunchHasOneCircle extends Migration {
	public function up()
	{
		Schema::table('lunches', function(Blueprint $table)
		{
			$table->unsignedInteger('circle_id');
		});
	}

	public function down()
	{
		Schema::table('lunches', function(Blueprint $table)
		{
			$table->dropColumn('circle_id');
		});
	}

}
