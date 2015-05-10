<?php
use Laracasts\TestDummy\Factory;
use App\Services\RSVPService;
use App\RSVP;
use Carbon\Carbon;

class RSVPServiceTest extends TestCase {
	public function setUp()
	{
		parent::setUp();
		$this->user = Factory::create('App\User');
		$this->lunch = Factory::create('App\Lunch');
		$this->lunch->circle->members()->save($this->user);
	}

	public function testCreatesValidRSVP()
	{
		$service = new RSVPService($this->lunch, $this->user);

		$this->assertTrue($service->rsvp());
		$this->assertTrue($this->lunch->isSignedUp($this->user));
	}

	public function testNoRSVPIfUserIsNotInCircle()
	{
		$this->lunch = Factory::create('App\Lunch');
		$service = new RSVPService($this->lunch, $this->user);

		$this->assertFalse($service->rsvp());

		$errors = $service->getErrors();
		$this->assertNotEmpty($errors->first('user_id'));
		$this->assertFalse($this->lunch->isSignedUp($this->user));
	}

	public function testPreventsRSVPWhenLunchExpired()
	{
		$this->lunch->starts_at = Carbon::yesterday();
		$service = new RSVPService($this->lunch, $this->user);

		$this->assertFalse($service->rsvp());

		$errors = $service->getErrors();
		$this->assertNotEmpty($errors->first('lunch_id'));
		$this->assertFalse($this->lunch->isSignedUp($this->user));
	}

	public function testChangesExistingRSVP()
	{
		$service = new RSVPService($this->lunch, $this->user);
		$service->rsvp();
		$service = new RSVPService($this->lunch, $this->user);

        $service->rsvp(false);


        $rsvp = RSVP::whereRaw('user_id = ? AND lunch_id = ?', [$this->user->id, $this->lunch->id])->first();
        $this->assertEquals('no', $rsvp->rsvp);
	}
}
