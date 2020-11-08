<?php

namespace App\Services;
class MailService implements SendMessageInterface
{
	public function send($message)
	{
		$toEmail = config('app.support_email');
		// TO DO
		return true;
	}
}