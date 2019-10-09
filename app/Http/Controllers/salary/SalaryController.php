<?php

namespace App\Http\Controllers\salary;

use App\employee_leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Salaryprogress; use App\indirect_expense;
use App\Employee,App\trx_record,App\BankDetails; use DateTime; 
use Carbon\Carbon, App\Departments; use DB;

class SalaryController extends Controller{

	public  function index(){

		$menuname = 'PayRoll';
		$dates = Salaryprogress::groupBy('salary_month')->get()->pluck('salary_month')->toArray();
		return view('salaryprogress.add_salaray_progress', compact('menuname', 'dates'));
	}
		
	public  function salarypupdate(){
		
		$employee =  Employee::select('*', 'employees.id')->join('departments','employees.dep_id', '=', 'departments.id')
					 ->join('designations','employees.dig_id', '=', 'designations.id')
					 ->get();
		
		$menuname = 'PayRoll';		 
		return view('salaryprogress.salarypupdate', compact('employee', 'menuname'));
	}
	
	public function update(Request $request){
		echo Employee::salarydetails($request->id);
	}

    public function store(Request $request)
    {

        $date_to=$request['date_to'];
        $echeck_number=$request['echeck_number'];
        switch ($request->input('action')) {

            case 'SaveSalery':

                $data['date_to'] = $date_to;

                $employee = Employee::get();

                $date_all = explode("-", $date_to);
                $year = $date_all[0];
                $month = $date_all[1];
                $salary_month = $year . "-" . $month . "-28";

                $i=0;
                $totalpayinngamount=0; $permanentTotal = 0; $temporaryTotal = 0;
                foreach ($employee as $employee) {


                    $dt = Carbon::parse($date_to);
                    $year=$dt->year;                                         // int(2012)
                    ///$month=$dt->month;                                        // int(10)
                    $number=$dt->daysInMonth;                                        // int(10)

                    $absendsalery = 0;
                    $absent = employee_leave::where('employee_id', $employee->id)->where('status', 1)->where('not_pay', 2)->get();


                    if(count($absent)>0) {
                        foreach ($absent as $abs) {

                            $datetime1 = new DateTime($abs->not_pay_from_date);
                            $datetime2 = new DateTime($abs->not_pay_to_date);

                            $from_not_pay_date = explode("-", $abs->not_pay_from_date);
                            $year1 = $date_all[0];
                            $month1 = $date_all[1];

                            $to_not_pay_date = explode("-", $abs->not_pay_to_date);
                            $year2 = $date_all[0];
                            $month2 = $date_all[1];



                            if (($month == $month1) && ($month == $month2) && ($year == $year1) && ($year == $year2)) {
                                $diff = date_diff($datetime2, $datetime1);

                                $absendsalery = $diff->days + 1;
                                $pardaysalery = $employee->gross_salary / $number;

                                $absendsalery = round($pardaysalery * $absendsalery);


                                employee_leave::where('employee_id', $employee->id)->where('status', 1)
                                    ->update([
                                        'abs_duduct_amount' => $absendsalery,
                                        'status' => 2,
                                    ]);


                            }
                        }
                    }
                    
                    $i++;
                    $bsce_contri = round($employee->gross_salary * 10 / 100);
                    $total_deducyt = $absendsalery + $employee->lninstall + $employee->incometax + 2 * $bsce_contri;

                    Salaryprogress::create([
                        
                        'emp_id'            => $employee->id,
                        'deg_id'            => $employee->dig_id, 
                        'gross_salary'      =>$employee->gross_salary,
                        'salary_deduct'     =>$total_deducyt,
                        'salary_month'      =>$salary_month,
                        'abs_duduct_amount' =>$absendsalery,
                        'empl_contri'       =>$bsce_contri,
                        'process_date'      =>date('Y-m-d H:i:s'),
                        'hrent'     	    => $employee->hrent,
                        'medcal'       	    => $employee->medcal,
                        'convence'         => $employee->convence,
                        'allownce'         => $employee->allownce,
                        'lninstall'        => $employee->lninstall,
                        'incometax'        => $employee->incometax,
                        'bsce_contri'      => $bsce_contri,
                        'echeck_number'    => $request->echeck_number
                    ]);

                    $id = DB::getPdo()->lastInsertId();
                    $dep = Salaryprogress::where('id', $id)->get();

                    foreach ($dep as $dep) {

                        $total1 = $dep->gross_salary + $dep->hrent + $dep->medcal + $dep->convence + $dep->allownce + $dep->bsce_contri;
                        $totaldeduction = (int)$dep->bsce_contri + (int)$dep->empl_contri + (int)$dep->lninstall + (int)$dep->incometax + (int)$dep->abs_duduct_amount;

                        $netpay = $total1 - $totaldeduction;
                        $totalpayinngamount += $netpay;

                        $trx_record = trx_record::create([
                            
                            'table_id' => 1,
                            'table_incrment_id' => $id,
                            'amount_type' => 2,
                            'branchid' => 37,
                            'acount_details_id' => 2,
                            'amount' => $netpay,
                            'trx_date' => date('Y-m-d H:i:s'),
                            'pay_type' => 1,
                            'salary_month' => $salary_month
                        ]);
                        
                        $empType = Employee::where('id', $employee->id)->first()->emp_type;
                        if($empType == 1){
                            
                            $permanentTotal += $netpay;
                        }else{
                            
                            $temporaryTotal += $netpay;
                        }
                    }
                }
                
                if($permanentTotal != 0){
                    
                    indirect_expense::create([
        				
        				'exp_cat' => 1,
        				'exp_type' => 1,
        				'pay_type' => 1,
        				'voucher' => $request->echeck_number,
        				'bank_id' => 38,
        				'branch_id' => 37,
        				'accountid' => 2,
        				'amount' => $permanentTotal,
        				'note' => 'Salary & Allowances ( Faculty )',
        				'paydate' => Carbon::now(),
        				'date' => Carbon::now()
                    ]);
                    
                }if($temporaryTotal != 0){
                    
                    indirect_expense::create([
        				
        				'exp_cat' => 1,
        				'exp_type' => 2,
        				'pay_type' => 1,
        				'voucher' => $request->echeck_number,
        				'bank_id' => 38,
        				'branch_id' => 37,
        				'accountid' => 2,
        				'amount' => $temporaryTotal,
        				'note' => 'Salary & Allowances ( Guest )',
        				'paydate' => Carbon::now(),
        				'date' => Carbon::now()
                    ]);
                    
                }
                
                //; $temporaryTotal = 0;
                $pay_amount = $totalpayinngamount;

                $bankdetails= BankDetails::where('bank_details_id', 2)->first();

                $amount=$bankdetails->update_balance - $pay_amount;
                BankDetails::where('bank_details_id', 2) ->update([
                    'update_balance'       => $amount,
                ]);


                return redirect()->back()->with('message', ' Salary Add Success');

                break;

            case 'progress':
                
                $menuname = 'PayRoll';
                $data['date_to'] = $date_to;

                $employee = Employee::join('departments','employees.dep_id', '=', 'departments.id')
                    ->join('designations','employees.dig_id', '=', 'designations.id')
                    ->get();
                $dates=Salaryprogress::all(['salary_month'])->toArray();
                return view('salaryprogress.salaryProgress', compact('menuname','submenu', 'employee', 'taxTypes', 'dates','date_to','echeck_number'));
                break;
        }
    }
	
	
	
