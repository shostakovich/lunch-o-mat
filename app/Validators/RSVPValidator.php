<?php
namespace App\Validators;

use App\Lunch;
use App\User;
use Validator;
use Illuminate\Validation\Validator as Validation;

class RSVPValidator {
	protected $lunch;
	protected $user;

	public function __construct(Lunch $lunch, User $user)
	{
		$this->lunch = $lunch;
		$this->user = $user;
	}

	public function passes($attributes)
	{
		return $this->validator($attributes)->passes();
	}

	public function getErrors($attributes)
	{
		return $this->validator($attributes)->messages();
	}
    protected function validator($attributes)
    {
        return Validator::make(
            $attributes,
            [
                'user_id' => 'required|numeric',
                'lunch_id' => 'required|numeric',
                'rsvp' => 'required|in:yes,no'
            ]
        )->after($this->rsvpRulesCheck());
    }

    protected function rsvpRulesCheck()
    {
        return function (Validation $v) {
            $is_circle_member = $this->lunch->circle->isMember($this->user);

            if (!$is_circle_member)
                $v->errors()->add('user_id', 'You are not a member of this circle');

            if ($this->lunch->isExpired())
                $v->errors()->add('lunch_id', 'This Lunch has expired');

        };
    }
}
