<?php

namespace App\Http\Controllers\expense_report;

use App\Expense_report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Incoexpense, App\Bank, App\Branch, App\BankDetails;

class Expense_reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $data['bank'] = Bank::all();
        $data['branch'] = Branch::all();
        $data['bankdetails'] = BankDetails::all();
        $menuname = 'রিপোর্টস';
       
        return view('expense_report.expense_report', compact('menuname', 'data'));
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
        
        $data['bank'] = Bank::all();
        $data['branch'] = Branch::all();
        $data['bankdetails'] = BankDetails::all();
		$data['bnk'] = $request->bank;	
		$data['brnch'] = $request->branch;
		$data['acc'] = $request->accno;
		$data['sd'] = $request->sd;
		$data['ed'] = $request->ed;
		
		$data['expencereport'] = Incoexpense::allexpenses($request->bank, $request->branch, $request->accno, $request->sd, $request->ed);		    
		$data['menuname'] = 'রিপোর্টস';
        return view('expense_report.expense_report', compact('data'));
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense_report  $expense_report
     * @return \Illuminate\Http\Response
     */
    public function show(Expense_report $expense_report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense_report  $expense_report
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense_report $expense_report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense_report  $expense_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense_report $expense_report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense_report  $expense_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense_report $expense_report)
    {
        //
    }
}
