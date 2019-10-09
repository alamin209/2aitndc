<?php

namespace App\Http\Controllers\billingconfiguration;

use App\Billingconfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Degree;
use App\Upangsho;
use DB;
use App\master_billing,App\Std_bill_type,App\student,App\Std_bill,App\trx_record,App\BankDetails;

class BillingconfigurationController extends Controller
{

    public function index()
    {
        $degrees = Degree::all();
        $menuname = 'Configure Billing';
        return view('billingconfiguration.add_billinginfo', compact('khattypetype','menuname','degrees', 'khattype', 'khats', 'upangshos'));
    }


    public function degree_id(Request $request){

        $degree_id          =  $request->degree_id;

        $degree_name        =   Upangsho::where('degree_id', $degree_id)->get();

        if(count($degree_name)>0) {

            $allsemestername = $degree_name[0]->semester;


            $data = '<div id = "semesterid" style="margin: 2px;"><div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Subject</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15" id="degress"name="sub_id" onchange="subjectid(this.value)" required>';

            $data .= '<option value="">Select Subject </option>';
            foreach ($degree_name as $deg) {

                $data .= '<option value="' . $deg->upangsho_id . '">' . $deg->subject_name . '</option>';
            }


            $data .= '</select></div> <div id="studentId" style="margin-left: 380px;">
                            </div> </div>';
            echo $data;
        }else {

            $data = '<div id="semesterid"><div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Subject</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15" id="sub_id"name="sub_id" onchange="" required>';

            $data .= '<option value="">Select Subject </option>';


            $data .= '</select></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select  Semester</strong></label>
                                        <div class="col-lg-10">
                                            <select class="form-control m-bot15"  name="sub_id" onchange="" required>
        
                                                <option value="">Select Semester </option>';

            $data .= '</select></div>
                             </div></div>';
            echo $data;
        }

    }



        public function criculamupdate(Request $request){

            $deg_id                =         $request->deg_id;
            $student_type          =         $request->student_type;
            $subjectid             =         $request->subjectid;

            $subjectcode = master_billing::where('degree_id', $deg_id)->where('sub_id', $subjectid)->where('std_type', $student_type)->first();

            if($subjectid==17){
                return view('billingconfiguration.bacholer', compact('subjectcode'));

            }
            if($subjectid==21){
                return view('billingconfiguration.bacholer', compact('subjectcode'));

            }
            elseif ($subjectid==18){

                return view('billingconfiguration.master', compact('subjectcode'));
            }
            elseif ($subjectid==19){
                return view('billingconfiguration.diploma', compact( 'subjectcode'));

            }
            elseif ($subjectid==20){
                return view('billingconfiguration.master', compact('subjectcode'));

            }
            else{
                echo "";
            }

        }

        public function  update_masterdetails(Request $request){
            
            $id                         = $request->master_id;
            $nonduereg                  = $request->nonduereg;
            $transcript                 = $request->transcript;
            $examentry                  = $request->examentry;
            $admission                  = $request->admission;
            $library_fee                = $request->library_fee;
            $idcard                     = $request->idcard;
            $libarycosion_money         = $request->libarycosion_money;
            $whole_tuition              = $request->whole_tuition;
            $com_lab_fee                = $request->com_lab_fee;
            $examfee                    = $request->examfee;
            $mignondue                  = $request->mignondue;
            $misc                       = $request->misc;
             $exam_center_fee            = $request->exam_center_fee;
             $session_charge            =   $request->session_charge;




            master_billing::where('id', $id) ->update([
                'idcard'                  => $idcard,
                'nonduereg'               => $nonduereg,
                'library_fee'             => $library_fee,
                'transcript'              =>  $transcript ,
                'examentry'               => $examentry,
                'mignondue'               => $mignondue,
                'admission'               => $admission,
                'whole_tuition'           => $whole_tuition,
                'com_lab_fee'             => $com_lab_fee,
                'examfee'                 => $examfee,
                'misc'                    => $misc,
                'libarycosion_money'      => $libarycosion_money,
                'exam_center_fee'         => $exam_center_fee,
                'session_charge'          =>$session_charge 

            ]);



            return redirect()->back()->with('message', 'Master Billing Update successfully');

        }

        public function view_semester_billing(){
            $degrees = Degree::all();
            $menuname = 'Semester Billing';
            return view('billingconfiguration.add_semesterbilling', compact( 'degrees','menuname'));

        }

        public function store_semester_billing(Request $request){

             $deg_id                             = $request->deg_id;
             $sub_id                             = $request->sub_id;
             $semester                           = $request->semester;
             $sem_year                           = $request->sem_year;

             if(empty($request->student_type)){

                     $student_type=$deg_id;
              }

             $studentbill                      =   master_billing::where('std_type',$student_type )->where('sub_id', $sub_id)->first();
             $mast_id                          =   $studentbill->id;


              $student                         = student::select('students.id as id','students.sub_id as sub_id')
                                                ->join('billingconfigurations','students.id','=','billingconfigurations.std_id')
                                                ->where('students.degree_id', $deg_id)
                                                ->where('students.sub_id', $sub_id)
                                                ->where('billingconfigurations.billing_type', 1)
                                                ->Where('billingconfigurations.billing_type', '!=','5')
                                                ->where('student_type', $student_type)
                                                ->get();

//            if($student->isEmpty())
//            {
//                return redirect('admissiondue')->with('err-message', 'Admission payment was not completed');
//            }

             foreach ( $student as $std) {


                    DB::table('billingconfigurations')
                            ->insert([
                                'sub_id'          => $std->sub_id,
                                'std_id'          => $std->id,
                                'mast_id'         => $mast_id,
                                'billing_type'    => 3,
                                'semester_id'     =>0,
                                'year'             =>date('Y-m-d',strtotime($sem_year)),
                                'excu_date'       => date('Y-m-d'),
                            ]);


               }
             return redirect('admissiondue')->with('message', 'Semester Billing Add Successfully');

        }

        public function createbilltype(){


            $billi_type = Std_bill_type::all();
            $menuname = 'Accounts';
            return view('billingconfiguration.student_bill_type', compact( 'billi_type','menuname'));

        }

        public function storebillltype(Request $request){
            Std_bill_type::create([
                'bill_type_name'=>$request->bill_type_name
            ]);
            return redirect()->back()->with('message', 'Bill Type added Successfully');

        }

        public function createbilltypes(){
            $billi_type = Std_bill_type::all();
            $menuname = 'Accounts';
            return view('billingconfiguration.student_bill', compact( 'billi_type','menuname'));
        }

        public function storebillinfo(Request $request){

            $Std_bill = new Std_bill;
            $Std_bill->billing_details = $request->billing_details;
            $Std_bill->billing_type_id = $request->billing_type_id;
            $Std_bill->amount = $request->amount;
            $Std_bill->bill_type_date = $request->bill_type_date;
            $Std_bill->remark  = $request->remark;

            $Std_bill->save();


            $insertedId=$Std_bill->id;

            $bankdetails= BankDetails::where('bank_details_id', 5)->first();
            $amount=$bankdetails->update_balance + $request->amount;
            BankDetails::where('bank_details_id', 5) ->update([
                'update_balance'       => $amount,
            ]);


            $trx_record = trx_record::create([
                'table_id'                  => 9,
                'table_incrment_id'         => $insertedId,
                'amount_type'               => 1,
                'acount_details_id'         => 5,
                'amount'                    => $request->amount ,
                'trx_date'                  =>  $request->bill_type_date ,
                'pay_type'                  => 3
            ]);

            return redirect()->back()->with('message', 'Student Bill  added Successfully');


        }

}
