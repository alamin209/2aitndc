<?php

namespace App\Http\Controllers\expense;

use App\balance_transfer;use App\indirect_expense;use App\indirect_expense_type;
use App\year_exp_type;use App\yearly_expense;use App\Bank;
use App\Http\Controllers\Controller;use Illuminate\Http\Request;
use DB;use File;use App\BankDetails;use App\trx_record; use App\ExpenseType;
use Carbon\Carbon; use App\Income; use App\Depreciation;

class ExpenseController extends Controller {

    public function expenseType(){
		
        $menuname = 'Accounts';
        $expense = DB::table('indirect_expense_types')->get();
		$expensetypes = ExpenseType::all();
        return view('expense.expense_type', compact('menuname', 'expense', 'expensetypes'));
    }

    public function yearlyExpenseType() {
        $year_exp_type = year_exp_type::all();
        $menuname = 'Accounts';
        return view('expense.yearly_expense_type', compact('menuname', 'year_exp_type'));
    }

    public function yearlyExpense() {
        $year_exp_type = year_exp_type::all();
        $bank = Bank::all();
        $menuname = 'Accounts';
        return view('expense.yearly_expense', compact('menuname', 'year_exp_type', 'bank'));
    }

    public function expense() {
        $cshids = ['3', '4', '5', '8', '9'];
        $exp_type = indirect_expense_type::all();
        $bank = Bank::all();
        $cashes = BankDetails::whereIn('bank_details_id', $cshids)->get();
		$expensetypes = ExpenseType::all();
        $menuname = 'Accounts';
        return view('expense.expense', compact('menuname', 'exp_type', 'bank', 'expensetypes', 'cashes'));
    }

    public function balanceTransfer() {
        $bank = Bank::all();
        $menuname = 'Accounts';
        return view('expense.balance_transfer', compact('menuname', 'bank'));
    }

    public function makeExpenseType(Request $request) {
        
		
		$data = array(
            'type' => $request->expenseType,
            'note' => $request->note,
            'created_at' => new \DateTime()
        );
		
        $id = DB::table('indirect_expense_types')->insertGetId($data);
		
        if ($id > 0) {
            $message = 'Expense Category has been created.';
        } else {
            $message = 'Expense Category create failed.';
        }
        return redirect()->back()->with('message', $message);
    }
	
	public function expensesubtype(Request $request) {
		
		$extp = new ExpenseType;
		$extp->category = $request->expcat;
		$extp->type     = $request->typename;
		$extp->depriciation     = $request->depriciation;
		$extp->save();
		if($request->expcat == 15){
		     
		    $year = (date('m') > 6) ? date('Y')  : date('Y') - 1;
		    $date = $year.'-07-01';
		    $checkifexist = Depreciation::where('type_id', $extp->id)->count();
	        if($checkifexist==0){
	            
	            $depre = new Depreciation;
	            $depre->type_id = $extp->id;
	            $depre->cost = 0;
	            $depre->depreciation = 0;
	            $depre->fdate = $date;
	            $depre->save();
	        }
		}
		return redirect()->back()->with('typemessage', 'Expense Type has been created');
	}
	

    public function makeYearlyExpenseType(Request $request) {
        
        year_exp_type::create([
            'type' => $request->yearlyExpenseType,
            'date' => new \DateTime()
        ]);
        return redirect()->back()->with('message', ' Yearly Expense Type Add Success');
    }

