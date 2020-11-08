<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendToEmailJob;
class SendMailTest extends TestCase
{
	public function testValidationMessage()
	{
		// пустое сообещние
		$response = $this->json('POST', '/api/mailer/sendToEmail');
		$response->assertStatus(422);
		$response->assertJson([
			'errors' => [
				'message' => ['Обязательное поле']
			]
		]);

		// валидация длины
		$response = $this->json('POST', '/api/mailer/sendToEmail', [
			'message' => '12'
		]);
		$response->assertStatus(422);
		$response->assertJson([
			'errors' => [
				'message' => ['Минимум 3 символа']
			]
		]);

		$response = $this->json('POST', '/api/mailer/sendToEmail', [
			'message' => Str::random(201)
		]);
		$response->assertStatus(422);
		$response->assertJson([
			'errors' => [
				'message' => ['Максимум 200 символов']
			]
		]);
	}
	public function testSendValidMessageToEmail()
	{
		Queue::fake();

		$response = $this->json('POST', '/api/mailer/sendToEmail', [
			'message' => Str::random(20)
		]);

		$response->assertStatus(200);
		Queue::assertPushed(SendToEmailJob::class);
	}
}
