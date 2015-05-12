<?php namespace App\Mailers;
use App\Mailers\BaseMailer;
use App\User;

class UserMailer extends BaseMailer
{
	public function confirm(User $user)
	{
		$subject = 'Please confirm your e-mail-address';
		$data = array('name' => $user->name);
		$view = 'confirm';

		$this->sendTo($user, $subject, $view, $data);
	}
}
