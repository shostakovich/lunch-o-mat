<?php
namespace App\Validators;

use App\Lunch;
use App\User;
use Validator;
use Illuminate\Validation\Validator as Validation;

class LunchSignupValidator {
	protected $validator;
	protected $lunch;
	protected $user;

	public function __construct(Lunch $lunch, User $user)
	{
		$this->lunch = $lunch;
		$this->user = $user;

		$this->validator = Validator::make(
			[
				'user_id' => $this->user->id,
				'lunch_id' => $this->lunch->id
			],
			[
				'user_id' => 'required|numeric',
				'lunch_id' => 'required|numeric'
			]
		);

		$this->validator->after($this->signUpRulesCheck());
	}

	public function passes()
	{
		return $this->validator->passes();
	}

	public function getErrors()
	{
		return $this->validator->messages();
	}

	protected function signUpRulesCheck()
	{
		return function (Validation $v) {
			$is_circle_member = $this->lunch->circle->isMember($this->user);

			if (!$is_circle_member)
				$v->errors()->add('user_id', 'You are not a member of this circle');

			if ($this->lunch->isExpired())
				$v->errors()->add('lunch_id', 'This Lunch has expired');

			if ($this->lunch->isSignedUp($this->user))
				$v->errors()->add('user_id', 'You are already signed up');
		};
	}
}
