@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Add New Student Bill Info </h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/billingofstudenttype">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Billing Details *</strong></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Student billing details " id="billing_details" name="billing_details" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Student Bill Type *</strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="billing_type_id" onchange="" required>
                                        <option value="">Select Billing Type </option>
                                        @foreach($billi_type as $dep)
                                            <option value="{{ $dep->id }}">{{ $dep->bill_type_name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Amount *</strong></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Student billing Amount " id="amount" name="amount" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Date *</strong></label>
                                <div class="col-lg-10">
                                    <input type="date" class="form-control" placeholder="Student Bill Type Name " id="bill_type_date" name="bill_type_date" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Remark *</strong></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Student Bill remark " id="remark" name="remark" required >
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


        function getdegree(degree_id) {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

        $.ajax({
            type: "get",
            url: "{{url('/')}}/getSubject",
            data: {'degree_id': degree_id},
            success: function (data) {
                $("#degress").html(data);
            }
        });


        // $("#myModalEdit").modal();
        }

    </script>

@endsection


