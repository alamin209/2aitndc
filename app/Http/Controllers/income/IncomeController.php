<?php

namespace App\Http\Controllers\income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; use App\IncomeType, App\Bank; 
use App\IncomeCat, App\Income; use App\BankDetails; use App\trx_record;
use Carbon\Carbon;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuname = 'Accounts';
        $upangshos = IncomeCat::all();
        $incometype = IncomeType::get();
        return view('income.add_income' , compact('upangshos', 'menuname', 'incometype'));
    }
	
	
	public function income_form()
    {
		$menuname = 'Accounts';
		$incomecats = IncomeCat::all();
		$incometypes = IncomeType::get();
		$bank = Bank::all();
        return view('income.income' , compact('menuname', 'incometypes', 'incomecats', 'bank')); 
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
        
         
		  incomeCat::create([
				'category'  => $request['incomecat'],
				 
		  ]);
		  $msg = 'Income Category has been Created!';
		  

        return redirect()->back()->with('message', $msg);
    }
	
	public function stor2(Request $request)
    {
        
			$inty = new IncomeType;
			$inty->category = $request->expcat;
			$inty->type =  $request->typename;
			$inty->note =  $request->note;
			$inty->save(); 
		 
		 $msg = 'Income Type has been Created!';

        return redirect()->back()->with('typemessage', $msg);
    }
	
	
	public function income_post(Request $request){
		
		$bank = $request->bank_id;
        $branch = $request->branch_id;
        $bankact = $request->bankact;
        $amounts = $request->amount;
        $exType = $request->expenseType;
        $exptype = $request->exptype;
        $notes = $request->note;
        $dates = $request->deductDate;
        $pType = $request->paymentType;
		
		$mth = explode('-', $dates);
		
		if($mth[1] > 6){ $sd = $mth[0].'-07-01';  $ed = ($mth[0]+1).'-06-30'; 
		}else{	$sd = ($mth[0]-1).'-07-01';   $ed = $mth[0].'-06-30'; }
		
		$vchr = Income::whereBetween('paydate', [$sd, $ed])->where('accountid', $bankact)->orderBy('id', 'desc')->first();
		if(empty($vchr)){ $vchr = 1; }else{ $vchr = $vchr->vcher + 1; }
		
		//echo $sd.' - '.$ed; echo '<br>';
		//echo $bankact;echo '<br>';
        //echo $vchr; exit;
        if ($pType == '2') {

            $balance_id = Income::create([
			
				'inco_cat' => $exType,
				'inco_type' => $exptype,
				'pay_type' => $pType,
				'bank_id' => $bank,
				'branch_id' => $branch,
				'accountid' => $bankact,
				'vcher' => $vchr,
				'amount' => $amounts,
				'note' => $notes,
				'paydate' => $dates,
				'date' => Carbon::now()
            ]);

            $lastId = $balance_id->id;            
			
			$bankdetails = BankDetails::where('bank_details_id', $bankact)->first();

			$am = $bankdetails->update_balance + $amounts;
			BankDetails::where('bank_details_id', $bankdetails->bank_details_id)->update([
				'update_balance' => $am
			]);

			$sourceBank = trx_record::create([
				'table_id' => 3, 
				'table_incrment_id' => $lastId,
				'amount_type' =>  2,
				'branchid' => $branch,
				'acount_details_id' => $bankact,
				'amount' => $amounts,
				'trx_date' => $dates,
				'pay_type' => 2
			]);		
			
			
        } else if ($pType == '1') {

            $balance_id = Income::create([
                        
				'inco_cat' => $exType,
				'inco_type' => $exptype,
				'pay_type' => $pType,
				'bank_id' => $bank,
				'branch_id' => $branch,
				'accountid' => $bankact,
				'vcher' => $vchr,
				'amount' => $amounts,
				'note' => $notes,
				'paydate' => $dates,
				'date' => Carbon::now()
            ]);

            $lastId = $balance_id->id;
            
            if($bankact == 14 || $bankact == 15){
            
                $bankdetails = BankDetails::where('bank_details_id', $bankact)->first();
                $am = $bankdetails->update_balance - $amounts;
                BankDetails::where('bank_details_id', $bankact)->update([
                    'update_balance' => $am
                ]);
            }else{
                
                $bankdetails = BankDetails::where('bank_details_id', $bankact)->first();
                $am = $bankdetails->update_balance + $amounts;
                BankDetails::where('bank_details_id', $bankact)->update([
                    'update_balance' => $am
                ]);
            }
            

            $sourceBank = trx_record::create([
				
				'table_id' => 3,
				'table_incrment_id' => $lastId,
				'amount_type' => 2,
				'branchid' => $branch,
				'acount_details_id' => $bankact,
				'amount' => $amounts,
				'trx_date' => $dates,
				'pay_type' => 1
            ]);
        }

        //return redirect()->back()->with('message', 'Income Added Successfuly');
		$expence_row = income::select('incomes.*', 'income_types.type as type', 'income_cats.category as category', 'incomes.note', 'banks.bank_name', 'branches.branch_name')
		->join('income_types', 'income_types.id', '=', 'incomes.inco_type')
		->join('income_cats', 'income_cats.id', '=', 'incomes.inco_cat')
		->join('banks', 'banks.bank_id', '=', 'incomes.bank_id')
		->join('branches', 'branches.branch_id', '=', 'incomes.branch_id')
		->where('incomes.id', $lastId)->first();
		
		return view('income.income_print', compact('menuname', 'expence_row'));
		
	}
	
	
	public function debit_voucher_print($id) {
	    
	    $expence_row = income::select('incomes.*', 'income_types.type as type', 'income_cats.category as category', 'incomes.note', 'banks.bank_name', 'branches.branch_name')
		->join('income_types', 'income_types.id', '=', 'incomes.inco_type')
		->join('income_cats', 'income_cats.id', '=', 'incomes.inco_cat')
		->join('banks', 'banks.bank_id', '=', 'incomes.bank_id')
		->join('branches', 'branches.branch_id', '=', 'incomes.branch_id')
		->where('incomes.id', $id)->first();
		
		return view('income.income_print', compact('menuname', 'expence_row'));
	    
	    
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
