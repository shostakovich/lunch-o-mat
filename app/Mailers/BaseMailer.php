<?php namespace App\Mailers;

use Illuminate\Support\Facades\Mail;

abstract class BaseMailer
{
	public function sendTo($user, $subject, $view, $data)
	{
		$subject = sprintf("[Lunch-o-mat] %s", $subject);
		$view = sprintf('emails/%s', $view);

		Mail::send($view, $data, function($message) use($user, $subject) {
			$message->to($user->email)->subject($subject);
		});
	}
}
