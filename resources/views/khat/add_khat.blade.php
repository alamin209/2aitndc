@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
					<h3>খাত সংযুক্তি</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/add_khat">
                        {{csrf_field()}}
                        <div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>উপাংশ</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" name="upangsho_id" onchange="getKhattype(this.value)" required>

								<option value="">উপাংশ নির্ধারণ</option>
									@foreach($upangshos as $data)
                                       @if($data->upangsho_id!=0)
    										<option value="{{$data->upangsho_id}}">{{$data->upangsho_name}}
    										</option>
                                        @endif    
									@endforeach
								</select>
							</div>
                        </div>
						
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>আয় / ব্যয় খাত </strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" id="inout_id"   name="inout_id" onchange="getKhat(this.value)">

								<option value="">আয় / ব্যয় খাত নির্ধারণ</option>
									@foreach($khats as $data)
                                       @if($data->khat_id!=0)
										<option class="inout" value="{{$data->khat_id}}">{{$data->khat}}
										</option>
                                       @endif 
									@endforeach
								</select>
							</div>
                        </div>						
                        <div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত টাইপ</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" name="tax_id">

									<option value="">খাত টাইপ নির্ধারণ</option
									
									@foreach($taxTypes as $data)

										<option class="khats  inout{{$data->khat_id}} khat{{ $data->upangsho_id}}" value="{{$data->tax_id}}">{{$data->tax_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত টাইপ-২</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" name="tax_id2">

									<option value="">খাত টাইপ নির্ধারণ</option>
									<option value="0">নাই</option>
									@foreach($khattypetype as $data)

										<option class="khat2 inout{{$data->khat_id}} khat{{ $data->upangsho_id}}" value="{{$data->tax_id}}">{{$data->tax_name2}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>ক্রমিক</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="ক্রমিক লিখুন (ক, খ, গ...)" name="serials">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>আয়খাত নাম</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="আয়খাত নাম লিখুন" name="expense_khat_name" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info pull-right">যুক্ত করুন</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
	<style> .khats, .inout, .khat2{display:none} </style>
	<section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
					<h3>সকল খাত</h3>
                </header>                 
                <div class="panel-body">
					<div class="adv-table">
                            <table class="display table table-bordered" id="myTable">
                                <thead>
                                    <tr>									 
                                        <th>উপাংশ </th>
                                        <th>আয় / ব্যয়</th>
                                        <th>খাত টাইপ</th>
                                        <th>আয়খাত</th>                                      
                                        <th>প্রক্রিয়া</th>                                      
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($incomeKhat as $inckhat)
                                    <tr class="gradeX">
                                         
                                        <td>{{ $inckhat->upangsho_name}}</td>
                                        <td>{{ $inckhat->khat}}</td>
                                        <td>{{ $inckhat->tax_name}}</td>
                                        <td>{{ $inckhat->serilas}} {{ $inckhat->khat_name}}</td>                                      
										<td>
                                            <button class="btn btn-primary btn-xs" onclick=""><i class="fa fa-pencil"></i></button>
                                        </td>
                                    </tr>
								@endforeach
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
	
 var upang = '';
  function getKhattype(id){
	upang=id;	
	$('.inout').hide();
	$('.inout').show();
    $('#inout_id').val('');	
  }
  function getKhat(id) {
	
	$('.khats').hide();
	$('.inout'+id+'.khat'+upang).show();
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