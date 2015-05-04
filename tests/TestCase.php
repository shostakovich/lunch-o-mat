<?php
ini_set('display_errors', true);

use Laracasts\TestDummy\Factory;
use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

class TestCase extends IntegrationTest {
	public function createApplication()
	{
		Factory::$factoriesPath = 'tests/factories';
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

    public function setUp()
    {
        parent::setUp();
        DB::beginTransaction();
    }

    public function tearDown()
    {
        DB::rollBack();
        parent::tearDown();
    }
}
