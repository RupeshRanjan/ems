<?php

namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
/**
* 
*/
class Employee
{
	protected $data;
	public function __construct($data){
		$this->data = $data;
	}

	private function validation($key){
		$validation = [
			'first_name' 		=> ['required','string'],
			'last_name' 		=> ['required','string'],
			'employee_id' 		=> ['required','string'],
			'date_of_birth' 	=> ['required','string'],
		];
		return $validation[$key];
	}

	public function createEmployee(){
        $validator = \Validator::make($this->data->all(), [
            'first_name' 	=> $this->validation('first_name'),
            'last_name' 	=> $this->validation('last_name'),
            'employee_id' 	=> $this->validation('employee_id'),
            'date_of_birth' => $this->validation('date_of_birth'),
        ],[
        	'email.required' 	=> trans('general.M0032'),
        	'email.string' 	=> trans('general.M0033'),
			
        ]);
        
        return $validator;		
	}
}