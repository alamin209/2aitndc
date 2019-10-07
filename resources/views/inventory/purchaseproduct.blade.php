@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Add New Product </h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/addproduct" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Supplier name * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="sup_id" id="sup_id" required>
                                        <option value="">Select Supplier </option>
                                        @foreach($sup_lier as $sup)
                                            <option value="{{ $sup->id }}">{{ $sup->companey_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Category name * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="cat_id" id="cat_id" onchange="getsupcategory(this.value)" required>
                                        <option value="">Select category </option>
                                        @foreach($inventorycat as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->catgeory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Sub Category name * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  id="sub_cat" name="sub_cat" required>
                                        <option value="">Select  Sub Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Product name*</strong></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder=" Product name" id="product_name" name="product_name" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Product Quantity*</strong></label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" placeholder=" Product Quantity " id="quantity" name="quantity" required >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Upload Document*</strong></label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control" placeholder=" Designation Name" id="doc_name" name="doc_name"  >
                                </div>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Payment Type * </strong></label>--}}
{{--                                <div class="col-lg-10">--}}
{{--                                    <select class="form-control m-bot15"  id="sub_cat" name="sub_cat2" onchange="get_paymenttype(this.value)" required>--}}
{{--                                        <option value="">Select Payment Type</option>--}}
{{--                                        <option value="1">Bank</option>--}}
{{--                                        <option value="2">Cash</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group" style="display: none" id="selectbank">--}}
{{--                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">--}}
{{--                                    <strong>Bank</strong></label>--}}
{{--                                <div class="col-lg-10">--}}
{{--                                    <select class="form-control m-bot15 lab" id="selectbankinput" name="bank_id" onchange="getBranch(this.value)" required>--}}

{{--                                        <option value="">Select Bank</option>--}}
{{--                                        @foreach($bank as $data)--}}
{{--                                            <option value="{{$data->bank_id}}">{{$data->bank_name}}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group" id="bankselected" style="display: none">--}}
{{--                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab">--}}
{{--                                    <strong> Select Branch</strong></label>--}}
{{--                                <div class="col-lg-10">--}}
{{--                                    <select class="form-control" id="branch_id" name="branch_id" onchange="getAcc(this.value)" required>--}}
{{--                                        <option value="">Branch</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group" id="selectbranch" style="display: none">--}}
{{--                                <label class="col-sm-2 control-label col-lg-2 lab" for="name">Branch </label>--}}
{{--                                <div class="col-lg-10">--}}
{{--                                    <select class="form-control  m-bot15"  name="bankact" id="bankact" > <!-- input-sm m-bot15  -->--}}
{{--                                        <option value="">Select Bank Account</option>--}}

{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group" id="hideseltecdeaccount">--}}
{{--                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Account No* </strong></label>--}}
{{--                                <div class="col-lg-10">--}}
{{--                                    <select class="form-control m-bot15"  id="acount_no" name="acount_no" required>--}}
{{--                                        <option value="">Select  Account No</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="form-group" >
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Purchase date* </strong></label>
                                <div class="col-lg-10">
                                    <input type="date" class="form-control" placeholder=" Purchase date " id="purchase_date" name="purchase_date" required >

                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> product Purchase Cost* </strong></label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" placeholder=" Purchase Cost " id="purchase_cost" name="purchase_cost" required >

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


        function getsupcategory(category) {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            $.ajax({
                type: "post",
                url: "{{url('/')}}/getsubcategory",
                data: {'category': category},
                success: function (data) {
                    $("#sub_cat").html(data);
                }
            });

        }
        {{--function get_paymenttype(payment_type) {--}}
        {{--    $.ajaxSetup({--}}
        {{--        headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }--}}
        {{--    });--}}

        {{--    $.ajax({--}}
        {{--        type: "post",--}}
        {{--        url: "{{url('/')}}/payment_typecheck",--}}
        {{--        data: {'payment_type': payment_type},--}}
        {{--        success: function (data) {--}}

        {{--            if(payment_type==1){--}}
        {{--                $("#bankselected").show();--}}
        {{--                $("#selectaccount").show();--}}
        {{--                $("#selectbranch").show();--}}
        {{--                $("#selectbank").show();--}}
        {{--                $("#hideseltecdeaccount").hide();--}}

        {{--                $("#acount_no").prop("required", false);--}}

        {{--                $("#acount_no").val('');--}}

        {{--            }else if(payment_type==2) {--}}
        {{--                $("#acount_no").html(data);--}}

        {{--                $("#bankselected").hide();--}}
        {{--                $("#bankselected").prop("required", false);--}}
        {{--                $("#bankselected").val('');--}}
        {{--                $("#selectaccount").hide();--}}
        {{--                $("#bankact").prop("required", false);--}}
        {{--                $("#bankact").val('');--}}
        {{--                $("#selectbranch").hide();--}}
        {{--                $("#branch_id").prop("required", false);--}}
        {{--                $("#branch_id").val('');--}}
        {{--                $("#selectbank").hide();--}}
        {{--                $("#selectbankinput").prop("required", false);--}}
        {{--                $("#hideseltecdeaccount").show();--}}

        {{--            }--}}
        {{--        }--}}
        {{--    });--}}

        {{--}--}}
        {{--function getBranch(bank_id) {--}}


        {{--    $.ajaxSetup({--}}
        {{--        headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }--}}
        {{--    });--}}

        {{--    $.ajax({--}}
        {{--        type: "post",--}}
        {{--        url: "{{url('/')}}/getbranches",--}}
        {{--        data: {'bank_id': bank_id},--}}
        {{--        success: function (data) {--}}
        {{--            $("#branch_id").html(data);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
        {{--function getAcc(account_id) {--}}


        {{--    $.ajaxSetup({--}}
        {{--        headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }--}}
        {{--    });--}}

        {{--    $.ajax({--}}
        {{--        type: "post",--}}
        {{--        url: "{{url('/')}}/get_acounts_details",--}}
        {{--        data: {'account_id': account_id},--}}
        {{--        success: function (data) {--}}
        {{--            $("#bankact").html(data);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}



    </script>

@endsection


