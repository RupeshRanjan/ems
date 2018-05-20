<?php

namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
/**
* 
*/
class Perks
{
	protected $data;
	public function __construct($data){
		$this->data = $data;
	}

	private function validation($key){
		$validation = [
			'password'	=> ['required'],

		];
		return $validation[$key];
	}

	public function login(){
        $validator = \Validator::make($this->data->all(), [
            'email' => 'required|string',
            'password' => $this->validation('password'),
        ],[
        	'email.required' 	=> trans('general.M0032'),
        	'email.string' 	=> trans('general.M0033'),
			'password.required'         	=> trans('general.M0019'),
			'password.string'           	=> trans('general.M0020'),
			'password.regex'            	=> trans('general.M0020'),
			'password.between'              => trans('general.user_authentication_failed')
        ]);
        
        return $validator;
    }

    public function resendVerificationMail(){
        $validator = \Validator::make($this->data->all(), [
            $this->username() => 'required|string',
        ],[
        	$this->username().'.required' 	=> trans('general.M0032'),
        	$this->username().'.string' 	=> trans('general.M0033'),
			
        ]);

        $validator->after(function($validator){
            $userdata = $this->findUser($this->data);
            if(!$userdata){
                $validator->errors()->add($this->username(), trans('general.user_not_exists'));
            }
        });
        
        return $validator;
    }

	public function normal_company_signup(){
		$validator = Validator::make($this->data->all(),[
			'company_name'      			=> array_merge($this->validation('company_name'),[Rule::unique('branch')->ignore('trashed','status')]), 
			'address'          				=> $this->validation('street'),
			'city'          				=> $this->validation('city'),
			'country'          				=> $this->validation('country'),
			'first_name'        			=> $this->validation('first_name'),
			'last_name'         			=> $this->validation('last_name'),
			'phone_code'        			=> $this->validation('phone_code'), 
			'mobile_number'     			=> array_merge($this->validation('mobile_number'),[Rule::unique('users')->ignore('trashed','status'),Rule::unique('branch')->ignore('trashed','status')]),
			'email'             			=> array_merge($this->validation('email'),[Rule::unique('users')->ignore('trashed','status')]),
			'password'          			=> $this->validation('password'),
			'g-recaptcha-response'          => $this->validation('g-recaptcha-response')
		],[
			'company_name.required'     => trans('general.M0001'),
			'company_name.string'       => trans('general.M0011'),
			'company_name.regex'        => trans('general.M0011'),
			'company_name.max'          => trans('general.M0012'),
			'company_name.unique'       => trans('general.unique',['attribute' => trans('field.company_name')]),
			'location.required'         => trans('general.M0002'),
			'location.string'           => trans('general.M0003'),
			'first_name.required'       => trans('general.M0004'),
			'first_name.string'         => trans('general.M0005'),
			'first_name.regex'          => trans('general.M0005'),
			'first_name.max'            => trans('general.M0006'),
			'last_name.required'        => trans('general.M0007'),
			'last_name.string'          => trans('general.M0008'),
			'last_name.regex'           => trans('general.M0008'),
			'last_name.max'             => trans('general.M0009'),
			'phone_code.required'       => trans('general.M0024'),
			'mobile_number.required'    => trans('general.M0010'),
			'mobile_number.string'      => trans('general.M0013'),
			'mobile_number.regex'       => trans('general.M0013'),
			'mobile_number.max'         => trans('general.M0014'),
			'mobile_number.min'         => trans('general.M0015'),
			'mobile_number.unique'      => trans('general.M0023'),
			'email.required'            => trans('general.M0016'),
			'email.email'               => trans('general.M0017'),
			'email.unique'              => trans('general.M0018'),
			'password.required'         => trans('general.M0019'),
			'password.string'           => trans('general.password_invalid'),
			'password.regex'            => trans('general.password_invalid'),
			'password.min'              => trans('general.M0021'),
			'password.max'              => trans('general.M0022'),
		]);
		return $validator;
	}

