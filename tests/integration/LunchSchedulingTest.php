<?php
use Laracasts\TestDummy\Factory;

class LunchSchedulingTest extends TestCase
{
	public function testRequiresLogin()
	{
		$this->assertRequiresLogin('/lunches/create');
	}

	public function testsOnlyCircleAdminsCanSchedule()
	{
        $this->login();
        Factory::create('App\Circle');

        $this->visit('/lunches/create');
		$this->andSee('You can not schedule any lunches!');
	}

	public function testScheduleAValidLunch()
	{
	    $user = $this->login();
        $circle = Factory::create('App\Circle', ['founder_id' => $user->id]);
		$lunch = Factory::attributesFor('App\Lunch', ['circle_id' => $circle->id]);

		$this->visit('/lunches/create');
        $this->submitForm('Schedule Lunch', $lunch);
        $this->andSee('You scheduled a lunch');

	}
}
