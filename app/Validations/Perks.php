<?php

namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\AuthenticatesUsers;
/**
* 
*/
class Perks
{
	use AuthenticatesUsers;
	protected $data;
	public function __construct($data){
		$this->data = $data;
	}

	private function validation($key){
		$validation = [
			'company_name' 				=> ['required','string','regex:/(^[A-Za-z0-9 .()]+$)+/','max:'.COMPANY_NAME_MAX_LENGTH],
			'location'					=> ['required','string'],
			'street'					=> ['required','string'],
			'city'						=> ['required','string'],
			'designation'				=> ['required','string'],
			'country'					=> ['required','integer'],
			'name'						=> ['required','string'],
			'first_name'				=> ['required','string','regex:/^[a-zA-Z0-9 ]{2,30}$/','max:'.NAME_MAX_LENGTH],
			'last_name'					=> ['required','string','regex:/^[a-zA-Z0-9 ]{2,30}$/','max:'.NAME_MAX_LENGTH],
			'about_you'					=> ['nullable'],
			'nationality'				=> ['required'],
			'country_of_residence'		=> ['required'],
			'phone_code'				=> ['required'],	
			'phone_code_company'		=> ['nullable'],	
			'mobile_number'				=> ['required','string','regex:/(^[0-9]+$)+/','max:'.PHONE_NUMBER_MAX_LENGTH,'min:'.PHONE_NUMBER_MIN_LENGTH],
			'mobile_number_company'		=> ['nullable','string','regex:/(^[0-9]+$)+/','max:'.PHONE_NUMBER_MAX_LENGTH,'min:'.PHONE_NUMBER_MIN_LENGTH],
			'email'						=> ['required','email'],
			'message'					=> ['required','string'],
			'username'					=> ['required','string'],
			'old_password'				=> ['required'],
			'password'					=> ['required', 'string', 'between:'.PASSWORD_MIN_LENGTH.','.PASSWORD_MAX_LENGTH ],
			'confirm_password'			=> ['required','same:password'],
			'user_id'					=> ['required'],
			'action'					=> ['required'],
			'g-recaptcha-response'		=> ['sometimes','required'],
			'experience'				=> ['required','numeric','min:'.EXPERIENCE_MIN_LENGTH,'max:'.EXPERIENCE_MAX_LENGTH],
			'otp'						=> ['required'],
			
			/*ADD BRANCH*/
			'phone_code_branch'				=> ['nullable'],
			'mobile_number_branch'			=> ['nullable','string','regex:/(^[0-9]+$)+/','max:'.PHONE_NUMBER_MAX_LENGTH,'min:'.PHONE_NUMBER_MIN_LENGTH],
			'mobile_number_not_required' 	=> ['nullable','string','regex:/(^[0-9]+$)+/','max:'.PHONE_NUMBER_MAX_LENGTH,'min:'.PHONE_NUMBER_MIN_LENGTH],
			'phone_code_not_required'		=> ['nullable'],
			
			/*CANDIDATE WORK EXPERIENCE*/
			'work_experience'			=> ['required','integer','max:'.MAX_WORK_EXPERIENCE_LIMIT],
			'jobtitle'					=> ['required','string','min:'.JOB_TITLE_MIN_LENGTH,'max:'.JOB_TITLE_MAX_LENGTH],
			'experience_level'			=> ['required','string',Rule::in(array_keys(experience_level(true)))],
			'company_name' 				=> ['required','string','min:'.COMPANY_NAME_MIN_LENGTH,'max:'.COMPANY_NAME_MAX_LENGTH],
			'is_currently_working' 		=> ['required',Rule::in(['yes','no'])],
			'joining_month' 			=> ['required','integer','min:1', "max:12"],
			'joining_year' 				=> ['required','integer','min:'.MIN_JOINING_YEAR,'max:'.MAX_JOINING_YEAR],
			'relieving_month' 			=> ['required_if:is_currently_working,'.DEFAULT_NO_VALUE],
			'relieving_year' 			=> ['required_if:is_currently_working,'.DEFAULT_NO_VALUE],
			'tags'						=> ['required','array'],
			'function'					=> ['nullable'],		
			'description' 				=> ['nullable','string','max:'.DESCRIPTION_MAX_LENGTH,'min:'.DESCRIPTION_MIN_LENGTH],
			
			/*CANDIDATE EDUCATION*/
			'education_experience'		=> ['required','integer','max:'.MAX_EDUCATION_EXPERIENCE_LIMIT],
			'degree_title'				=> ['required','string','min:'.EDUCATION_TITLE_MIN_LENGTH,'max:'.EDUCATION_TITLE_MAX_LENGTH],
			'degree_level'				=> ['required','string'],
			'grade_point'				=> ['nullable','numeric','min:'.GRADE_MIN_LENGTH,'max:'.GRADE_MAX_LENGTH],
			'field_of_study'			=> ['required','string'],
			'minor'						=> ['nullable','string','min:'.MINOR_MIN_LENGTH,'max:'.MINOR_MAX_LENGTH],
			'school'					=> ['nullable','string','min:'.SCHOOL_NAME_MIN_LENGTH,'max:'.SCHOOL_NAME_MAX_LENGTH],
			'degree_status'				=> ['required','string',Rule::in(['passed','appearing'])],
			'education_start_year'		=> ['required','integer','min:'.MIN_START_EDUCATION_YEAR,'max:'.MAX_START_EDUCATION_YEAR],
			'education_end_year'		=> ['required_if:degree_status,passed','nullable'],

			/*CANDIDATE SKILLS*/
			'skills'					=> ['required','array','min:2','max:6'],
			'tags'						=> ['required','array','min:2','max:6'],

			/*CERTIFICATES*/
			'certificate'						=> ['required','integer','max:'.MAX_CERTIFICATE_LIMIT],
			"certificate_name"					=> ['required', 'string'],
			"certificate_authority"				=> ['nullable','string'],
			"received_month"					=> ['nullable','integer', 'min:1', "max:12"],
			"received_year"						=> ['nullable','integer','min:'.MIN_RECEIVED_YEAR,'max:'.MAX_RECEIVED_YEAR],
			"valid_till_month"					=> ['nullable','integer', 'min:1', "max:12"],
			"valid_till_year"					=> ['nullable','integer','min:'.MIN_VALID_TILL_YEAR,'max:'.MAX_VALID_TILL_YEAR],
			
			/*CANDIDATE LANUGUAGE*/
			'language_name'						=> ['sometimes','nullable','string'],
			'ilr_level'							=> ['nullable','integer'],
			
			/*CANDIDATE SOCIAL*/
			'candidate_social'					=> ['nullable','array'],
			'social_key'						=> ['required','string'],
			'social_value'						=> ['required','string','max:'.MAX_SOCIAL_LENGTH,'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],


			/*DELETE*/
			"id"								=> ['required','string'],

			/*EYES SHARE*/
			'candidate_entity'					=> ['required','string',Rule::in(sharableEntity(true))],
			'share_status'						=> ['required','string',Rule::in(['public','private','protected'])],
			
			/*PERSONAL INFORMATION*/
			
			'dob_check'							=>['required'],
			'date_of_birth'						=>['required_if:dob_check,yes'],
			'gender'							=>['required'],
			'country_work_from'					=>[],
			'country_work_from_country'			=>['nullable'],
			'country_work_from_eligibility'		=>['nullable',Rule::in(['current','previous'])],
			'travel_willingness'				=>['required',Rule::in([DEFAULT_YES_VALUE,DEFAULT_NO_VALUE])],	
			'travel_willingness_percentage'		=>['required_if:travel_willingness,'.DEFAULT_YES_VALUE],

			/*CANDIDATE PREFERENCES*/
			'countries_work_from'				=>['required','array','min:'.MIN_PREFERRED_COUNTRIES_LIMIT,'max:'.MAX_PREFERRED_COUNTRIES_LIMIT],
			'desired_job_titles'				=>['required','array','min:'.MIN_DESIRED_JOB_TITLE_LIMIT,'max:'.MAX_DESIRED_JOB_TITLE_LIMIT],

			/*COMPANY PROFILE*/
			'company_industry' 					=> ['required'],
			'industry' 							=> ['required'],
			'industry_name' 					=> ['required'],
			'industry_type'						=> ['required'],
			'point_of_contact'					=> ['required'],
			'interviewers'						=> ['nullable','array'],
			'interviewer_name'					=> ['nullable'],
			'website'  							=> ['nullable','string','regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
			'fax_code'          				=> ['nullable','string'],	
			'fax'          						=> ['nullable','string','regex:/(^[0-9]+$)+/','max:'.PHONE_NUMBER_MAX_LENGTH,'min:'.PHONE_NUMBER_MIN_LENGTH],
			'location_street'					=> ['nullable','string'],
			'billing_street'					=> ['nullable','string'],
			'location_code'						=> ['nullable','string','regex:/(^[0-9]+$)+/','max:'.POSTAL_CODE_MAX_LENGTH,'min:'.POSTAL_CODE_MIN_LENGTH],
			'billing_code'						=> ['nullable','string','regex:/(^[0-9]+$)+/','max:'.POSTAL_CODE_MAX_LENGTH,'min:'.POSTAL_CODE_MIN_LENGTH],
			'location_state'					=> ['nullable','string'],
			'billing_state'						=> ['nullable','string'],
			'billing_city'						=> ['nullable','string'],
			'location_city'						=> ['nullable','string'],
			'billing_country'					=> ['nullable','string','integer'],
			'location_country'					=> ['nullable','string','integer'],
			'location_address'					=> ['nullable',Rule::in('same','different')],

			/*************** C L I E N T ( C O M P A N Y ) **************************/
			
			/*COMPANY CREATE USER*/
			'primary_branch'					=> ['required'],
			'company_user_type'					=> ['required',Rule::in(['company_user','interviewer'])],
			'company_status'					=> ['required',Rule::in(['active','inactive'])],
			
			/*BRANCH LIST*/
			'search_by_branch_name'				=> ['nullable','string'],
			'search_by_branch_industry'			=> ['nullable'],

			/*USER LIST*/
			'search_by_user_name'				=> ['nullable','string'],
			'search_by_user_type'				=> ['nullable','string'],
			'search_by_user_status'				=> ['nullable',Rule::in(['active','inactive','locked'])],
			'search_by_user_branch'				=> ['nullable','string'],
			'profile_picture'				    => ['nullable'],		

		];
		return $validation[$key];
	}

	public function login(){
        $validator = \Validator::make($this->data->all(), [
            $this->username() => 'required|string',
            'password' => $this->validation('password'),
        ],[
        	$this->username().'.required' 	=> trans('general.M0032'),
        	$this->username().'.string' 	=> trans('general.M0033'),
			'password.required'         	=> trans('general.M0019'),
			'password.string'           	=> trans('general.M0020'),
			'password.regex'            	=> trans('general.M0020'),
			'password.between'              => trans('general.user_authentication_failed')
        ]);

        $validator->after(function($validator){
            $userdata = $this->findUser($this->data);
            $loginLable = $this->getLoginLable($this->data);

            $checkIp = \Models\LoginAttempt::checkIp($this->data->ip());
            $remaining_attempt = 4 - $userdata['maxattempts'];
            if (($loginLable == 'email' && !filter_var($this->data->{$this->username()}, FILTER_VALIDATE_EMAIL)) || ($loginLable == 'mobile' && (strlen($this->data->{$this->username()}) > PHONE_NUMBER_MAX_LENGTH || strlen($this->data->{$this->username()}) < PHONE_NUMBER_MIN_LENGTH))){
				$validator->errors()->add($this->username(), trans('general.invalid_format_email_mobile',['attribute' => trans('general.email_mobile')]));
            }else if(!$userdata){
                
                $validator->errors()->add('password', trans('general.user_authentication_failed'));
            }elseif(!in_array($userdata->type,FRONT_END_USER_ROLE_TYPE)){
            	$validator->errors()->add('password','Currently the system allows access to client admin and candidate only.');
            }else if($userdata->status == 'locked'){
                $validator->errors()->add('password', trans('general.account_locked'));
            }else if($userdata->status == 'pending'){
            	if($this->data->is('api/*')){
            		$validator->errors()->add('resend_mail',trans('general.M0027'));
            	}else{
	            	$validator->errors()->add('password',sprintf(trans('general.inactive_resend_mail'),url(sprintf('resend-mail-verification?email=%s',base64_encode($userdata->email)) ) ));
            	}
	        }else if($loginLable == 'mobile' && $userdata->is_mobile_verified == 'no'){
            	if($this->data->is('api/*')){
            		$validator->errors()->add('verify_mobile',trans('general.webservice_mobile_not_verified'));
            	}else{
            		$validator->errors()->add('username',sprintf(trans('general.inactive_verify_mobile'),url(sprintf('resend-mobile-verification?mobile_number=%s',$userdata->mobile_number) ) ));
            	}
            }else if($userdata->status == 'inactive'){
	            $validator->errors()->add('password' ,trans('general.M0029'));
	        }elseif(!empty($checkIp->attempt) && $checkIp->attempt> 2){
            	$requestData = $this->data->all();
            	if(empty($requestData['g-recaptcha-response'])){
            		$validator->errors()->add('g-recaptcha-response','g-recaptcha-response is required.');
            	}
            }
        });
        
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