<?php
use Laracasts\TestDummy\Factory;
use App\Services\LunchSignupService;
use Carbon\Carbon;

class LunchSignupServiceTest extends TestCase {
	public function setUp()
	{
		parent::setUp();
		$this->user = Factory::create('App\User');
		$this->lunch = Factory::create('App\Lunch');
		$this->lunch->circle->members()->save($this->user);
	}

	public function testCreatesValidSignup()
	{
		$service = new LunchSignupService($this->lunch, $this->user);

		$this->assertTrue($service->signUp());
		$this->assertTrue($this->lunch->isSignedUp($this->user));
	}

	public function testPreventsSignupIfUserIsNotInCircle()
	{
		$this->lunch = Factory::create('App\Lunch');
		$service = new LunchSignupService($this->lunch, $this->user);

		$this->assertFalse($service->signUp());

		$errors = $service->getErrors();
		$this->assertNotEmpty($errors->first('user_id'));
		$this->assertFalse($this->lunch->isSignedUp($this->user));
	}

	public function testPreventsSignupWhenLunchExpired()
	{
		$this->lunch->starts_at = Carbon::yesterday();
		$service = new LunchSignupService($this->lunch, $this->user);

		$this->assertFalse($service->signUp());

		$errors = $service->getErrors();
		$this->assertNotEmpty($errors->first('lunch_id'));
		$this->assertFalse($this->lunch->isSignedUp($this->user));
	}

	public function testPreventsDuplicateSignups()
	{
		$service = new LunchSignupService($this->lunch, $this->user);
		$service->signUp();
		$service = new LunchSignupService($this->lunch, $this->user);

		$this->assertFalse($service->signUp());
	}
}
