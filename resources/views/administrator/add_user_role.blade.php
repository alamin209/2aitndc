@extends('layouts.admin') 
@section('content')
<!--main content start-->
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add User Role
                    </header>
                     @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                      @endif
                    <div class="panel-body">
                        <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="{{url('/')}}/add_user_role">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Role Name</label>
                                <div class="col-lg-10">
                                    <input type="test" class="form-control" placeholder="Enter Role Name" id="role_name" name="role_name" minlength="2" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View User Role
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th class="hide_coloum">Role Id</th>
                                        <th>Role Name</th>
                                        <th>Action</th>
                                     <!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    <tr class="gradeX">
                                        <td class="hide_coloum"></td>
                                        <td></td>
                                       <td>
                                            <button class="btn btn-primary btn-xs" onclick="editRole();"><i class="fa fa-pencil"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
<!--main content end-->



<!-- Modal -->
<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete Role Confirmation</h4>
            </div>
            <div class="modal-body">

                Do You Want To Delete This Role?
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
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Role Confirmation</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label" for="name">Role Name</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Enter Role Name" id="edit_role_name" name="edit_role_name" class="form-control">
							<input type="hidden" id="edit_role_id" name="edit_role_id" />
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

<!--main content end-->

<script>

// function editRole(){
	   
    // $("#myModalEdit").modal();

// }

</script>

<script>


   // function editRole(role_id){
	 
	   //      $.ajax({
    //             type: "Post",
    //             url: "add_user_role/getMenuData",
    //             data: {'role_id':role_id} ,
    //             success: function(data) {  
				// var ob=JSON.parse(data);
				// var role_id=ob[0].role_id;
				// var role_name=ob[0].role_name;
				// console.log(data);
				//   $("#edit_role_id").val(role_id);
    //               $("#edit_role_name").val(role_name);
                    
    //             }
    //         });
	   
	   
    //  $("#myModalEdit").modal();
    // //} 

</script>

<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_user_role.js"></script>
<!--script for this page-->
<script src="public/js/form-validation-script_add_role.js"></script>
@endsection