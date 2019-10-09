<?php

namespace App\Http\Controllers\expensekhat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Khat; 
use App\upangsho, App\TaxType; 
class ExpensekhatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
		  $upangshos = upangsho::all();
          $taxTypes = TaxType::where('khat_id',2)->get();
		  $submenu = 'ব্যায়ের খাত যুক্তকরণ';
          $ExpenceKhat = Khat::join('upangshos','upangshos.upangsho_id','=','khats.upangsho_id')
						     ->join('tax_types','tax_types.tax_id','=','khats.tax_type_id')
						     ->where('khats.khattype', 2)->paginate(10);
           
		  $menuname = 'ব্যায়ের খাত';
          return view('expensekhat.add_expensekhat', compact('submenu', 'upangshos','taxTypes','ExpenceKhat','menuname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        
          Khat::create([
		  
                'khattype'   => 2,
                'upangsho_id'   => $request['upangsho_id'],
                'tax_type_id'   => $request['tax_id'],
                'serilas'   => $request['serials'].')',
                'khat_name' => $request['expense_khat_name'],
          ]);

        return redirect()->back()->with('message', 'ব্যয়খাত সংযুক্তি  সফল');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
    }
}
