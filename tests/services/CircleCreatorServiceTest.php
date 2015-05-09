<?php
use Laracasts\TestDummy\Factory;
use App\Services\CircleCreatorService;

class CircleCreatorServiceTest extends TestCase {
    public function testCreatesValidCircle()
    {
        $circle = Factory::build('App\Circle')->toArray();
        $service = new CircleCreatorService;

        $this->assertTrue($service->make($circle), 'Circle was created (returns true)');

        $this->verifyInDatabase('circles', $circle);
    }

    public function testInvalidWithoutName()
    {
        $circle = Factory::build('App\Circle', ['name' => null])->toArray();
        $service = new CircleCreatorService;

        $this->assertFalse($service->make($circle), 'Circle was not created (returns false)');
    }

    public function testInvalidWithDuplicatesNames()
    {
        $circle = Factory::build('App\Circle')->toArray();

        $service = new CircleCreatorService;
        $this->assertTrue($service->make($circle), 'Same name is only valid once');


        $service = new CircleCreatorService;
        $this->assertFalse($service->make($circle), 'No duplicate names are allowed');
    }

    public function testInvalidWithoutDescription()
    {
        $circle = Factory::build('App\Circle', ['description' => null])->toArray();
        $service = new CircleCreatorService;

        $this->assertFalse($service->make($circle), 'Circle was not created (returns false)');
    }

	public function testReturnsAllErrors()
	{
		$circle = [];
		$service = new CircleCreatorService;

		$service->make($circle);
		$errors_message_bag = $service->getErrors();

		$this->assertTrue($errors_message_bag->has('name'), 'Has an error for the missing name');
		$this->assertTrue($errors_message_bag->has('description'), 'Has an error for the missing description');
	}
}
