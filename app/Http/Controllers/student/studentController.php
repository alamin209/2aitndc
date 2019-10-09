<?php

namespace App\Http\Controllers\student;

use App\Billingconfiguration;
use App\Http\Controllers\billingconfiguration\BillingconfigurationController;
use App\student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Degree;
use DB;

class studentController extends Controller
{
    public  function index(){

        $menuname = 'Student';

        $degrees = Degree::all();
        $all_batch=student::all();

        return view('student.studentlist', compact('menuname', 'dates','degrees','all_batch'));
    }

    public function subjectwisestudent(Request $request){

        $deg_id= $request->deg_id;
        $sub_id= $request->sub_id;
        $batch_id= $request->batch_id;
        $session= $request->sessions;


        $all_due =  DB::table('students')
            ->select('students.id as id', 'student_id', 'full_name', 'student_type','degrees.subject_name as subject_name', 'upangshos.subject_name as subject_names','billingconfigurations.billing_type  as billing_type')
            ->leftJoin('degrees', 'students.degree_id',             '=',  'degrees.id')
            ->leftJoin('upangshos', 'students.sub_id',              '=',  'upangshos.upangsho_id')
            ->leftJoin('billingconfigurations', 'students.id',       '=', 'billingconfigurations.std_id')
            ->whereIn('billingconfigurations.billing_type', [1,4])
//            ->where('billingconfigurations.billing_type', 4)
            ->where('billingconfigurations.billing_type', '!=' , 5)
            ->where('students.degree_id',$deg_id)
            ->where('students.sub_id',$sub_id)
            ->where('students.batch_id',$batch_id)
            ->where('students.session',$session)
            ->orderBy('students.student_id', 'ASC')
            ->get();

        $menuname  =   'Student';
        return view('student.all_studentlist', compact('menuname', 'all_due', 'khats', 'taxTypes', 'expensese','all_batch'));


    }

    public function subjectwithdetail(Request $request){

        $sub_id= $request->sub_id;
        $degrees = student::where('sub_id',$sub_id)-> groupBy('batch_id')->get();

        return view('student.degreewisestident', compact('degrees'));

    }

    public function studentpaymentreport(){

        $menuname  =   'Report';
        $degrees   = Degree::all();
        $all_batch =student::all();

        return view('student.stud_paylist_report_show', compact('menuname','degrees'));
    }
    public function studentpaymentreportprocess(Request $request){
        $deg_id= $request->deg_id;
        $sub_id= $request->sub_id;
        $batch_id= $request->batch_id;
        $session= $request->sessions;
        $payment_type= $request->payment_typ;



        $all_payment_list =  DB::table('students')
            ->select('students.id as id', 'student_id', 'full_name', 'student_type','degrees.subject_name as subject_name', 'upangshos.subject_name as subject_names','billingconfigurations.billing_type  as billing_type','billingconfigurations.pay_amount as pay_amount','billingconfigurations.totalamount as totalamount')
            ->leftJoin('degrees', 'students.degree_id',             '=',  'degrees.id')
            ->leftJoin('upangshos', 'students.sub_id',              '=',  'upangshos.upangsho_id')
            ->leftJoin('billingconfigurations', 'students.id',       '=', 'billingconfigurations.std_id')
//            ->whereIn('billingconfigurations.billing_type', [1,4])
            ->where('billingconfigurations.billing_type', $payment_type)
            ->where('students.degree_id',$deg_id)
            ->where('students.sub_id',$sub_id)
            ->where('students.batch_id',$batch_id)
            ->where('students.session',$session)
            ->orderBy('students.student_id', 'ASC')
            ->get();
        $menuname  =   'Report';
        return view('student.all_paymentlist_process_process', compact('menuname', 'all_payment_list', 'khats', 'taxTypes', 'expensese','all_batch'));

    }

    public function deopstudent($id){

                $Billingconfiguration = Billingconfiguration::find($id);
                $Billingconfiguration->billing_type = '5';
                $Billingconfiguration->save();
                return redirect('admissiondue')->with('err-message', 'Student Drop Successfully');

    }



    public function deopstudentlist(Request $request){

//        $deg_id= $request->deg_id;
//        $sub_id= $request->sub_id;
//        $batch_id= $request->batch_id;
//        $session= $request->sessions;
//

        $all_due =  DB::table('students')
            ->select('students.id as id', 'student_id', 'full_name', 'student_type','degrees.subject_name as subject_name', 'upangshos.subject_name as subject_names','billingconfigurations.billing_type  as billing_type')
            ->leftJoin('degrees', 'students.degree_id',             '=',  'degrees.id')
            ->leftJoin('upangshos', 'students.sub_id',              '=',  'upangshos.upangsho_id')
            ->leftJoin('billingconfigurations', 'students.id',       '=', 'billingconfigurations.std_id')
//             ->whereIn('billingconfigurations.billing_type', [1,4])
            ->where('billingconfigurations.billing_type', '5')
//            ->where('students.degree_id',$deg_id)
//            ->where('students.sub_id',$sub_id)
//            ->where('students.batch_id',$batch_id)
//            ->where('students.session',$session)
            ->orderBy('students.student_id', 'ASC')
            ->get();

        $menuname  =   'Student';
            return view('student.all_drop_studentlist', compact('menuname', 'all_due', 'khats', 'taxTypes', 'expensese','all_batch'));


    }

}
