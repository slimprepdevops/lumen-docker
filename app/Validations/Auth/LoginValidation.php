<?php

namespace App\Validations\Auth;

use App\Validations\Validation;

class LoginValidation extends Validation
{
	/**
	 * Get the validation rules that apply to the request. 
	 * 
	 * @return array
	 */
	protected function rules(): array
	{
		return [
			'email' => ['required', 'email', 'max:100'], 
			'password' => ['required', 'string', 'max:100', 'min:8'], 
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	protected function messages(): array
	{
		return [
			// 
		];
	}

	/**
	 * Get custom attributes for validator errors.
	 *
	 * @return array
	 */
	protected function attributes(): array
	{
		return [
			// 
		];
	}

}