<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
protected $fillable=[
    'sup_id','doc_name','inco_cat','inco_type','user_id','cat_id','sub_cat','product_name','quantity','bankact','branch_id','purchase_date','purchase_cost','total_qty'
];

    public $timestamps=false;
    
    
    public static function getfiancial_position($sd){
		
		$cuurentYear = date('Y'); 	$dates = explode('-', $sd);	
		
		if((int)$dates[1] <= 6){
			
			$cfd = ($dates[0]-1).'-07-01';			
			if($cuurentYear != $dates[0]){
				$ctd = ($dates[0]).'-06-30'; }else{				
				$ctd = $sd;
			}
			$pfd = ($dates[0]-2).'-07-01';
			$ptd = ($dates[0]-1).'-06-30'; 
			$perevyear = $dates[0]-1;
		}else{
			
			$cfd = ($dates[0]).'-07-01';			
			if($cuurentYear != $dates[0]){
				$ctd = ($dates[0]+1).'-06-30'; }else{				
				$ctd = $sd;
			}
			$pfd = ($dates[0]-1).'-07-01';
			$ptd = ($dates[0]).'-06-30'; 
			$perevyear = $dates[0];
		}
		
		$times =  $cfd.' to '.$ctd.', '.$pfd.' to '.$ptd;
		 
		$data = '<div id="prinarea"><div style="text-align:center">
			<h3>Dhaka School of Economics</h3>
			<span>Statement of Financial Position</span><br>
			<span>As at '.date('d F Y', strtotime($sd)).'</span><br>
			<small style="font-size:8px">'. $times .'</small>
		</div><br>';		
		
		
		
		//$invtories = Inventory::whereBetween('purchase_date', [$sd, $ed])->get();
		$ids = ["1","2"];
		$categories = inventorycatagory::whereIn('id', $ids)->get();
		$data .= '<table style="width:100%" cellspacing="10">
			<tr>
				<td rowspan="2" align="center" style="border:1px solid"><strong>Particulars</strong></td>
				<td  rowspan="2" align="center" style="border:1px solid"><strong>Note</strong></td>
				<td align="center" style="border:1px solid"><strong>Amount in BDT</strong></td>
				<td align="center" style="border:1px solid"><strong>Amount in BDT</strong></td>			
			</tr>
			<tr>
				 
				<td align="center" style="border:1px solid"><strong>'.$dates[2].'.'.$dates[1].'.'.$dates[0].'</strong></td>
				<td align="center" style="border:1px solid"><strong>30.06.'. $perevyear .'</strong></td>
			</tr>';
			$totla_curent = 0; $totla_previos = 0;
			foreach($categories as $cats){
				
				$data .= '<tr class="noBorder">
					<td colspan="4"><strong>'. $cats->catgeory_name .'</strong></td>
				</tr>';
				$subcategories = inventorysucategory::where('cat_id', $cats->id)->get();
				$cur_total = 0; $prev_total = 0;
				foreach($subcategories as $subcat){
					
					$current_sum = Inventory::where('sub_cat', $subcat->id)->whereBetween('purchase_date', 	[$cfd, $ctd])->sum('purchase_cost');
					$previus_sum = Inventory::where('sub_cat', $subcat->id)->whereBetween('purchase_date',  [$pfd, $ptd])->sum('purchase_cost');
					
					$data .= '<tr class="noBorder">
						<td align="">'. $subcat->sub_cate_name .'</td>
						<td align="center">'. $subcat->note .'</td>
						<td align="right" style="border:1px solid">'. $current_sum .'</td>
						<td align="right"  style="border:1px solid">'. $previus_sum .'</td>
					</tr>';
					$cur_total += $current_sum; $prev_total += $previus_sum;
				}
				$data .= '<tr class="noBorder">
					<td align=""></td>
					<td align="center"></td>
					<td align="right" style="border-bottom:1px solid"><strong>'. $cur_total .'</strong></td>
					<td align="right" style="border-bottom:1px solid"><strong>'. $prev_total .'</strong></td>
				</tr>';
				
				$totla_curent +=  $cur_total ;
				$totla_previos += $prev_total;
			}
			
			$data .= '<tr class="noBorder">
				<td align=""><strong>Total Assets</strong></td>
				<td align="center"></td>
				<td align="right" style="border-bottom:1px solid double"><strong>'. $totla_curent .'</strong></td>
				<td align="right" style="border-bottom:1px solid double"><strong>'. $totla_previos .'</strong></td>
			</tr>			 
			<tr class="noBorder">
			
				<td colspan="4"><strong><br>Fund and libilities</strong></td>				
			</tr>';
			
			$ids = ["1","2"];
			$incomescats = IncomeCat::whereIn('id', $ids)->get();
			$totla_curent = 0; $totla_previos = 0;
			foreach($incomescats as $incmcts){
				
				$data .= '<tr class="noBorder">
					<td colspan="4"><strong>'. $incmcts->category .'</strong></td>					
				</tr>';
				
				$cur_total = 0; $prev_total = 0;
				$cur_total2 = 0; $prev_total2 = 0;
				
				$incomestypes = IncomeType::where('category', $incmcts->id)->get();
				foreach($incomestypes as $incmtps){
					
					$current_sum = Income::where('inco_type', $incmtps->id)->whereBetween('date', [$cfd, $ctd])->sum('amount');
					$previus_sum = income::where('inco_type', $incmtps->id)->whereBetween('date', [$pfd, $ptd])->sum('amount');
					
					$data .= '<tr class="noBorder">
						<td align="">'.$incmtps->type.'</td>
						<td align="center">'.$incmtps->note.'</td>
						<td align="right" style="border:1px solid">'. $current_sum .'</td>
						<td align="right" style="border:1px solid">'. $previus_sum .'</td>
					</tr>';
					if($incmcts->id==2)
					$cur_total += $current_sum; $prev_total += $previus_sum;
					$cur_total2 += $current_sum; $prev_total2 += $previus_sum;
				}
				if($incmcts->id==2)
				$data .= '<tr class="noBorder">
					<td align=""></td>
					<td align="center"></td>
					<td align="right" style="border-bottom:1px solid"><strong>'. $cur_total .'</strong></td>
					<td align="right" style="border-bottom:1px solid"><strong>'. $prev_total .'</strong></td>
				</tr>';
				
				$totla_curent +=  $cur_total2;
				$totla_previos += $prev_total2;
			}
			
			$data .= '<tr class="noBorder">
				<td align=""><strong>Total Equity & Libilities</strong></td>
				<td align="center"></td>
				<td align="right" style="border-bottom:1px solid"><strong>'. $totla_curent .'</strong></td>
				<td align="right" style="border-bottom:1px solid"><strong>'. $totla_previos .'</strong></td>
			</tr>';
			
			
			
			
			$data .= '</table><br><hr><div class="col-md-12" style="padding-left:0px">
				<span class="col-md-12" style="padding-left:0px">The Accompanying notes from an integral part of the Statement of Financial Position.</span>
				<br><br><br><br><br>
				<span class="col-md-10" style="padding-left:0px"><strong>Head of Administration</strong></span>
				<span class="col-md-2" style="padding-left:0px"><strong>Director</strong></span>
				<br><br>
				<span class="col-md-12" style="padding-left:0px">This is the Statement of Financial Position referred to in our separate report of the even date.</span>
				<br><br>
				<span class="col-md-10" style="padding-left:0px">Dhaka : '. date('d-F-y') .'</span>
				<span class="col-md-2" style="padding-left:0px">Software Genarated</span>
			</div>
		</div>';
		
		
		return $data;
	}

}
