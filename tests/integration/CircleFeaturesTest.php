<?php
use Laracasts\TestDummy\Factory;

class CirclesFeaturesTest extends TestCase {
	public function testCircleListRequiresLogin()
	{
		$this->assertRequiresLogin('/circles');
	}

	public function testCircleListShowsAllCircles()
	{
		$circle = Factory::create('App\Circle');

		$this->login();
		$this->visit('/circles');

		$this->andSee($circle->name);
		$this->andSee($circle->description);
	}

	public function testCreatingACircle()
	{
		$circle = Factory::attributesFor('circle_user_input');

		$this->login();
		$this->visit('/circles/create');
		$this->submitForm('Create Circle', $circle);

		$this->visit('/circles');
		$this->andSee($circle['name']);
		$this->andSee($circle['description']);
	}

	public function testErrorsAreDisplayedIfCircleCanNotBeCreated()
	{
		$invalid_circle = [];

		$this->login();
		$this->visit('/circles/create');
		$this->submitForm('Create Circle', $invalid_circle);

		$this->andSee('The name field is required.');
	}
}
