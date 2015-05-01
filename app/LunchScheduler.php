<?php namespace App;
class LunchScheduler {
    public function __construct(Lunch $lunch){
        $this->lunch = $lunch;
    }

    public function schedule(){
        $groups = [];
        $participants = $this->lunch->participants()->get();

        $participants->shuffle();

        if($participants->count() == 3)
            $groups[0] = $participants;
        elseif($participants->count() == 6)
        {
            $groups[0] = $participants->slice(0, 3);
            $groups[1] = $participants->slice(3, 6);
        }
        return $groups;
    }
}