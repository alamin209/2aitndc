<?php

namespace App\Http\Controllers\department;

use App\Departments;
use Illuminate\Http\Request;
//use App\Course;
use App\Http\Controllers\Controller;



class DepartmentsController extends Controller
{

    public function index()
    {
       $department = Departments::all();
        $menuname = 'Administrator';
        return view('department.add_department', compact('menuname','department', 'upangshos'));
    }


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

        Departments::create([
            'instutite_id'  => 1,
            'department_name'     => $request['department_name'],
        ]);

        return redirect()->back()->with('message', ' Department Add   Success');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function show(Departments $departments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function edit(Departments $departments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departments $departments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departments  $departments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departments $departments)
    {
        //
    }
}
