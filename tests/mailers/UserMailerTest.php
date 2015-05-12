<?php
use Laracasts\TestDummy\Factory;
use App\Mailers\UserMailer;


class UserMailerTest extends MailTestCase
{
	public function testSendsConfirmationMail()
	{
		$user = Factory::create('App\User');

	  $mailer = new UserMailer();
		$mailer->confirm($user);

		$email = $this->getLastEmail();
		$this->assertEmailBodyContains('confirm your registration', $email);
	}
}
