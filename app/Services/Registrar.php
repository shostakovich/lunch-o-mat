<?php namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use App\Mailers\UserMailer;

class Registrar implements RegistrarContract
{
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	public function create(array $data)
	{
		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);

		$mailer = new UserMailer;
		$mailer->confirm($user);

		return $user;
	}
}
