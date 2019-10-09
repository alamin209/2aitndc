<?php

namespace App\Http\Controllers\check_register;

use App\Check_register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Incoexpense;
use App\Upangsho;

class Check_registerController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $upangshos = upangsho::all();
        $incoexpense = Incoexpense::all();
        $years = Incoexpense::select('year')->groupBy('year')->get();
        $checkregister = Incoexpense::checkregister();
        $menuname = 'রিপোর্টস';
        return view('check_register.check_register',compact('years','menuname','upangshos','incoexpense', 'checkregister'));
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

   
    public function updateexpense($x){
        Incoexpense::where('incoexpenses_id', $x) ->update(['status' => 1]);
        return Redirect::back();
    }

    public function store(Request $request){
        
        $upangshos = upangsho::all();
        $incoexpense = Incoexpense::all();
        $years = Incoexpense::select('year')->groupBy('year')->get();
        $upangso = $request->upangsho_id;
        $year = $request->year;
        $date = $request->date;
        $menuname = 'রিপোর্টস';
        $checkregister = Incoexpense::checkregister($upangso, $year, $date);
        
        return view('check_register.check_register',compact('date', 'upangso', 'checkregister', 'year', 'years', 'menuname', 'upangshos', 'incoexpense'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Check_register  $check_register
     * @return \Illuminate\Http\Response
     */
    public function show(Check_register $check_register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Check_register  $check_register
     * @return \Illuminate\Http\Response
     */
    public function edit(Check_register $check_register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Check_register  $check_register
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Check_register $check_register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Check_register  $check_register
     * @return \Illuminate\Http\Response
     */
    public function destroy(Check_register $check_register)
    {
        //
    }
}
