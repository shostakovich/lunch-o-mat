<?php
use Laracasts\TestDummy\Factory;
use App\User;

class LunchFeaturesTest extends TestCase
{
	public function testLunchOverviewPreventsAnonymousAccess()
	{
		$this->visit('/lunches');
		$this->onPage('/auth/login');
	}

    public function testLunchOverviewAllowsUserAccess()
    {
	    $this->login();
	    $this->visit('/lunches');
	    $this->onPage('/lunches');
    }

	public function testLunchOverviewShowsOnlyLunchesInJoinedCircles()
	{
		$user = $this->login();

		$visible_lunch = $this->buildLunch($user);
		$invisible_lunch = $this->buildLunch();

		$this->visit('/lunches');
		$this->andSee(sprintf('(%s min.)', $visible_lunch->duration_in_minutes));
		$this->andNotSee(sprintf('(%s min.)', $invisible_lunch->duration_in_minutes));
	}

	public function testSignupForLunch()
	{
		$user = $this->login();
		$this->buildLunch($user);

		$this->visit('/lunches');
		$this->press('Signup');

		$this->andSee('You succesfully signed up!');
	}

    public function testCancelLunchParticipation()
    {
        $user = $this->login();
        $lunch = $this->buildLunch($user);
        $lunch->participants()->save($user);

        $this->visit('/lunches');
        $this->press('Cancel');

        $this->andSee('You will not take part in this lunch!');
    }

	private function buildLunch(User $visible_to_user = null)
	{
		$lunch = Factory::create('App\Lunch');

		if($visible_to_user)
			$lunch->circle->members()->save($visible_to_user);

		return $lunch;
	}
}
