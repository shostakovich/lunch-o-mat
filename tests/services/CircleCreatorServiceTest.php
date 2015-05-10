<?php
use Laracasts\TestDummy\Factory;
use App\Services\CircleCreatorService;

class CircleCreatorServiceTest extends TestCase {
    public function testCreatesValidCircle()
    {
        $circle = Factory::attributesFor('circle_user_input');
        $founder = Factory::create('App\User');

        $service = new CircleCreatorService($circle, $founder);

        $this->assertTrue($service->make(), 'Circle was created (returns true)');

        $this->verifyInDatabase('circles', $circle);
    }

    public function testInvalidWithoutName()
    {
        $circle = Factory::attributesFor('circle_user_input', ['name' => null]);
        $founder = Factory::create('App\User');

        $service = new CircleCreatorService($circle, $founder);

        $this->assertFalse($service->make(), 'Circle was not created (returns false)');
    }

    public function testInvalidWithDuplicatesNames()
    {
        $circle = Factory::attributesFor('circle_user_input');
        $founder = Factory::create('App\User');

        $service = new CircleCreatorService($circle, $founder);
        $this->assertTrue($service->make(), 'Same name is only valid once');


        $service = new CircleCreatorService($circle, $founder);
        $this->assertFalse($service->make(), 'No duplicate names are allowed');
    }

    public function testInvalidWithoutDescription()
    {
        $circle = Factory::attributesFor('circle_user_input', ['description' => null]);
        $founder = Factory::create('App\User');

        $service = new CircleCreatorService($circle, $founder);

        $this->assertFalse($service->make(), 'Circle was not created (returns false)');
    }

	public function testReturnsAllErrors()
	{
		$circle = [];
        $founder = Factory::create('App\User');
		$service = new CircleCreatorService($circle, $founder);

		$service->make();
		$errors_message_bag = $service->getErrors();

		$this->assertTrue($errors_message_bag->has('name'), 'Has an error for the missing name');
		$this->assertTrue($errors_message_bag->has('description'), 'Has an error for the missing description');
	}
}
