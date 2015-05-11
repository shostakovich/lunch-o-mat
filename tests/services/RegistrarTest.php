<?php
use App\Services\Registrar;
use App\User;

class RegistrarTest extends TestCase
{
	public function testItCreatesAValidUser()
	{
		$attributes = [
			'name' => 'Ron Weasley',
			'email' => 'ron@example.com',
			'password' => '1234',
			'password_confirmation' => '1234'
		];

		$registrar = new Registrar();
		$registrar->create($attributes);

		$this->assertEquals(1, User::where(array('email' => $attributes['email']))->count());
	}
}
