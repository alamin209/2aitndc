@extends('layouts.admin')

@section('content')
    <!--main content start-->
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Employee  Information
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form class="cmxform form-horizontal tasi-form " name="employeefrom" id="addUserForm2"  role="form" method="post"  action="#" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-1 lab">Employee Id</label>
                                <div class="col-lg-6 col-lg-offset-1">
                                    <input type="text" class="form-control"  id="employee_code" placeholder="Enter employee id" name="employee_code" pattern="\d*" title="Please enter only employee code">
                                </div>
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-info pull-left" onclick="getEmployeeInfo()">Search</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control"  id="employee_name" name="employee_name"  readonly>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Joining Date</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control"  id="joining_date"  name="joining_date" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Mobile Number</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control"  id="mobile_number" name="mobile_number" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control"  id="email" name="email" readonly>
                                </div>
                            </div>

                        </form>

                    </div>
                </section>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Employee Leave Confirmation
                    </header>
                    <div class="panel-body addfrom">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  action="{{ url('/addemployleave') }}"  onsubmit="return validateForm()" enctype="multipart/form-data">


                            @csrf
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Leave Type*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="leave_type" name="leave_type" required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Type</option>
                                        <option value="Casual">Casual</option>
                                        <option value="Sick">Sick</option>
                                        <option value="Annual">Annual</option>
                                        <option value="Maternity">Maternity</option>
                                        <option value="Special">Special</option>
                                         <option value="Advancedleave">Advanced leave</option>
                                    </select>
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">With pay*</label>
                                <div class="col-lg-10">
                                    <div class="col-lg-2" style="padding-left: 0px;">
										<input type="checkbox" id="checkbox1" name="pay" value="1"  required onchange="getpay(this.value)">  <span class="lab"> With Pay</span>
									</div>
									<div class="col-lg-5 withleabel">
										<p class="lab"> From Date *</p>
										<input type="date" class="default-date-picker form-control"  placeholder="Enter From Date"    name="from_date"  id="withpay1" style="display: none">
									</div>
									<div class="col-lg-5 withleabel" style="padding-right: 0px;">
										<p class="lab"> To Date *</p>
										<input type="date" class="default-date-picker form-control" placeholder="Enter To Date"    name="to_date"  id="withpay2" style="display: none">
									</div>
								</div>
                            </div>
							
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Without pay*</label>
                                <div class="col-lg-10">
                                    <div class="col-lg-2" style="padding-left: 0px;">
										<input type="checkbox"  class="lab" id="checkbox" name="not_pay" value="2" onchange="getnotpay(this.value)"> <span  class="lab" >Without Pay</span>
									</div>
									<div class="col-lg-5 withoutleabel">
										<p class="lab"> From Date *</p>
										<input type="date" class="default-date-picker form-control" placeholder="Enter From Dat" name="not_pay_from_date" id="withoutpay1" style="display: none">
									</div>
									<div class="col-lg-5 withoutleabel" style="padding-right: 0px;">
										<p class="lab"> To Date *</p>
										<input type="date" class="default-date-picker form-control" placeholder="Enter From Dat" name="not_pay_to_date" id="withoutpay2" style="display: none">
									</div>
									
                                </div>
                            </div>

                             

                            <input type="hidden" value="" id="employ_id" name="employ_id">
                        

                            


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">Remarks</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Remarks " id="remark" name="remark" ></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>

    </section>
    </section>
    <!--main content end-->

	<style>
	
	.withleabel, .withoutleabel{ display:none; }
	
	</style>


    <!-- Modal -->
    <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Menu Confirmation</h4>
                </div>
                <div class="modal-body">

                    Do You Want To Delete This Menu?
                    <input type="hidden" id="delete_menu_id" name="delete_menu_id" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button">Yes</button>
                    <button data-dismiss="modal" class="btn btn-default" type="button">No</button>
                </div>
            </div>
        </div>
    </div>



    <!--dynamic table initialization -->
    <script src="public/js/dynamic_table_init_menu.js"></script>
    <script src="public/js/form-validation-script_add_menu.js"></script>

    <script>


        function toDate(d) {
            var from_date = $("#from_date").val()
            var today = new Date(from_date);
            var dd = today.getDay() + d;
            var mm = today.getMonth(); //January is 0!

            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            var today = yyyy + '-' + dd + '-' + mm;
            $("#to_date").val(today);
            alert(today);
        }



        function getEmployeeInfo() {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            var emp_id = $("#employee_code").val();

            if ($.isNumeric(emp_id) && emp_id != "") {
                $.ajax({
                    type: "Post",
                    url: "get_employe_details",
                    data: {'emp_id': emp_id},
                    success: function (data) {

                        if (data != 'not matched') {
                            var ob = JSON.parse(data);
                            var id = ob[0].id;
                            var emp_id = ob[0].emp_id;
                            var emp_name = ob[0].add_full_name;
                            var department =        ob[0].department;
                            var designation =       ob[0].degin_name;
                            var joining_date =       ob[0].joining_date;
                            var mobile_number =      ob[0].add_mobile;
                            var email         =      ob[0].add_email;

                            $("#edit_id").val(id);
                            $("#employee_name").val(emp_name);

                            $("#department").val(department);
                            $("#designation").val(designation);
                            $("#joining_date").val(joining_date);
                            $("#mobile_number").val(mobile_number);
                            $("#email").val(email);
                            $("#employ_id").val(id);
                        } else {
                            $("#edit_id").val("");
                            $("#employee_name").val("");

                            $("#department").val("");
                            $("#designation").val("");
                            $("#joining_date").val("");
                            $("#mobile_number").val("");
                            $("#email").val("");
                            alert("Not found");
                        }


                    }
                });
            } else {
                $("#edit_id").val("");
                $("#employee_name").val("");

                $("#department").val("");
                $("#designation").val("");
                $("#joining_date").val("");
                $("#mobile_number").val("");
                $("#email").val("");
                alert("Please enter a valid employee code");
            }



        }
        function getnotpay() {

            if( $('#checkbox').is(':checked')){

                $("#withoutpay1").show();
                $("#withoutpay2").show();
				$(".withoutleabel").show();
				
				$("#withoutpay1").attr('required', 'required');
				$("#withoutpay2").attr('required', 'required');
				
				$('#checkbox1').removeAttr('required');

            }else{
                $("#withoutpay1").hide();
                $("#withoutpay2").hide();
				$(".withoutleabel").hide();
				
                $("#withoutpay1").removeAttr('required');
				$("#withoutpay2").removeAttr('required');
				
                $('#checkbox1').attr('required', 'required');

                $('#withpay1').val('');
                $('#withpay2').val('');
                 

            }
        }

        function getpay() {

            if( $('#checkbox1').is(':checked')){

                $("#withpay1").show();
                $("#withpay2").show();
                $(".withleabel").show();				 

                $('#withpay1').attr('required', 'required');
                $('#withpay2').attr('required', 'required');


            }else{
                $("#withpay1").hide();
                $("#withpay2").hide();
				$(".withleabel").hide();
                
				$('#withpay1').removeAttr('required');
                $('#withpay2').removeAttr('required');

                $('#withpay2').val('');
                $('#withpay1').val('');
                 
                 
            }
        }


        function validateForm() {
            var x = document.forms["employeefrom"]["employee_code"].value;
            if (x == "") {
                alert("employee Id must be filled out");
                return false;
            }
        }
    </script>


@endsection