	 public function updatesalary(Request $request){

		$emp =  Employee::find($request->eid);
             
        $emp->gross_salary	= $request->salary;
        $emp->hrent      	= $request->houserent;
        $emp->medcal       	= $request->treatment;
        $emp->convence      = $request->tifin;
        $emp->allownce      = $request->wash;        
        $emp->lninstall     = $request->mobile;
        $emp->incometax     = $request->tranport;        
        $emp->save();    
		
        return redirect()->back()->with('message', 'Update Successful');
		
	}
	
	
	public  function salaryreport(){

		$menuname = 'Report';
		$dates = Salaryprogress::groupBy('salary_month')->get()->pluck('salary_month')->toArray();


		return view('salaryprogress.salaray_report', compact('dates', 'menuname'));
	}
	
	 public function salaryreportdetails(Request $request){
		 
		 if($request->action=='delete'){

             $pay_amount= trx_record::where('salary_month', $request->dateto)->sum('amount');
             $bankdetails= BankDetails::where('bank_details_id', 2)->first();

             $amount=$bankdetails->update_balance + $pay_amount;
             BankDetails::where('bank_details_id', 2) ->update([
                 'update_balance'       => $amount,
             ]);

             Salaryprogress::where('salary_month', $request->dateto)->delete();
              trx_record::where('salary_month', $request->dateto)->delete();


         }
		  
		 $menuname = 'PayRoll';
		 $dateto = $request->dateto;
		 $dates = Salaryprogress::groupBy('salary_month')->get()->pluck('salary_month')->toArray();
		 
		 $allsalary = Salaryprogress::select('*', 'salaryprogresses.gross_salary', 'salaryprogresses.hrent', 'salaryprogresses.medcal', 'salaryprogresses.convence', 'salaryprogresses.allownce', 'salaryprogresses.lninstall', 'salaryprogresses.incometax', 'salaryprogresses.bsce_contri', 'salaryprogresses.empl_contri','salaryprogresses.abs_duduct_amount')
		 ->Leftjoin('employees', 'employees.id', '=', 'salaryprogresses.emp_id')
		 ->Leftjoin('departments','employees.dep_id', '=', 'departments.id')
		 ->Leftjoin('designations','employees.dig_id', '=', 'designations.id')
		 ->where('salaryprogresses.salary_month', $request->dateto)->get();			 
		  		 
		 return view('salaryprogress.salaray_report', compact('allsalary', 'menuname', 'dates', 'dateto'));
	 }

