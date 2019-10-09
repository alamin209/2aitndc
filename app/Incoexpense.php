<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BankDetails; use App\Khat;  
use App\Bank; use App\TaxType; 
use App\Branch;  use App\TaxTypeType; 
use App\Upangsho; 

class Incoexpense extends Model
{
	static protected $year;
	static protected $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
	static protected $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");


    
    protected $fillable = [
        
        'upangsho_id', 'inout_id', 'khattype_id', 'khtattypetype_id', 'khat_id', 'khat_des','tax','vat',
        'year', 'bank_id', 'branch_id', 'acc_no', 'vourcher_no', 'chalan_no', 'check_no', 'amount',
        'date', 'receiver_name', 'receive_datwe', 'note','vat_tax_status'
    ];




    //public static function allexpenses($bank_id, $branch, $accno, $month){
    public static function allexpenses($bank_id, $branch, $accno, $sd, $ed){
        
     
		$data='';
		$expensese  = Incoexpense::join('upangshos','upangshos.upangsho_id', '=', 'incoexpenses.upangsho_id')
			->join('khats','khats.khat_id', '=', 'incoexpenses.khat_id')				 
		    ->join('tax_types','tax_types.tax_id', '=', 'incoexpenses.khattype_id')
		    ->join('tax_type_types','tax_type_types.tax_id', '=', 'incoexpenses.khtattypetype_id')
		    ->where('incoexpenses.bank_id', $bank_id)
		    ->where('incoexpenses.branch_id', $branch)
		    ->where('incoexpenses.acc_no', $accno)
		    ->where('incoexpenses.inout_id', 2)
		    ->whereBetween('incoexpenses.receive_datwe', [$sd, $ed])
		    ->where('incoexpenses.status', 1)
		    ->get();
		    
			foreach($expensese as $exp){
		     	
		     	$data .= '<tr>
	                <td>'. $exp->upangsho_name .'</td>
	                <td>'. $exp->tax_name .'</td>
	                <td>'. $exp->tax_name2 .'</td>
	                <td>'. $exp->khat_name .'</td>  
	                <td>'. $exp->receive_datwe .'</td>
	                <td>'. $exp->chalan_no .'</td>
	                <td>'. $exp->khat_des .'</td>
	                <td>'. $exp->amount	.'</td>  
	                <td>'. $exp->check_no .'</td>
	                <td>'. $exp->amount	.'</td>
	                <td>'. $exp->note .'</td> 
	            </tr>';
	        }
    		
		return $data;
	}
	
	public static function allincomes($bank_id, $branch, $accno, $sd, $ed){
    		
		$data=''; $date=''; $totamount=0;

		$expensese  = Incoexpense::join('upangshos','upangshos.upangsho_id','=','incoexpenses.upangsho_id')
			
			->join('khats','khats.khat_id','=','incoexpenses.khat_id')				 
		    ->join('tax_types','tax_types.tax_id','=','incoexpenses.khattype_id')
		    ->join('tax_type_types','tax_type_types.tax_id','=','incoexpenses.khtattypetype_id')
		    ->where('incoexpenses.bank_id', $bank_id)
		    ->where('incoexpenses.branch_id', $branch)
		    ->where('incoexpenses.acc_no', $accno)
		    ->where('incoexpenses.inout_id', 1)
		    ->whereBetween('incoexpenses.receive_datwe', [$sd, $ed])
		    ->groupBy('incoexpenses.receive_datwe')
		    ->get();
          			    		    
		foreach($expensese as $exp){
	     	
	     	$data .= '<tr>
                <td>'. $exp->upangsho_name .'</td>
                <td>'. $exp->tax_name .'</td>
                <td>'. $exp->tax_name2 .'</td>
                <td>'. $exp->khat_name .'</td>  
                <td>'. str_replace(self::$en, self::$bn, $exp->receive_datwe) .'</td>
                <td>'. str_replace(self::$en, self::$bn, $exp->chalan_no) .'</td>
                <td>'. $exp->khat_des .'</td>
                <td>'. str_replace(self::$en, self::$bn, $exp->amount)	.'</td>  
                <td></td>
                <td>'. $exp->note .'</td> 
            </tr>';
            
            $i=0;
            $totamount += $exp->amount;
            $expenseses  = Incoexpense::join('upangshos', 'upangshos.upangsho_id', '=', 'incoexpenses.upangsho_id')
				->join('khats','khats.khat_id','=','incoexpenses.khat_id')				 
			    ->join('tax_types','tax_types.tax_id','=','incoexpenses.khattype_id')
			    ->join('tax_type_types','tax_type_types.tax_id','=','incoexpenses.khtattypetype_id')
			    ->where('incoexpenses.bank_id', $bank_id)->where('incoexpenses.branch_id', $branch)
			    ->where('incoexpenses.acc_no', $accno)->where('incoexpenses.inout_id', 1)
			    ->where('incoexpenses.receive_datwe', $exp->receive_datwe)->get();
	        
	            foreach($expenseses as $exps){
	                if($i>0)  {
        	            $data .= '<tr>
        	                <td>'. $exps->upangsho_name .'</td>
        	                <td>'. $exps->tax_name .'</td>
        	                <td>'. $exps->tax_name2 .'</td>
        	                <td>'. $exps->khat_name .'</td>  
        	                <td>   </td>
        	                <td>'. str_replace(self::$en, self::$bn, $exps->chalan_no) .'</td>
        	                <td>'. $exps->khat_des .'</td>
        	                <td>'. str_replace(self::$en, self::$bn, $exps->amount)	.'</td>  
        	                <td></td>
        	                <td>'. $exps->note	 .'</td> 
        	            </tr>';
        	            $totamount += $exps->amount;
	                }$i++;
                }
                
            $data .= '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>  
                <td></td>
                <td></td>
                <td></td>
                <td></td>  
                <td>'. str_replace(self::$en, self::$bn, $totamount) .'</td>
                <td></td> 
            </tr>';
            $totamount=0;
        }
    	        
		return $data;
	 }


