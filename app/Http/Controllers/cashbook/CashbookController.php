<?php

namespace App\Http\Controllers\cashbook;

use Illuminate\Http\Request; use App\indirect_expense;
use App\Http\Controllers\Controller; use App\Income; 
use App\Inventory; use Request as Rqst; use App\BankDetails;
use App\ExpenseType; use App\IncomeType; use App\Bank; use App\Expense;

class CashbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $banks = BankDetails::join('banks', 'banks.bank_id', '=', 'bank_details.bank_id')->where('type',1)->get();
		$menuname = 'Report';
        return view('report.cashbook', compact('menuname', 'banks'));
    }
	
	
	public function finacial_report(Request $request){
		
		$sd = $request->sd;
        $report = Inventory::getfiancial_position($sd);
		$menuname = 'Report';
		return view('report.financial', compact('report', 'menuname', 'sd'));
    }
	
	public function finacial_details_report(){		
		 
		$sd = Rqst::segment(2);
        $report = Inventory::getfiancial_datails($sd);
		$menuname = 'Report';
		return view('report.financial_details', compact('report', 'menuname', 'sd'));
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
		
        $year = $request->year;
		$month = $request->month;
		$bank = $request->bank;
		$sd = $request->year.'-'.$request->month.'-01';
		$ed = date('Y-m-t', strtotime($sd));
		$report = Expense::getcashbook($sd, $ed, $bank);
		$banks = BankDetails::join('banks', 'banks.bank_id', '=', 'bank_details.bank_id')->where('type',1)->get();
		$menuname = 'Report';
		return view('report.cashbook', compact('report', 'menuname', 'year', 'month', 'bank', 'banks'));
    }
    
    public function cashbook_year(Request $request){
		
		$report ='';
		$fyear = $request->fyear;
		$fbank = $request->fbank;
		$month_array = array('07', '08', '09', '10', '11', '12', '01', '02', '03', '04', '05', '06');
		$current_month = date('m');
		foreach($month_array as $k=>$ma){
		    
		    if($k>5 && $request->fyear==$fyear) $fyear++;
		    $sd = $fyear.'-'.$ma.'-01'; 
		    $ed = date('Y-m-t', strtotime($sd));
		    $report .= Expense::getcashbook($sd, $ed, $fbank);
		    if($current_month == $ma)break;
		}
		$fyear = $request->fyear;
		$menuname = 'Report';
		$banks = BankDetails::join('banks', 'banks.bank_id', '=', 'bank_details.bank_id')->where('type',1)->get();
		return view('report.cashbook', compact('report', 'menuname', 'fyear', 'fbank', 'banks'));
    }
	
	
	public function updateaccounts(Request $request) {
        
        //echo $request->amount.$request->note.$request->date.$request->type.$request->fyear.$request->fbank;
        if($request->type == 'income'){
            
            $income = Income::where('id', $request->id)->get()->first();
            $update_balance = BankDetails::where('bank_details_id', $income->accountid)->get()->first()->update_balance;
            $newbalance = ($update_balance - $income->amount) + $request->amount;
            BankDetails::where('bank_details_id', $income->accountid)->update(['update_balance'=>$newbalance]);
            Income::where('id', $request->id)->update(['amount'=>$request->amount, 'note'=>$request->note]);
            echo $request->type;
        }
        if($request->type == 'expense'){
            
            $income = indirect_expense::where('id', $request->id)->get()->first();
            $update_balance = BankDetails::where('bank_details_id', $income->accountid)->get()->first()->update_balance;
            $newbalance = ($update_balance + $income->amount) - $request->amount;
            BankDetails::where('bank_details_id', $income->accountid)->update(['update_balance'=>$newbalance]);
            indirect_expense::where('id', $request->id)->update(['amount'=>$request->amount, 'note'=>$request->note]);
            echo $request->type;
        }
    }
	
	
	public function ledger(){
		
		$ex_types = ExpenseType::all();
		$in_types = IncomeType::all();
		
		
		
        $menuname = 'Report';
        return view('report.ledger', compact('menuname', 'ex_types', 'in_types'));
    }
    
    public function ledger_post(Request $request){
	    
	    $report = '';
		$year = $request->year;
		$acctype = $request->acctype;
		$acc = $request->acc;
		
		$sd = $request->year.'-07-01';
		$ed = ($request->year+1).'-06-30';
		if($acc!='all'){
		    
		    $report = IncomeType::getLedger($year, $sd, $ed, $acctype, $acc);
		}else{
		    if($acctype==1){ $accs = IncomeType::all(); }else{ $accs = ExpenseType::all(); }
		    foreach($accs as $acc){
		    
		        $report .= IncomeType::getLedger($year, $sd, $ed, $acctype, $acc->id);
		    }
		}
		$ex_types = ExpenseType::all();
		$in_types = IncomeType::all();
		$acc = $request->acc.$request->acctype;
		
		$menuname = 'Report';
        return view('report.ledger', compact('report', 'menuname', 'ex_types', 'in_types', 'year', 'acctype', 'acc'));
    }

	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
		
		        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        
    
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
