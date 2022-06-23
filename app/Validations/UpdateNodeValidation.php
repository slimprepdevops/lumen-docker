<?php 

namespace App\Validations;

use App\Validations\Validation;
use Illuminate\Validation\Rule;

class UpdateNodeValidation extends Validation
{
	/**
	 * Get the validation rules that apply to the request. 
	 * 
	 * @return array
	 */
	protected function rules(): array
	{
		return [
			'system_uptime' => [
				Rule::requiredIf(function () {
			        return isset(request()->system_uptime);
			    }),
				'date'
			],
			'total_ram' => [
				Rule::requiredIf(function () {
			        return isset(request()->total_ram);
			    }),
				'integer'
			],
			'allocated_ram' => [
				Rule::requiredIf(function () {
			        return isset(request()->allocated_ram);
			    }),
				'integer'
			],
			'total_disk' => [
				Rule::requiredIf(function () {
			        return isset(request()->total_disk);
			    }),
				'integer'
			],
			'allocated_disk' => [
				Rule::requiredIf(function () {
			        return isset(request()->allocated_disk);
			    }),
				'integer'
			],
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