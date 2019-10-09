<?php

namespace App\Http\Controllers\incoexpense;

use App\Incoexpense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Buget
use Illuminate\Support\Facades\DB;
use App\Budget, App\TaxTypeType; 
use App\Upangsho;
use App\Khat;
use App\Khattype;
use App\TaxType;
// endBuget
// bankdetails
use App\Bank;
use App\Branch; 
use App\BankDetails; 
// endbankdetails
class IncoexpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

         $data ='<option value="">শাখা  নির্ধারণ</option>';
        $taxtptp = BankDetails::where('branch_id', $request->branch_id)->get();
        foreach($taxtptp as $tp){
            
            $data .= '<option value="'.$tp->bank_details_id.'">'.$tp->acc_no.'</option>';
        }
        echo $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $bn= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $en= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        if($request['inout_id']==1)
        {
            $vourcher_no = "";
            $chalan_no = $request['vourcher_no'];
        }
        else
        {
            $vourcher_no = $request['vourcher_no'];
            $chalan_no = "";
        }


          Incoexpense::create([
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
                'chalan_no'         => $chalan_no,
                'check_no'          => $request['check_no'],
                'amount'            => str_replace($bn, $en, $request['amount']),
                'date'              => $request['curr_date'],
                'receiver_name'     => $request['receiver_name'],
                'receive_datwe'     => $request['receive_date'],
                'note'              => $request['note'],               
          ]);

      
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
    public function show(Incoexpense $incoexpense)
    {
        //
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



