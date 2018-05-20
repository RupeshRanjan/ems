<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
    	$data['view'] = 'dashboard';
    	return view('index')->with($data);
    }
}
