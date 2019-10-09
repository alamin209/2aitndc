<?php

namespace App\Http\Controllers\designation;

use App\Designations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Departments;
class DesignationsController extends Controller
{

    public function index()
    {
        $designations=Designations::join('departments','designations.dep_id', '=', 'departments.id')
                          ->get();
        $menuname = 'Administrator';
        $department = Departments::all();
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


    public function store(Request $request)
    {

        Designations::create([
            'instutite_id'  => 1,
            'dep_id'     => $request['dep_id'],
            'degin_name' => $request['degin_name'],
        ]);

        return redirect()->back()->with('message', ' Designation Add   Success');
    }


    public function show(Request $request)
    {
        $desig                = $request->desig;
        $designation          =  Designations::where('dep_id',$desig)->select('id','degin_name')->get();
        $data                 =   '<option value="">Select Designation</option>';

        foreach( $designation  as $tp){
            $data .= '<option value="'.$tp->id.'">'.$tp->degin_name.'</option>';
        }
        echo $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function edit(Designations $designations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designations $designations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designations $designations)
    {
        //
    }
}
