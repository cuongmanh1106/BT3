<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        //return redirect()->route('product.list');
        return view('login');
    }

    public function notfound() {
    	return view('404');
    }

  
}
