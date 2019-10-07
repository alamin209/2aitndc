@extends('layouts.admin') 

@section('content')
  <section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
					<h3>খাত টাইপ সংযুক্তি</h3>
                </header>
                 @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/khattype">
                        {{csrf_field()}}
						<div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত টাইপ-২(যদি থাকে)</strong></label>
                            <div class="col-lg-10">
                                <input type="checkbox" class="" id="iskhattype" name="iskhattype" value="1" onchange="gettypetypefield()">
                            </div>
                        </div>
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>উপাংশ</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" name="upangsho_id" onchange="getInKhat(this.value)" required>

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
								<select class="form-control m-bot15" name="khat_id" onchange="">

								<option value="">আয় / ব্যয় খাত নির্ধারণ</option>
									@foreach($khats as $data)
									   @if($data->khat_id!=0)
										<option value="{{$data->khat_id}}">{{$data->khat}}
										</option>
									  @endif	
									@endforeach
								</select>
							</div>
                        </div>
						
						
						
                        <div class="form-group ifkhat">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত টাইপ</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="খাত টাইপ লিখুন" id="tax_name" name="tax_name" minlength="2" required>
                            </div>
                        </div>
						
						<div class="form-group ifkhat">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত(যদি আধীন না থাকে)</strong></label>
                            <div class="col-lg-10">
                                <input type="checkbox" class="" id="subormain" name="subormain" value="1">
                            </div>
                        </div>
						
						
						
						<div class="form-group typetypefield">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত টাইপ</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" name="tax_id" id="tax_id">

									<option value="">খাত টাইপ নির্ধারণ</option>
									@foreach($taxTypes as $data)

										<option class="khats  inout{{$data->khat_id}} khat{{ $data->upangsho_id}}" value="{{$data->tax_id}}">{{$data->tax_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group typetypefield">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত টাইপ২</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="খাত টাইপ২ লিখুন" id="tax_name2" name="tax_name2" minlength="2">
                            </div>
                        </div>		
                        

                        <button type="submit" class="btn btn-info pull-right">যুক্ত করুন</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
	
	
	<div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
						সকল খাত টাইপ
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="display table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>উপাংশ </th> 
                                    <th>আয় / ব্যয় খাত</th> 
									
                                    <th>খাত টাইপ</th>                                                                         
                                                                                                             
                                    <th>প্রক্রিয়া</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($khattype as $upang)
                                <tr class="gradeX">
									<td>{{ $upang->upangsho_name}}</td>
                                    <td>{{ $upang->khat }}</td>
                                    <td>{{ $upang->tax_name }}</td>
                                     
                                    <td width="7%">
                                    
                                        <button class="btn btn-primary btn-xs" onclick="editMenu();"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" onclick="deleteMenu();"><i class="fa fa-trash-o "></i></button>     

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
	
	<div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
						সকল খাত টাইপ-২
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="display table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>উপাংশ </th> 
                                    <th>আয় / ব্যয় খাত</th> 									
                                    <th>খাত টাইপ</th>                                                                         
                                    <th>খাত টাইপ২</th>                                                       
                                    <th>প্রক্রিয়া</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($khattypetype as $upang)
                                <tr class="gradeX">
									<td>{{ $upang->upangsho_name}}</td>
                                    <td>{{ $upang->khat }}</td>
                                    <td>{{ $upang->tax_name }}</td>
                                    <td>{{ $upang->tax_name2 }}</td>
                                     
                                    <td width="7%">
                                    
                                        <button class="btn btn-primary btn-xs" onclick="editMenu();"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" onclick="deleteMenu();"><i class="fa fa-trash-o "></i></button>     

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

<style>

	.typetypefield{ display:none; }
</style>
 
<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>

	function gettypetypefield(id) {
		
		if($('#iskhattype').is(':checked')){	
			//alert('ok');			
			$('.typetypefield').show();
			$('.ifkhat').hide();
			$('#tax_name').removeAttr('required');
			$('#tax_id').attr('required','required');
			$('#tax_name2').attr('required','required');
			
		}else{ 
			//alert('not ok');			
			$('.typetypefield').hide();
			$('.ifkhat').show();
			$('#tax_name').attr('required', 'required');
			$('#tax_id').removeAttr('required');
			$('#tax_name2').removeAttr('required');
		}
	}


    //function gettypetypefield(menu_id) {
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