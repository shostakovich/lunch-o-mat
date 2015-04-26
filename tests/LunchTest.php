<?php
use Carbon\Carbon;
use App\Lunch;
use App\User;


class LunchTest extends TestCase {
    public function testEndTimeCalculation()
    {
        $start_time = Carbon::now();
        $duration = 60;

        $lunch = new Lunch();
        $lunch->starts_at = $start_time;
        $lunch->duration_in_minutes = $duration;

        $this->assertTrue($lunch->ends_at()->eq($start_time->addMinutes(60)));
    }

    public function testAddingOfParticipant()
    {
        $lunch = Lunch::create(['starts_at' => Carbon::now()]);
        $user = new User(['email' => 'ab@example.com', 'name' => 'John Doe']);

        $lunch->addParticipant($user);

        $this->assertEquals($lunch->participants()->first()->id, $user->id);
    }
}