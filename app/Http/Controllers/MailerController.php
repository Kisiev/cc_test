<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendToEmailRequest;
use App\Services\MailService;
use App\Models\Message;
use App\Jobs\SendMessageJob;
class MailerController extends Controller
{
	/**
	 * Отправка сообщения на фиксированный E-mail
	 * @bodyParam  message string required Текст сообщения
	 * @response  200
	 * @response  422 {
	 *		"errors": {
	 *			"message": [
	 *				'Обязательное поле',
	 *				'Минимум 3 символа',
	 *				'Максимум 200 символов'
	 *			]
	 *		}
	 *	}
	 * @response  429 {
	 *		"message": "Too Many Attempts."
	 *	}
	 */
	public function sendToEmail(SendToEmailRequest $request, MailService $mailService)
	{
		$messageText = $request->get('message');
		Message::create(['text' => $messageText]);
		SendMessageJob::dispatch($mailService, $messageText);
	}
}
