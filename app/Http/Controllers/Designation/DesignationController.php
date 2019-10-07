<?php

namespace App\Http\Controllers\Designation;

use App\Designation;
use App\Depertment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations=Designation::join('depertments','designations.dep_id', '=', 'depertments.id')
            ->get();
        $menuname = 'Administrator';
        $department = Depertment::all();
        return view('designation.add_designation', compact('menuname','designations','department', 'upangshos'));
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
        Designation::create([
            'dep_id'     => $request['dep_id'],
            'degin_name' => $request['degin_name'],
        ]);

        return redirect()->back()->with('message', ' Designation Add   Success');
    }


    public function show(Request $request)
    {
        $desig                = $request->desig;
        $designation          =  Designation::where('dep_id',$desig)->select('id','degin_name')->get();
        $data                 =   '<option value="">Select Designation</option>';

        foreach( $designation  as $tp){
            $data .= '<option value="'.$tp->id.'">'.$tp->degin_name.'</option>';
        }
        echo $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        //
    }
}
