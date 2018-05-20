<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validations\Employee as Validations;
use Models\Users;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class EmployeeController extends Controller
{

    private $post;
    
    public function __construct(Request $request){
        $this->jsondata         = (object)[];
        $this->message          = "";
        $this->error_code       = "no_error_found";
        $this->status           = false;
        $this->status_code      = 200;
        $this->redirect         = false;
        $this->modal            = false;
        $this->alert            = false;
        $this->successimage     = asset('images/success.png');
        $this->ajax             = 'api';
        
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,Builder $builder)
    {
        $userList = \Models\Users::list('array','','','id_user-desc');
        $userList = $userList['userlist'];
        $data['view'] = 'admin.backend.employee.list';

        if ($request->ajax()) {
            return DataTables::of($userList)

            ->editColumn('action',function($userList){
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url('admin/client/'.___encrypt($userList['id_user']).'').'"
                            ">View</a>';
               
                if($userList['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/client/status/?id=%s&status=inactive',$userList['id_user'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('/images/inactive.png').'"
                        data-ask="Would you like to change '.$userList['name'].' status from active to inactive?" >Active</a>';
                }elseif($userList['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/client/status/?id=%s&status=active',$userList['id_user'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('/images/active.png').'"
                        data-ask="Would you like to change '.$userList['name'].' status from inactive to active?" >Inactive</a>';
                }
                    $html   .= '</div>';
                                
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $data['html'] = $builder
            ->addColumn(['data' => 'id', 'name' => 'id','title' => 'Cand-ID','orderable' => false])
            ->addColumn(['data' => 'name',     'name' => 'name',    'title' => 'Name','orderable' => false])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email','orderable' => false])
            ->addColumn(['data' => 'mobile_number','name' => 'mobile_number', 'title' => 'Mobile Number','orderable' => false])
            ->addColumn(['data' => 'location','name' => 'location', 'title' => 'Location','orderable' => false])
            ->addColumn(['data' => 'registration_device','name' => 'registration_device','title' => 'App','orderable' => false])
            ->addColumn(['data' => 'last_login','name' => 'last_login','title' => 'Last Access','orderable' => false])
            ->addColumn(['data' => 'is_modified','name' => 'is_modified','title' => 'Modified','orderable' => false])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false])
            ->addAction([
                'title' => '',
                'orderable' => false
        ]);        
        return view('admin.backend.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['view'] = 'admin.backend.employee.add';
        return view('admin.backend.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = new Validations($request);
        $validator  = $validation->createEmployee();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $addEmployee = [
                'name'              => sprintf('%s %s',$request->first_name,$request->last_name),
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'email'             => $request->email,
                'password'          => bcrypt($request->password),
                'type'              => 'employee',
                'phone_code'        => $request->phone_code,
                'mobile_number'     => $request->mobile_number,
                'date_of_birth'     => date('Y-m-d',strtotime($request->date_of_birth)),
                'gender'            => $request->gender,
                'current_address'   => $request->current_address,
                'permanent_address' => $request->permanent_address,
                'marital_status'    => $request->marital_status,
                'date_of_joining'   => date('Y-m-d',strtotime($request->date_of_joining)),
                'remember_token'    => bcrypt(__random_string()),
                'status'            => 'pending',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ];
            $isAdded = Users::add($addEmployee);
            if(!empty($isAdded)){
                $this->status   = true;
                $this->redirect = url('admin/employee');
                $this->modal    = true;
                $this->message  = "Employee has been added successfully.";
            }
        }
        return $this->populateresponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
