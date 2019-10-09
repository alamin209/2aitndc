<?php

namespace App\Http\Controllers\employee;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Departments;
use App\employee_leave;
use App\Designations;
use App\Bank;
use App\loan_type;
use App\Employeloan;
use DB;
use App\Degree;
use App\AdjunicTeacher;
use App\Salaryprogress,App\BankDetails,App\trx_record;

class EmployeeController extends Controller
{

    public function index()
    {
        $employee              =   Employee::select('*','employees.id')->join('departments','employees.dep_id', '=', 'departments.id')
                                     ->join('designations','employees.dig_id', '=', 'designations.id')
                                     ->get();
        $menuname              =    'HR Module';

        return view('employee.employee', compact('menuname','employee', 'upangshos'));
    }


	public function getemployee(Request $request){


		echo Employee::details($request->id);
	}

	public function updateemployee(Request $request){

		$employ = Employee::find($request->eid);
		$path = 'public/admin/employee/' . $request->uid;

		if (request()->hasFile('sign_upload')) {
            $file      = $request->file('sign_upload');
            $fileName  = $file->getClientOriginalName();
            $file->move($path, $fileName);
			$employ->sign_upload = $fileName;
        }

        if (request()->hasFile('photo')) {
            $file       = $request->file('photo');
            $fileName1  = $file->getClientOriginalName() ;
            $file->move($path, $fileName1);

            $employ->photo_upload =  $fileName1;
        }



		$employ->dep_id =  $request->dept;
		$employ->dig_id =  $request->desig;
		$employ->emp_id =  $request->employe_id;
		$employ->add_full_name =  $request->name;
		$employ->update_user_id =  Auth()->id();
		$employ->reporting_to =  $request->reporting_to;
		$employ->add_mobile =  $request->add_mobile;
		$employ->emp_type =  $request->emp_type;
		$employ->gender =  $request->gender;
		$employ->marital_status =  $request->marital;
		$employ->appointed_date =  $request->appointed_date;
		$employ->joining_date = $request->joindate;
		$employ->father_name = $request->fname;
		$employ->mother_name = $request->mname;
		$employ->add_religin = $request->add_religin;
		$employ->date_birth = $request->date_birth;
		$employ->emrgemcy_contact = $request->emrgemcy_contact;
		$employ->permenet_address = $request->permenet_address;
		$employ->present_address = $request->present_address;
		$employ->add_email = $request->add_email;


		$employ->save();

		return redirect()->back()->with('message', 'Employee Update Success.');
	}

    public function createloantype(){


        $menuname             =    'HR Module';
        $loan                 =    loan_type::select('id','loan_name')->get();
        return view('employee.add_loan_type', compact('menuname','employee', 'loan','bank'));

    }

    public function createloan()
    {
//      $employee             =  Employee::select('id','add_full_name')->get();
        $department           =  Departments::select('id','department_name')->get();
        $bank                 =    Bank::select('bank_id','bank_name')->get();
        $loan                 =    loan_type::select('id','loan_name')->get();
        $menuname             =    'HR Module';
        return view('employee.employeeloan', compact('loan', 'menuname','employee', 'department','bank'));

    }


    public function getemployeeleave(){

        $menuname           =    'HR Module';
        return view('employee.add_employee_leave', compact('menuname','employee', 'upangshos'));
    }

    public function employeewith_id(Request $request){

        $emp_id=$request->emp_id;

        $employ=Employee::where('emp_id',$emp_id)
        ->join('departments','employees.dep_id', '=', 'departments.id')
        ->join('designations','employees.dig_id', '=', 'designations.id')
        ->select('designations.degin_name as degin_name','employees.id as id','emp_id','add_full_name','joining_date','add_email','add_mobile','departments.department_name as department_name')->get();

        if (count($employ) > 0):

            echo json_encode($employ);
        else:

            echo "not matched";
        endif;
    }

    public function employleavestore(Request $request){

        employee_leave::create([

            'leave_type'                    =>  $request['leave_type'],
            'from_date'                     =>  $request['from_date'],
            'to_date'                       =>  $request['to_date'],
            'pay'                           =>  $request['pay'],
            'not_pay'                       =>  $request['not_pay'],
            'not_pay_from_date'             =>  $request['not_pay_from_date'],
            'not_pay_to_date'               =>  $request['not_pay_to_date'],
            'employee_id'                   =>  $request['employ_id'],
            'reason'                        =>  $request['remark'],
            'user_id'                       =>  Auth()->id(),
           // 'update_by'                     =>  $request['remark'],
            'inco_cat'                     => 6,
            'inco_type'                    => 7,
            'date'                         =>  date('Y-m-d'),

        ]);

        return redirect()->back()->with('message', ' Leave  Add   Success');

    }

