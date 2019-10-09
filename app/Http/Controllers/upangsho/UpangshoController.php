<?php

namespace App\Http\Controllers\Upangsho;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Upangsho;
use App\Degree;
class UpangshoController extends Controller
{

    public function index()
    {

       $degrees = Degree::all();

		$upangso = Upangsho::paginate(10);
		$menuname = 'Subject';
        return view('subjects.add_subject', compact('upangso', 'menuname','degrees'));
    }


    public function store(Request $request)
    {

          upangsho::create([
                'degree_id'  => $request['degree_id'],
                'status'     => $request['status'],
                'subject_name'     => $request['subject_name'],
                'semester'     => $request['semester'],
                'sub_code'     => $request['sub_code'],

          ]);



        return redirect()->back()->with('message', 'Subject Add   Success');
    }
	
	public function manage()
    {
        return view('upangsho.add_upangsho');
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
