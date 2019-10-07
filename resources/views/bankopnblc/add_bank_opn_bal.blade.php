@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Bank opening balance
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/add_menu">
                        {{csrf_field()}}
                        <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Bank</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="select_role">
                                    
                                    
                                       <option value="" onclick="getPermission()" selected></option> 
                                           
                                        <option value="" onclick="getPermission()">E khat</option>
                                     
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Account</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="select_role">
                                    
                                    
                                       <option value="" onclick="getPermission()" selected></option> 
                                           
                                        <option value="" onclick="getPermission()">E khat</option>
                                     
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Amount</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Enter Menu Name" id="menu_name" name="menu_name" minlength="2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Date</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Enter Menu Icon" id="menu_icon" name="menu_icon" minlength="2" required>
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
    <!--  <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    </div> -->
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


    //function deleteMenu(menu_id) {
    //     $("#delete_menu_id").val(menu_id);
    //     $("#myModalDelete").modal();
    // }

   // function editMenu(menu_id) {

        // $.ajax({
        //     type: "Post",
        //     url: "",
        //     data: {'menu_id': menu_id},
        //     success: function (data) {
        //         var ob = JSON.parse(data);
        //         var menu_id = ob[0].menu_id;
        //         var menu_name = ob[0].menu_name;
        //         console.log(data);
        //         $("#edit_menu_id").val(menu_id);
        //         $("#edit_menu_name").val(menu_name);

        //     }
        // });


       // $("#myModalEdit").modal();
   // }

</script>

@endsection