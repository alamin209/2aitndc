<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'rol_id','add_full_name','emp_id','date_birth','dep_id','dig_id','emp_type','gross_salary','user_id',
        'appointed_date','joining_date','marital_status','add_mobile','father_name','mother_name','login_user_id','update_user_id',
        'emrgemcy_contact','sign_upload','photo_upload','present_address','permenet_address','add_email','add_religin',
        'cv_upload','reporting_to','gender','amount','abs_duduct_amount','account_no','probition_confor_date','probition_date'
    ];
    public static function salarydetails($id){


        $employee = Employee::select('*', 'employees.id')->join('departments','employees.dep_id', '=', 'departments.id')
            ->join('designations','employees.dig_id', '=', 'designations.id')
            ->where('employees.id', $id)
            ->first();



        $data = '<form role="form" class="form-horizontal" method="post" action="'.url('/').'/updatesalary">
            '. csrf_field() .'
            <input type="hidden" name="eid" value="'.$employee->id.'">
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Department</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" value="'. $employee->department_name .'" disabled>
                </div>
            </div>
			
			<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Designation</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="check_no" name="name" required value="'. $employee->degin_name .'" disabled>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Name</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="check_no" name="name" required value="'. $employee->add_full_name .'" disabled>
                </div>
            </div>			
			
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Basic Salary</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="vourcher_no" name="salary" required value="'. $employee->gross_salary .'">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>House Rent</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="check_no" name="houserent" required value="'. $employee->hrent .'">
                </div>
            </div>

            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Medical </strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control"  id="check_no" name="treatment" required value="'. $employee->medcal .'">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Conveyance</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="check_no" name="tifin" value="'. $employee->convence .'">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Allowances</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="check_no" name="wash" value="'. $employee->allownce .'">
                </div>
            </div> 

			<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Income TAX</strong></label> 
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="receive_date" name="tranport" required value="'. $employee->incometax .'">
                </div>
            </div>
                        
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Loan Install</strong></label> 
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="receive_date" name="mobile" required value="'. $employee->lninstall .'">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-lg-12">
                    <button class="btn btn-success pull-right" type="submit">Submit</button>
                </div>
            </div>
        </form>';

        return $data;
    }
	
	
	public static function details($id){


        $employee = Employee::where('id', $id)->first();


        $upangshos = Departments::get();
         
        $designations = Designations::all();


        $data = '<form role="form" class="form-horizontal" method="post" action="'.url('/').'/updateemployee" enctype="multipart/form-data">'. csrf_field() .'
		  
		    <input type="hidden" name="eid" value="'.$employee->id.'">
		    <input type="hidden" name="uid" value="'.$employee->user_id.'">
            
            <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Department </strong></label>
				<div class="col-lg-10">
					<select class="form-control m-bot15" id="upangsho_id" name="dept"  onchange="getkhattype(this.value)" required>
						<option value="">Select Department</option>';
							foreach($upangshos as $d){
								if($employee->dep_id == $d->id) {
									$data .= '<option';
									$data .= ' selected ';
									$data .= '<option selected="selected" value="' . $d->id. '">' .  $d->department_name. '</option>';

								}else{
									$data .= '<option value="' . $d->id. '">' .  $d->department_name. '</option>';

								}
							}
					$data .= '</select>
				</div>
            </div> 
			
            <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Designation</strong></label>
				<div class="col-lg-10">
					<select class="form-control m-bot15" id="khattype_id" name="desig" required>

						<option value="">Select Designation</option>';

						foreach($designations as $d) {
							if($employee->dig_id==$d->id) {
								$data .= '<option';
								$data .= ' selected ';
								$data .= 'value="' . $d->id . '">' . $d->degin_name . '</option>';
							}else{
								
								$data .= '<option value="' . $d->id. '">' .  $d->degin_name. '</option>';
							}
						}
					$data .= '</select>
				</div>
			</div>
			
			<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Employ ID</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="employe_id" value="'. $employee->emp_id .'" >
                </div>
            </div>
			
			<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Full Name</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="" id="check_no" name="name" required value="'. $employee->add_full_name .'">
                </div>
            </div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Employee Type</strong></label>
				<div class="col-lg-10">
					<select class="form-control" id="" name="emp_type" required>
						<option value="">Employee Type</option>

						<option'; if($employee->emp_type==1) { $data .= ' selected'; } $data .= ' value="1">Permanent</option>
						<option'; if($employee->emp_type==0) { $data .= ' selected'; } $data .= ' value="0">Temporary</option>

					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Reporting To</strong></label>
				<div class="col-lg-10">
					<input type="text" class="form-control " placeholder="Enter Reporting Date" id="reporting_to"  name="reporting_to" value="'. $employee->reporting_to .'">
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Mobile Number</strong> </label>
				<div class="col-lg-10">
					<input type="text" class="form-control" placeholder="Enter Mobile Number" id="add_mobile" name="add_mobile" maxlength="11" value="'. $employee->add_mobile .'">
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Gender</strong></label>
				<div class="col-lg-10">
					<select class="form-control" id="Marital Status" name="gender" required>  
						<option value="">Select Gender</option>
						<option'; if($employee->gender==1) { $data .= ' selected'; } $data .= ' value="1">Male</option>
						<option'; if($employee->gender==0) { $data .= ' selected'; } $data .= ' value="0">Female</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Marital</strong></label>
				<div class="col-lg-10">
					<select class="form-control m-bot15" id="" name="marital" required>

						<option value="">Marital Status</option>
						<option'; if($employee->marital_status==1) { $data .= ' selected'; } $data .= ' value="1">Single</option>
                        <option'; if($employee->marital_status==0) { $data .= ' selected'; } $data .= ' value="0">Married</option>
					</select>
				</div>
			</div>  

			 <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Appointed Date</strong></label>
				<div class="col-lg-10">
					<input type="date" class="form-control datepickerpading" placeholder="" id=""  name="appointed_date"  value="'. $employee->appointed_date .'">
				</div>
			</div>
			
			<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Joining Date</strong></label> 
                <div class="col-lg-10">
                    <input type="date" class="form-control" id="receive_date" name="joindate" value="'. $employee->joining_date .'">
                </div>
            </div>
            
            
			
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Father Name</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="" id="check_no" name="fname" required value="'. $employee->father_name .'">
                </div>
            </div>
			
             <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Mother Name</strong></label>
				<div class="col-lg-10">
					<input type="text" class="form-control" placeholder="" id="check_no" name="mname" required value="'. $employee->mother_name .'">
				</div>
			</div>    

            <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Religion</strong></label>
				<div class="col-lg-10">
					<input type="text" class="form-control" placeholder="" id="check_no" name="add_religin" required value="'. $employee->add_religin .'">
				</div>
			</div>            
           
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Date Of Birth</strong></label> 
                <div class="col-lg-10">
                    <input type="date" class="form-control" id="receive_date" name="date_birth" required value="'. $employee->date_birth .'">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Emergncy Number</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="" id="" name="emrgemcy_contact"  required value="'. $employee->emrgemcy_contact .'">
                </div>
            </div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Present Address</strong></label>
				<div class="col-lg-10">
					<textarea class="form-control" placeholder="" id="" name="present_address">'. $employee->present_address .'</textarea>
				</div>
			</div>
			
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Permanent Address</strong></label>
				<div class="col-lg-10">
					<textarea class="form-control" placeholder="" id="" name="permenet_address">'. $employee->permenet_address .'</textarea>
				</div>
			</div>          
           
			
            <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Email</strong></label>
				<div class="col-lg-10">
					<input type="email" class="form-control" placeholder="Enter Email" id="add_email" name="add_email" value="'. $employee->add_email .'">
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Signature Upload</strong></label>
				<div class="col-lg-10">
					<img src="'.url('/').'/public/admin/employee/'.$employee->user_id.'/'. $employee->sign_upload .'" width="120">
					<input type="file" class="form-control" placeholder="Enter" id=""  name="sign_upload">
				</div>
			</div>
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Photo</strong></label> 
                <div class="col-lg-10">
                    <img src="'.url('/').'/public/admin/employee/'.$employee->user_id.'/'. $employee->photo_upload .'" width="120">
                    <input type="file" class="form-control"  id="receive_date" name="photo" value="">
                </div>
            </div>
			
            <div class="form-group">
                <div class="col-lg-12">
                    <button class="btn btn-success pull-right" type="submit">Submit</button>
                </div>
            </div>
			
        </form>';

        return $data;
    }
    public static function detailforshow($id){


        $employee = Employee::where('id', $id)->first();


        $upangshos = Departments::get();

        $designations = Designations::all();


        $data = '<form role="form" class="form-horizontal" method="post" action="'.url('/').'/updateemployee" enctype="multipart/form-data">'. csrf_field() .'
		  
		    <input type="hidden" name="eid" value="'.$employee->id.'">
		    <input type="hidden" name="uid" value="'.$employee->user_id.'">
            
            <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Department </strong></label>
				<div class="col-lg-10">
					<select class="form-control m-bot15" id="upangsho_id" name="dept"  readonly=""  disabled onchange="getkhattype(this.value)" required>
						<option value="">Select Department</option>';
							foreach($upangshos as $d){
								if($employee->dep_id == $d->id) {
									$data .= '<option';
									$data .= ' selected ';
									$data .= '<option selected="selected" value="' . $d->id. '">' .  $d->department_name. '</option>';

								}else{
									$data .= '<option value="' . $d->id. '">' .  $d->department_name. '</option>';

								}
							}
					$data .= '</select>
				</div>
            </div> 
			
            <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Designation</strong></label>
				<div class="col-lg-10">
					<select class="form-control m-bot15" id="khattype_id" readonly="" disabled name="desig" required>

						<option value="">Select Designation</option>';

						foreach($designations as $d) {
							if($employee->dig_id==$d->id) {
								$data .= '<option';
								$data .= ' selected ';
								$data .= 'value="' . $d->id . '">' . $d->degin_name . '</option>';
							}else{

								$data .= '<option value="' . $d->id. '">' .  $d->degin_name. '</option>';
							}
						}
					$data .= '</select>
				</div>
			</div>
			
			<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Full Name</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control"  readonly disabled placeholder="" id="check_no" name="name" required value="'. $employee->add_full_name .'">
                </div>
            </div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Employee Type</strong></label>
				<div class="col-lg-10">
					<select class="form-control" id="" name="emp_type" readonly=" "  disabled required>
						<option value="">Employee Type</option>

						<option'; if($employee->emp_type==1) { $data .= ' selected'; } $data .= ' value="1">Permanent</option>
						<option'; if($employee->emp_type==0) { $data .= ' selected'; } $data .= ' value="0">Temporary</option>

					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Reporting To</strong></label>
				<div class="col-lg-10">
					<input type="text" class="form-control " readonly disabled placeholder="Enter Reporting Date" id="reporting_to"  name="reporting_to" value="'. $employee->reporting_to .'">
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Mobile Number</strong> </label>
				<div class="col-lg-10">
					<input type="text" class="form-control" placeholder="Enter Mobile Number" readonly disabled id="add_mobile" name="add_mobile" maxlength="11" value="'. $employee->add_mobile .'">
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Gender</strong></label>
				<div class="col-lg-10">
					<select class="form-control" id="Marital Status" name="gender" readonly="" disabled required>  
						<option value="">Select Gender</option>
						<option'; if($employee->gender==1) { $data .= ' selected'; } $data .= ' value="1">Male</option>
						<option'; if($employee->gender==0) { $data .= ' selected'; } $data .= ' value="0">Female</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Marital</strong></label>
				<div class="col-lg-10">
					<select class="form-control m-bot15" id="" name="marital"  readonly="" disabled required>

						<option value="">Marital Status</option>
						<option'; if($employee->marital_status==1) { $data .= ' selected'; } $data .= ' value="1">Single</option>
                        <option'; if($employee->marital_status==0) { $data .= ' selected'; } $data .= ' value="0">Married</option>
					</select>
				</div>
			</div>  

			 <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Appointed Date</strong></label>
				<div class="col-lg-10">
					<input type="date" class="form-control datepickerpading" placeholder="" id=""  readonly disabled name="appointed_date"  value="'. $employee->appointed_date .'">
				</div>
			</div>
			
			<div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Joining Date</strong></label> 
                <div class="col-lg-10">
                    <input type="date" class="form-control" id="receive_date" name="joindate"  readonly disabled value="'. $employee->joining_date .'">
                </div>
            </div>
            
            
			
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Father Name</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="" id="check_no" readonly disabled name="fname" required value="'. $employee->father_name .'">
                </div>
            </div>
			
             <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Mother Name</strong></label>
				<div class="col-lg-10">
					<input type="text" class="form-control" placeholder="" id="check_no" readonly disabled name="mname" required value="'. $employee->mother_name .'">
				</div>
			</div>    

            <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Religion</strong></label>
				<div class="col-lg-10">
					<select class="form-control m-bot15" id="" name="marital"  readonly="" disabled required>

					<option value="">Marital Status</option>
					<option'; if($employee->add_religin==1) { $data .= ' selected'; } $data .= ' value="1">Muslim</option>
					<option'; if($employee->add_religin==2) { $data .= ' selected'; } $data .= ' value="2">Hindu</option>
					<option'; if($employee->add_religin==3) { $data .= ' selected'; } $data .= ' value="3">Christan</option>
					</select>
				</div>
			</div>            
           
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Date Of Birth</strong></label> 
                <div class="col-lg-10">
                    <input type="date" class="form-control" id="receive_date"  readonly disabled name="birthdate" required value="'. $employee->date_birth .'">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Emergncy Number</strong></label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="" id="" readonly disabled name="emrgemcy_contact"  required value="'. $employee->emrgemcy_contact .'">
                </div>
            </div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Present Address</strong></label>
				<div class="col-lg-10">
					<textarea class="form-control" placeholder="" id="" readonly disabled name="present_address">'. $employee->present_address .'</textarea>
				</div>
			</div>
			
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Permanent Address</strong></label>
				<div class="col-lg-10">
					<textarea class="form-control" placeholder="" id=""  readonly name="permenet_address">'. $employee->permenet_address .'</textarea>
				</div>
			</div>          
           
			
            <div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Email</strong></label>
				<div class="col-lg-10">
					<input type="email" class="form-control" placeholder="Enter Email" id="add_email" name="add_email" value="'. $employee->add_email .'">
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Signature Upload</strong></label>
				<div class="col-lg-10">
					<img src="'.url('/').'/public/admin/employee/'.$employee->user_id.'/'. $employee->sign_upload .'" width="120">
					<input type="file" class="form-control" placeholder="Enter" id="" disabled  readonly name="sign_upload">
				</div>
			</div>
            
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>Photo</strong></label> 
                <div class="col-lg-10">
                    <img src="'.url('/').'/public/admin/employee/'.$employee->user_id.'/'. $employee->photo_upload .'" width="120">
                    <input type="file" class="form-control"  id="receive_date"  readonly  disabled name="photo" value="">
                </div>
            </div>
			 <div class="form-group">
                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                <strong>CV</strong></label> 
                <div class="col-lg-10">
                    <img src="'.url('/').'/public/admin/employee/'.$employee->user_id.'/'. $employee->cv_upload .'" width="120">
                    <input type="file" class="form-control"  id="receive_date"  readonly  disabled name="photo" value="">
                </div>
            </div>
			

			
        </form>';

        return $data;
    }
}
