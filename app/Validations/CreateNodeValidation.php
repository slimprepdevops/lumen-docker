<?php 

namespace App\Validations;

use App\Validations\Validation;

class CreateNodeValidation extends Validation
{
	/**
	 * Get the validation rules that apply to the request. 
	 * 
	 * @return array
	 */
	protected function rules(): array
	{
		return [
			'system_uptime' => ['required', 'date'],
			'total_ram' => ['required', 'integer'],
			'allocated_ram' => ['required', 'integer'],
			'total_disk' => ['required', 'integer'],
			'allocated_disk' => ['required', 'integer'],
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