<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ResponseController extends Controller
{
    public function index(){

        if (!Auth::check()) {
            return redirect('/login');  
        }

        $roles = Auth::user()->getRoleNames()->toArray();
       
        // $checkrole = explode(',', $role);
        if (in_array('admin', $roles)) {
            return redirect('/admin/dashboard');
        } else if (in_array('customer', $roles)) {
            return redirect('/user/home');
        }else {
            return redirect('/login');
        }
    }
}
