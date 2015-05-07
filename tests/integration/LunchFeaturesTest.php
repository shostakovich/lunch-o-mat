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
	    $this->signedInUser();
	    $this->visit('/lunches');
	    $this->onPage('/lunches');
    }

	public function testLunchOverviewShowsOnlyLunchesInJoinedCircles()
	{
		$user = $this->signedInUser();

		$visible_lunch = $this->buildLunch($user);
		$invisible_lunch = $this->buildLunch();

		$this->visit('/lunches');
		$this->andSee(sprintf('(%s min.)', $visible_lunch->duration_in_minutes));
		$this->andNotSee(sprintf('(%s min.)', $invisible_lunch->duration_in_minutes));
	}

	public function testSignupForLunch()
	{
		$user = $this->signedInUser();
		$lunch = $this->buildLunch($user);

		$this->visit('/lunches');

		$this->press('Signup');

		$this->andSee('You succesfully signed up!');
	}

	private function signedInUser()
	{
		$user = Factory::create('App\User');
		Auth::login($user);
		return $user;
	}

	private function buildLunch(User $visible_to_user = null)
	{
		$lunch = Factory::create('App\Lunch');

		if($visible_to_user)
			$lunch->circle->members()->save($visible_to_user);

		return $lunch;
	}
}