	public function linkedin_company_signup(){
		$validator = Validator::make($this->data->all(),[
			'company_name'      => $this->validation('company_name'), 
			'first_name'        => $this->validation('first_name'),
			'email'             => array_merge($this->validation('email'),[Rule::unique('users')->ignore('trashed','status')]),
		],[
			'company_name.required'     => 'Unable to fetch the company name from linkedin so please do the sign up manually.',
			'company_name.string'       => trans('general.M0011'),
			'company_name.regex'        => trans('general.M0011'),
			'company_name.max'          => trans('general.M0012'),
			'first_name.required'       => 'Unable to fetch the first name from linkedin so please do the sign up manually.',
			'first_name.string'         => trans('general.M0005'),
			'first_name.regex'          => trans('general.M0005'),
			'first_name.max'            => trans('general.M0006'),
			'email.required'            => 'Unable to fetch the email from linkedin so please do the sign up manually.',
			'email.email'               => trans('general.M0017'),
			'email.unique'              => trans('general.M0018'),
		]);		

		return $validator;
	}

	public function normal_candidate_signup(){
		$validator = Validator::make($this->data->all(),[
			'first_name'        => $this->validation('first_name'),
			'last_name'         => $this->validation('last_name'),
			'phone_code'        => $this->validation('phone_code'), 
			'mobile_number'     => array_merge($this->validation('mobile_number'),[Rule::unique('users')->ignore('trashed','status')]),
			'email'             => array_merge($this->validation('email'),[Rule::unique('users')->ignore('trashed','status')]),
			'password'          => $this->validation('password'),
			'g-recaptcha-response'          => $this->validation('g-recaptcha-response')
		],[
			'first_name.required'       => trans('general.M0004'),
			'first_name.string'         => trans('general.M0005'),
			'first_name.regex'          => trans('general.M0005'),
			'first_name.max'            => trans('general.M0006'),
			'last_name.required'        => trans('general.M0007'),
			'last_name.string'          => trans('general.M0008'),
			'last_name.regex'           => trans('general.M0008'),
			'last_name.max'             => trans('general.M0009'),
			'phone_code.required'       => trans('general.M0024'),
			'mobile_number.required'    => trans('general.M0010'),
			'mobile_number.string'      => trans('general.M0013'),
			'mobile_number.regex'       => trans('general.M0013'),
			'mobile_number.max'         => trans('general.M0014'),
			'mobile_number.min'         => trans('general.M0015'),
			'mobile_number.unique'      => trans('general.M0023'),
			'email.required'            => trans('general.M0016'),
			'email.email'               => trans('general.M0017'),
			'email.unique'              => trans('general.M0018'),
			'password.required'         => trans('general.M0019'),
			'password.string'           => trans('general.password_invalid'),
			'password.regex'            => trans('general.password_invalid'),
			'password.min'              => trans('general.M0021'),
			'password.max'              => trans('general.M0022'),
		]);
		return $validator;
	}

	public function linkedin_candidate_signup(){
		$validator = Validator::make($this->data->all(),[
			'first_name'        => $this->validation('first_name'),
			'email'             => array_merge($this->validation('email'),[Rule::unique('users')->ignore('trashed','status')]),
			
		],[
			'first_name.required'       => 'Unable to fetch the first name from linkedin so please do the sign up manually.',
			'first_name.string'         => trans('general.M0005'),
			'first_name.regex'          => trans('general.M0005'),
			'first_name.max'            => trans('general.M0006'),
			'email.required'            => 'Unable to fetch the email from linkedin so please do the sign up manually.',
			'email.email'               => trans('general.M0017'),
			'email.unique'              => trans('general.M0018'),
			
		]);
		return $validator;
	}		

	public function contactus(){
		$validator = Validator::make($this->data->all(), [
			'first_name'            => $this->validation('first_name'),
			'last_name'             => $this->validation('last_name'),
			'email'                 => ['required','email'],
			/*'phone'         		=> $this->validation('mobile_number'),
			'company_name'         	=> $this->validation('company_name'),
			'country'         		=> $this->validation('country'),*/
			'message'               => $this->validation('message'),
			'g-recaptcha-response'  => $this->validation('g-recaptcha-response'),
		],[
			'first_name.required'       => trans('general.M0004'),
			'first_name.regex'          => trans('general.M0005'),
			'first_name.string'         => trans('general.M0005'),
			'first_name.max'            => trans('general.M0006'),
			'last_name.required'        => trans('general.M0007'),
			'last_name.regex'           => trans('general.M0008'),
			'last_name.string'          => trans('general.M0008'),
			'last_name.max'             => trans('general.M0009'),
			'email.required'            => trans('general.M0016'),
			'email.email'               => trans('general.M0017'),
			/*'phone.required'     		=> trans('general.M0024'),
			'phone.regex'        		=> trans('general.M0013'),
			'phone.string'       		=> trans('general.M0013'),
			'phone.min'          		=> trans('general.M0015'),
			'phone.max'          		=> trans('general.M0014'),*/
			'message.required'          => trans('general.message'),
			'message.string'            => trans('general.message1'),
			'message.max'               => trans('general.message2'),
			'g-recaptcha-response.required' => trans('general.g-recaptcha-response'),
		]);
		return $validator;
	}

