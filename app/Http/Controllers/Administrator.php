<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Administrator extends Controller
{
    //
    public function __construct(){
    
        $this->middleware('auth');  
    }
   
    public function dashboard()
    {
       return view('administrator.dashboard');
    }


    public function add_menu()
    {
       return view('administrator.add_menu');
    }


     public function add_subs_menu()
    {
       return view('administrator.add_subs_menu');
    }


     public function add_user_role()
    {
       return view('administrator.add_user_role');
    }


     public function add_user_permission()
    {
       return view('administrator.add_user_permission');
    }


     public function add_user()
    {

       return view('administrator.add_user');
    }

}
