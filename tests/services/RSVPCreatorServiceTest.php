<?php
use Laracasts\TestDummy\Factory;
use App\Services\RSVPCreatorService;
use Carbon\Carbon;

class RSVPCreatorServiceTest extends TestCase {
	public function setUp()
	{
		parent::setUp();
		$this->user = Factory::create('App\User');
		$this->lunch = Factory::create('App\Lunch');
		$this->lunch->circle->members()->save($this->user);
	}

	public function testCreatesValidRSVP()
	{
		$service = new RSVPCreatorService($this->lunch, $this->user);

		$this->assertTrue($service->signUp());
		$this->assertTrue($this->lunch->isSignedUp($this->user));
	}

	public function testNoRSVPIfUserIsNotInCircle()
	{
		$this->lunch = Factory::create('App\Lunch');
		$service = new RSVPCreatorService($this->lunch, $this->user);

		$this->assertFalse($service->signUp());

		$errors = $service->getErrors();
		$this->assertNotEmpty($errors->first('user_id'));
		$this->assertFalse($this->lunch->isSignedUp($this->user));
	}

	public function testPreventsRSVPWhenLunchExpired()
	{
		$this->lunch->starts_at = Carbon::yesterday();
		$service = new RSVPCreatorService($this->lunch, $this->user);

		$this->assertFalse($service->signUp());

		$errors = $service->getErrors();
		$this->assertNotEmpty($errors->first('lunch_id'));
		$this->assertFalse($this->lunch->isSignedUp($this->user));
	}

	public function testPreventsDuplicateRSVPs()
	{
		$service = new RSVPCreatorService($this->lunch, $this->user);
		$service->signUp();
		$service = new RSVPCreatorService($this->lunch, $this->user);

		$this->assertFalse($service->signUp());
	}
}
