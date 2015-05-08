<?php
use Laracasts\TestDummy\Factory;
use App\Services\LunchSchedulingService;
use Carbon\Carbon;

class LunchSchedulingServiceTest extends TestCase
{
    public function testValidLunchWorks()
    {
        $lunch = Factory::create('App\Lunch')->toArray();
        $user = Factory::create('App\User');

        $service = new LunchSchedulingService($lunch, $user);

        $this->assertTrue($service->schedule());
        $this->verifyInDatabase('lunches', $lunch);
    }

    public function testLunchInThePastFails()
    {
        $circle = Factory::create('App\Circle');
        $attributes = ['circle_id' => $circle->id, 'starts_at' => '2015-01-01', 'duration_in_minutes' => '10'];
        $user = Factory::create('App\User');

        $service = new LunchSchedulingService($attributes, $user);

        $this->assertFalse($service->schedule());
        $errors_message_bag = $service->getErrors();

        $this->assertTrue($errors_message_bag->has('starts_at'));
    }

    public function testLunchWithoutCircleFails()
    {
        $attributes = Factory::attributesFor('App\Lunch', ['circle_id' => null]);
        $user = Factory::create('App\User');
        $service = new LunchSchedulingService($attributes, $user);

        $this->assertFalse($service->schedule());
        $errors_message_bag = $service->getErrors();

        $this->assertTrue($errors_message_bag->has('circle_id'));
    }

    public function testLunchThatIsToLongFails()
    {
        $attributes = Factory::create('App\Lunch', ['duration_in_minutes' => 0])->toArray();
        $user = Factory::create('App\User');
        $service = new LunchSchedulingService($attributes, $user);

        $this->assertFalse($service->schedule());
        $errors_message_bag = $service->getErrors();

        $this->assertTrue($errors_message_bag->has('duration_in_minutes'));
    }
}
