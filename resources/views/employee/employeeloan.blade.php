@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Employee loan </h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/employeloan" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Department * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="dep_id" id="dep_id"  onchange="getdegignation(this.value)" required>
                                        <option value="">Select Department </option>
                                        @foreach($department  as $dep)
                                            <option value="{{ $dep->id }}">{{ $dep->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Designation * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="desig_id" id="desig_id" onchange="getemployee(this.value)"  required>
                                        <option value="">Select Designation </option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Employee * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="employ_id" id="employ_id"  required>
                                        <option value="">Select Employee </option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Loan Type * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="loan_type" id="loan_type"  required>
                                        <option value="">Select Loan Type </option>
                                        @foreach($loan  as $dep)
                                            <option value="{{ $dep->id }}">{{ $dep->loan_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Amount*</strong></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Give amount" id="amount" name="amount" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Payment Type * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  id="sub_cat" name="sub_cat" onchange="get_paymenttype(this.value)" required>
                                        <option value="">Select Payment Type</option>
                                        <option value="1">Bank</option>
{{--                                        <option value="2">Cash</option>--}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" style="display: none" id="selectbank">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">
                                    <strong>Bank *</strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15 lab" id="selectbankinput" name="bank_id" onchange="getBranch(this.value)" required>

                                        <option value="">Select Bank</option>
                                        @foreach($bank as $data)
                                            <option value="{{$data->bank_id}}">{{$data->bank_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="bankselected" style="display: none">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">
                                    <strong> Select Branch *</strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="branch_id" name="branch_id" onchange="getAcc(this.value)" required>
                                        <option value="">Branch</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="selectbranch" style="display: none">
                                <label class="col-sm-2 control-label col-lg-2 lab" for="name">Bank Account * </label>
                                <div class="col-lg-10">
                                    <select class="form-control  m-bot15"  name="bankact" id="bankact"  required > <!-- input-sm m-bot15  -->
                                        <option value="">Select Bank Account</option>

                                    </select>
                                </div>
                            </div>

{{--                        --}}
                            <div class="form-group" >
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Per month installment* </strong></label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" placeholder=" per month installment " id="mon_inst" name="mon_inst" required >

                                </div>
                            </div>

                            <div class="form-group" >
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Loan date* </strong></label>
                                <div class="col-lg-10">
                                    <input type="date" class="form-control" placeholder=" Loan  date " id="loan_date" name="loan_date" required >

                                </div>
                            </div>


                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>

    </section>

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
    <!-- modal -->

    <!-- Modal -->
    <!-- <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Menu Confirmation</h4>
                </div>

                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label" for="name">Menu Name</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="Enter Menu Name" id="edit_menu_name" name="edit_menu_name" class="form-control">
                                <input type="hidden" id="edit_menu_id" name="edit_menu_id" />
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
    </div> -->
    <!-- modal -->



    <!--dynamic table initialization -->
    <script src="public/js/dynamic_table_init_menu.js"></script>
    <script src="public/js/form-validation-script_add_menu.js"></script>

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
                    $("#desig_id").html(data);
                }
            });

        }
        function get_paymenttype(payment_type) {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            $.ajax({
                type: "post",
                url: "{{url('/')}}/payment_typecheck",
                data: {'payment_type': payment_type},
                success: function (data) {

                    if(payment_type==1){

                        $("#bankselected").show();
                        $("#selectaccount").show();
                        $("#selectbranch").show();
                        $("#selectbank").show();
                        $("#hideseltecdeaccount").hide();
                        $("#bankact").prop("required", true);

                    }
                }
            });

        }
        function getBranch(bank_id) {


            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            $.ajax({
                type: "post",
                url: "{{url('/')}}/getbranches",
                data: {'bank_id': bank_id},
                success: function (data) {
                    $("#branch_id").html(data);
                }
            });
        }
        function getAcc(account_id) {


            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            $.ajax({
                type: "post",
                url: "{{url('/')}}/get_acounts_details",
                data: {'account_id': account_id},
                success: function (data) {
                    $("#bankact").html(data);
                }
            });
        }
         function getemployee(employeid) {

            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });


            $.ajax({
                type: "post",
                url: "{{url('/')}}/get_employe_id",
                data: {'employeid': employeid},
                success: function (data) {

                    $("#employ_id").html(data);
                }
            });
        }




    </script>

@endsection


