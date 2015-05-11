<?php
use Laracasts\TestDummy\Factory;
use App\Services\MembershipCreatorService;

class MembershipCreatorServiceTest extends TestCase {
	public function testCreatesMembership()
	{
		$circle = Factory::create('App\Circle');
		$user = Factory::create('App\User');
		$service = new MembershipCreatorService($circle, $user);

		$this->assertTrue($service->create());
	}
}
