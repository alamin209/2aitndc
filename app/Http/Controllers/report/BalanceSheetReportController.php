<?php

namespace App\Http\Controllers\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankDetails;

class BalanceSheetReportController extends Controller {

    public function balanceSheet() {

        $banks = BankDetails::join('banks', 'bank_details.bank_id', '=', 'banks.bank_id')
                ->join('branches', 'bank_details.branch_id', '=', 'branches.branch_id')
                ->where('acc_code', '!=', '')
                ->where('acc_code', '!=', 'SOD')
                ->get();
        $sodbanks = BankDetails::join('banks', 'bank_details.bank_id', '=', 'banks.bank_id')
                ->join('branches', 'bank_details.branch_id', '=', 'branches.branch_id')
                
                ->where('acc_code', 'SOD')
                ->get();

        $cashes = BankDetails::Leftjoin('banks', 'bank_details.bank_id', '=', 'banks.bank_id')
                ->Leftjoin('branches', 'bank_details.branch_id', '=', 'branches.branch_id')
                ->orderBy('bank_details.bank_id')
                ->where('bank_details.acc_details', '')
                ->get();

        $menuname = 'Report';
        return view('report.balance_sheet', compact('menuname', 'banks', 'cashes', 'sodbanks'));
    }
    
    public function updateopening(Request $request) {
        
        
        if(BankDetails::where('bank_details_id', $request->bid)->update(['open_balance'=>$request->amount])){
            
            echo 'ok';
        }else{
            
            echo 'Update fail, Please try again !';
        }
        
        
    }

}