    public function makeYearlyExpense(Request $request) {

        $bank       = $request->bank_id;
        $branch     = $request->branch_id;
        $bankact    = $request->bankact;
        $amounts    = $request->amount;
        $exType     = $request->expenseType;
        $notes      = $request->note;
        $dates      = $request->deductDate;
        $pType      = $request->paymentType;

        if ($pType == '1') {

            $bankact = '';

            $balance_id = yearly_expense::create([
                        'bank_id' => $bank,
                        'branch_id' => $branch,
                        'accountid' => $bankact,
                        'pay_type' => $pType,
                        'expense_type' => $exType,
                        'amount' => $amounts,
                        'note' => $notes,
                        'date' => $dates
            ]);

            $lastId = $balance_id->id;

            $bankdetails = BankDetails::where('bank_id', $bank)
                    ->where('type', '2')
                    ->first();

            $am = $bankdetails->update_balance - $amounts;
            BankDetails::where('bank_details_id', $bankdetails->bank_details_id)->update([
                'update_balance' => $am
            ]);

            trx_record::create([
                'table_id' => 11,
                'table_incrment_id' => $lastId,
                'amount_type' => 2,
                'branchid' => $branch,
                'acount_details_id' => $bankact,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 2
            ]);
        } else if ($pType == '2') {

            $balance_id = yearly_expense::create([
                        'bank_id' => $bank,
                        'branch_id' => $branch,
                        'accountid' => $bankact,
                        'pay_type' => $pType,
                        'expense_type' => $exType,
                        'amount' => $amounts,
                        'note' => $notes,
                        'date' => $dates
            ]);

            $lastId = $balance_id->id;

            $bankdetails = BankDetails::where('bank_details_id', $bankact)->first();
            $am = $bankdetails->update_balance - $amounts;
            BankDetails::where('bank_details_id', $bankact)->update([
                'update_balance' => $am
            ]);

            trx_record::create([
                'table_id' => 11,
                'table_incrment_id' => $lastId,
                'amount_type' => 2,
                'branchid' => $branch,
                'acount_details_id' => $bankact,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);
        }

        return redirect()->back()->with('message', ' Yearly Expense Success');
    }

    public function makeExpense(Request $request) {

        $bank = $request->bank_id;
        $branch = $request->branch_id;
        $bankact = $request->bankact; 
        $bankactcash = $request->bankactcash; 
        $amounts = $request->amount;
        $exCat = $request->expenseCat;
        $exType = $request->expenseType;
        $notes = $request->note;
        $dates = $request->deductDate;
        $pType = $request->paymentType;
		
		$mth = explode('-', $dates);
		
		if($mth[1] > 6){ $sd = $mth[0].'-07-01';  $ed = ($mth[0]+1).'-06-30'; 
		}else{	$sd = ($mth[0]-1).'-07-01';   $ed = $mth[0].'-06-30'; }
		 
		
        if ($pType == '2'){ 
            
            $bankdetails = BankDetails::where('bank_details_id', $bankactcash)->get()->first();
            if($bankdetails->update_balance < $amounts){
				
				return redirect()->back()->with('message', 'Failed, Expense Amount Excede');
			}
            $am = $bankdetails->update_balance - $amounts;
            
            
            $vchr = indirect_expense::whereBetween('paydate', [$sd, $ed])->where('bank_id', $bankdetails->bank_id)->where('branch_id', $bankdetails->branch_id)->orderBy('id', 'desc')->first();
		    if(empty($vchr)){ $vchr = 1; }else{ $vchr = $vchr->voucher + 1; }
            
            $balance_id = indirect_expense::create([
				
				'exp_cat' => $exCat,
				'exp_type' => $exType,
				'pay_type' => $pType,
				'bank_id' => $bankdetails->bank_id,
				'branch_id' => $bankdetails->branch_id,
				'accountid' => $bankactcash,
				'voucher' => $vchr,
				'amount' => $amounts,
				'note' => $notes,
				'paydate' => $dates,
				'date' => Carbon::now()
            ]);

            $lastId = $balance_id->id;            
            
			BankDetails::where('bank_details_id', $bankactcash)->update(['update_balance' => $am]);

            $sourceBank = trx_record::create([
				
				'table_id' => 9,
				'table_incrment_id' => $lastId,
				'amount_type' => 2, // amount_type = 2 cost  1 income
				'branchid' => $bankdetails->branch_id,
				'acount_details_id' => $bankactcash,
				'amount' => $amounts,
				'trx_date' => $dates,
				'pay_type' => 2
            ]);
		} 
		else if ($pType == '1') { 
			
			$bankdetails = BankDetails::where('bank_details_id', $bankact)->first();
			
			if($bankdetails->update_balance < $amounts){
				
				return redirect()->back()->with('message', 'Failed, Expense Amount Excede');
			}
			
			$vchr = indirect_expense::whereBetween('paydate', [$sd, $ed])->where('bank_id', $bank)->where('branch_id', $branch)->orderBy('id', 'desc')->first();
		    if(empty($vchr)){ $vchr = 1; }else{ $vchr = $vchr->voucher + 1; }
			
			$balance_id = indirect_expense::create([
				'exp_cat' => $exCat,
				'exp_type' => $exType,
				'pay_type' => $pType,
				'voucher' => $vchr,
				'bank_id' => $bank,
				'branch_id' => $branch,
				'accountid' => $bankact,
				'amount' => $amounts,
				'note' => $notes,
				'paydate' => $dates,
				'date' => Carbon::now()
            ]);

            $lastId = $balance_id->id;

            if($bankact == 14 || $bankact == 15){
			    
                $am = $bankdetails->update_balance + $amounts;
			}else{
			    
			    $am = $bankdetails->update_balance - $amounts;
			}
			
            BankDetails::where('bank_details_id', $bankact)->update([
                
                'update_balance' => $am
            ]);

            $sourceBank = trx_record::create([
				
				'table_id' => 9,
				'table_incrment_id' => $lastId,
				'amount_type' => 2,
				'branchid' => $branch,
				'acount_details_id' => $bankact,
				'amount' => $amounts,
				'trx_date' => $dates,
				'pay_type' => 1
            ]);
         }

        //return redirect()->back()->with('message', 'Expense Success');
		
		$expence_row = indirect_expense::select('indirect_expenses.*', 'expense_types.type as type', 'indirect_expense_types.type as category')
		->join('expense_types', 'expense_types.id', '=', 'indirect_expenses.exp_type')
		->join('indirect_expense_types', 'indirect_expense_types.id','=','indirect_expenses.exp_cat')
		->where('indirect_expenses.id', $lastId)->first();
		
		return view('expense.expense_print', compact('menuname', 'expence_row'));
		
    }
    
    public function credit_voucher_print($id) {
        
        $expence_row = indirect_expense::select('indirect_expenses.*', 'expense_types.type as type', 'indirect_expense_types.type as category')
		->join('expense_types', 'expense_types.id', '=', 'indirect_expenses.exp_type')
		->join('indirect_expense_types', 'indirect_expense_types.id','=','indirect_expenses.exp_cat')
		->where('indirect_expenses.id', $id)->first();
		
		return view('expense.expense_print', compact('menuname', 'expence_row'));
    }

    public function makeBalanceTransfer(Request $request) {

        // echo $pType = $request->paymentType; echo ' tp<br>';

        // echo $s_bank = $request->s_bank; echo ' s_bnak<br>';
        // echo $s_bank_branch = $request->s_bank_branch; echo ' s_b_b<br>';
        // echo $s_bank_act = $request->s_bank_act; echo ' s_b_a<br>';

        // echo $t_bank = $request->t_bank; echo ' t_b<br>';
        // echo $t_bank_branch = $request->t_bank_branch; echo ' t_b_b<br>';
        // echo $t_bank_act = $request->t_bank_act; echo ' t_b_a<br>';

        // echo $amounts = $request->amount; echo ' amnt<br>';
        // echo $notes = $request->note; echo ' nt<br>';
        // echo $dates = $request->trnsferdate; echo ' td<br>';
        
        
        
        // exit;
        
        $pType = $request->paymentType; 

        $s_bank = $request->s_bank; 
        $s_bank_branch = $request->s_bank_branch; 
        $s_bank_act = $request->s_bank_act; 

        $t_bank = $request->t_bank; 
        $t_bank_branch = $request->t_bank_branch; 
        $t_bank_act = $request->t_bank_act; 

        $amounts = $request->amount; 
        $notes = $request->note; 
        $dates = $request->trnsferdate; 

        if ($pType == '3') { // Bank to Bank

            $path = public_path() . "/admin/expenseCheck";
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

            $checkImg = null;
            if (request()->hasFile('checkupload')) {
                $file = $request->file('checkupload');
                $checkImg = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move($path, $checkImg);
            }

            $balance_id = balance_transfer::create([
                
                'payment_type' => $pType,
                's_bank' => $s_bank,
                's_bank_branch' => $s_bank_branch,
                's_bank_act' => $s_bank_act,
                't_bank' => $t_bank,
                't_bank_branch' => $t_bank_branch,
                't_bank_act' => $t_bank_act,
                'amount' => $amounts,
                'cheque' => $checkImg,
                'note' => $notes,
                'trnsferdate' => $dates
            ]);
            $lastId = $balance_id->id;
            
            if($s_bank_act == 14 || $s_bank_act == 15){
            
                $bankdetails = BankDetails::where('bank_details_id', $s_bank_act)->first();
                $am = $bankdetails->update_balance + $amounts;
                BankDetails::where('bank_details_id', $s_bank_act)->update([
                    'update_balance' => $am,
                ]);
            }else{
                
                $bankdetails = BankDetails::where('bank_details_id', $s_bank_act)->first();
                $am = $bankdetails->update_balance - $amounts;
                BankDetails::where('bank_details_id', $s_bank_act)->update([
                    'update_balance' => $am,
                ]);
            }

            $bankdetails2 = BankDetails::where('bank_details_id', $t_bank_act)->first();
            $am2 = $bankdetails2->update_balance + $amounts;
            BankDetails::where('bank_details_id', $t_bank_act)->update([
                'update_balance' => $am2,
            ]);


            $sourceBank = trx_record::create([
                        'table_id' => 13,
                        'table_incrment_id' => $lastId,
                        'amount_type' => 2,
                        'branchid' => $s_bank_branch,
                        'acount_details_id' => $s_bank_act,
                        'amount' => $amounts,
                        'trx_date' => $dates,
                        'pay_type' => 2 //it also can callback database
            ]);

            $targetBank = trx_record::create([
                        'table_id' => 13,
                        'table_incrment_id' => $lastId,
                        'amount_type' => 1,
                        'branchid' => $t_bank_branch,
                        'acount_details_id' => $t_bank_act,
                        'amount' => $amounts,
                        'trx_date' => $dates,
                        'pay_type' => 2 //it also can callback database
            ]);
        } else if ($pType == '4') { // Bank to Bank Cash

             

            $path = public_path() . "/admin/expenseCheck";
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

            $checkImg = null;
            if (request()->hasFile('checkupload')) {
                $file = $request->file('checkupload');
                $checkImg = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move($path, $checkImg);
            }

            $balance_id = balance_transfer::create([
                
                'payment_type' => $pType,
                's_bank' => $s_bank,
                's_bank_branch' => $s_bank_branch,
                's_bank_act' => $s_bank_act,
                't_bank' => $t_bank,
                't_bank_branch' => $t_bank_branch,
                't_bank_act' => $t_bank_act,
                'amount' => $amounts,
                'cheque' => $checkImg,
                'note' => $notes,
                'trnsferdate' => $dates
            ]);
            
            $lastId = $balance_id->id;
            
            if($s_bank_act == 14 || $s_bank_act == 15){
            
                $bankdetails = BankDetails::where('bank_details_id', $s_bank_act)->first();
                $am = $bankdetails->update_balance + $amounts;
                BankDetails::where('bank_details_id', $s_bank_act)->update([
                    'update_balance' => $am,
                ]);
            }else{
                
                $bankdetails = BankDetails::where('bank_details_id', $s_bank_act)->first();
                $am = $bankdetails->update_balance - $amounts;
                BankDetails::where('bank_details_id', $s_bank_act)->update([
                    'update_balance' => $am,
                ]);
            }

            $bankdetails2 = BankDetails::where('bank_details_id', $t_bank_act)->first();
            
            $am2 = $bankdetails2->update_balance + $amounts;
            BankDetails::where('bank_details_id', $bankdetails2->bank_details_id)->update([
                'update_balance' => $am2,
            ]);

            $sourceBank = trx_record::create([
                
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 2,
                'branchid' => $s_bank_branch,
                'acount_details_id' => $s_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);

            $targetBank = trx_record::create([
                
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 1,
                'branchid' => $t_bank_branch,
                'acount_details_id' => $t_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);
        } else if ($pType == '5') { // Bank to Cash

            $t_bank = '';
            $t_bank_branch = '';
            $t_bank_act = '';

            $path = public_path() . "/admin/expenseCheck";
            if (!File::exists($path)) {
                
                File::makeDirectory($path);
            }

            $checkImg = null;
            if (request()->hasFile('checkupload')) {
                
                $file = $request->file('checkupload');
                $checkImg = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move($path, $checkImg);
            }

            $balance_id = balance_transfer::create([
                
                'payment_type' => $pType,
                's_bank' => $s_bank,
                's_bank_branch' => $s_bank_branch,
                's_bank_act' => $s_bank_act,
                't_bank' => $t_bank,
                't_bank_branch' => $t_bank_branch,
                't_bank_act' => $t_bank_act,
                'amount' => $amounts,
                'cheque' => $checkImg,
                'note' => $notes,
                'trnsferdate' => $dates
            ]);
            $lastId = $balance_id->id;

            $bankdetails = BankDetails::where('bank_details_id', $s_bank_act)->first();
            $am = $bankdetails->update_balance - $amounts;
            BankDetails::where('bank_details_id', $s_bank_act)->update([
                'update_balance' => $am,
            ]);

            $bankdetails2 = BankDetails::where('bank_details_id', '5')->first();
            $am2 = $bankdetails2->update_balance + $amounts;
            BankDetails::where('bank_details_id', '5')->update([
                'update_balance' => $am2,
            ]);

            $sourceBank = trx_record::create([
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 2,
                'branchid' => $s_bank_branch,
                'acount_details_id' => $s_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);

            $targetBank = trx_record::create([
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 1,
                'branchid' => $t_bank_branch,
                'acount_details_id' => $t_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);
        } else if ($pType == '6') { // Cash to Bank

            $s_bank = '';
            $s_bank_branch = '';
            $s_bank_act = '';

            $path = public_path() . "/admin/expenseCheck";
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

            $checkImg = null;
            if (request()->hasFile('checkupload')) {
                $file = $request->file('checkupload');
                $checkImg = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move($path, $checkImg);
            }

            $balance_id = balance_transfer::create([
                'payment_type' => $pType,
                's_bank' => $s_bank,
                's_bank_branch' => $s_bank_branch,
                's_bank_act' => $s_bank_act,
                't_bank' => $t_bank,
                't_bank_branch' => $t_bank_branch,
                't_bank_act' => $t_bank_act,
                'amount' => $amounts,
                'cheque' => $checkImg,
                'note' => $notes,
                'trnsferdate' => $dates
            ]);
            $lastId = $balance_id->id;

            $bankdetails2 = BankDetails::where('bank_details_id', '5')->first();
            $am2 = $bankdetails2->update_balance - $amounts;
            BankDetails::where('bank_details_id', 5)->update([
                'update_balance' => $am2,
            ]);
            
            $bankdetails = BankDetails::where('bank_details_id', $t_bank_act)->first();
            $am = $bankdetails->update_balance + $amounts;
            BankDetails::where('bank_details_id', $t_bank_act)->update([
                'update_balance' => $am,
            ]);

            $sourceBank = trx_record::create([
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 2,
                'branchid' => $s_bank_branch,
                'acount_details_id' => $s_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);

            $targetBank = trx_record::create([
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 1,
                'branchid' => $t_bank_branch,
                'acount_details_id' => $t_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);
        } else if ($pType == '7') { // Cash to Bank Cash

            $s_bank = '';
            $s_bank_branch = '';
            $s_bank_act = '';
            

            $path = public_path() . "/admin/expenseCheck";
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

            $checkImg = null;
            if (request()->hasFile('checkupload')) {
                $file = $request->file('checkupload');
                $checkImg = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move($path, $checkImg);
            }

            $balance_id = balance_transfer::create([
                'payment_type' => $pType,
                's_bank' => $s_bank,
                's_bank_branch' => $s_bank_branch,
                's_bank_act' => $s_bank_act,
                't_bank' => $t_bank,
                't_bank_branch' => $t_bank_branch,
                't_bank_act' => $t_bank_act,
                'amount' => $amounts,
                'cheque' => $checkImg,
                'note' => $notes,
                'trnsferdate' => $dates
            ]);
            $lastId = $balance_id->id;

            $bankdetails = BankDetails::where('bank_details_id', '5')->first();
            $am = $bankdetails->update_balance - $amounts;
            BankDetails::where('bank_details_id', '5')->update([
                'update_balance' => $am,
            ]);

            $bankdetails2 = BankDetails::where('bank_details_id', $t_bank_act)->first();
            $am2 = $bankdetails2->update_balance + $amounts;
            BankDetails::where('bank_details_id', $t_bank_act)->update([
                'update_balance' => $am2,
            ]);

            $sourceBank = trx_record::create([
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 2,
                'branchid' => $s_bank_branch,
                'acount_details_id' => $s_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);

            $targetBank = trx_record::create([
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 1,
                'branchid' => $t_bank_branch,
                'acount_details_id' => $t_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);
        } else if ($pType == '8') { // Bank Cash to Bank 

            

            $path = public_path() . "/admin/expenseCheck";
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

            $checkImg = null;
            if (request()->hasFile('checkupload')) {
                $file = $request->file('checkupload');
                $checkImg = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move($path, $checkImg);
            }

            $balance_id = balance_transfer::create([
                'payment_type' => $pType,
                's_bank' => $s_bank,
                's_bank_branch' => $s_bank_branch,
                's_bank_act' => $s_bank_act,
                't_bank' => $t_bank,
                't_bank_branch' => $t_bank_branch,
                't_bank_act' => $t_bank_act,
                'amount' => $amounts,
                'cheque' => $checkImg,
                'note' => $notes,
                'trnsferdate' => $dates
            ]);
            $lastId = $balance_id->id;

            $bankdetails = BankDetails::where('bank_details_id', $s_bank_act)->first();
            $am = $bankdetails->update_balance - $amounts;
            BankDetails::where('bank_details_id', $s_bank_act)->update([
                
                'update_balance' => $am,
            ]);

            $bankdetails2 = BankDetails::where('bank_details_id', $t_bank_act)->first();
            $am2 = $bankdetails2->update_balance + $amounts;
            BankDetails::where('bank_details_id', $t_bank_act)->update([
                
                'update_balance' => $am2,
            ]);

            $sourceBank = trx_record::create([
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 2,
                'branchid' => $s_bank_branch,
                'acount_details_id' => $s_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);

            $targetBank = trx_record::create([
                'table_id' => 13,
                'table_incrment_id' => $lastId,
                'amount_type' => 1,
                'branchid' => $t_bank_branch,
                'acount_details_id' => $t_bank_act,
                'amount' => $amounts,
                'trx_date' => $dates,
                'pay_type' => 1
            ]);			
			
        } else if ($pType == '9') { // Bank Cash to Bank Cash

            $path = public_path() . "/admin/expenseCheck";
            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

            $checkImg = null;
            if (request()->hasFile('checkupload')) {
                $file = $request->file('checkupload');
                $checkImg = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move($path, $checkImg);
            }

            $balance_id = balance_transfer::create([
				'payment_type' => $pType,
				's_bank' => $s_bank,
				's_bank_branch' => $s_bank_branch,
				's_bank_act' => $s_bank_act,
				't_bank' => $t_bank,
				't_bank_branch' => $t_bank_branch,
				't_bank_act' => $t_bank_act,
				'amount' => $amounts,
				'cheque' => $checkImg,
				'note' => $notes,
				'trnsferdate' => $dates
            ]);
            $lastId = $balance_id->id;

            $bankdetails = BankDetails::where('bank_details_id', $s_bank_act)->first();
            $am = $bankdetails->update_balance - $amounts;
            BankDetails::where('bank_details_id', $s_bank_act)->update([
                
                'update_balance' => $am,
            ]);

            $bankdetails2 = BankDetails::where('bank_details_id', $t_bank_act)->first();
            $am2 = $bankdetails2->update_balance + $amounts;
            BankDetails::where('bank_details_id', $t_bank_act)->update([
                
                'update_balance' => $am2,
            ]);

            $sourceBank = trx_record::create([
                        
				'table_id' => 13,
				'table_incrment_id' => $lastId,
				'amount_type' => 2,
				'branchid' => $s_bank_branch,
				'acount_details_id' => $s_bank_act,
				'amount' => $amounts,
				'trx_date' => $dates,
				'pay_type' => 1
            ]);

            $targetBank = trx_record::create([
                        
				'table_id' => 13,
				'table_incrment_id' => $lastId,
				'amount_type' => 1,
				'branchid' => $t_bank_branch,
				'acount_details_id' => $t_bank_act,
				'amount' => $amounts,
				'trx_date' => $dates,
				'pay_type' => 1
            ]);
			
        } 
        
        if($s_bank==''){ $s_bank = $t_bank; $s_bank_branch = $t_bank_branch; $s_bank_act = $t_bank_act; }
        if($t_bank==''){ $t_bank = $s_bank; $t_bank_branch = $s_bank_branch; $t_bank_act = $s_bank_act; }
        
        $mth = explode('-', $dates);
        if($mth[1] > 6){ $sd = $mth[0].'-07-01';  $ed = ($mth[0]+1).'-06-30'; }else{ $sd = ($mth[0]-1).'-07-01';   $ed = $mth[0].'-06-30'; }
		
		$vchr = indirect_expense::whereBetween('paydate', [$sd, $ed])->where('bank_id', $s_bank)->where('branch_id', $s_bank_branch)->orderBy('id', 'desc')->first();
		if(empty($vchr)){ $vchr = 1; }else{ $vchr = $vchr->voucher + 1; }
		
		if($s_bank_act != 14 && $s_bank_act != 15){
    		
    		$expensesins = indirect_expense::create([
    				
    			'exp_cat' => 0,
    			'exp_type' => 0,
    			'pay_type' => $pType,
    			'bank_id' => $s_bank,
    			'branch_id' => $s_bank_branch,
    			'accountid' => $s_bank_act,
    			'voucher' => $vchr,
    			'amount' => $amounts,
    			'note' => $notes,
    			'paydate' => $dates,
    			'date' => Carbon::now()
    		]);
    		
    		$lastId = $expensesins->id;
		
		    $expence_row = indirect_expense::where('indirect_expenses.id', $lastId)->first();
    		
		}else{
		    
		    $vchr = income::whereBetween('paydate', [$sd, $ed])->where('bank_id', $s_bank)->where('branch_id', $s_bank_branch)->orderBy('id', 'desc')->first();   
		    if(empty($vchr)){ $vchr = 1; }else{ $vchr = $vchr->vcher + 1; }
	        
	        Income::create([
				
    			'inco_cat' => 0,
    			'inco_type' => 0,
    			'pay_type' => $pType,
    			'bank_id' => $s_bank,
    			'branch_id' => $s_bank_branch,
    			'accountid' => $s_bank_act,
    			'vcher' => $vchr,
    			'amount' => $amounts,
    			'note' => $notes,
    			'paydate' => $dates,
    			'date' => Carbon::now()
    		]);	
    		
    		$expence_row = '';
		}
		
		
		 
		$vchr = income::whereBetween('paydate', [$sd, $ed])->where('bank_id', $t_bank)->where('branch_id', $t_bank_branch)->orderBy('id', 'desc')->first();
		$paytypearrays = ['5', '4'];
		if(in_array($pType, $paytypearrays)){
		    
		    if(empty($vchr)){ 
		        
		        $vchr = 0; 
		    }else{ 
		        
		        $vchr = $vchr->vcher; 
		    }
		}else{
		        
	        
		    if(empty($vchr)){ 
		        
		        $vchr = 1; 
		    }else{ 
		        
		        $vchr = $vchr->vcher + 1; 
		    }
	    }
		
		$incomeins = Income::create([
					
			'inco_cat' => 0,
			'inco_type' => 0,
			'pay_type' => $pType,
			'bank_id' => $t_bank,
			'branch_id' => $t_bank_branch,
			'accountid' => $t_bank_act,
			'vcher' => $vchr,
			'amount' => $amounts,
			'note' => $notes,
			'paydate' => $dates,
			'date' => Carbon::now()
		]);		
		
		$lastId = $incomeins->id;
		
		$income_row = income::select('incomes.*', 'incomes.note', 'banks.bank_name', 'branches.branch_name')
		->join('banks', 'banks.bank_id', '=', 'incomes.bank_id')
		->join('branches', 'branches.branch_id', '=', 'incomes.branch_id')
		->where('incomes.id', $lastId)->first();
        
        return view('expense.balance_transfer_print', compact('menuname', 'expence_row', 'income_row', 'pType'));
        
        //return redirect()->back()->with('message', 'Balance Transfer Success');
    }
    
    
    


}
