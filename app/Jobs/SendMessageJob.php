<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\SendMessageInterface;
class SendMessageJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	protected $mail;
	protected $message;
	public function __construct(SendMessageInterface $mail, String $message)
	{
		$this->mail = $mail;
		$this->message = $message;
	}

	public function handle()
	{
		$result = $this->mail->send($this->message);
		logs()->info(__METHOD__ . ' ' . json_encode($result));
	}
}