        public function get_employe_id(Request $request){

            $employeid =$request->employeid;
            $designation          =  Employee::where('dig_id',$employeid)->select('id','add_full_name')->get();
            $data                 =   '<option value="">Select Employee</option>';

            foreach( $designation  as $tp){
                $data .= '<option value="'.$tp->id.'">'.$tp->add_full_name.'</option>';
            }
            echo $data;
        }

        public function storeloantype(Request $request){

            loan_type::create([
                'loan_name'        =>  $request['loan_name']

            ]);

            return redirect()->back()->with('message', 'Loan Type  Add   Success');
        }


        public function storeloan(Request $request){

             $employ_id         =       $request->employ_id;


             $loan              =       new Employeloan;
             $loan->dep_id      =       $request->dep_id;
             $loan->desig_id    =       $request->desig_id;
             $loan->employ_id   =       $employ_id;
             $loan->amount      =       $request->amount;
             $loan->branch_id   =       $request->branch_id;
             $loan->bankact     =       $request->bankact;
             $loan->loan_type   =      $request->loan_type;
             $loan->mon_inst    =       $request->mon_inst;
             $loan->mon_inst    =       $request->mon_inst;
             $loan->loan_date   =      $request->loan_date;
             $loan->save();


             $insertedId=$loan->id;

             Salaryprogress::where('emp_id',$employ_id)
             ->update(['lninstall' => $request->amount ]);


             $updateinstalment  =      Employee::find($employ_id);
             $updateinstalment->lninstall = $request->mon_inst;
             $updateinstalment->repay = $request->amount ;
             $updateinstalment->save();


             $bankdetails= BankDetails::where('bank_details_id', $request->bankact)->first();
             $amount=$bankdetails->update_balance - $request->amount;
             BankDetails::where('bank_details_id', $request->bankact) ->update([
                 'update_balance'       => $amount,
             ]);


             $trx_record = trx_record::create([
                 'table_id'                  => 8,
                 'table_incrment_id'         => $insertedId,
                 'amount_type'               => 2,
                 'branchid'                  => $request->branch_id,
                 'acount_details_id'         => $request->bankact,
                 'amount'                    => $request->amount ,
                 'trx_date'                  =>  $request->loan_date ,
                 'pay_type'                  => 1
             ]);




             return redirect()->back()->with('message', ' Loan  Add   Success');
         }
         public function employee_activity(Request $request){


             $employee              =   Employee::select('*','employees.id')->where('emp_type',1)->join('departments','employees.dep_id', '=', 'departments.id')
                 ->join('designations','employees.dig_id', '=', 'designations.id')
                 ->get();
             $menuname              =    'HR Module';

             return view('employee.employee_activity', compact('menuname','employee', 'upangshos'));

         }

         public function employee_activity_with_id(Request $request){
           $id=$request->id;
             $employee = Employee::select('*', 'employees.id')->join('departments','employees.dep_id', '=', 'departments.id')
                             ->join('designations','employees.dig_id', '=', 'designations.id')
                             ->where('employees.id', $id)
                             ->first();

           return view('employee.employ_activitydetails', compact('menuname','employee', 'upangshos'));

         }


    public function getemployeedetails(Request $request){


        echo Employee::detailforshow($request->id);
    }

        public function temporaray_teacher_list(){

             $menuname              =    'HR Module';
             $employee              =   Employee::select('*','employees.id')->join('departments','employees.dep_id', '=', 'departments.id')
                                     ->join('designations','employees.dig_id', '=', 'designations.id')
                                     ->where('employees.emp_type','0')
                                     ->get();

             return view('employee.temporary_employee', compact('menuname','employee', 'upangshos'));

         }

         public function assigned_teacher(Request $request){


             $menuname           =    'HR Module';
            $id=$request->id;
             $degrees = Degree::all();
             $employee = Employee::select('*', 'employees.id')
                      ->join('departments','employees.dep_id', '=', 'departments.id')
                     ->join('designations','employees.dig_id', '=', 'designations.id')
                     ->where('employees.id', $id)
                     ->where('employees.emp_type', 0)
                     ->first();

             return view('employee.temporary_employee_payment', compact('menuname','employee', 'upangshos','degrees'));

         }

         public function store_assign_teacher(Request $request){

             AdjunicTeacher::create($request->all());

             return redirect()->back()->with('message', ' Payment Add Succssfully  Success');

         }

         public function update_adject_details(Request $request ){

             $id                = $request->id;
             $degrees          = Degree::all();
             $all_detail        = AdjunicTeacher::select('*','adjunic_teachers.id')
                                    ->where('adjunic_teachers.id',$id)
                                   ->leftJoin('employees', 'adjunic_teachers.emp_id','=','employees.id')
                                     ->join('departments','employees.dep_id', '=', 'departments.id')
                                     ->join('designations','employees.dig_id', '=', 'designations.id')
                                    ->LeftJoin('degrees','adjunic_teachers.degree_id','degrees.id')
                                   ->LeftJoin('courses','adjunic_teachers.course_id','courses.id')
                                   ->LeftJoin('upangshos','adjunic_teachers.sub_id','upangshos.upangsho_id')
                                   ->first();

            return view('employee.temporary_employee_payment_update', compact('menuname','all_detail','degrees'));

         }