	public function forgot_password(){
		$validator = \Validator::make($this->data->all(), [
            $this->username()   			=> ['required','string'],
            'g-recaptcha-response'          => $this->validation('g-recaptcha-response')
        ],[
            $this->username().'.required'       => trans('general.required',['attribute' => trans('general.email_mobile')]),
            $this->username().'.string'         => trans('general.invalid_format_email_mobile',['attribute' => trans('general.email_mobile')]),
        ]);

		$validator->after(function($validator){
			$userdata = $this->findUser($this->data);
            $loginLable = $this->getLoginLable($this->data);
            $checkIp = \Models\LoginAttempt::checkIp($this->data->ip());
            if (($loginLable == 'email' && !filter_var($this->data->{$this->username()}, FILTER_VALIDATE_EMAIL)) || ($loginLable == 'mobile' && (strlen($this->data->{$this->username()}) > PHONE_NUMBER_MAX_LENGTH || strlen($this->data->{$this->username()}) < PHONE_NUMBER_MIN_LENGTH))){
				$validator->errors()->add($this->username(), trans('general.invalid_format_email_mobile',['attribute' => trans('general.email_mobile')]));
            }elseif(!$userdata){
                $validator->errors()->add($this->username(), trans('general.user_not_exists'));
            }elseif(!in_array($userdata->type,FRONT_END_USER_ROLE_TYPE)){
            	$validator->errors()->add('username','Currently the system allows access to client admin and candidate only.');
            }else if($userdata->status == 'locked'){
                $validator->errors()->add('username', trans('general.account_locked'));
            }else if($userdata->status == 'pending'){
            	if($this->data->ajax() == true){
	            	$validator->errors()->add('username',sprintf(trans('general.inactive_resend_mail'),url(sprintf('resend-mail-verification?email=%s',base64_encode($userdata->email)) ) ));
            	}else{
            		$validator->errors()->add('resend_mail',trans('general.M0027'));
            	}
	        }else if($loginLable == 'mobile' && $userdata->is_mobile_verified == 'no'){
            	if($this->data->ajax() == true){
            		$validator->errors()->add('username',sprintf(trans('general.inactive_verify_mobile'),url(sprintf('resend-mobile-verification?mobile_number=%s',$userdata->mobile_number) ) ));
            	}else{
            		$validator->errors()->add('verify_mobile',trans('general.webservice_mobile_not_verified'));
            	}
            }else if($userdata->status == 'inactive'){
	            $validator->errors()->add('username' ,trans('general.M0029'));
	        }
        });        
        return $validator;
	}

	public function change_password(){
		$validator = \Validator::make($this->data->all(), [
            'old_password' => array_merge($this->validation('old_password'),['old_password:'.(!empty(\Auth::user()->password)?\Auth::user()->password:"")]),
            'password'     => $this->validation('password'),
            'confirm_password'=> $this->validation('confirm_password'),
        ],[
        	'old_password.required' 			=> trans('general.required',['attribute' => 'Old Password']),
        	'old_password.old_password' 		=> trans('general.valid_input',['attribute' => 'Old Password']),
			'password.required'         		=> trans('general.required',['attribute' => 'Password']),
			'password.string'           		=> trans('general.invalid_format',['attribute' => trans('general.password')]),
			'password.regex'            		=> trans('general.invalid_format',['attribute' => trans('general.password')]),
			'password.min'              		=> trans('general.password_min_length'),
			'password.max'              		=> trans('general.password_max_length'),	
        	'confirm_password.required'     	=> trans('general.required',['attribute' => 'Confirm Password']),
        ]);
        return $validator;
	}

	public function changePass(){
		$validator = Validator::make($this->data->all(),[
			'password'		  	=> $this->validation('password'),
			'confirm_password' 	=> $this->validation('confirm_password'),
		],[
			'password.required' =>  \Lang::get('general.required',['attribute' => 'password',
			
			])
		]);
		return $validator;
	}

