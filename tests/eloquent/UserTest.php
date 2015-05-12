<?php
use Laracasts\TestDummy\Factory;

class UserTest extends TestCase {
	public function testMemberOfManyCircles()
	{
		$user = Factory::create('App\User');

		$user->circles()->saveMany(array(Factory::build('App\Circle'), Factory::build('App\Circle')));

		$this->assertEquals(2, $user->circles()->count());
	}

  public function testFounderOfManyCircles()
  {
	  $user = Factory::create('App\User');
	  $circle = Factory::create('App\Circle', ['founder_id' => $user->id]);

	  $this->assertEquals($circle, $user->foundedCircles()->first());
  }

	public function testHasUniqueSecretConfirmationToken()
	{
		$user1 = Factory::create('App\User');
		$user2 = Factory::create('App\User');

		$this->assertNotEquals($user1->confirmationToken(), $user2->confirmationToken());
	}
}
