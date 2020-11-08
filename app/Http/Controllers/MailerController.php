<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendToEmailRequest;
use App\Services\MailService;
use App\Models\Message;
use App\Jobs\SendMessageJob;
class MailerController extends Controller
{
	public function sendToEmail(SendToEmailRequest $request, MailService $mailService)
	{
		$messageText = $request->get('message');
		Message::create(['text' => $messageText]);
		SendMessageJob::dispatch($mailService, $messageText);
	}
}
