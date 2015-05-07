<?php namespace App\Services;

use Validator;
use App\Circle;

class CircleCreatorService
{
	protected $errors = [];

	public function make(array $input)
	{
		$validation = $this->validator($input);

		if ($validation->fails()) {
			$this->errors = $validation->messages();
			return false;
		}

		Circle::create([
			'name' => $input['name'],
			'description' => $input['description'],
		]);
		return true;
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|unique:circles|max:255',
			'description' => 'required|max:512'
		]);
	}
}
