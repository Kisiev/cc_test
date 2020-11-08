<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendToEmailRequest extends FormRequest
{
	public function messages()
	{
		return [
			'message.required' => 'Обязательное поле',
			'message.min'      => 'Минимум :min символа',
			'message.max'      => 'Максимум :max символов',
		];
	}
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'message' => 'required|min:3|max:200'
		];
	}
}
