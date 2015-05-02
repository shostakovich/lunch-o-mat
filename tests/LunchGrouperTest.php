<?php
use Laracasts\TestDummy\Factory;
use App\LunchGrouper;

class LunchGrouperTest extends TestCase
{
    public function testSchedulesEmptyLunch()
    {
        $groups = $this->scheduleParticipants(0);
        $this->assertEquals(count($groups), 0);
    }

    public function testOnePersonLandsInOwnGroup()
    {
        $groups = $this->scheduleParticipants(1);
        $this->assertEquals(count($groups[0]), 1);
    }

    public function testTwoPersonsLandsInOwnGroup()
    {
        $groups = $this->scheduleParticipants(2);
        $this->assertEquals(count($groups[0]), 2);
    }

    public function testThreeParticipantPerGroup()
    {
        $groups = $this->scheduleParticipants(3);
        $this->assertEquals(count($groups[0]), 3);
    }

    public function testFourParticipantsAreTwoGroupsOfTwo()
    {
        $groups = $this->scheduleParticipants(4);
        $this->assertEquals(count($groups[0]), 2);
        $this->assertEquals(count($groups[1]), 2);
    }


    public function testSevenParticipantsAreOneGroupsOfThreeAndTwoOfTwo()
    {
        $groups = $this->scheduleParticipants(7);
        $this->assertEquals(count($groups[0]), 3);
        $this->assertEquals(count($groups[1]), 2);
        $this->assertEquals(count($groups[2]), 2);
    }


    public function testSixParticipantsAreTwoGroups()
    {
        $groups = $this->scheduleParticipants(6);
        $this->assertEquals(count($groups[0]), 3);
        $this->assertEquals(count($groups[1]), 3);
    }


    private function scheduleParticipants($numberOfParticipants)
    {
        $participants = $this->buildParticipants($numberOfParticipants);
        $lunch = Factory::create('App\Lunch');

        foreach($participants as $participant)
            $lunch->addParticipant($participant);

        $grouper = new LunchGrouper($lunch);
        $groups = $grouper->group();
        return $groups;
    }
    
    private function buildParticipants($numberOfParticipants)
    {
        $participants = [];

        while(count($participants) < $numberOfParticipants)
            array_push($participants, Factory::build('App\User'));

        return $participants;
    }
}
