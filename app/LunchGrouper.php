<?php namespace App;
class LunchGrouper
{
    const GROUP_SIZE = 3;
    protected $participants;
    protected $groups;

    public function __construct(Lunch $lunch)
    {
        $this->participants = $lunch->participants()->get();
        $this->participants->shuffle();
    }

    public function group()
    {
        $this->groups = [];

        $this->fillNormalGroups();
        $this->fillSmallGroups();

        return $this->groups;
    }

    private function fillNormalGroups()
    {
        $groups = $this->numberOfNormalGroups();

        for ($i = 0; $i < $groups; $i++) {
            $offset = $i * self::GROUP_SIZE;
            $this->groups[$i] = $this->participants->slice($offset, self::GROUP_SIZE);
        }
    }

    private function numberOfNormalGroups()
    {
        $numParticipants = $this->participants->count();

        if(($this->participants->count() % self::GROUP_SIZE) == 1) {
            return intval($numParticipants / self::GROUP_SIZE) - 1;
        } else {
            return intval($numParticipants / self::GROUP_SIZE);
        }
    }

    private function fillSmallGroups()
    {
        $smallGroupSize = 2;
        $groups = $this->numberOfSmallGroups();

        for ($i = 0; $i < $groups; $i++) {
            $offset = ($i + 1) * -$smallGroupSize;

            $this->groups[$this->numberOfNormalGroups() + $i] = $this->participants->slice($offset, $smallGroupSize);
        }
    }

    private function numberOfSmallGroups()
    {
        $numParticipants = $this->participants->count();

        if(($numParticipants % self::GROUP_SIZE) == 1)
            return 2;
        elseif(($numParticipants % self::GROUP_SIZE) == 2)
            return 1;
        else
            return 0;
    }
}
