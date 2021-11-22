<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    public function index() {
       return view('auth');
      
    }
}
