<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
     
    protected $fillable = [

        'category', 'type'
    ];

    public function expcat(){
        
		return $this->belongsTo(indirect_expense_type::class,'category','id');
    }
    
    
    public static function getReceiptPayments($year, $sd, $ed){
         
        $fy  = $year.'-'.($year+1);
        $pfy  = ($year-1).'-'.$year;
        
        $psd = date('Y-m-d', strtotime($sd.'-1 year'));
        $ped = date('Y-m-d', strtotime($ed.'-1 year'));
		
		$data = '<br><hr><div id="prinarea"><div style="text-align:center">
			<h3>Dhaka School of Economics</h3>
			<span>Statement of Receipt and Payments</span><br>
			<span>For the year ended '.date('d F Y', strtotime($ed)).'</span><br>
			 
		</div><br>
		<table style="width:100%" cellspacing="10">
			<tr>
				<td rowspan="2" align="center" style="border:1px solid"><strong>Particulars</strong></td>
				<td  rowspan="2" align="center" style="border:1px solid"><strong>Note</strong></td>
				<td align="center" style="border:1px solid"><strong>Amount in BDT</strong></td>
				<td align="center" style="border:1px solid"><strong>Amount in BDT</strong></td>			
			</tr>
			<tr>
				 
				<td align="center" style="border:1px solid"><strong>'.$fy.'</strong></td>
				<td align="center" style="border:1px solid"><strong>'. $pfy .'</strong></td>
			</tr>';
		$openingBalances = array('2'=>'Cash in Hand', '1'=>'Cash at Bank');	
		$data .= '<tr class="noBorder">
			<td colspan="4"><strong>Opening Balance</strong></td>
		</tr>';
		
		
		$totaolCurrent = 0; $totalPrevious = 0;
		foreach($openingBalances as $k => $opnblnc){
		    
		    $bank_opening = BankDetails::where('type', $k)->sum('open_balance');
		    
		    $previousincome = Income::where('pay_type', $k)->where('paydate',  '<', $sd)->sum('amount');
		    $priviousExpence = indirect_expense::where('pay_type', $k)->where('paydate',  '<', $sd)->sum('amount');
		    $previousamount[$k] = ($bank_opening + $previousincome) - $priviousExpence;
		    
		    
		    
    		$data .= '<tr class="">
    			<td>'. $opnblnc .'</td>
    			<td></td>
    			<td align="right" style="border:1px solid">'. number_format($previousamount[$k]) .'</td>
    			<td align="right" style="border:1px solid">'. number_format($bank_opening) .'</td>
    		</tr>';
    		$totaolCurrent += $bank_opening; $totalPrevious += $previousamount[$k];
		}
		
		$data .= '<tr class="">
			<td></td>
			<td></td>
			<td align="right" style="border-bottom:2px solid"><strong>'. number_format($totaolCurrent) .'</strong></td>
			<td align="right" style="border-bottom:2px solid"><strong>'. number_format($totalPrevious) .'</strong></td>
		</tr>
		<tr class="noBorder">
			<td colspan="4"><strong>Receipts</strong></td>
		</tr>';
		
		$incomecats = IncomeCat::all();
		$totalCurrentReceipts = 0; $totalPreviousReceipts = 0;
		foreach($incomecats as $inccats){
		    $currentReceipts = Income::where('inco_cat', $inccats->id)->whereBetween('paydate',  [$sd, $ed])->sum('amount');
		    $previousRecipts = Income::where('inco_cat', $inccats->id)->whereBetween('paydate',  [$psd, $ped])->sum('amount');
		    $data .= '<tr class="">
    			<td>'. $inccats->category .'</td>
    			<td align="center">'. $inccats->note .'</td>
    			<td align="right" style="border:1px solid">'. number_format($currentReceipts) .'</td>
    			<td align="right" style="border:1px solid">'. number_format($previousRecipts) .'</td>
    		</tr>';
		    $totalCurrentReceipts += $currentReceipts; $totalPreviousReceipts += $previousRecipts;
		}
		$data .= '<tr class="">
			<td></td>
			<td></td>
			<td align="right" style="border-bottom:2px solid"><strong>'. number_format($totalCurrentReceipts) .'</strong></td>
			<td align="right" style="border-bottom:2px solid"><strong>'. number_format($totalPreviousReceipts) .'</strong></td>
		</tr>
		<tr class="">
			<td><strong>Total Receipts</strong></td>
			<td></td>
			<td align="right" style="border-bottom:2px solid"><strong>'. number_format($totaolCurrent+$totalCurrentReceipts) .'</strong></td>
			<td align="right" style="border-bottom:2px solid"><strong>'. number_format($totalPrevious+$totalPreviousReceipts) .'</strong></td>
		</tr>
		<tr class="noBorder">
			<td colspan="4"><strong>Payments</strong></td>
		</tr>';
		
		$incomecats = indirect_expense_type::all();
		$totalCurrentReceipts = 0; $totalPreviousReceipts = 0;
		foreach($incomecats as $inccats){
		    $currentReceipts = indirect_expense::where('exp_cat', $inccats->id)->whereBetween('paydate',  [$sd, $ed])->sum('amount');
		    $previousRecipts = indirect_expense::where('exp_cat', $inccats->id)->whereBetween('paydate',  [$psd, $ped])->sum('amount');
		    $data .= '<tr class="">
    			<td>'. $inccats->type .'</td>
    			<td align="center">'. $inccats->note .'</td>
    			<td align="right" style="border:1px solid">'. number_format($currentReceipts) .'</td>
    			<td align="right" style="border:1px solid">'. number_format($previousRecipts) .'</td>
    		</tr>';
		    $totalCurrentReceipts += $currentReceipts; $totalPreviousReceipts += $previousRecipts;
		}
		$data .= '<tr class="">
			<td><strong>Total Payments</strong></td>
			<td></td>
			<td align="right" style="border-bottom:2px solid"><strong>'. number_format($totalCurrentReceipts) .'</strong></td>
			<td align="right" style="border-bottom:2px solid"><strong>'. number_format($totalPreviousReceipts) .'</strong></td>
		</tr><tr class="noBorder">
			<td colspan="4"><strong>Closing Balance</strong></td>
		</tr>';
		
		foreach($openingBalances as $k => $opnblnc){
		    
		    $currentincome = Income::where('pay_type', $k)->whereBetween('paydate',  [$sd, $ed])->sum('amount');
		    $currentExpence = indirect_expense::where('pay_type', $k)->whereBetween('paydate',  [$sd, $ed])->sum('amount');
		    $currentamount = ($previousamount[$k] + $currentincome) - $currentExpence;
		    
		    $data .= '<tr class="">
    			<td>'. $opnblnc .'</td>
    			<td></td>
    			<td align="right" style="border:1px solid">'. number_format($currentamount) .'</td>
    			<td align="right" style="border:1px solid">'. number_format($previousamount[$k]) .'</td>
    		</tr>';
		}
		
		$data .= '</table>';
		
		return $data;
        
    }

}




