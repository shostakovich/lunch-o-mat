<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Circle extends Model {
	protected $fillable = array('name', 'description');

	public function lunches()
	{
		return $this->hasMany('App\Lunch');
	}

	public function upcomingLunches()
	{
		return $this->lunches()->upcoming();
	}

	public function members()
	{
		return $this->belongsToMany('App\User');
	}

	public function isMember(User $user)
	{
		return $this->members()->where(['user_id' => $user->id])->count() > 0;
	}
}
