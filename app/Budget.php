<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    //
	static protected $year;
	static protected $upangso;
	static protected $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
	static protected $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    
	protected $fillable = [
	    
        'user_id', 'inout_id', 'upangsho_id', 'budget_amo', 'year', 'status', 'khattype_id', 'khtattypetype_id', 'khat_id' 
    ];
	
	public static function getinbudget($upangsho_id, $year, $khatid){
		
		self::$year = $year;
		self::$upangso = $upangsho_id;
		$data=''; $sl=1;
				
		$khattypes = TaxType::where('upangsho_id', $upangsho_id)->where('khat_id', $khatid)->get();
		 
		
			foreach($khattypes as $khats){
				if($khats->subormain != 1){
					
					$data .= '<tr>
					
						<td align="center">'. str_replace(self::$en, self::$bn, $sl++) .'।</td>
						<td>'. $khats->tax_name .'</td>
						<td></td>
						<td></td>
						<td></td>			
					</tr>'.
					self::getinkhats($khats->tax_id);
					
				}else{
					
					$khattypes = Khat::where('tax_type_id', $khats->tax_id)->first()->khat_id;
					$data .= '<tr>
					
						<td align="center">'. str_replace(self::$en, self::$bn, $sl++) .'।</td>
						<td>'. $khats->tax_name .'</td>';
						$data .=  self::getkhatsbadget($khattypes)	
					.'</tr>';
				}
			}		
		return $data;
	}
	
	
	public static function getinkhats($khatid){
		
		$data='';
		$khattypes = Khat::where('tax_type_id', $khatid)->get();		
		$flag = 0;
		
		foreach($khattypes as $khats){
			$tax = TaxTypeType::where('tax_id', $khats->tax_type_type_id)->first();
			if($khats->tax_type_type_id!=0){
				 if($flag != $khats->tax_type_type_id){
					$data .= '<tr>				
						<td></td>
						<td>'.$tax->serialise.' '.$tax->tax_name2 .'</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>';	
					$flag = $khats->tax_type_type_id;
				 }
			}
			
			$data .= '<tr>
			
				<td></td>
				<td>'. $khats->serilas.' '.$khats->khat_name.'</td>'
				.self::getkhatsbadget($khats->khat_id);			
			
			$data .= '</tr>';
		}	

		
		return $data;
	}
	
	
	
	public static function getkhatsbadget($khatid){
		
		$data='';
		$yr = self::$year;
		$year = explode('-', self::$year);
		$prev_year = ($year[0]-1).'-'.($year[1]-1);
		$next_year = ($year[0]+1).'-'.($year[1]+1);
		
		$budgets = Budget::where('khat_id', $khatid)->where('year', $yr)->first();
		$prev_budgets = self::getaay($khatid, $year) - self::getbaay($khatid, $yr); //self::getpreviousbudget($yr, 'khat_id');
		$next_budgets = Budget::where('khat_id', $khatid)->where('year', $next_year)->first();
		 
			
			$data .= '<td align="right">'; if($prev_budgets) $data .=  str_replace(self::$en, self::$bn, $prev_budgets->budget_amo.'.00'); $data .='</td>
			<td align="right">'; if($budgets) $data .=str_replace(self::$en, self::$bn, $budgets->budget_amo.'.00'); $data .='</td>
			<td align="right">'; if($next_budgets) $data .=str_replace(self::$en, self::$bn, $next_budgets->budget_amo.'.00'); $data .='</td>';
		 			
		return $data;
	}
	
 
	
	public static function getbudget(){
	    $data='';
	    $badget = Budget::select('*', 'budgets.khat_id')->join('upangshos','upangshos.upangsho_id','=','budgets.upangsho_id')
			->join('khattypes','khattypes.khat_id','=','budgets.inout_id')
			->join('khats','khats.khat_id','=','budgets.khat_id')						 
		    ->join('tax_types','tax_types.tax_id','=','budgets.khattype_id')->get();
	    
	    
	    foreach($badget as $bdgt){
            
            $data .= '<tr class="gradeX">
                 
                <td>'.$bdgt->upangsho_name.'</td>
                <td>'.$bdgt->khat.'</td>
                <td>'.$bdgt->tax_name.'</td> 
                <td><span id="khatname'.$bdgt->bidget_id.'">'.$bdgt->serilas.$bdgt->khat_name.'</span>
                    <input type="hidden" id="khatid'.$bdgt->bidget_id.'" name="khatid" value="'.$bdgt->khat_id.'">
                </td>                                      
                <td><span id="year'.$bdgt->bidget_id.'"><strong>'. str_replace(self::$en, self::$bn, $bdgt->year).'</strong></span></td>
                <td align="right"><strong>'. str_replace(self::$en, self::$bn, $bdgt->budget_amo.'.00') .'</strong></td>
				
				<td align="right"><strong>'. str_replace(self::$en, self::$bn, self::getaay($bdgt->khat_id, $bdgt->year).'.00') .'</strong></td>
				<td align="right"><strong>'. str_replace(self::$en, self::$bn, self::getbaay($bdgt->khat_id, $bdgt->year).'.00') .'</strong></td>
				<td align="right"><strong>'. str_replace(self::$en, self::$bn, ($bdgt->budget_amo - self::getbaay($bdgt->khat_id, $bdgt->year)).'.00') .'</strong></td>
				<td align="right"><strong>'. str_replace(self::$en, self::$bn, ((self::getaay($bdgt->khat_id, $bdgt->year) + $bdgt->budget_amo) - self::getbaay($bdgt->khat_id, $bdgt->year)).'.00').'</strong></td>
				
				<td>
                    <button class="btn btn-primary btn-xs" onclick="getbudget('.$bdgt->bidget_id.')"><i class="fa fa-pencil"></i></button>
                </td>
            </tr>';
		}
		return $data;
	    
	}
	
	public static function getaay($khat_id, $year){
	    
	    
	    return Incoexpense::where('inout_id', 1)->where('khat_id', $khat_id)->where('year', $year)->sum('amount');
	    
	}
	
	public static function getbaay($khat_id, $year){
	    
	    
	    return Incoexpense::where('inout_id', 2)->where('khat_id', $khat_id)->where('year', $year)->sum('amount');
	    
	}
	
	
	public static function getpendingbudget(){
	    $data='';
	    $badget = BudgetLog::join('khats', 'khats.khat_id', '=', 'budget_logs.khat_id')->where('budget_logs.status', 2)->get();
	    
	    foreach($badget as $bdgt){
            
            $data .= '<tr class="gradeX">
                <td id="khatname'.$bdgt->bdgtlog_id.'">'.$bdgt->khat_name.'</td>
                <td id="budgetyr'.$bdgt->bdgtlog_id.'">'.$bdgt->year.'</td>
                <td align="right"><strong>'. str_replace(self::$en, self::$bn, $bdgt->amount.'.00') .'</strong></td>
                <td>
                    <button class="btn btn-primary btn-xs" onclick="getupdatebudget('.$bdgt->bdgtlog_id.', '.$bdgt->budget_id.','. $bdgt->amount .')"><i class="fa fa-pencil"></i></button>
                </td>
            </tr>';
		}
		return $data;
	    
	}
}
