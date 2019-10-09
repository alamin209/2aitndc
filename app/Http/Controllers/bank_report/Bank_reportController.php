<?php

namespace App\Http\Controllers\Bank_report;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bank;
use App\Branch; 
use App\BankDetails; 
use App\Incoexpense; 
class Bank_reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

       $years = Incoexpense::select('year')->groupBy('year')->get();
       $bank_datas = BankDetails::details();
       $menuname = 'রিপোর্টস';
       return view('bank_report.view_bank_report', compact('years','bank_datas','menuname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
      
        $year = $request->year;
        $years = Incoexpense::select('year')->groupBy('year')->get();
        $bank_datas = BankDetails::details($year); $menuname = 'রিপোর্টস';
        return view('bank_report.view_bank_report', compact('year','years','bank_datas','menuname'));

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
