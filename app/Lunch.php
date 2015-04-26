<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model {
    protected $table = 'lunches';
    protected $fillable = array('starts_at', 'duration_in_minutes');

    /**
     * Calculates when the lunch will end
     *
     * @return Carbon
     */
    public function ends_at()
    {
        return Carbon::instance($this->starts_at)->addMinutes($this->duration_in_minutes);
    }

    /**
     * Registers a participant for a lunch
     *
     * @param User $participant
     */
    public function addParticipant(User $participant)
    {
        $this->participants()->save($participant);
    }

    /**
     * A lunch has many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participants()
    {
        return $this->belongsToMany('App\User');
    }
}
