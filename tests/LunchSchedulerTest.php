<?php
use Laracasts\TestDummy\Factory;
use App\LunchScheduler;

class LunchSchedulerTest extends TestCase {
    public function testSchedulesEmptyLunch() {
        $groups = $this->scheduleParticipants(array());
        $this->assertEquals(count($groups), 0);
    }

    public function testThreeParticipantsGoIntoOneGroup() {
        $participants = array(
            Factory::build('App\User'),
            Factory::build('App\User'),
            Factory::build('App\User')
        );
        $groups = $this->scheduleParticipants($participants);
        $this->assertEquals(count($groups[0]), 3);
    }

    public function testSixParticipantsMakeTwoGroupsOfThree() {
        $participants = array(
            Factory::build('App\User'),
            Factory::build('App\User'),
            Factory::build('App\User'),
            Factory::build('App\User'),
            Factory::build('App\User'),
            Factory::build('App\User')
        );

        $groups = $this->scheduleParticipants($participants);
        $this->assertEquals(count($groups[0]), 3);
        $this->assertEquals(count($groups[1]), 3);
    }

    private function scheduleParticipants($participants)
    {
        $lunch = Factory::create('App\Lunch');

        foreach($participants as $participant) {
            $lunch->addParticipant($participant);
        }

        $scheduler = new LunchScheduler($lunch);
        $groups = $scheduler->schedule();
        return $groups;
    }
}
