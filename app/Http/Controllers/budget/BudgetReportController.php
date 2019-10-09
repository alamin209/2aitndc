<?php

namespace App\Http\Controllers\budget;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Budget; 
use App\Upangsho;
use App\Khat;
use App\Khattype;
use App\TaxType;

class BudgetReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index($url){ //echo $url; die();
       
        $upangshos = upangsho::all();
		$years = Budget::select('year')->groupBy('year')->get();
		$menuname = 'রিপোর্টস';	
		return view('budget.badget_report_'.$url, compact('url','years', 'submenu', 'upangshos', 'menuname', 'khats', 'taxTypes', 'khat', 'ExpenceKhat'));
		 
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

     $results = IncomeKhat::where('upangsho_id', $request->upangsho_id)->get();

     if (count($results) > 0) {
            foreach ($results as $row){
                ?>
                <option value="<?=$row->income_id; ?>"><?=$row->expense_khat_name; ?></option>
                <?php
          }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		
		$upangshos = Upangsho::all();
		$years = Budget::select('year')->groupBy('year')->get();
		$menuname = 'রিপোর্টস';	
		
		$upangsho_id = $request->upangsho_id;
		$type = $request->type;
		$url = $request->url;
		$upangshoname = Upangsho::where('upangsho_id', $upangsho_id)->first()->upangsho_name;
		$year = $request->year;
        
		
		$badget = Budget::getinbudget($upangsho_id, $year, $type);
        return view('budget.badget_report_'.$url,compact('url','upangsho', 'year', 'years', 'upangshoname', 'badget', 'upangshos', 'menuname', 'khats', 'taxTypes', 'khat', 'ExpenceKhat'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showbudget()
    {
		$badget = Budget::join('upangshos','upangshos.upangsho_id','=','budgets.upangsho_id')
						->join('khattypes','khattypes.khat_id','=','budgets.inout_id')
						->join('khats','khats.khat_id','=','budgets.khat_id')						 
					    ->join('tax_types','tax_types.tax_id','=','budgets.khattype_id')->paginate(10);
        
		$menuname = 'বাজেট';
		return view('budget.view_badget',compact('badgetstatus', 'badget', 'menuname'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