	 public static function checkregister($upangsho_id=null, $year=null, $sd=null, $ed=null){
   		
   		$data=''; 


   		$expensese  = Incoexpense::join('upangshos','upangshos.upangsho_id', '=', 'incoexpenses.upangsho_id')
			
			->join('khats','khats.khat_id','=','incoexpenses.khat_id')				 
		    ->join('bank_details','bank_details.bank_details_id','=','incoexpenses.acc_no')
		    ->join('banks','banks.bank_id','=','incoexpenses.bank_id')
		    ->where('incoexpenses.inout_id', 2)
		    ->where('incoexpenses.status', 0)
		    ->whereBetween('incoexpenses.receive_datwe', [$sd, $ed])
		    ->get();

	 	    foreach($expensese as $exp){

		     	$data .= '<tr>
	                <td>'. $exp->upangsho_name .'</td>
	                <td>'. $exp->receiver_name .'</td>
	                <td>'. $year .'</td> 
	                <td>'. $exp->khat_des .'</td>
	                <td>'. str_replace(self::$en, self::$bn, $exp->check_no) .'</td>
	                <td>'. str_replace(self::$en, self::$bn, $exp->vourcher_no) .'</td>  
	                <td>'. str_replace(self::$en, self::$bn, $exp->acc_no) .'</td>
	                <td>'. $exp->bank_name .'</td>
	                <td>'. str_replace(self::$en, self::$bn, $exp->amount) .'</td>
	                <td></td>
	                <td></td>';
    		     	if($exp->khat_des == '-ঐ-কাজের মূঃসঃক' || $exp->khat_des == 'ঐ-কাজের আয়কর')
    
                        $data .= '<td></td> ';
    		     	else {

    	                $data .='<td><a class="btn btn-success" onclick="return getconfirm()"
                        href="'.url('/').'/check_register/'.$exp->incoexpenses_id.'">pending</a></td>';
                    }
                $data .= '</tr>';
	         }
		return $data;
		

	 }
	 
	 public static function getvattax($sd, $ed, $id){
	     
	     //echo $sd.' ';
	     //echo $ed;
	     $data = '';
	     $vatdata = Incoexpense::join('khats','khats.khat_id','=','incoexpenses.khat_id')
	                            ->whereBetween('incoexpenses.receive_datwe', [$sd, $ed])
	                            ->where('receiver_name', $id)->get();
	     //echo '<pre>';
	     //print_r($vatdata); exit;
	     
	     foreach($vatdata as $vd){
	        
	        $data .= '<tr>
	            <td>'. $vd->khat_name.'</td>
	            <td>'. $vd->khat_des.'</td>
	            <td>'. $vd->receive_datwe.'</td>
	            <td>'. $vd->amount.'</td>
	        </tr>';
	         
	     }
	     return $data;
	 }
}



