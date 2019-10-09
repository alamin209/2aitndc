<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model {
    
	protected $fillable = [

        'category', 'type'
    ];
	
	
	public function inccat(){
		
		return $this->belongsTo(incomeCat::class, 'category', 'id');
	}
	
	public static function getLedger($year, $sd, $ed, $acctype, $acc){
	    
	    $data = '<div style="padding:10px; width:100%; text-align:center; border:1px solid">
	            <h2>Ledger</h2>
	            <span style="font-size : 20px">Financial Year : '. $year.'-'.($year+1).'</span>
	        </div>';
	   if($acctype==1){
	       
	        $data .= '<div style="padding:10px; width:100%; border:1px solid">
	             
	            <span>(Account of) : '. IncomeType::where('id', $acc)->first()->type .' </span>
	        </div>
    	    <table class="table table-bordered">
    	        <tr>
        	        <th rowspan="2" style="vertical-align:middle">Date</th>
        	        <th rowspan="2" style="vertical-align:middle">Particular</th>
        	        <th>Dabit</th>
        	        <th>Cradit</th>
        	        <th rowspan="2" style="vertical-align:middle">Cr. or Dr.</th>
        	        <th>Balance</th>
        	   </tr><tr>
        	        <th>Amount / Tk</th>
        	        <th>Amount / Tk</th>
        	        <th>Amount / Tk</th>
        	   </tr>';
	        
	        $incomes = Income::where('inco_type', $acc)->whereBetween('paydate', [$sd, $ed])->get();
	        $total = 0; $count = 0;
	        foreach($incomes as $inc){
	            $particular = ($inc->pay_type==1)?'Cheque':'Cash';
	            $data .= '<tr>
        	        <td align="center">'. $inc->date .'</td>
        	        <td align="center">'. $particular .'</td>
        	        <td align="right"></td>
        	        <td align="right">'. number_format($inc->amount, 2) .'</td>
        	        <td></td>
        	        <td align="right"></td>
        	   </tr>';
        	   $total += $inc->amount;
        	   $count++;
	        }
	        for($i=$count; $i<14; $i++){
	            $data .= '<tr>
        	        <td align="center">-</td>
        	        <td align="center"></td>
        	        <td align="right"></td>
        	        <td align="right"></td>
        	        <td></td>
        	        <td align="right"></td>
        	   </tr>';
	            
	        }
	        $data .= '<tr>
    	        <td></td>
    	        <td></td>
    	        <td></td>
    	        <td align="right"><strong><u>'. number_format($total, 2) .'</u></strong></td>
    	        <td></td>
    	        <td></td>
    	   </tr>';
	    }
	    if($acctype == 2){
	       
	        $data .= '<div style="padding:10px; width:100%; border:1px solid">
	            <span style="font-weight:bold; font-size:16px">(Account of) : '. ExpenseType::where('id', $acc)->first()->type .' </span>
	        </div>
    	    <table class="table table-bordered">
    	        <tr>
        	        <th rowspan="2" style="vertical-align:middle">Date</th>
        	        <th rowspan="2" style="vertical-align:middle">Particular</th>
        	        <th>Dabit</th>
        	        <th>Cradit</th>
        	        <th rowspan="2" style="vertical-align:middle">Cr. or Dr.</th>
        	        <th>Balance</th>
        	   </tr><tr>
        	        <th>Amount / Tk</th>
        	        <th>Amount / Tk</th>
        	        <th>Amount / Tk</th>
        	   </tr>';
	        
	        $incomes = indirect_expense::where('exp_type', $acc)->whereBetween('paydate', [$sd, $ed])->get();
	        $total = 0; $count = 0;
	        foreach($incomes as $inc){
	            $particular = ($inc->pay_type==1)?'Cheque':'Cash';
	            $data .= '<tr>
        	        <td align="center">'. $inc->date .'</td>
        	        <td align="center">'. $particular .'</td>
        	        <td align="right">'. number_format($inc->amount,2) .'</td>
        	        <td align="right"></td>
        	        <td></td>
        	        <td align="right"></td>
        	   </tr>';
        	   $total += $inc->amount;
        	   $count++;
	        }
	        
	        for($i=$count; $i<14; $i++){
	            $data .= '<tr>
        	        <td align="center">-</td>
        	        <td align="center"></td>
        	        <td align="right"></td>
        	        <td align="right"></td>
        	        <td></td>
        	        <td align="right"></td>
        	   </tr>';
	            
	        }
	        $data .= '<tr>
    	        <td></td>
    	        <td></td>
    	        <td align="right"><strong><u>'.number_format($total, 2).'</u></strong></td>
    	        <td></td>
    	        <td></td>
    	        <td></td>
    	   </tr>';
	    }
	    
	    
	    
	    $data .= '</table>';
	    return $data;
	    
	}
	
}
