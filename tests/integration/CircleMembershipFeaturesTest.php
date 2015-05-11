<?php
use Laracasts\TestDummy\Factory;

class CircleMembershipFeaturesTest extends TestCase {
	public function testJoiningACircle()
	{
		$this->login();

		$circle = Factory::create('App\Circle');

		$this->visit("/circles/{$circle->id}");
		$this->submitForm('Join Circle');

		$this->andSee('Leave Circle');

	}

	// Joining a circle

	// Founder AutoJoins a circle
	// leaving a circle
}
