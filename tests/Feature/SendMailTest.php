<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendMessageJob;
class SendMailTest extends TestCase
{
	public function testValidationMessage()
	{
		$this->artisan('cache:clear');
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
		$this->artisan('cache:clear');
		Queue::fake();
		$messageText = Str::random(20);
		$response = $this->json('POST', '/api/mailer/sendToEmail', [
			'message' => $messageText
		]);

		$response->assertStatus(200);
		$this->assertDatabaseHas('messages', [
			'text' => $messageText
		]);
		Queue::assertPushed(SendMessageJob::class);
	}
	public function testSendManyRequests()
	{
		$this->artisan('cache:clear');
		Queue::fake();
		for ($index = 0; $index < 10; $index ++){
			$messageText = Str::random(20);
			$response = $this->json('POST', '/api/mailer/sendToEmail', [
				'message' => $messageText
			]);
			$response->assertStatus(200);
			$this->assertDatabaseHas('messages', [
				'text' => $messageText
			]);
		}

		$messageText = Str::random(20);
		$response = $this->json('POST', '/api/mailer/sendToEmail', [
			'message' => $messageText
		]);
		$this->assertDatabaseMissing('messages', [
			'text' => $messageText
		]);
		$response->assertStatus(429);
	}
}
