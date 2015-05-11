<?php
use Laracasts\TestDummy\Factory;

class MembershipFeaturesTest extends TestCase {
	public function testJoiningACircle()
	{
		$this->login();

		$circle = Factory::create('App\Circle');

		$this->visit("/circles/{$circle->id}");
		$this->submitForm('Join Circle');

		$this->andSee('Leave Circle');
	}

	public function testLeavingACircle()
	{
		$user = $this->login();
		$circle = Factory::create('App\Circle');
		$circle->members()->save($user);

		$this->visit("/circles/{$circle->id}");
		$this->submitForm('Leave Circle');

		$this->andSee('Join Circle');
	}
}
