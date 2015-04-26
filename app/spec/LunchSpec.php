<?php

namespace spec\App;

use Carbon\Carbon;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LunchSpec extends ObjectBehavior
{
    function it_has_an_end_date()
    {
        $start_time = Carbon::now();
        $duration = 60;

        $this->starts_at = $start_time;
        $this->duration_in_minutes = $duration;

        $this->ends_at()->eq($start_time->addMinutes(60))->shouldBe(true);
    } 
}

