<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model {
    protected $table = 'lunches';
    protected $fillable = array('starts_at', 'duration_in_minutes');

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
        return $this->belongsToMany('App\User');
    }
}
