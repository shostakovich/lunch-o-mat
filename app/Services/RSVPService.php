<?php namespace App\Services;

use App\Lunch;
use App\User;
use App\RSVP;
use App\Validators\RSVPValidator;

class RSVPService {
	protected $lunch;
	protected $user;
	protected $validation;
	protected $attributes;

	public function __construct(Lunch $lunch, User $user)
	{
		$this->lunch = $lunch;
		$this->user = $user;
		$this->validation = new RSVPValidator($lunch, $user);
	}

	public function rsvp($participating = true)
	{
		$rsvp = ($participating) ? 'yes' : 'no';
		$user_id = $this->user->id;
		$lunch_id = $this->lunch->id;

		$this->attributes = compact('rsvp', 'lunch_id', 'user_id');

		if ($this->validation->passes($this->attributes)) {
			RSVP::updateOrCreate(compact('lunch_id', 'user_id'), compact('rsvp'));
			return true;
		} else {
			return false;
		}
	}

	public function getErrors()
	{
		return $this->validation->getErrors($this->attributes);
	}
}
