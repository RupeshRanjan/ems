<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Employee extends Controller
{
    public function addView(){
    	$data['view'] = 'admin.backend.employee.add';
    	return view('admin.backend.index')->with($data);
    }
}