    public function temporaray_teacher_list_payment(){

        $menuname              =    'HR Module';
        $employee              =   AdjunicTeacher::select('*','adjunic_teachers.id','degrees.subject_name as subject_names','upangshos.subject_name as subject_name')
                                    ->join('employees','adjunic_teachers.emp_id', '=', 'employees.id')
                                    ->join('departments','employees.dep_id', '=', 'departments.id')
                                    ->LeftJoin('upangshos','adjunic_teachers.sub_id','upangshos.upangsho_id')
                                    ->LeftJoin('degrees','adjunic_teachers.degree_id','degrees.id')
                                     ->join('courses','adjunic_teachers.course_id', '=', 'courses.id')
                                    ->where('employees.emp_type','0')
                                    ->get();

        return view('employee.temporary_employee_payment_details', compact('menuname','employee', 'upangshos'));

    }

    public function update_assigned_teacher(Request $request,$id){

        $update_assigned_techher=AdjunicTeacher::find($id);

        $update_assigned_techher->degree_id =$request->degree_id;
        $update_assigned_techher->sub_id =$request->sub_id;
        $update_assigned_techher->sem_id =$request->sem_id;
        $update_assigned_techher->batch_id =$request->batch_id;
        $update_assigned_techher->session_id =$request->session_id;
        $update_assigned_techher->current_position =$request->current_position;
        $update_assigned_techher->lecture_no =$request->lecture_no;
        $update_assigned_techher->lecture_duration =$request->lecture_duration;
        $update_assigned_techher->total_payment =$request->total_payment;
        $update_assigned_techher->course_id =$request->course_id;
       $update_assigned_techher->save();
        return redirect()->back()->with('message', ' Payment Add Succssfully  Update');
    }


    public function payment_adjunct_teacher(Request $request,$id){
        $menuname              =    'HR Module';

        $empl                   =   AdjunicTeacher::select('*','adjunic_teachers.id','degrees.subject_name as subject_names','upangshos.subject_name as subject_name')
                                ->join('employees','adjunic_teachers.emp_id', '=', 'employees.id')
                                ->join('departments','employees.dep_id', '=', 'departments.id')
                                ->LeftJoin('upangshos','adjunic_teachers.sub_id','upangshos.upangsho_id')
                                ->LeftJoin('degrees','adjunic_teachers.degree_id','degrees.id')
                                ->join('courses','adjunic_teachers.course_id', '=', 'courses.id')
                                ->where('adjunic_teachers.id',$id)
                                ->first();


        return view('employee.temporary_employee_payment_details_print', compact('menuname','empl', 'upangshos'));

    }

    public function employee_report_leave_management(Request $request){
        $menuname              =    'HR Module';
        $employee                   =   employee_leave::select('*','employees.id as employed_id','employee_leaves.id',\DB::raw('sum(DATEDIFF( not_pay_to_date,not_pay_from_date )) +1 as not_pay,sum(DATEDIFF( to_date,from_date ) +1) as pay_date'))
                                        ->join('employees','employee_leaves.employee_id', '=', 'employees.id')
                                        ->join('departments','employees.dep_id', '=', 'departments.id')
                                        ->groupBy('employee_leaves.employee_id')
                                        ->get();

        return view('employee.employee_leave_list', compact('menuname','employee', 'upangshos'));

    }

    public function employee_leave_management(){
        $menuname              =    'HR Module';
        $employee                   =   employee_leave::select('*','employees.id as employed_id','employee_leaves.id',\DB::raw('DATEDIFF( not_pay_to_date,not_pay_from_date ) +1 as not_pay,DATEDIFF( to_date,from_date ) +1 as pay_date'))
            ->join('employees','employee_leaves.employee_id', '=', 'employees.id')
            ->join('departments','employees.dep_id', '=', 'departments.id')
            //->groupBy('employee_leaves.employee_id')
            ->get();

        return view('employee.employee_leave_lmanagement', compact('menuname','employee', 'upangshos'));

    }
    public function employeleavereportprint(Request $request ,$id){



        return view('employee.leave_print', compact('menuname','employee', 'upangshos'));

    }

    public function edit_employee_leave(Request $request){

               $id    = $request->id;

//            $employe_leave=employee_leave::select('*','employee_leaves.id as id')
//                            ->join('employees','employee_leaves.employee_id', '=', 'employees.id')
//                            ->join('departments','employees.dep_id', '=', 'departments.id')
//                            ->where('employee_leaves.id',$id)
//                            ->first();
//
//            echo $employe_leave;


    }




}
