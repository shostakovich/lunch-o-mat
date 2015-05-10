<?php namespace App\Services;
use App\Lunch;
use App\User;
use App\RSVP;

class RSVPChangeService {
    protected $lunch;
    protected $user;
    protected $validation;

    public function __construct(Lunch $lunch, User $user)
    {
        $this->lunch = $lunch;
        $this->user = $user;
    }

    public function cancel()
    {
        RSVP::where(['user_id' => $this->user->id, 'lunch_id' => $this->lunch->id])->delete();
        return true;
    }
}
