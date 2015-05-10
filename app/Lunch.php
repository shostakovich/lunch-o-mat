<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model {
    protected $table = 'lunches';
    protected $fillable = array('starts_at', 'circle_id', 'duration_in_minutes');
	protected $dates = ['starts_at'];

	public function scopeUpcoming($query)
	{
		$query->where('starts_at', '>', Carbon::now()->endOfDay());
	}

	public function isExpired()
	{
		return $this->starts_at <= Carbon::now()->endOfDay();
	}

    public function endsAt()
    {
        return Carbon::instance($this->starts_at)->addMinutes($this->duration_in_minutes);
    }

    public function addParticipant(User $participant)
    {
        $this->participants()->save($participant);
    }

    public function participants()
    {
        return $this->belongsToMany('App\User', 'rsvps');
    }

	public function circle()
	{
		return $this->belongsTo('App\Circle');
	}

	public function isSignedUp(User $user)
	{
		return 0 < $this->participants()->where(['user_id' => $user->id])->count();
	}
}
