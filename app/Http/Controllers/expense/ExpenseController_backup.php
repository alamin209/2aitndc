<?php

namespace App\Http\Controllers\expense;

use App\balance_transfer;use App\indirect_expense;use App\indirect_expense_type;
use App\year_exp_type;use App\yearly_expense;use App\Bank;
use App\Http\Controllers\Controller;use Illuminate\Http\Request;
use DB;use File;use App\BankDetails;use App\trx_record; use App\ExpenseType;
use Carbon\Carbon; use App\Income;

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
        $exp_type = indirect_expense_type::all();
        $bank = Bank::all();
		$expensetypes = ExpenseType::all();
        $menuname = 'Accounts';
        return view('expense.expense', compact('menuname', 'exp_type', 'bank', 'expensetypes'));
    }

    public function balanceTransfer() {
        $bank = Bank::all();
        $menuname = 'Accounts';
        return view('expense.balance_transfer', compact('menuname', 'bank'));
    }

    public function makeExpenseType(Request $request) {
        $data = array(
            'type' => $request->expenseType,
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
		$extp->type = $request->typename;
		$extp->save();
		
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

        $bank = $request->bank_id;
        $branch = $request->branch_id;
        $bankact = $request->bankact;
        $amounts = $request->amount;
        $exType = $request->expenseType;
        $notes = $request->note;
        $dates = $request->deductDate;
        $pType = $request->paymentType;

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
        $amounts = $request->amount;
        $exCat = $request->expenseCat;
        $exType = $request->expenseType;
        $notes = $request->note;
        $dates = $request->deductDate;
        $pType = $request->paymentType;
		
		$mth = explode('-', $dates);
		$vchr = indirect_expense::where('paydate', 'like', $mth[0].'-'.$mth[1].'-%')->orderBy('id', 'desc')->first();
		if(empty($vchr)){ $vchr = 1;}else{ $vchr = $vchr->voucher+1; }

        if ($pType == '1'){

            $bankact = '';			
			$bankdetails = BankDetails::where('bank_id', $bank)
                    ->where('type', '2')
                    ->first();
			if($bankdetails->update_balance < $amounts){
				
				return redirect()->back()->with('message', 'Failed, Expense Amount Excede');
			}
            $am = $bankdetails->update_balance - $amounts;

            $balance_id = indirect_expense::create([
				
				'exp_cat' => $exCat,
				'exp_type' => $exType,
				'pay_type' => $pType,
				'bank_id' => $bank,
				'branch_id' => $branch,
				'accountid' => $bankact,
				'voucher' => $vchr,
				'amount' => $amounts,
				'note' => $notes,
				'paydate' => $dates,
				'date' => Carbon::now()
            ]);

            $lastId = $balance_id->id;            
            
			BankDetails::where('bank_details_id', $bankdetails->bank_details_id)->update([
                'update_balance' => $am
            ]);

            $sourceBank = trx_record::create([
				'table_id' => 9,
				'table_incrment_id' => $lastId,
				'amount_type' => 2, // amount_type = 2 cost  1 income
				'branchid' => $branch,
				'acount_details_id' => $bankact,
				'amount' => $amounts,
				'trx_date' => $dates,
				'pay_type' => 2
            ]);
			
        } else if ($pType == '2') {
			
			$bankdetails = BankDetails::where('bank_details_id', $bankact)->first();
            $am = $bankdetails->update_balance - $amounts;
			if($bankdetails->update_balance < $amounts){
				
				return redirect()->back()->with('message', 'Failed, Expense Amount Excede');
			}
			
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
		
		$expence_row = indirect_expense::select('*', 'expense_types.type as type', 'indirect_expense_types.type as category', 'indirect_expenses.note')
		->join('expense_types', 'expense_types.id', '=', 'indirect_expenses.exp_type')
		->join('indirect_expense_types', 'indirect_expense_types.id','=','indirect_expenses.exp_cat')
		->where('indirect_expenses.id', $lastId)->first();
		
		return view('expense.expense_print', compact('menuname', 'expence_row'));
		
    }

    public function makeBalanceTransfer(Request $request) {

        $sb = $request->s_bank;
        $sbId = $request->s_bank_branch;
        $bankact = $request->s_bank_act;

        $tb = $request->t_bank;
        $tbId = $request->t_bank_branch;
        $tbaId = $request->t_bank_act;

        $pType = $request->paymentType;
        $amounts = $request->amount;
        $dates = $request->trnsferdate;
        $notes = $request->note;

        if ($pType == '1') {

            $bankact = '';
            $tbaId = '';

            $path = public_path() . "/admin/expenseCheck";
            if (!File::exists($path)){
				
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
				's_bank' => $sb,
				's_bank_branch' => $sbId,
				's_bank_act' => $bankact,
				't_bank' => $tb,
				't_bank_branch' => $tbId,
				't_bank_act' => $tbaId,
				'amount' => $amounts,
				'cheque' => $checkImg,
				'note' => $notes,
				'trnsferdate' => $dates
            ]);
            $lastId = $balance_id->id;

            $bankdetails = BankDetails::where('bank_id', $sb)
                    ->where('type', '1')
                    ->first();

            $am = $bankdetails->update_balance - $amounts;
            BankDetails::where('bank_details_id', $bankdetails->bank_details_id)->update([
                'update_balance' => $am,
            ]);

            $bankdetails2 = BankDetails::where('bank_id', $tb)
                    ->where('branch_id', $tbId)
//                    ->where('acc_no', '=', '')
                    ->where('type', '2')
                    ->first();

            $am2 = $bankdetails2->update_balance + $amounts;
            BankDetails::where('bank_details_id', $bankdetails2->bank_details_id)->update([
                'update_balance' => $am2,
            ]);

            $sourceBank = trx_record::create([
                        'table_id' => 13,
                        'table_incrment_id' => $lastId,
                        'amount_type' => 2,
                        'branchid' => $sbId,
                        'acount_details_id' => $bankact,
                        'amount' => $amounts,
                        'trx_date' => $dates,
                        'pay_type' => 2, //it also can callback database
            ]);

            $targetBank = trx_record::create([
                        'table_id' => 13,
                        'table_incrment_id' => $lastId,
                        'amount_type' => 1,
                        'branchid' => $tbId,
                        'acount_details_id' => $tbaId,
                        'amount' => $amounts,
                        'trx_date' => $dates,
                        'pay_type' => 2, //it also can callback database
            ]);
			
			indirect_expense::create([
				
				'exp_cat' => 0,
				'exp_type' => 0,
				'pay_type' => $pType,
				'bank_id' => $tb,
				'branch_id' => $tbId,
				'accountid' => $tbaId,
				'amount' => $amounts,
				'note' => $notes,
				'paydate' => $dates,
				'date' => Carbon::now()
            ]);
			
			Income::create([
                        
				'inco_cat' => 0,
				'inco_type' => 0,
				'pay_type' => $pType,
				'bank_id' => $tb,
				'branch_id' => $tbId,
				'accountid' => $tbaId,
				'amount' => $amounts,
				'note' => $notes,
				'paydate' => $dates,
				'date' => Carbon::now()
            ]);
			
			
			
        } else if ($pType == '2') {

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
                        's_bank' => $sb,
                        's_bank_branch' => $sbId,
                        's_bank_act' => $bankact,
                        't_bank' => $tb,
                        't_bank_branch' => $tbId,
                        't_bank_act' => $tbaId,
                        'amount' => $amounts,
                        'cheque' => $checkImg,
                        'note' => $notes,
                        'trnsferdate' => $dates
            ]);
            $lastId = $balance_id->id;

            $bankdetails = BankDetails::where('bank_details_id', $bankact)->first();

            $am = $bankdetails->update_balance - $amounts;
            BankDetails::where('bank_details_id', $bankact)->update([
                'update_balance' => $am,
            ]);

            $bankdetails2 = BankDetails::where('bank_details_id', $tbaId)->first();
            $am2 = $bankdetails2->update_balance + $amounts;
            BankDetails::where('bank_details_id', $tbaId)->update([
                'update_balance' => $am2,
            ]);

            $sourceBank = trx_record::create([
                        'table_id' => 13,
                        'table_incrment_id' => $lastId,
                        'amount_type' => 2,
                        'branchid' => $sbId,
                        'acount_details_id' => $bankact,
                        'amount' => $amounts,
                        'trx_date' => $dates,
                        'pay_type' => 1, //it also can callback database
//            'nat_id'                  => $request['nat_id'],
            ]);

            $targetBank = trx_record::create([
                        'table_id' => 13,
                        'table_incrment_id' => $lastId,
                        'amount_type' => 1,
                        'branchid' => $tbId,
                        'acount_details_id' => $tbaId,
                        'amount' => $amounts,
                        'trx_date' => $dates,
                        'pay_type' => 1, //it also can callback database

            ]);
			
			indirect_expense::create([
				
				'exp_cat' => 0,
				'exp_type' => 0,
				'pay_type' => $pType,
				'bank_id' => $tb,
				'branch_id' => $tbId,
				'accountid' => $tbaId,
				'amount' => $amounts,
				'note' => $notes,
				'paydate' => $dates,
				'date' => Carbon::now()
            ]);
			
			Income::create([
                        
				'inco_cat' => 0,
				'inco_type' => 0,
				'pay_type' => $pType,
				'bank_id' => $tb,
				'branch_id' => $tbId,
				'accountid' => $tbaId,
				'amount' => $amounts,
				'note' => $notes,
				'paydate' => $dates,
				'date' => Carbon::now()
            ]);
        }

        return redirect()->back()->with('message', 'Balance Transfer Success');
    }


}
