<?php
use Laracasts\TestDummy\Factory;

class CircleTest extends TestCase {
	public function testCircleHasManyLunches()
	{
		$circle = Factory::create('App\Circle');

		$circle->lunches()->saveMany(array(Factory::build('App\Lunch'), Factory::build('App\Lunch')));

		$this->assertEquals(2, $circle->lunches()->count());
	}

	public function testCircleHasMembers()
	{
		$circle = Factory::create('App\Circle');

		$circle->members()->saveMany(array(Factory::build('App\User'), Factory::build('App\User')));

		$this->assertEquals(2, $circle->members()->count());
	}

    public function testCircleHasAFounder()
    {
        $circle = Factory::create('App\Circle');

        $this->assertEquals(1, $circle->founder()->count());
    }
}
