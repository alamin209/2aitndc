<?php

namespace App\Http\Controllers\administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User_role;
use App\Departments;
use App\Designations;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Employee;
use File;
class Add_userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $useroll = User_role::all();
        $departments = Departments::all();
        $designations = Designations::all();
         $menuname             =    'HR Module';
        return view('administrator.add_user',compact('useroll','departments','designations','menuname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $this->validate($request, [
            'email'        => 'required|email|unique:users,email'
        ]);
        

        DB::table('users')
            ->insert([
                'user_name' =>$request['user_name'],
                'role_id' =>2,
                'password' => Hash::make($request['add_password']),
                'email' => $request['email'],
            ]);
        $user_id = DB::getPdo()->lastInsertId();


        $path = 'public/admin/employee/' . $user_id;
        File::makeDirectory($path);

        $fileName = null;
        $fileName2=null;
        if (request()->hasFile('sign_upload')) {
            $file      = $request->file('sign_upload');
            $fileName  = $file->getClientOriginalName();
            $file->move($path, $fileName);
        }
        $fileName1 = null;
        if (request()->hasFile('photo_upload')) {
            $file       = $request->file('photo_upload');
            $fileName1  = $file->getClientOriginalName() ;
            $file->move($path, $fileName1);
        }
        if (request()->hasFile('cv_upload')) {
            $file           = $request->file('cv_upload');
            $fileName2      = $file->getClientOriginalName() ;
            $file->move($path, $fileName2);
        }

        Employee::create([
                'rol_id'              => 2,
                'add_full_name'       => $request['add_full_name'],
                'emp_id'              => $request['emp_id'],
                'date_birth'          => date('Y-m-d',strtotime( $request['date_birth'])),
                'dep_id'              => $request['dep_id'],
                'dig_id'              => $request['dig_id'],
                'emp_type'            => $request['emp_type'],
                'gross_salary'        => $request['gross_salary'],
                'user_id'             => $user_id,
                'appointed_date'      => date('Y-m-d',strtotime($request['appointed_date'])),
                'joining_date'        => date('Y-m-d',strtotime( $request['joining_date'])),
                'marital_status'      => $request['marital_status'],
                'add_mobile'          => $request['add_mobile'],
                'father_name'         => $request['father_name'],
                'mother_name'         => $request['mother_name'],
                'reporting_to'        => $request['reporting_to'],
                'emrgemcy_contact'    => $request['emrgemcy_contact'],
                'sign_upload'         => $fileName,
                'photo_upload'        => $fileName1,
                'gender'             => $request['gender'],
                'present_address'     => $request['present_address'],
                'permenet_address'    => $request['permenet_address'],
                'add_email'           => $request['email'],
                'add_religin'         => $request['add_religin'],
                'account_no'         => $request['account_no'],
                'cv_upload'           => $fileName2,

            ]);
//        }
        return redirect()->back()->with('message', ' Employee Add   Success');
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
