<?php

namespace App\Http\Controllers\incoexpense;


use App\Incoexpense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Budget, App\TaxTypeType; use App\Upangsho; use App\Khat;
use App\Khattype; use App\TaxType; use App\Bank; use App\Branch;
use App\BankDetails;


class IncoexpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $upangshos = upangsho::all();
        $khats = Khattype::all();
        $taxTypes = TaxType::all();
        $khat = Khat::all();
        $khattypetype = TaxTypeType::all();
        $menuname = 'আয়/ব্যয় সংযুক্তি';
        $bank = Bank::all();
        $bankdetails = Bank::
                        join('bank_details', 'bank_details.bank_id', '=', 'banks.bank_id')
                            ->join('branches', 'branches.bank_id', '=', 'banks.bank_id')
                            ->get();

        return view('incoexpense.add_incoexpense',compact('khattypetype', 'submenu', 'upangshos', 'menuname', 'khats', 'taxTypes', 'khat', 'ExpenceKhat','bank','bankdetails'));

    }

     
    public function create(Request $request){
       
        $data ='<option value="">Bank Account Number</option>';
        $taxtptp = BankDetails::where('branch_id', $request->branch_id)->get();
        foreach($taxtptp as $tp){

            $data .= '<option class="accounts accounts'.$tp->upangsho_id.'" value="'.$tp->bank_details_id.'">'.$tp->acc_no.'</option>';
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

        if($request['inout_id'] == 1){
            
            $vourcher_no = "";
            $chalan_no = $request['vourcher_no'];
        }else{
            
            $vourcher_no = $request['vourcher_no'];
            $chalan_no = "";
        }

        if(!empty($request['vat']) || !empty($request['tax']) ){

            $vat_tax_status=1;
        }else{
            
            $vat_tax_status=0;
        }


        $incoexpenseid=Incoexpense::insertGetId([
            
            'user_id'       => $request['userid'],
            'upangsho_id'       => $request['upangsho_id'],
            'inout_id'          => $request['inout_id'],
            'khattype_id'       => $request['khattype_id'],
            'khtattypetype_id'  => $request['khtattypetype_id'],
            'khat_id'           => $request['khat_id'],
            'khat_des'          => $request['khat_des'],
            'year'              => $request['year'],
            'bank_id'           => $request['bank_id'],
            'branch_id'         => $request['branch_id'],
            'acc_no'            => $request['acc_no'],
            'vourcher_no'       => $vourcher_no,
            'vat_tax_status'    => $vat_tax_status,
            'chalan_no'         => $chalan_no,
            'check_no'          => $request['check_no'],
            'amount'            => str_replace($bn, $en, $request['amount']),
            'date'              => $request['receive_date'],
            'receiver_name'     => $request['receiver_name'],
            'receive_datwe'     => $request['receive_date'],
            'note'              => $request['note']
            
        ]);




        if(!empty($request['vat'])){
            
            Incoexpense::create([
                'user_id'       => $request['userid'],
                'upangsho_id'       => $request['upangsho_id'],
                'inout_id'          => $request['inout_id'],
                'khattype_id'       => $request['khattype_id'],
                'khtattypetype_id'  => $request['khtattypetype_id'],
                'khat_id'           => $request['khat_id'],
                'khat_des'          =>'-ঐ-কাজের মূঃসঃক' ,
                'year'              => $request['year'],
                'bank_id'           => $request['bank_id'],
                'branch_id'         => $request['branch_id'],
                'acc_no'            => $request['acc_no'],
                'vourcher_no'       => $request['vat_check_no'],
                'chalan_no'         => $chalan_no,
                'check_no'          => $request['vat_check_no'],
                'amount'            => str_replace($bn, $en, $request['vat']),
                'date'              => $request['receive_date'],
                'receiver_name'     => '১/১১৩৩/০০৫/০৩১১',
                'vat_tax_status'    => $incoexpenseid,
                'receive_datwe'     => $request['receive_date'],
                'note'              => $request['note'],
            ]);
        }
        
        
        if(!empty($request['tax'])){
            
            Incoexpense::create([
                'user_id'       => $request['userid'],
                'upangsho_id'       => $request['upangsho_id'],
                'inout_id'          => $request['inout_id'],
                'khattype_id'       => $request['khattype_id'],
                'khtattypetype_id'  => $request['khtattypetype_id'],
                'khat_id'           => $request['khat_id'],
                'khat_des'          => 'ঐ-কাজের আয়কর',
                'year'              => $request['year'],
                'bank_id'           => $request['bank_id'],
                'branch_id'         => $request['branch_id'],
                'acc_no'            => $request['acc_no'],
                'vourcher_no'       => $request['taxvourcher_no'],
                'vat_tax_status'    =>$incoexpenseid,
                'chalan_no'         => $chalan_no,
                'check_no'          => $request['tax_check_no'],
                'amount'            => str_replace($bn, $en, $request['tax']),
                'date'              => $request['receive_date'],
                'receiver_name'     => '১/১১৪২/০০১০/০১১১',
                'receive_datwe'     => $request['receive_date'],
                'note'              => $request['note'],
            ]);
            
        }
        

        BankDetails::where('bank_details_id', $request['acc_no'])->increment('update_balance', $request['amount']);
        $menuname = 'আয়/ব্যয় সংযুক্তি';
        return redirect()->back()->with('message','আয়/ব্যয় সংযুক্তি সফল হয়েছে');

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



