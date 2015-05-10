<?php namespace App\Services;
use App\Lunch;
use App\User;
use App\LunchUser;

class LunchParticipationCancelingService {
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
        LunchUser::where(['user_id' => $this->user->id, 'lunch_id' => $this->lunch->id])->delete();
        return true;
    }
}
