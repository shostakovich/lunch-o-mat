<?php namespace App;
class LunchScheduler {
    public function __construct(Lunch $lunch){
        $this->lunch = $lunch;
    }

    public function schedule()
    {
        $groups = [];
        $participants = $this->lunch->participants()->get();

        $participants->shuffle();
        $numParticipants = $participants->count();

        if ($numParticipants % 3 == 0)
        {
            for($i=0; $i < ($numParticipants / 3); $i++)
            {
                $offset = $i*3;
                $groups[$i] = $participants->slice($offset, 3);
            }
        }
        elseif ($numParticipants % 3 == 1)
        {
            $numberOfGroups = intval($numParticipants / 3) + 1;

            for($i=0; $i < $numberOfGroups - 2; $i++)
            {
                $offset = $i*3;
                $groups[$i] = $participants->slice($offset, 3);
            }
            $groups[$numberOfGroups - 2] = $participants->slice(-4, 2);
            $groups[$numberOfGroups - 1] = $participants->slice(-2, 2);
        }
        elseif($numParticipants % 3 == 2)
        {
            $numberOfGroups = intval($numParticipants / 3) + 1;

            for($i=0; $i < $numberOfGroups - 1; $i++)
            {
                $offset = $i*3;
                $groups[$i] = $participants->slice($offset, 3);
            }
            $groups[$numberOfGroups - 1] = $participants->slice(-2, 2);
        }

        return $groups;
    }
}