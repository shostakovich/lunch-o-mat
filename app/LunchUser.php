<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LunchUser extends Model {
	protected $table = 'lunch_user';
	protected $fillable = ['user_id', 'lunch_id'];
}
