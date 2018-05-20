<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validations\Perks as Validations;

class FrontController extends Controller
{

    private $post;

    public function __construct(Request $request){
        $this->language         = \App::getLocale();
        $this->prefix           = \DB::getTablePrefix();        
        $this->jsondata         = (object)[];
        $this->message          = "";
        $this->error_code       = "no_error_found";
        $this->status           = false;
        $this->status_code      = 200;
        $this->redirect         = false;
        $this->modal            = false;
        $this->alert            = false;
        $this->ajax             = 'api';
        $this->successimage     = asset('images/message.png');
        
        if($request->ajax()){
            $this->ajax = 'web';
        }

        $json = json_decode(file_get_contents('php://input'),true);
        if(!empty($json)){
            $this->post = $json;
        }else{
            $this->post = $request->all();
        }


        $request->replace($this->post);
    }

    public function login(Request $request)
    {
    	$data['view'] = 'admin.front.login';
    	return view('admin.front.index')->with($data);
    }

    public function authenticate(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->login();

        if($validator->fails()){
            $this->validator->errors();
        }else{

        	$credentials = ['email' => $request->email,'password' => $request->password];
            if(Auth::attempt($credentials)){
                $this->jsondata     = [];
                $this->message      = 'logged in';
                $this->status       = true;
                $this->modal        = false;
                $this->redirect     = url('admin/dashboard');
        	}else{
        		
        	}
        }
        return $this->populateresponse();
    }
}