	 public function employesalaryshet(){

         $menuname = 'PayRoll';
         $departments = Departments::all();
         $dates = Salaryprogress::groupBy('salary_month')->get()->pluck('salary_month')->toArray();
         return view('salaryprogress.salarysheet_show', compact('menuname', 'dates','departments'));
     }

     public function processsalaryshet(Request $request){

         $menuname = 'PayRoll';
         $dateto = $request->dateto;
         $dates = Salaryprogress::groupBy('salary_month')->get()->pluck('salary_month')->toArray();
         $dep_id    = $request->dep_id;
         $departments = Departments::all();
         $allsalary = Salaryprogress::select('*', 'salaryprogresses.gross_salary', 'salaryprogresses.hrent', 'salaryprogresses.medcal', 'salaryprogresses.convence', 'salaryprogresses.allownce', 'salaryprogresses.lninstall', 'salaryprogresses.incometax', 'salaryprogresses.bsce_contri', 'salaryprogresses.empl_contri','salaryprogresses.abs_duduct_amount')
             ->Leftjoin('employees', 'employees.id', '=', 'salaryprogresses.emp_id')
             ->Leftjoin('departments','employees.dep_id', '=', 'departments.id')
             ->Leftjoin('designations','employees.dig_id', '=', 'designations.id')
             ->where('salaryprogresses.salary_month', $dateto)
             ->where('departments.id', $dep_id )
             ->get();
         return view('salaryprogress.salary_sheet_report_process', compact('dates', 'menuname','departments','allsalary','dateto','dep_id'));
     }

    public function SalaryOrderbank(){

        $menuname = 'PayRoll';
        $dates = Salaryprogress::groupBy('salary_month')->get()->pluck('salary_month')->toArray();
        return view('salaryprogress.salaryorderbankmonthwise', compact('menuname', 'dates'));
    }

    public function processsbankoredr(Request $request){

        $menuname = 'PayRoll';
        $dateto = $request->dateto;
        $dates = Salaryprogress::groupBy('salary_month')->get()->pluck('salary_month')->toArray();

//        $total          = +(int) $dep->medcal+ (int)$dep->convence+$dep->allownce + (int)$dep->bsce_contri;
//        $totaldeduction = + (int)$dep->lninstall + (int)$dep->incometax + (int)$dep->abs_duduct_amount;
//
//
//        $netpay         =  $total - $totaldeduction;
//        $netpaytotal    += $netpay;



//        $allsalary = Salaryprogress::select('*', 'salaryprogresses.gross_salary', 'salaryprogresses.hrent', 'salaryprogresses.medcal', 'salaryprogresses.convence', 'salaryprogresses.allownce', 'salaryprogresses.lninstall', 'salaryprogresses.incometax', 'salaryprogresses.bsce_contri', 'salaryprogresses.empl_contri','salaryprogresses.abs_duduct_amount')
        $allsalary = Salaryprogress::select('departments.department_name', 'salaryprogresses.echeck_number',DB::raw('sum((salaryprogresses.gross_salary +salaryprogresses.hrent + salaryprogresses.medcal + salaryprogresses.convence + salaryprogresses.allownce  ) -(salaryprogresses.empl_contri + salaryprogresses.lninstall + salaryprogresses.incometax + salaryprogresses.abs_duduct_amount )) as salary'))
            ->Leftjoin('employees', 'employees.id', '=', 'salaryprogresses.emp_id')
            ->Leftjoin('departments','employees.dep_id', '=', 'departments.id')
            ->Leftjoin('designations','employees.dig_id', '=', 'designations.id')
            ->where('salaryprogresses.salary_month', $dateto)
            ->groupBy('departments.id')
            ->get();


        $bankdetail   =BankDetails::where('bank_details_id',2)->first();
        $departments  = Departments::all();


        return view('salaryprogress.slarayprocessmonwise_porcess', compact('dates', 'menuname','departments','allsalary','dateto','dep_id','bankdetail'));
    }
}