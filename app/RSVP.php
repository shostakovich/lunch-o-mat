<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RSVP extends Model {
	protected $table = 'rsvps';
	protected $fillable = ['user_id', 'lunch_id'];
}
