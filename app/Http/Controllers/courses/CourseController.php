<?php

namespace App\Http\Controllers\courses;

use App\Course;
use Illuminate\Http\Request;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Degree;
use App\Upangsho;
use App\student;

class CourseController extends Controller
{

    public function index()
    {

        $degrees = Degree::all();
        $menuname = 'Courses';

        return view('courses.add_course', compact('menuname','degrees', 'upangshos','course'));
    }

    public function store(Request $request)
    {



        Course::create([
            'degree_id'           => $request['degree'],
            'sub_id'              => $request['sub_id'],
            'sem_id'              => $request['sem_id'],
            'course_code'         => $request['course_code'],
            'course_credit'       => $request['course_credit'],
            'course_name'         => $request['course_name'],
            'course_mark'         => $request['course_mark'],
            'lab_mark'            => $request['lab_mark'],
            'lab_credit'          => $request['lab_credit'],

        ]);

        return redirect()->back()->with('message', ' Course  Add   Success');
    }


    public function degree_id(Request $request){

        $degree_id=$request->degree_id;

        $degree_name= Upangsho::degreedetails($degree_id);

          echo $degree_name;
    }

    public function viewcourses(){
        $degrees = Degree::all();
        $menuname = 'Course';

        return view('courses.viewcourses', compact('menuname','degrees', 'upangshos','course'));
    }

    public function viewcourseswithid(Request $request){

        $degree_id=$request->degree;
        $sub_id=$request->sub_id;
        $sem_id=$request->sem_id;

    }

    public function semesterwithsubject(Request $request)
    {
        $degree_id=$request->degree_id;


        $degree_name= Upangsho::degreedetailswithsemester($degree_id);

        echo $degree_name;
    }

    public function getSubjectwhoutsemed(Request $request){

        $degree_id=$request->degree_id;

        $degree_name= Upangsho::degreedetailwithoutsem($degree_id);

        echo $degree_name;

    }
    
      public function getcourses_id_with_semester(Request $request){
        $course_id=$request->course_id;
        $sub_id=$request->sub_id;

        $semester_details=Course::where('sem_id',$course_id)->where('sub_id',$sub_id)->groupBy('sub_id')->get();
        $batch_session=student::where('sub_id',$sub_id)->groupBy('sub_id')->get();
        $data="";
                  $data .='<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong> Batch  </strong></label>
                     <div class="col-lg-10">
               <select class="form-control m-bot15" id="batch_id" name="batch_id"   required>
                                         <option>Select Batch </option>';
                                           foreach ($batch_session as $c){
                                               $data .='<option value="'. $c->batch_id.'" >'. $c->batch_id.' </option>';
                                           }
                $data .='</select>  
                </div>';
                 $data .='<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong> Session </strong></label>
                     <div class="col-lg-10">
                     <select class="form-control m-bot15" id="session_id" name="session_id"   required>
                                                 <option>Select Session </option>';
                                                   foreach ($batch_session as $c){
                                                       $data .='<option value="'. $c->session.'" >'. $c->session.' </option>';
                                                   }
                        $data .='</select></div>';


                   $data .='<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong> Course Name </strong></label>
                          <div class="col-lg-10">
            <select class="form-control m-bot15" id="session_id" name="course_id"   required>

                                     <option>Select Course </option>';
                                       foreach ($semester_details as $c){
                                           $data .='<option value="'. $c->id.'" >'. $c->course_name.' </option>';
                                       }
            $data .='</select>
                </div>';

        
      echo $data;
    }





}
