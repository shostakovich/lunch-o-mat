<?php
use Laracasts\TestDummy\Factory;

class UserTest extends TestCase {
	public function testUserIsMemberOfManyCircles()
	{
		$user = Factory::create('App\User');

		$user->circles()->saveMany(array(Factory::build('App\Circle'), Factory::build('App\Circle')));

		$this->assertEquals(2, $user->circles()->count());
	}
}
