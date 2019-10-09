<?php

namespace App\Http\Controllers\badget_register;

use App\Budget_register, Illuminate\Http\Request, App\Http\Controllers\Controller;
use App\Upangsho, App\TaxTypeType, App\BudgetLog, App\Khat;
use App\Khattype, App\TaxType, App\Budget;

class Badget_registerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $upangshos = upangsho::all();
        $khats = Khat::where('upangsho_id',3)->where('khattype', 2)->get();
        $years = Budget::select('year')->groupBy('year')->get();
        $menuname = 'রিপোর্টস';
        return view('badget_register.badget_register', compact('menuname','upangshos','khats','taxTypes', 'years'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        

       $data ='<option value="">খাত নির্ধারণ</option>';
       $taxtptp = Khat::where('upangsho_id', $request->id)->get();
      
        foreach($taxtptp as $tp){
            
            $data .= '<option value="'.$tp->khat_id.'">'.$tp->serilas.$tp->khat_name.'</option>';
        }
        echo $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $badgetRegister = Upangsho::getBadgetRegister($request->upangsho_id, $request->khattype_id, $request->year);
        $upangshos = upangsho::all();
        $khats = Khat::where('upangsho_id', 3)->where('khattype', 2)->get();
        $years = Budget::select('year')->groupBy('year')->get();
        $menuname = 'রিপোর্টস';
        $upangshoid = $request->upangsho_id;
        $khattypeid = $request->khattype_id;
        $year = $request->year;
        $budget = Upangsho::getBadget();
        $getKhatNupangsho = Upangsho::getKhatNupangsho();
        
        return view('badget_register.badget_register', compact(
            
            'getKhatNupangsho', 
            'budget', 'upangshoid', 
            'khattypeid', 
            'year', 
            'menuname',
            'upangshos',
            'khats',
            'taxTypes', 
            'years', 
            'badgetRegister'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Budget_register  $budget_register
     * @return \Illuminate\Http\Response
     */
    public function show(Budget_register $budget_register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Budget_register  $budget_register
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget_register $budget_register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Budget_register  $budget_register
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget_register $budget_register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Budget_register  $budget_register
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget_register $budget_register)
    {
        //
    }
}
