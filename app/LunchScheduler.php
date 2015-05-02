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
                $length = ($i+1)*3;

                $groups[$i] = $participants->slice($offset, $length);
            }
        }
        elseif ($numParticipants % 3 == 1)
        {
            $groups[0] = $participants->slice(0, 2);
            $groups[1] = $participants->slice(2, 2);

        }

        return $groups;
    }
}