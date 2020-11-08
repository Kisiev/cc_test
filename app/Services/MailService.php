<?php

namespace App\Services;
class MailService implements SendMessageInterface
{
	public function send($message)
	{
		$toEmail = config('SUPPORT_EMAIL');
		// TO DO
		return true;
	}
}