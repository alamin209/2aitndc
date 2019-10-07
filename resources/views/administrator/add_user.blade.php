@extends('layouts.admin')

@section('content')
<!--main content start-->
<section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        Add  Employee

                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (session('err-message'))
                        <div class="alert alert-danger">
                            {{ session('err-message') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel-body addfrom">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  action="{{url('/')}}/add_user"  enctype="multipart/form-data" >
                                @csrf

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Full Name *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Full Name" id="add_full_name" name="add_full_name" value="{{ old('add_full_name') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Employee Id(make it unique)*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Employee id" id="emp_id" value="<?=rand(10000, 99999);?>" name="emp_id" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Date Of Birth*</label>
                                <div class="col-lg-10">
                                    <input type="date" class="form-control datepickerpading" placeholder="Enter Date Of Birth" id="date_birth"  value="{{ old('date_birth') }}" name="date_birth" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Probation Date*</label>
                                <div class="col-lg-10">
                                    <input type="date" class="form-control datepickerpading" placeholder="Enter Date Of Birth" id="probition_date"  value="{{ old('date_birth') }}" name="probition_date" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Probation Confirmation date*</label>
                                <div class="col-lg-10">
                                    <input type="date" class="form-control datepickerpading" placeholder="Enter Date Of Birth" id="probition_confor_date"  value="{{ old('date_birth') }}" name="probition_confor_date">
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Department * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="dep_id" id="dep_id"  onchange="getdegignation(this.value)" required>
                                        <option value="" >Select Department </option>
                                        @foreach($departments  as $dep)
                                            <option value="{{ $dep->id }}" {{ (Request::old("dep_id") ==  $dep->id ? "selected":"") }}>{{ $dep->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Designation * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="dig_id" id="dig_id"   required>
                                        <option value="">Select Designation </option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Employee Type*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="add_role" name="emp_type" required>
                                        <option value="">Employee Type</option>

                                        <option value="1" {{ (Request::old("add_role") ==  1 ? "selected":"") }}>Permanent</option>
                                        <option value="0" {{ (Request::old("add_role") ==  0 ? "selected":"") }} >Temporary</option>

                                    </select>
                                </div>
                            </div>

                            <!--<div class="form-group">-->
                            <!--    <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Basic Salary*</label>-->
                            <!--    <div class="col-lg-10">-->
                            <!--        <input type="text" class="form-control " placeholder="Enter Basic Salary" id="gross_salary"   value="{{ old('gross_salary') }}"  name="gross_salary" required>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Reporting To*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control " placeholder="Enter Reporting Date" id="reporting_to"  value="{{ old('reporting_to') }}"  name="reporting_to" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Appointed Date*</label>
                                <div class="col-lg-10">
                                    <input type="date" class="form-control datepickerpading" placeholder="Enter Appointed Date" id="appointed_date"  value="{{ old('appointed_date') }}"  name="appointed_date" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Joining Date*</label>
                                <div class="col-lg-10">
                                    <input type="date" class="form-control datepickerpading" placeholder="Enter Joining Date" id="joining_date" value="{{ old('joining_date') }}"  name="joining_date" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">User Name *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter User Name" id="add_user_name" name="user_name" value="{{ old('user_name') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Password *</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" placeholder="Enter Password" id="add_password" name="add_password"  required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Gender*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="gender Status" name="gender" required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Gender</option>
                                        <option value="1" {{ (Request::old("gender") ==  1 ? "selected":"") }}>Male</option>
                                        <option value="0" {{ (Request::old("gender") ==  0 ? "selected":"") }}>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Marital Status*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="Marital Status" name="marital_status" required> <!-- input-sm m-bot15  -->

										<option value="">Select Marital Status</option>
                                        <option value="1" {{ (Request::old("marital_status") ==  1 ? "selected":"") }}>Single</option>
                                        <option value="0" {{ (Request::old("marital_status") ==  0 ? "selected":"") }} >Married</option>
                                    </select>
                                </div>
                            </div>

							<div class="form-group">
								<label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Mobile Number* </label>
								<div class="col-lg-10">
									<input type="text" class="form-control" placeholder="Enter Mobile Number" id="add_mobile" name="add_mobile" maxlength="11" value="{{ old('add_mobile') }}" required>
								</div>
							</div>

							<div class="form-group">
								<label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Father Name* </label>
								<div class="col-lg-10">
									<input type="text" class="form-control" placeholder="Enter Father name" id="father_name" name="father_name" value="{{ old('father_name') }}" required>
								</div>
							</div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Mother Name* </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Mother Name" id="mother_name" name="mother_name"  value="{{ old('mother_name') }}" required>
                                </div>
                            </div>

							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Emergency Contact* </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Emergency Contact" id="emrgemcy_contact" name="emrgemcy_contact" value="{{ old('emrgemcy_contact') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Signature Upload*</label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control" placeholder="Enter" id="sign_upload"  name="sign_upload" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Photo Upload*</label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control" placeholder="Enter" id="photo_upload"  name="photo_upload" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Present Address* </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Present Address " id="present_address" name="present_address" required> {{ old('present_address') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Permanent Address* </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Permanent Address " id="permenet_address" name="permenet_address"  required> {{ old('permenet_address') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Email*</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" placeholder="Enter Email" id="add_email" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Religion*</label>
                                <div class="col-lg-10">

                                    <select class="form-control" id="add_religin" name="add_religin" required> <!-- input-sm m-bot15  -->

                                        <option value="">Select Religion </option>
                                        <option value="1" {{ (Request::old("add_religin") ==  1 ? "selected":"") }} >Muslim</option>
                                        <option value="2" {{ (Request::old("add_religin") ==  2 ? "selected":"") }} >Hindu</option>
                                        <option value="3" {{ (Request::old("add_religin") ==  3 ? "selected":"") }}>Christan</option>
                                        <option value="4" {{ (Request::old("add_religin") ==  4 ? "selected":"") }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Account No*</label>-->
                            <!--    <div class="col-lg-10">-->
                            <!--        <input type="text" class="form-control" placeholder="Account No" id="account_no" name="account_no" value="{{ old('account_no')  }}" required>-->
                            <!--    </div>-->
                            <!--</div>-->
                            {{--<div class="form-group">--}}
                                {{--<label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Religion*</label>--}}
                                {{--<div class="col-lg-10">--}}
                                    {{--<input type="text" class="form-control" placeholder="Enter Religion" id="add_religin" name="add_religin" required>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">CV Upload*</label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control" placeholder="Enter" id="cv_upload"  name="cv_upload" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>



</section>

<!--main content end-->
        <!-- Modal -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit User Confirmation</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label" for="name">Full Name</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Enter Full Name" id="edit_name" name="edit_name" class="form-control">
							<input type="hidden" id="edit_user_id" name="edit_user_id" />
                        </div>
						 <label class="col-lg-3 col-sm-3 control-label" for="name">Mobile Number</label>
						 <div class="col-lg-9">
                            <input type="text" placeholder="Enter Phone" id="edit_phone" name="edit_phone" class="form-control">

                        </div>
						 <label class="col-lg-3 col-sm-3 control-label" for="name">Email</label>
						 <div class="col-lg-9">
                            <input type="text" placeholder="Enter Email" id="edit_email" name="edit_email" class="form-control">

                        </div>


						<label class="col-lg-3 col-sm-3 control-label" for="name">Select Status</label>
						 <div class="col-lg-9">
                           <select class="form-control" id="edit_status" name="edit_status"> <!-- input-sm m-bot15  -->


                                <option value="1">Active</option>
                               <option value="2">In Active</option>
                            </select>

                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            </div>

        </div>
    </div>
</div>
        <!-- modal -->

    </section>
</section>
<!--main content end-->

<script>


//function editUser(){

//   $("#myModalEdit").modal();
// }

</script>

<script>


    function getdegignation(desig) {
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/getdesignation",
            data: {'desig': desig},
            success: function (data) {
                $("#dig_id").html(data);
            }
        });

    }

</script>


<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_user.js"></script>
<!--common script for all pages-->
<script src="public/js/form-validation-script_add_user.js"></script>
@endsection
