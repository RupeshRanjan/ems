<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Perks\Response;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $status;
    protected $jsondata;
    protected $status_code;
    protected $error_code;
    protected $ajax;
    protected $redirect;
    protected $modal;
    protected $successimage;
    protected $alert;
    protected $message;
    protected $prefix;
    protected $language;
    protected $reCaptcha;

    protected function populateresponse(){
        if(empty($this->status)){
            $data['status']     = $this->status;
            $response = new Response($this->message);
            if($this->ajax == 'api'){
                $data['errors']     = $response->api_error_response();
                $data = json_decode(json_encode($data),true);

                if(empty($this->jsondata)){
                    $data['data'] = (object) $this->jsondata;
                }
                $data['status_code'] = $this->status_code = 200;
                $data['error_code']  = $this->error_code;
                return $data;
            }else{
                $data['errors']     = $response->web_error_response();
                return ([
                    'data'          => $data['errors'],
                    'status'        => $this->status,
                    'status_code'   => $this->status_code,
                    'message'       => $this->message,
                    'reCaptcha'     => $this->reCaptcha,
                    'nomessage'     => true,
                    'modal'         => $this->modal,
                    'successimage'  => $this->successimage,
                ]);                
            }
        }else{
            if($this->ajax == 'api'){
                return [
                    'status'        => $this->status,
                    'status_code'   => $this->status_code,
                    'data'          => $this->jsondata,
                    'message'       => $this->message,
                ]; 
            }else{
                return [
                    'status'        => $this->status,
                    'status_code'   => $this->status_code,
                    'redirect'      => $this->redirect,
                    'data'          => $this->jsondata,
                    'modal'         => $this->modal,
                    'successimage'  => $this->successimage,
                    'message'       => $this->message,
                    'alert'         => $this->alert,
                ];  
            }
        }        
    }    
}
