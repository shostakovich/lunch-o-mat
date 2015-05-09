<?php
use Carbon\Carbon;
use Laracasts\TestDummy\Factory;
use App\Lunch;

class LunchTest extends TestCase {
    public function testEndTimeCalculation()
    {
        $start_time = Carbon::now();
        $duration = 60;

        $lunch = Factory::build('App\Lunch',
            ['starts_at' => $start_time, 'duration_in_minutes' => $duration]
        );

        $this->assertTrue($lunch->endsAt()->eq($start_time->addMinutes(60)));
    }

    public function testAddingOfParticipant()
    {
        $lunch = Factory::create('App\Lunch');
        $user = Factory::build('App\User');

        $lunch->addParticipant($user);

        $this->assertEquals($lunch->participants()->first()->id, $user->id);
    }

	public function testLunchHasOneCircle()
	{
		$circle = Factory::create('App\Lunch')->circle;

		$this->assertInstanceOf('App\Circle', $circle);
	}

	public function testUpcomingLunches()
	{
		$lunch_today = Factory::create('App\Lunch', ['starts_at' => Carbon::now()->endOfDay()]);
		$lunch_tomorrow = Factory::create('App\Lunch', ['starts_at' => Carbon::now()->tomorrow()]);

		$this->assertEquals(Lunch::upcoming()->count(), 1);
		$this->assertEquals(Lunch::upcoming()->first(), $lunch_tomorrow);
	}
}
