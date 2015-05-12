<?php namespace App\Mailers;

use Illuminate\Support\Facades\Mail;
use App\User;

abstract class BaseMailer
{
	public function sendTo(User $user, $subject, $view, Array $data = [])
	{
		$subject = sprintf("[Lunch-o-mat] %s", $subject);
		$view = sprintf('emails/%s', $view);

		Mail::queue($view, $data, function($message) use($user, $subject) {
			$message->to($user->email)->subject($subject);
		});
	}
}
