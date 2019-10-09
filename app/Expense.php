<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class expense extends Model
{
    //
    protected $fillable = [
	
        'expense_id', 'bank_id', 'upangsho_id', 'check_chalan', 'client_name', 'paymant_date','note','status'
    ];
	
	
	public static function getcashbook($sd, $ed, $bank){	
		
		$opening_balance = 0;
		$data = '<div style="width:100%"; float:left;>
		    <h5 style="text-align:center; border:1px solid; padding:10px 0px; margin-bottom:0px; background:#cdcdcd; float:left; width:100%">
    		    <strong>'. date('F-y', strtotime($sd)) .'</strong>
    		</h5>
		<div>
			<span style="width:50%; text-align:right;float:left;border:1px solid;padding:5px;"><strong>Debit</strong></span>
			<span style="width:50%; text-align:right;float:left;border:1px solid;padding:5px;"><strong>Credit</strong></span>
		</div>
		<table class="table table-bordered" style="width:50%; float:left">
			
			<tr>
				<th>Date</th>
				<th>Voucher Credit</th>
				<th>Voucher Debit</th>
				<th>Particular</th>
				<th>Amount<br>TK</th>
				<th>Total<br>TK</th>
			</tr>';
			if($bank!=''){ 
			    
			    $cashbankcombine = array(1=>4,2=>3, 6=>9,7=>8, 11=>'', 12 => '', 13 => '', 14 => '', 15 => '');
			    $bank_opening = BankDetails::where('bank_details_id', $bank)->where('type', 1)->sum('open_balance');
			    $cash_opening = BankDetails::where('bank_details_id', $cashbankcombine[$bank])->where('type', 2)->sum('open_balance');
			    $total_income_bank_previous = Income::where('accountid', $bank)->whereNotIn('pay_type', ['2', '5', '4'])->where('paydate', '<', $sd)->sum('amount');
			    $total_expense_bank_previous = indirect_expense::where('accountid', $bank)->whereNotIn('pay_type', ['2', '6'])->where('paydate', '<', $sd)->sum('amount'); 
			    $total_income_cash_previous = Income::where('accountid', $cashbankcombine[$bank])->whereIn('pay_type', ['2', '5', '4'])->where('paydate', '<', $sd)->sum('amount');
			    $total_expense_cash_previous = indirect_expense::where('accountid', $cashbankcombine[$bank])->whereIn('pay_type', ['2', '6'])->where('paydate', '<', $sd)->sum('amount'); 
			}else{ 
			    
			    $bank_opening = BankDetails::where('type', 1)->sum('open_balance'); 
			    $cash_opening = BankDetails::where('type', 2)->sum('open_balance');
			    $total_income_bank_previous = Income::where('pay_type', 1)->where('paydate', '<', $sd)->sum('amount');
			    $total_expense_bank_previous = indirect_expense::where('paydate', '<', $sd)->sum('amount'); 
			    $total_income_cash_previous = Income::where('pay_type', 2)->where('paydate', '<', $sd)->sum('amount');
			    $total_expense_cash_previous = indirect_expense::where('pay_type', 2)->where('paydate', '<', $sd)->sum('amount'); 
			}	
			
			$opening_balance = ((int)$bank_opening + (int)$total_income_bank_previous) - (int)$total_expense_bank_previous;
			$cash_opening = ((int)$cash_opening + (int)$total_income_cash_previous) - (int)$total_expense_cash_previous;
			
			$data .= '<tr>
				<td>'. Carbon::parse($sd)->format('d.m.Y') .'</td>					
				<td> </td>	
				<td> </td>
				<td>Opening Balance</td>					
				<td align="right">'. $cash_opening .'</td>					
				<td align="right">'. $opening_balance .'</td>					
			</tr>';
			
			$total_income = 0;
			$total_income_0 = 0;
			if($bank!=''){
			    
			    $getIncomes = Income::orderBy('paydate')->whereIn('accountid', [$bank, $cashbankcombine[$bank]])->whereBetween('paydate', [$sd, $ed])->get(); 
			    $getEspenes = indirect_expense::orderBy('paydate')->whereIn('accountid', [$bank, $cashbankcombine[$bank]])->whereBetween('paydate', [$sd, $ed])->get();
			}else{ 
			    
			    $getIncomes = Income::orderBy('id')->whereBetween('paydate', [$sd, $ed])->get(); 
			    $getEspenes = indirect_expense::orderBy('id')->whereBetween('paydate', [$sd, $ed])->get();
			}
			$income_rows  = $getIncomes->count() + 1;
			$expense_rows  = $getEspenes->count() + 2;
			
			$row_difference = abs($income_rows - $expense_rows);
			$makeup_rows = '';
			for($i=1; $i<=$row_difference; $i++){ 
			    
			    $makeup_rows .= '<tr><td>-</td><td></td><td></td><td></td><td></td></tr>';
			}
			
			foreach($getIncomes as $income){
				
				if($income->pay_type == 5){
				    
				   
					$data .= '<tr>
						<td>'. date('d.m.Y', strtotime($income->paydate)) .'</td>					
						<td align="center"></td>
						<td align=""></td>
						<td>Bank</td>					
						<td align="right">'. $income->amount .'</td>					
						<td align="right">'.'</td>					
					</tr>';
					$cash_opening += $income->amount;
				}
				
				if($income->pay_type == 4 && ( $income->accountid == 14 || $income->accountid == 15 )){
				    
					$data .= '<tr>
						<td>'. date('d.m.Y', strtotime($income->paydate)) .'</td>					
						<td align="center">'. $income->vcher .'</td>	
						<td align=""></td>
						<td>'. $income->note .'</td>					
						<td align="right">'.'</td>					
						<td align="right">'. $income->amount .'</td>					
					</tr>';
				    $total_income += $income->amount;
				}
				
				if($income->pay_type == 4 &&  $income->accountid != 14 && $income->accountid != 15 ){
				    
				    
					$data .= '<tr>
						<td>'. date('d.m.Y', strtotime($income->paydate)) .'</td>					
						<td align="center"></td>
						<td align="center">'. indirect_expense::where('amount', $income->amount)->where('created_at', 'like', $income->created_at)->first()->voucher .'</td>
						<td>Bank</td>					
						<td align="right">'. $income->amount .'</td>					
						<td align="right"></td>					
					</tr>';
				    $cash_opening += $income->amount;
				}
				
				if($income->pay_type == 2){
					
					$cash_opening += $income->amount;
					$data .= '<tr>
						<td>'. date('d.m.Y', strtotime($income->paydate)) .'</td>					
						<td align="center">'. $income->vcher .'</td>	
						<td align=""></td>
						<td id="dabitnote'.$income->id.'">'. $income->note .'</td>					
						<td align="right"><a href="javascript:void(0)" onclick="getdebitoptions('.$income->id.')" id="dabitamount'.$income->id.'">'. $income->amount .'</a>
						    <span id="debitoptionsfilds'.$income->id.'" class="optionsfield">
						        
						        <a href="'.url('/').'/debit_voucher/'.$income->id.'" target="_blank">Print</a>
						        <a href="javascript:void(0)" onclick="getdebitupdateform('.$income->id.')">Update</a>
						        <a href="javascript:void(0)">Delete</a><br><br>
						        <a href="javascript:void(0)" onclick="hidedebitoptions('.$income->id.')" style="color:red; font-size:10px">Close</a>
						    </span>
						</td>					
						<td align="right"></td>					
					</tr>';
					 
				}
				if($income->pay_type == 1){
				
					$data .= '<tr>
						<td>'. date('d.m.Y', strtotime($income->paydate)) .'</td>					
						<td align="center">'. $income->vcher .'</td>
						<td align=""></td>
						<td id="dabitnote'.$income->id.'">'. $income->note .'</td>					
						<td align="right">'.'</td>					
						<td align="right"><a href="javascript:void(0)" onclick="getdebitoptions('.$income->id.')" id="dabitamount'.$income->id.'">'. $income->amount .'</a>
						    <span id="debitoptionsfilds'.$income->id.'" class="optionsfield">
						        
						        <a href="'.url('/').'/debit_voucher/'.$income->id.'" target="_blank">Print</a>
						        <a href="javascript:void(0)" onclick="getdebitupdateform('.$income->id.')">Update</a>
						        <a href="javascript:void(0)">Delete</a><br><br>
						        <a href="javascript:void(0)" onclick="hidedebitoptions('.$income->id.')" style="color:red; font-size:10px">Close</a>
						    </span>
						</td>					
					</tr>';
					$total_income += $income->amount;
				}
				if($income->pay_type == 3){
				
					$data .= '<tr>
						<td>'. date('d.m.Y', strtotime($income->paydate)) .'</td>					
						<td align="center">'. $income->vcher .'</td>
						<td align=""></td>
						<td>'. $income->note .'</td>					
						<td align="right">'.'</td>					
						<td align="right">'. $income->amount .'</td>					
					</tr>';
					$total_income += $income->amount;
				}
			}
			
			if($income_rows < $expense_rows){ $data .= $makeup_rows; }
			$total_income += $opening_balance;
			$data .= '<tr>
				<td></td>					
				<td></td>
				<td></td>
				<td></td>					
				<td align="right">'. $cash_opening .'</td>					
				<td align="right">'. $total_income .'</td>					
			</tr>';
		$data .= '</table>';		
		$data .= '<table class="table table-bordered" style="width:50%; float:left">
			<tr>
				<th>Date</th>
				<th>Voucher</th>
				<th>Particular</th>
				<th>Amount<br>TK</th>
				<th>Total<br>TK</th>
			</tr>';
			$total_expense = 0;
			$total_expense_0 = 0;
			foreach($getEspenes as $expense){
			    
				if($expense->pay_type == 2){
				    
				    $data .= '<tr>
    					<td>'. date('d.m.Y', strtotime($expense->paydate)) .'</td>					
    					<td align="center">'. $expense->voucher .'</td>					
    					<td>'. $expense->note .'</td>					
    					<td align="right">'. $expense->amount .'</td>					
    					<td align="right"></td>					
    				</tr>';
    				$total_expense_0 += $expense->amount;
				}
				if($expense->pay_type == 1 || $expense->pay_type == 4){
    				$data .= '<tr>
    					<td>'. date('d.m.Y', strtotime($expense->paydate)) .'</td>					
    					<td align="center">'. $expense->voucher .'</td>					
    					<td id="creditnote'.$expense->id.'">'. $expense->note .'</td>					
    					<td></td>					
    					<td align="right"><a href="javascript:void(0)" onclick="getcreditoptions('.$expense->id.')" id="creditamount'.$expense->id.'">'. $expense->amount .'</a>
						    <span id="creditoptionsfilds'.$expense->id.'" class="optionsfieldcredit">
						        
						        <a href="'.url('/').'/credit_voucher/'.$expense->id.'" target="_blank">Print</a>
						        <a href="javascript:void(0)" onclick="getcreditupdateform('.$expense->id.')">Update</a>
						        <a href="javascript:void(0)">Delete</a><br><br>
						        <a href="javascript:void(0)" onclick="hidecreditoptions('.$expense->id.')" style="color:red; font-size:10px">Close</a>
						    </span>
						</td>					
    				</tr>';
    				$total_expense += $expense->amount;
				}
				if($expense->pay_type == 5){
				    
				    $data .= '<tr>
    					<td>'. date('d.m.Y', strtotime($expense->paydate)) .'</td>					
    					<td align="center">'. $expense->voucher .'</td>					
    					<td id="creditnote'.$expense->id.'">'. $expense->note .'</td>					
    					<td>'. '</td>					
    					<td align="right"><a href="javascript:void(0)" onclick="getcreditoptions('.$expense->id.')" id="creditamount'.$expense->id.'">'. $expense->amount .'</a>
						    <span id="creditoptionsfilds'.$expense->id.'" class="optionsfieldcredit">
						        <a href="javascript:void(0)" onclick="getcreditupdateform('.$expense->id.')">Update</a>
						        <a href="javascript:void(0)">Delete</a><br><br>
						        <a href="javascript:void(0)" onclick="hidecreditoptions('.$expense->id.')" style="color:red; font-size:10px">Close</a>
						    </span>
						</a></td>					
    				</tr>';
    				$total_expense += $expense->amount;
				}
				
				if( $expense->pay_type == 3 ){
    				$data .= '<tr>
    					<td>'. date('d.m.Y', strtotime($expense->paydate)) .'</td>					
    					<td align="center">'. $expense->voucher .'</td>					
    					<td id="creditnote'.$expense->id.'">'. $expense->note .'</td>					
    					<td>'. '</td>					
    					<td align="right"><a href="javascript:void(0)" onclick="getcreditoptions('.$expense->id.')" id="creditamount'.$expense->id.'">'. $expense->amount .'</a>
						    <span id="creditoptionsfilds'.$expense->id.'" class="optionsfieldcredit">
						        
						        <a href="'.url('/').'/credit_voucher/'.$expense->id.'" target="_blank">Print</a>
						        <a href="javascript:void(0)" onclick="getcreditupdateform('.$expense->id.')">Update</a>
						        <a href="javascript:void(0)">Delete</a><br><br>
						        <a href="javascript:void(0)" onclick="hidecreditoptions('.$expense->id.')" style="color:red; font-size:10px">Close</a>
						    </span>
						</td>					
    				</tr>';
    				$total_expense += $expense->amount;
				}
			}	
			if($income_rows > $expense_rows){ $data .= $makeup_rows; }
			$data .= '<tr>
				<td></td>					
				<td></td>					
				<td align="right">Total Expences = </td>					
				<td align="right">'. $total_expense_0 .'</td>					
				<td align="right">'. $total_expense .'</td>					
			</tr>
			<tr>
				<td></td>					
				<td></td>					
				<td align="right">Balance c/d</td>					
				<td align="right">'. ($cash_opening - $total_expense_0) .'</td>					
				<td align="right">'. ($total_income - $total_expense) .'</td>					
			</tr><tr>
				<td></td>					
				<td></td>					
				<td align="right"></td>					
				<td align="right">'. $cash_opening.'</td>					
				<td align="right">'. $total_income .'</td>					
			</tr>';
		$data .= '</table></div><br><hr>';
		 
			
		return $data;
		
	}
}
