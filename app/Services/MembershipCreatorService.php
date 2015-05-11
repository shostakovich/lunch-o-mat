<?php namespace App\Services;

use App\Circle;
use App\User;

class MembershipCreatorService
{
	protected $cicle;
	protected $user;

	public function __construct(Circle $circle, User $user)
	{
		$this->circle = $circle;
		$this->user = $user;
	}

	public function create()
	{
		$this->circle->members()->save($this->user);
		return true;
	}
}
