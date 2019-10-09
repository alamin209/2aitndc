<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        
        'role_id','emp_id','name','user_name','email', 'phone', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
        'password', 'remember_token', 
    ];
    
    public static function getmenu(){
        
        //$request = new Request();
        
        //echo $usrrole = Auth::id; die();
       
         
        $menu = array(		
		/*	'উপাংশ' => array(			
						'উপাংশ যুক্তকরণ' => 'upangsho/'					
					),
			'খাত টাইপ' => array(			
						'খাত টাইপ যুক্তকরণ' => 'khattype/'					
					),
			'খাত' => array(			
						'খাত যুক্তকরণ' => 'add_khat/'					
					), */

			'বাজেট' => array(	
			
				'বাজেট যুক্তকরণ' => 'budget/',					
				'বাজেট ব্যবস্থাপন' => 'budget_management/'					
			),
			'ব্যাংক' => array(
			 /* 'ব্যাংক যুক্তকরণ' => 'bank/',
				'শাখা যুক্তকরণ' => 'branch/', */		
				'ব্যাংক বিবরণ সংযুক্তি' => 'bankdetails/'					
			),
			
			'আয়/ব্যয় সংযুক্তি' => array(

				'আয়/ব্যয় সংযুক্তি' => 'incoexpense/',				
				'আয়/ব্যয়  ব্যবস্থাপন' => 'incoexpense_managment/'
			),
			
			'রিপোর্টস' => array(
			
				'আয় বাজেট' => 'budget_report/in',					
				'ব্যয় বাজেট' => 'budget_report/out',
				'ব্যাংক বিবরণ' => 'bank_report/',
				'খরচ বিবরণ' => 'expense_report/',
				'জমা বিবরণ' => 'income_report/'	,
				'চেক রেজিস্টার' => 'check_register/',
				'বাজেট রেজিস্টার' => 'badget_register/',
				'এ্যাবস্ট্রাক্ট রেজিস্টার' => 'abstruct_register/'
			),
		
		);
		return $menu;
    }
}
