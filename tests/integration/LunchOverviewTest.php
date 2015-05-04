<?php
use Laracasts\TestDummy\Factory;

class LunchOverviewTest extends TestCase
{
    public function testLunchOverviewShowsLunches()
    {
        $lunch = Factory::create('App\Lunch', ['duration_in_minutes' => '45']);

        $this->visit('/lunches');
        $this->andSee(sprintf('(%s min.)', $lunch->duration_in_minutes));
    }
}
