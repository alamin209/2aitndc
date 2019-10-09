<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    //
    protected $fillable = [
        
        'bank_id', 'branch_id', 'upangsho_id',  'acc_no','acc_code', 'acc_details','open_balance','update_balance', 'status'
    ];

    public static function details($year=''){


 $data=''; $update_balance=0;
    	
        $sl = 1; 
    
        	$bank_datas = BankDetails::join('banks', 'banks.bank_id', '=', 'bank_details.bank_id')
                   ->join('branches', 'branches.branch_id', '=', 'bank_details.branch_id')->get();
        
            foreach($bank_datas as $bank_data){
                      

            	$data .= '<tr class="gradeX">
                    <td>'. $sl++.'</td>
                    <td>'. $bank_data->bank_name .', '. $bank_data->branch_name .'</td>
                    <td>'. $bank_data->acc_no .'</td>
                    <td>'. $bank_data->acc_details .'</td>
                    <td>'. $bank_data->open_balance .'</td>';
                if($year !=''){
                	$incomexpense = Incoexpense::where('acc_no', $bank_data->bank_details_id)->where('year', $year)->get();
                }else{
                	$incomexpense = Incoexpense::where('acc_no', $bank_data->bank_details_id)->get();
                }
                foreach($incomexpense as $inex){

                    $update_balance +=  $inex->amount;
                }
                $data .= '<td>'. $update_balance .'</td></tr>';
                $update_balance=0;
           } 
           return $data;

    }
}
