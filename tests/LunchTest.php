<?php
use Carbon\Carbon;
use Laracasts\TestDummy\Factory;

class LunchTest extends TestCase {
    public function testEndTimeCalculation()
    {
        $start_time = Carbon::now();
        $duration = 60;

        $lunch = Factory::build('App\Lunch',
            ['starts_at' => $start_time, 'duration_in_minutes' => $duration]
        );

        $this->assertTrue($lunch->ends_at()->eq($start_time->addMinutes(60)));
    }

    public function testAddingOfParticipant()
    {
        $lunch = Factory::create('App\Lunch');
        $user = Factory::build('App\User');

        $lunch->addParticipant($user);

        $this->assertEquals($lunch->participants()->first()->id, $user->id);
    }
}