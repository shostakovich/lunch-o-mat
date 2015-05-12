<?php
use GuzzleHttp\Client;

class MailTestCase extends TestCase
{
	public function __construct()
	{
		$this->mailcatcher = new Client(['base_url' => 'http://localhost:1080']);
		parent::__construct();
	}

	public function setUp()
	{
		$this->deleteAllEmails();
		parent::setUp();
	}

	public function getAllEmails()
	{
		$emails = $this->mailcatcher->get('/messages')->json();

		if (empty($emails)) {
			$this->fail('No emails sent.');
		}
		return $emails;
	}

	public function deleteAllEmails()
	{
		return $this->mailcatcher->delete('/messages');
	}

	public function getLastEmail()
	{
		$email_id = $this->getAllEmails()[0]['id'];
		$email = $this->mailcatcher->get("/messages/{$email_id}.html");

		return (string)$email;
	}

	public function assertEmailBodyContains($body, $email)
	{
		$this->assertContains($body, $email);
	}
}
