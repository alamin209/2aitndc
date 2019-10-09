<?php

namespace App\Http\Controllers\bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bank;
class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bank = Bank::all();
        $menuname = 'Bank';
        return view('bank.add_bank', compact('bank','menuname'));
    }


    public function store(Request $request)
    {

          Bank::create([
                'bank_name'  => $request['bank_name'],
                'bank_code'     => $request['bank_code'],
          ]);

         return redirect()->back()->with('message', 'Bank  Success');
    }


}
