<?php

namespace App\Http\Controllers\balancetransfer;


use App\Incoexpense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Budget, App\TaxTypeType;
use App\Upangsho;
use App\Khat;
use App\Khattype;
use App\TaxType;
use App\Bank;
use App\Branch;
use App\BankDetails;


class BalancetransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $upangshos = upangsho::all();
        
        //$khats = Khattype::all();
        //$taxTypes = TaxType::all();
        //$khat = Khat::all();
        //$khattypetype = TaxTypeType::all();
        
        $economicalYears = Upangsho::getecoyears('17');
        
        $menuname = 'আয়/ব্যয় সংযুক্তি';
        $bank = Bank::all();
        
        $bankdetails = Bank::join('bank_details', 'bank_details.bank_id', '=', 'banks.bank_id')
            ->join('branches', 'branches.bank_id', '=', 'banks.bank_id')
            ->get();

        return view('balancetransfer.balancetransfer',compact('economicalYears', 'khattypetype', 'submenu', 'upangshos', 'menuname', 'khats', 'taxTypes', 'khat', 'ExpenceKhat','bank','bankdetails'));

    }

     
    public function create(Request $request){
       
        $data ='<option value="">ব্যাংক একাউন্ট নম্বর নির্ধারণ</option>';
        $taxtptp = BankDetails::where('branch_id', $request->branch_id)->get();
        foreach($taxtptp as $tp){

            $data .= '<option class="'.$request->div.' '. $request->div.$tp->upangsho_id.'" value="'.$tp->bank_details_id.'">'.$tp->acc_no.'</option>';
        }
        echo $data;
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
        
        echo $request->fbank_id.' ';
        echo $request->fbranch_id.' ';
        echo $request->facc_no.' ';
        echo $request->amount.' ';
        echo $request->tbank_id.' ';
        echo $request->tbranch_id.' ';
        echo $request->tacc_no.' ';
        
        echo $request->yar.' ';
        echo $request->chqno.' ';
        echo $request->vouno.' ';
        
        //exit;
        
        
        BankDetails::where('bank_details_id', $request->facc_no)->decrement('update_balance',$request->amount);
        BankDetails::where('bank_details_id', $request->tacc_no)->increment('update_balance',$request->amount);
        
        Incoexpense::create([
            
            'upangsho_id'       => 3,
            'inout_id'          => 2,
            'khattype_id'       => 75,
            'khtattypetype_id'  => 0,
            'khat_id'           => 186,
            'khat_des'          => 'স্থানানন্ত্র প্রদান',
            'year'              => $request->yar,
            'bank_id'           => $request['fbank_id'],
            'branch_id'         => $request['fbranch_id'],
            'acc_no'            => $request['facc_no'],
            'vourcher_no'       => '',
            'vat_tax_status'    => 0,
            'chalan_no'         => '',
            'check_no'          => $request['chqno'],
            'amount'            => str_replace($bn, $en, $request['amount']),
            'date'              => date('Y-m-d'),
            'receiver_name'     => '',
            'receive_datwe'     => date('Y-m-d'),
            'note'              => 'স্থানানন্ত্র প্রদান'
            
        ]);
        
        
        Incoexpense::create([
            
            'upangsho_id'       => 3,
            'inout_id'          => 1,
            'khattype_id'       => 56,
            'khtattypetype_id'  => 0,
            'khat_id'           => 240,
            'khat_des'          => 'স্থানানন্ত্র গ্রহন',
            'year'              => $request->yar,
            'bank_id'           => $request['tbank_id'],
            'branch_id'         => $request['tbranch_id'],
            'acc_no'            => $request['tacc_no'],
            'vourcher_no'       => $request['vouno'],
            'vat_tax_status'    => 0,
            'chalan_no'         => '',
            'check_no'          => '',
            'amount'            => str_replace($bn, $en, $request['amount']),
            'date'              => date('Y-m-d'),
            'receiver_name'     => '',
            'receive_datwe'     => date('Y-m-d'),
            'note'              => 'স্থানানন্ত্র গ্রহন'
        ]);
        
        $menuname = 'আয়/ব্যয় সংযুক্তি';
        return redirect()->back()->with('message','আর্থিক স্থানন্তর সফল হয়েছে');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Incoexpense  $incoexpense
     * @return \Illuminate\Http\Response
     */
     
    public function showincomeexpnses(){
        
        $expensese =Incoexpense::leftJoin('budgets','incoexpenses.khat_id','=','budgets.khat_id')
            ->leftJoin('upangshos','upangshos.upangsho_id','=','incoexpenses.upangsho_id')
            ->leftJoin('khattypes','khattypes.khat_id','=','incoexpenses.inout_id')
            ->leftJoin('khats','khats.khat_id','=','incoexpenses.khat_id')

            ->orderBy('incoexpenses.incoexpenses_id', 'DESC')
            ->leftJoin('tax_types','tax_types.tax_id','=','budgets.khattype_id')->get();

        $menuname = 'আয়/ব্যয় সংযুক্তি';
        return view('incoexpense.incoexpense_management', compact('menuname','upangshos','khats','taxTypes','expensese'));
        
    }
    
    
    public function updatincomeexpense(Request $request){
 

        $bn= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $en= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        $incoexpenses_id=$request->incoexpenses_id;
        
        $data = array(
            'amount' => $request->amount,
        );
        
        DB::table('incoexpenses')
            ->where('incoexpenses_id',$incoexpenses_id)
            ->update($data);


        //Budget::where('bidget_id', $request->bdgtid)->increment('budget_amo', str_replace($bn, $en, $request->amount));
        return redirect()->back()->with('message', 'আয়/ব্যয়  হালনাগাদ সফল');
        
    }
     
     
     
    public function show(Incoexpense $incoexpense)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Incoexpense  $incoexpense
     * @return \Illuminate\Http\Response
     */
    public function edit(Incoexpense $incoexpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Incoexpense  $incoexpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incoexpense $incoexpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Incoexpense  $incoexpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incoexpense $incoexpense)
    {
        //
    }
}