	public function sendOtpViaEmail(){
		$validator = Validator::make($this->data->all(),[
				'email' => array_merge($this->validation('email'),['exists:users,email']),
			],[
				'email.required'=> trans('general.M0016'),
				'email.email'   => trans('general.M0017'),
				'email.exists'   => trans('general.email_not_exists')
			]
		);	
		return $validator;
	}

	public function sendOtpMobile(){
		$validator = \Validator::make($this->data->all(),[
				'mobile_number' => $this->validation('mobile_number'),
			],[
				'mobile_number.required'    => trans('general.M0010'),
				'mobile_number.string'      => trans('general.M0013'),
				'mobile_number.regex'       => trans('general.M0013'),
				'mobile_number.max'         => trans('general.M0014'),
				'mobile_number.min'         => trans('general.M0015')
			]
		);
		$request = $this->data->all();
		$validator->after(function ($validator) use ($request){
			$getUser = \Models\Users::getUserDataByKeyVal('mobile_number',$request['mobile_number']);
            if(empty($getUser) || $getUser === null || $getUser==""){
            	$validator->errors()->add('mobile_number',trans('general.record_not_exists',['attribute' => 'Mobile Number']));
            }
        });
        return $validator;
	}
	
	public function forgot_otp(){
		$validator = Validator::make($this->data->all(),[
			$this->username()   => ['required','string'],
			'otp'		  => 'required'
		],[
            $this->username().'.required'       => trans('general.required',['attribute' => trans('general.email_mobile')]),
            $this->username().'.string'         => trans('general.invalid_format_email_mobile',['attribute' => trans('general.email_mobile')]),
            'otp'								=> trans('general.required',['attribute' => trans('general.otp')]),
		]);
        $validator->after(function($validator){
			$user_status = $this->findUser($this->data);
            if(empty($user_status)){
                $validator->errors()->add($this->username(), trans('general.user_not_exists'));
            }elseif($user_status['status'] != 'active'){
            	$validator->errors()->add($this->username(), trans('general.user_not_active'));
            }else if($user_status['forgot_otp'] != $this->data->otp){
                $validator->errors()->add('otp',trans('general.invalid_otp'));
            }
        });

		return $validator;
	}

	public function resetPassowrd(){
		$validator = Validator::make($this->data->all(),[
			$this->username()   => $this->validation('username'),
			'otp'		  		=> $this->validation('otp'),
            'password'        	=> $this->validation('password'),
            'confirm_password'	=> $this->validation('confirm_password'),
		],[
            $this->username().'.required'       => trans('general.required',['attribute' => trans('general.email_mobile')]),
            $this->username().'.string'         => trans('general.invalid_format_email_mobile',['attribute' => trans('general.email_mobile')]),
            'otp.required'						=> trans('general.required',['attribute' => trans('general.otp')]),
			'password.required'         		=> trans('general.required',['attribute' => 'Password']),
			'password.string'           		=> trans('general.invalid_format',['attribute' => trans('general.password')]),
			'password.regex'            		=> trans('general.invalid_format',['attribute' => trans('general.password')]),
			'password.min'              		=> trans('general.password_min_length'),
			'password.max'              		=> trans('general.password_max_length'),
        	'confirm_password.required'			=> trans('general.required',['attribute' => 'Confirm Password']),
		]);

        $validator->after(function($validator){
			$user_status = $this->findUser($this->data);
            $userdata = $this->findUser($this->data);
            $loginLable = $this->getLoginLable($this->data);
            $checkIp = \Models\LoginAttempt::checkIp($this->data->ip());
            if(empty($user_status)){
                $validator->errors()->add($this->username(), trans('general.user_not_exists'));
            }elseif($user_status['status'] == 'inactive'){
            	$validator->errors()->add($this->username(), trans('general.user_not_active'));
            }else if($user_status['forgot_otp'] != $this->data->otp){
                $validator->errors()->add('otp',trans('general.otp_expire',['attribute' => trans('general.otp')]));
            }else if($user_status->status == 'locked'){
                $validator->errors()->add($this->username(), trans('general.account_locked'));
            }else if($user_status->status == 'pending'){
            	if($this->data->ajax() == true){
	            	$validator->errors()->add($this->username(),sprintf(trans('general.inactive_resend_mail'),url(sprintf('resend-mail-verification?email=%s',base64_encode($userdata->email)) ) ));
            	}else{
            		$validator->errors()->add($this->username(),trans('general.M0027'));
            	}
	        }
            
        });

        return $validator;
	}
}