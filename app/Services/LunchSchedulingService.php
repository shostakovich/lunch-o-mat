<?php namespace App\Services;

use App\User;
use Validator;
use App\Lunch;
use Carbon\Carbon;

class LunchSchedulingService {
	protected $attributes;
	protected $user;
	protected $validation;

	public function __construct(Array $attributes, User $user)
	{
		$this->attributes = $attributes;
		$this->user = $user;

		$midnight = Carbon::now()->endOfDay()->toRfc2822String();
		$this->validation = Validator::make($attributes, [
			'circle_id' => 'required|exists:circles,id',
			'starts_at' => "required|after:{$midnight}",
			'duration_in_minutes' => 'required|numeric|min:5|max:255'
		]);
	}

	public function schedule()
	{
		if($this->validation->passes()) {
			Lunch::create($this->attributes);
			return true;
		} else {
			return false;
		}
	}

	public function getErrors()
	{
		return $this->validation->messages();
	}
}
