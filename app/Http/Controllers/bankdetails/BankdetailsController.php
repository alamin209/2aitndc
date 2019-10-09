<?php

namespace App\Http\Controllers\bankdetails;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bank;
use App\Branch;
use App\BankDetails;
class BankdetailsController extends Controller
{

    public function index()
    {


        $bank        =    Bank::all();
        $bankdetails =   BankDetails::
                         join('banks', 'banks.bank_id', '=', 'bank_details.bank_id')
                         ->join('branches', 'branches.branch_id', '=', 'bank_details.branch_id')
                         ->get();
         $menuname   =   'Bank';
       return view('bankdetails.add_bank_details',compact('bank','bankdetails','menuname'));
    }





    public function get_branch(Request $request)
    {
      $data        =   '<option value="">Select Branch</option>';
        $taxtptp   =   Branch::where('bank_id', $request->bank_id)->get();
        foreach($taxtptp as $tp){

            $data .= '<option value="'.$tp->branch_id.'">'.$tp->branch_name.'</option>';
        }
        echo $data;
    }


    public function store(Request $request)
    {
        $bn= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $en= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

          BankDetails::create([
                'bank_id'       => $request['bank_id'],
                'branch_id'     => $request['branch_id'],
                'acc_no'        => $request['acc_no'],
                'acc_code'      => $request['acc_code'],
                'acc_details'   => $request['acc_details'],
                'open_balance'  => str_replace($bn, $en, $request['open_balance']),
                'update_balance'  => str_replace($bn, $en, $request['open_balance'])


          ]);


        return redirect()->back()->with('message', 'Bank Added Successfully');

    }

    public function getbankdetails(Request $request){

        echo $request->account_id;
        $taxtptp = BankDetails::where('branch_id', $request->account_id)->where('type',1)->get();
        $data ='<option value="">Select Acount</option>';
        foreach($taxtptp as $tp){

            $data .= '<option value="'.$tp->bank_details_id.'">'.$tp->acc_no.'</option>';
        }
        echo $data;
    }

    public function getcashbankdetails(Request $request){

        echo $request->account_id;
        $taxtptp = BankDetails::where('branch_id', $request->account_id)->where('type',2)->get();
        $data ='<option value="">Select Acount</option>';
        foreach($taxtptp as $tp){

            $data .= '<option value="'.$tp->bank_details_id.'">'.$tp->acc_no.'</option>';
        }
        echo $data;
    }




}
