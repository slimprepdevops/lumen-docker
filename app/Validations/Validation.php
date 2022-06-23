<?php 

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class Validation
{
	/**
	 * Run the validator's rules against its data.
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|bool
	 */
	public function validate(Request $request)
	{
		$validation = Validator::make(
			$request->toArray(), 
			$this->rules(), 
			$this->messages(),
			$this->attributes()
		);

		if ($validation->fails()) {
			return $this->format($validation->errors());
		}
		
		return false;
	}

	/**
	 * Format the validation errors
	 * 
	 * @param  Illuminate\Support\MessageBag  $errors 
	 * @return array
	 */
	protected function format($errors): array
	{
		return collect($errors)->map(function ($error) {
			return $error[0];
		})->toArray();
	}

	/**
	 * Get the validation rules that apply to the request. 
	 * 
	 * @return array
	 */
	abstract protected function rules(): array;

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