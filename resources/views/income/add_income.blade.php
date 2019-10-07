@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
					Income Category
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/income_type">
                        {{csrf_field()}}
                       
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Income Category</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Income Category" id="" name="incomecat" required>
                            </div>
                        </div>

                        <input type="submit" name="categorySubmit" class="btn btn-info pull-right" value="Submit" />
                    </form>

                </div>
            </section>
        </div>
    </div>
	<br><hr>
		<div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Income Type
                </header>                
				@if (session('typemessage'))
                <div class="alert alert-success">
                    {{ session('typemessage') }}
                </div>
                @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm"
                          action="{{url('/')}}/income_type2">

                        @csrf
						
						<div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Income Category *</label>
                            <div class="col-lg-10">
								<select class="form-control" name="expcat" required>
									<option value="">Select Income Category</option>
									@foreach($upangshos as $expens)
									<option value="{{ $expens->id }}">{{ $expens->category }}</option>
									@endforeach
									
								</select>
                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Type *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Enter Type Name" id="" name="typename" required>
                            </div>
                        </div>
						
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Note*</strong></label>
							<div class="col-lg-10">
								<input type="text" class="form-control" placeholder="Note " id="note" name="note" required >
							</div>
						</div>

                        <input type="submit" name="typeSubmit" class="btn btn-info pull-right" value="Submit">
                    </form>

                </div>
            </section>
        </div>
    </div>
	
	
	
	<hr><br>

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Income Types
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
                                    <th>Income Category</th>
                                    <th>Income Type</th>                                     
                                 <!--   <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($incometype as $expens)                               

									<tr class="gradeX">
										<td>{{ $expens->inccat->category }}</td>
										<td>{{ $expens->type }}</td>
										 
									<!--	<td>

											<button class="btn btn-primary btn-xs" onclick="editMenu();"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-danger btn-xs" onclick="deleteMenu();"><i class="fa fa-trash-o "></i></button>

										</td> -->
									</tr>                                
                                @endforeach

                            </tbody>
                        </table>

                    </div>
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


 function getIncomeKhat(upangsho_id) {

         $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "../budget/create",
            data: {'upangsho_id': upangsho_id},
            success: function (data) {
                 $("#option").html(data);  
            }
        });
   }

</script>

@endsection