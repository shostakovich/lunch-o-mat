<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLunchHasOneCircle extends Migration {
	public function up()
	{
		Schema::table('lunches', function(Blueprint $table)
		{
			$table->unsignedInteger('circle_id');

			$table->foreign('circle_id')->references('id')->on('circles');

		});
	}

	public function down()
	{
		Schema::table('lunches', function(Blueprint $table)
		{
			$table->dropForeign('lunches_circle_id_foreign');
			$table->dropColumn('circle_id');
		});
	}

}
