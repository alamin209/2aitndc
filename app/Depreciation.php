<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Depreciation extends Model
{
    protected $fillable = [
	
        'type_id', 'cost', 'depreciation', 'date',
    ];
    
    public static function getDepreciation($sd, $ed, $id){
        
        
        
        $fsd = Carbon::parse($sd)->format('d.m.Y');
        $fed = Carbon::parse($ed)->format('d.m.Y');
        $lfed = date('t.m.Y', strtotime($sd.'-1 month')) ;
        
        $data = '<div class="col-md-12 text-center">
            <h4>Dhaka Schoolof Economics</h3>
            <span>Schedule of Property, Plant and Equipment</span><br>
            <span>For the year Ended '. date('d F Y') .'</span><br><hr>
        </div>
        <table class="table table-bordered">
            <tr>
                <th rowspan="2" style="vertical-align:middle">Particulars</th>
                <th colspan="4">Cost</th>
                <th rowspan="2" style="vertical-align:middle">Rate</th>
                <th colspan="4">Depreciation</th>
                <th rowspan="2">Write Down as on '.$fed.'</th>
                <th rowspan="2">Write Down as on '.$lfed.'</th>
            </tr><tr>
                <th>Balance as on '.$fsd.'</th>
                <th>Addition During the year</th>
                <th>Adjustment / write off during the year</th>
                <th>Balance as on '.$fed.'</th>
                <th>Balance as on '.$fsd.'</th>
                <th>Addition During the year</th>
                <th>Adjustment / write off during the year</th>
                <th>Balance as on '.$fed.'</th>
            </tr>';
        
        $heads = ExpenseType::where('category', $id)->get();
        foreach($heads as $hds){
            
            $costndepre = Depreciation::where('fdate', $sd)->where('type_id', $hds->id)->first();
            $yearcost = indirect_expense::where('exp_cat', $id)->where('exp_type',$hds->id)->whereBetween('paydate', [$sd, $ed])->sum('amount');
            $yearcost_total = $yearcost + $costndepre->cost;
            $cdpre = ceil((($yearcost_total - $costndepre->depreciation)*$hds->depriciation/100) - (($yearcost*$hds->depriciation/100)/2));
            
            $data .= '<tr>
                <td align="">'. $hds->type.'</td>
                <td align="right">'. number_format($costndepre->cost).'</td>
                <td align="right">'. number_format($yearcost) .'</td>
                <td align="right">-</td>
                <td align="right">'. number_format($yearcost_total) .'</td>
                <td align="center">'.number_format($hds->depriciation) .'%</td>
                <td align="right">'. number_format($costndepre->depreciation) .'</td>
                <td align="right">'. number_format($cdpre) .'</td>
                <td align="right">-</td>
                <td align="right">'. number_format( $cdpre+$costndepre->depreciation ) .'</td>
                <td align="right">'. number_format($yearcost_total - ($cdpre+$costndepre->depreciation )).'</td>
                <td align="right">'. number_format($costndepre->cost-$costndepre->depreciation).'</td>
            </tr>';
        }
        
        $data .= '</table>';
        return $data;
    }
    
}
