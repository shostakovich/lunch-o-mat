<?php namespace App\Services;

use App\Lunch;
use App\User;
use App\RSVP;
use App\Validators\RSVPValidator;

class RSVPCreatorService {
	protected $lunch;
	protected $user;
	protected $validation;

	public function __construct(Lunch $lunch, User $user)
	{
		$this->lunch = $lunch;
		$this->user = $user;
		$this->validation = new RSVPValidator($lunch, $user);
	}

	public function signUp()
	{
		if ($this->validation->passes()) {
			RSVP::create([
				'user_id' => $this->user->id,
				'lunch_id' => $this->lunch->id
			]);
			return true;
		} else {
			return false;
		}
	}

	public function getErrors()
	{
		return $this->validation->getErrors();
	}
}
