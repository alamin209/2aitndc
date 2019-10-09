<?php

namespace App\Http\Controllers\khat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Khat, App\Khattype, App\TaxTypeType;
use App\Upangsho;
use App\TaxType;

class KhatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){ 
        
         $upangshos = upangsho::all();
         $taxTypes = TaxType::all();
		 $khats = Khattype::all();
		 $khattypetype = TaxTypeType::all();
         $incomeKhat = Khat::join('upangshos','upangshos.upangsho_id','=','khats.upangsho_id')
						   ->join('tax_types','tax_types.tax_id','=','khats.tax_type_id')
						   ->join('khattypes','khattypes.khat_id','=','khats.khattype')->get();
		 $menuname = 'খাত';
         return view('khat.add_khat',compact('khattypetype', 'khats', 'submenu', 'upangshos','taxTypes', 'incomeKhat', 'menuname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
		
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
      Khat::create([
			'khattype'   => $request['inout_id'],
            'upangsho_id'  => $request['upangsho_id'],
            'tax_type_id'     => $request['tax_id'],
            'tax_type_type_id'     => $request['tax_id2'],
            'serilas'     => $request['serials'].')',
            'khat_name'     => $request['expense_khat_name'],
      ]);

        return redirect()->back()->with('message', 'খাত সংযুক্তি  সফল');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
