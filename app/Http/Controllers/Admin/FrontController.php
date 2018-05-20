<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function login(Request $request)
    {
    	$data['view'] = 'admin.front.login';
    	return view('admin.front.index')->with($data);
    }

    public function authenticate(Request $request)
    {
    	dd($request->all());
    }
}
