<?php

namespace App\Http\Controllers\khattype;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller, App\Khat;
use App\TaxType; use App\Khattype, App\Upangsho, App\TaxTypeType;
class KhattypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		
		$upangshos = upangsho::all();
		$khats = Khattype::all();
		$taxTypes = TaxType::all();
		$khattype = TaxType::join('khattypes','khattypes.khat_id','=','tax_types.khat_id')
						   ->join('upangshos','upangshos.upangsho_id','=','tax_types.upangsho_id')->get();
						   
						   
		$khattypetype = TaxTypeType::join('tax_types','tax_types.tax_id', '=', 'tax_type_types.khtattype_id')
						   ->join('khattypes','khattypes.khat_id', '=', 'tax_type_types.khat_id')
						   ->join('upangshos','upangshos.upangsho_id', '=', 'tax_type_types.upangsho_id')
						   ->where('tax_type_types.tax_id', '!=', '0')->get();
		 
        $menuname = 'খাত টাইপ';
        return view('khattype.add_khattype', compact('khattypetype', 'taxTypes', 'submenu','menuname', 'khattype', 'khats', 'upangshos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		 //echo $request['subormain']; die();
		 if($request['iskhattype']){
			  
			  TaxTypeType::create([
		  
					'upangsho_id'  => $request['upangsho_id'],
					'khat_id'  => $request['khat_id'],
					'khtattype_id'  => $request['tax_id'],
					'tax_name2'  => $request['tax_name2'],
			  ]);
			  
		  }else{
			  $khat = TaxType::create([
			  
					'upangsho_id'  => $request['upangsho_id'],
					'khat_id'  => $request['khat_id'],
					'subormain'  => $request['subormain'],
					'tax_name'  => $request['tax_name'],
			  ]);
			  
			  
			  
			  if($request['subormain']){
				  
					  Khat::create([
					  
							'khattype'   => $request['khat_id'],
							'upangsho_id'  => $request['upangsho_id'],
							'tax_type_id'     => $khat->tax_id,
							'serilas'     => '',
							'khat_name'     => $request['tax_name'],
					  ]);
				  
			  }
		  }

        return redirect()->back()->with('message', 'খাত যুক্তকরণ সফল হয়েছে');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }
}
