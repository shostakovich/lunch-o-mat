<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Circle extends Model {
	protected $fillable = array('name', 'description', 'founder_id');

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

    public function founder()
    {
        return $this->belongsTo('App\User', 'founder_id');
    }

	public function isMember(User $user)
	{
		return $this->members()->where(['user_id' => $user->id])->count() > 0;
	}
}
