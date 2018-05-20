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
			'gender' 			=> ['required','string'],
			'phone_code' 		=> ['required','string'],
			'mobile_number' 	=> ['required','string'],
			'address' 			=> ['required','string','max:500'],
			'marital_status' 	=> ['required','string'],
			'date_of_joining' 	=> ['required','string'],
		];
		return $validation[$key];
	}

	public function createEmployee(){
        $validator = \Validator::make($this->data->all(), [
            'first_name' 	=> $this->validation('first_name'),
            'last_name' 	=> $this->validation('last_name'),
            'employee_id' 	=> $this->validation('employee_id'),
            'date_of_birth' => $this->validation('date_of_birth'),
			'gender'			=> $this->validation('gender'),
			'phone_code'		=> $this->validation('phone_code'),
			'mobile_number'		=> $this->validation('mobile_number'),
			'current_address'	=> $this->validation('address'),
			'permanent_address'	=> $this->validation('address'),
			'marital_status'	=> $this->validation('marital_status'),
			'date_of_joining'	=> $this->validation('date_of_joining'),            
        ],[
        	'email.required' 	=> trans('general.M0032'),
        	'email.string' 	=> trans('general.M0033'),
			
        ]);
        
        return $validator;		
	}
}