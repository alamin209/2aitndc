<?php

namespace App\Http\Controllers\income_report;

use App\Income_rep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Incoexpense, App\Bank, App\Branch, App\BankDetails;

class Income_reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    
    public function index()
    {
        //
         
        $data['bank'] = Bank::all();
        $data['branch'] = Branch::all();
        $data['bankdetails'] = BankDetails::all();
        $data['menuname'] = 'রিপোর্টস';
         
        return view('income_report.income_report', compact('data'));
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
    public function store(Request $request){
        
        $data['bank'] = Bank::all();
        $data['branch'] = Branch::all();
        $data['bankdetails'] = BankDetails::all();
		$data['bnk'] = $request->bank;	
		$data['brnch'] = $request->branch;
		$data['acc'] = $request->accno;
		$data['sd'] = $request->sd;
		$data['ed'] = $request->ed;
		
		$data['incomereport'] = Incoexpense::allincomes($request->bank, $request->branch, $request->accno, $request->sd, $request->ed);		    
		$data['menuname'] = 'রিপোর্টস';
        return view('income_report.income_report', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Income_rep  $income_rep
     * @return \Illuminate\Http\Response
     */
    public function show(Income_rep $income_rep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Income_rep  $income_rep
     * @return \Illuminate\Http\Response
     */
    public function edit(Income_rep $income_rep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Income_rep  $income_rep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income_rep $income_rep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income_rep  $income_rep
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income_rep $income_rep)
    {
        //
    }
}
