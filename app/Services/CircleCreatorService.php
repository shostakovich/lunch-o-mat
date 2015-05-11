<?php namespace App\Services;

use Validator;
use App\Circle;
use App\User;

class CircleCreatorService
{
	protected $attributes;
	protected $user;
	protected $validation;

	public function __construct(Array $attributes, User $user)
	{
		$this->attributes = $attributes;
		$this->user = $user;
		$this->validation = $this->validator($attributes);
	}

	public function make()
	{
		if ($this->validation->fails()) {
			return false;
		}

		Circle::create([
			'name' => $this->attributes['name'],
			'description' => $this->attributes['description'],
			'founder_id' => $this->user->id
		]);
		return true;
	}

	public function getErrors()
	{
		return $this->validation->messages();
	}

	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|unique:circles|max:255',
			'description' => 'required|max:512'
		]);
	}
}
