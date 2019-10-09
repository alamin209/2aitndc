<?php

namespace App\Http\Controllers\abstruct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Upangsho, App\TaxType;use App\Khattype;
class AbstructController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuname = 'রিপোর্টস';
        $upangshos = upangsho::all();
        $khats = Khattype::all();
        return view('abstruct.abstruct_register', compact('upangshos', 'menuname', 'khats'));
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
    public function store(Request $request){ 
          
        
        $ids1 = TaxType::select('tax_id')->where('upangsho_id', $request->upangsho_id)->where('khat_id', $request->inout_id)->limit(3)->pluck('tax_id')->toArray();
        $ids2 = TaxType::select('tax_id')->where('upangsho_id', $request->upangsho_id)->where('khat_id', $request->inout_id)->skip(3)->take(PHP_INT_MAX)->pluck('tax_id')->toArray();
        
        $m = $request->year.'-'.$request->month.'-';
        
        $abstruct = Upangsho::getabstruct($m, $ids1);
        $abstruct2 = Upangsho::getabstruct($m, $ids2);
        
        $menuname = 'রিপোর্টস';
        $upangshos = upangsho::all(); $khats = Khattype::all();
        return view('abstruct.abstruct_register', compact('upangshos', 'menuname', 'abstruct', 'abstruct2', 'khats'));
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
