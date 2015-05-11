<?php namespace App\Mailers;
use App\Mailers\BaseMailer;

class UserMailer extends BaseMailer
{
	public function confirm($user)
	{
		$subject = 'Please confirm your e-mail-address';
		$data = compact('user');
		$view = 'confirm';

		$this->sendTo($user, $subject, $view, $data);
	}
}
