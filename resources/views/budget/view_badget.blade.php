@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
					<h3>বাজেট  ব্যবস্থাপন</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
					<div class="adv-table">
                        <table class="display table table-bordered" id="myTable">
                            <thead>
                                <tr>									 
                                    <th>উপাংশ </th>                                        
                                    <th>আয়/ব্যায়খাত</th>                                      
                                    <th>খাত টাইপ</th>                                      
                                    <th>খাত</th>
									<th>আর্থ বছর</th>
									<th>টাকা</th> 
									<th>aay</th>
									<th>baay</th>
									<th>rest budget</th>
									<th>rest budget include aay</th>
                                    <th>প্রক্রিয়া</th>                                      
                                </tr>
                            </thead>
                            <tbody>
                            {!! $badget!!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
	
	
	

   <!--  <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    View Menu
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
                                    <th class="hide_coloum">Menu Id</th>
                                    <th>Menu Name</th>
                                    <th>Menu Icon</th>
                                    <th>Action</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                            
                            
                                <tr class="gradeX">
                                  

                                    <td class="hide_coloum"></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                    
                                        <button class="btn btn-primary btn-xs" onclick="editMenu();"><i class="fa fa-pencil"></i></button>
                                            
                                        <button class="btn btn-default btn-xs"><i class="fa fa-trash-o "></i></button>
                                           
                                        <button class="btn btn-danger btn-xs" onclick="deleteMenu();"><i class="fa fa-trash-o "></i></button>     

                                    </td>
                                 
                                </tr>
                
                            
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div> -->
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

    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Menu Confirmation</h4>
                </div>

                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" action="{{url('/')}}/budget_update">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label" for="name">Menu Name</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="" id="edit_menu_name" name="" class="form-control" disabled>
    							<input type="hidden" id="edit_menu_id" name="bdgtid" />
    							<input type="hidden" id="khat_id" name="khat_id" />
    							<input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label" for="name">Year</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="" id="year" name="" class="form-control" disabled>
                                <input type="hidden" id="year2" name="year">
							</div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label" for="name">Amount</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="Enter Amount" id="" name="amount" class="form-control">
    							 
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


 
<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>


    function getbudget(bdgtid) {
		
		//alert(bdgtid);
		var khat = $('#khatname'+bdgtid).html();
		$('#edit_menu_id').val(bdgtid);		
		$('#edit_menu_name').val(khat);	
		$('#khat_id').val($('#khatid'+bdgtid).val());
		var yr = $('#year'+bdgtid).text();
		$('#year, #year2').val(yr);
		 
		$('#myModalEdit').modal();
	}
    

  function getInKhat(upangsho_id) {

         $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "../income/create",
            data: {'upangsho_id': upangsho_id},
            success: function (data) {
                 $("#option").html(data);  
            }
        });
   }


</script>

@endsection