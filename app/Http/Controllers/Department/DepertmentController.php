<?php

namespace App\Http\Controllers\department;

use App\Depertment;
use Illuminate\Http\Request;
//use App\Course;
use App\Http\Controllers\Controller;



class DepertmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Depertment::all();
        $menuname = 'Administrator';
        return view('department.add_department', compact('menuname','department', 'upangshos'));
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
        Depertment::create([
            'department_name'     => $request['department_name'],


        ]);

        return redirect()->back()->with('message', ' Department Add   Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Depertment  $depertment
     * @return \Illuminate\Http\Response
     */
    public function show(Depertment $depertment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Depertment  $depertment
     * @return \Illuminate\Http\Response
     */
    public function edit(Depertment $depertment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Depertment  $depertment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Depertment $depertment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Depertment  $depertment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depertment $depertment)
    {
        //
    }
}
