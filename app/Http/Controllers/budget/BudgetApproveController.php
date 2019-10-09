<?php

namespace App\Http\Controllers\budget;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Budget;
use App\BudgetLog;


class BudgetApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       
        $badget = Budget::getpendingbudget();
        //echo 'tst'; exit;
		$menuname = 'বাজেট';
		
		return view('budget.badget_approve', compact('badget', 'menuname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        
        echo $request->amnt; 
    }
    
    public function budgetallow(Request $request){
        
        echo $request->amnt; exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		
		$bn= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
		$en= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        //echo $request['userid']; exit;
        //Budget::create([
            
            //'user_id'           => $request['userid'],
            //'upangsho_id'       => $request['upangsho_id'],
            //'inout_id'          => $request['inout_id'],
            //'khattype_id'       => $request['khattype_id'],
            //'khtattypetype_id'  => $request['khtattypetype_id'],
            //'khat_id'           => $request['khat_id'],
            //'year'              => $request['year'],
            //'budget_amo'        => str_replace($bn, $en, $request['budget_amo'])               
        //]);
        
        //echo $request->apprvid.' '; 
        //echo $request->bdgid.' ';
        //echo $request->bdglgid.' ';
        //echo $request->amount,' ';
        
        BudgetLog::where('bdgtlog_id', $request->bdglgid)->update(['amount'=>str_replace($bn, $en, $request->amount), 'status'=>1, 'apprby'=>$request->apprvid]); 
        Budget::where('bidget_id', $request->bdgid)->increment('budget_amo', str_replace($bn, $en, $request->amount));
        return redirect()->back()->with('message', 'বাজেট সংযুক্তি সফল');
        
    }
    
    public function updatebudget(Request $request){
		
		$bn= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
		$en= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
       
        //echo $request->year; die();
        $bdgtupdt = new BudgetLog;
        $bdgtupdt->user_id = $request->userid;
        $bdgtupdt->budget_id = $request->bdgtid;
        $bdgtupdt->khat_id = $request->khat_id;
        $bdgtupdt->status = 2;
        $bdgtupdt->year = str_replace($bn, $en, $request->year);
        $bdgtupdt->amount = str_replace($bn, $en, $request->amount);
        $bdgtupdt->save();
        
        
        //Budget::where('bidget_id', $request->bdgtid)->increment('budget_amo', str_replace($bn, $en, $request->amount));
        return redirect()->back()->with('message', 'বাজেট সংযুক্তি সফল');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showbudget(){
        
		$badget = Budget::getbudget();
       
		$menuname = 'বাজেট';
		return view('budget.view_badget',compact('badgetstatus', 'badget', 'menuname'));
    }
    
    
    public function budgetappr(){
        
		$badget = Budget::getpendingbudget();
        //echo 'tst'; exit;
		$menuname = 'বাজেট';
		return view('budget.badget_approve', compact('badget', 'menuname'));
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
