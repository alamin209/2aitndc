@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
					<h3>Add Budget</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/budget">
                        {{csrf_field()}}
                        
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>expense/income</strong></label>
                            <div class="col-lg-10">
                                
                                <select class="form-control m-bot15" id="upangsho_id" name="upangsho_id" onchange="getIncomeKhat(this.value)">
									<option value="">Select   </option>
                                    @foreach($upangshos as $data)
                                        @if($data->upangsho_id!=0)
                                            <option value="{{$data->upangsho_id}}">{{$data->upangsho_name}}</option>
                                        @endif
                                    @endforeach                                     
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>আয় / ব্যয় খাত </strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15"  id="inout_id" name="inout_id" onchange="getkhattype(this.value)">
								<option value="">আয় / ব্যয় খাত নির্ধারণ</option>
									@foreach($khats as $data)
									    @if($data->khat_id!=0)
										    <option class="inout" value="{{$data->khat_id}}">{{$data->khat}}</option>
										@endif
									@endforeach
								</select>
							</div>
                        </div>
                        <div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত টাইপ</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" id="khattype_id" name="khattype_id" onchange="getkhat(this.value)">
									<option value="">খাত টাইপ নির্ধারণ</option>
									@foreach($taxTypes as $data)
									
										<option class="khattypes khattype{{$data->khat_id}} upnag{{$data->upangsho_id}}" value="{{$data->tax_id}}">{{$data->tax_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত টাইপ-২</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" id="khtattypetype_id" name="khtattypetype_id" onchange="getkhatfortypetype(this.value)">

									<option value="">খাত টাইপ নির্ধারণ</option>
									@foreach($khattypetype as $data)

										<option class="katype2 inout{{$data->khat_id}} upa{{ $data->upangsho_id}} khattp{{ $data->khtattype_id }}" value="{{$data->tax_id}}">{{$data->tax_name2}}</option>
									@endforeach
									<option class="" value="0">নাই</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাত </strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" id="khat_id" name="khat_id" onchange="khatchange(this.value)">

									<option value="">খাত  নির্ধারণ</option>
									@foreach($khat as $data)

										<option class="khats khat{{ $data->khattype }} khattp{{ $data->tax_type_id }} khattypetype{{ $data->tax_type_type_id }}" value="{{ $data->khat_id }}">{{$data->serilas}} {{$data->khat_name}}</option>
									@endforeach
									
								</select>
							</div>
						</div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>অর্থ বছর</strong></label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" name="year" required onchange="yearchange(this.value)">

									<option value="">অর্থ বছর নির্ধারণ</option>
									<option value="2017-18">২০১৭-১৮</option>
									<option value="2018-19">২০১৮-১৯</option>
									<option value="2019-20">২০১৯-২০</option>									 
								</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>টাকা</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="টাকার পরিমাণ লিখুন" id="menu_icon" name="budget_amo" minlength="2" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info pull-right" id="smbtn">Submit</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
  </section>  
  <style>
  
	.khattypes, .khats, .inout, .katype2 { display:none; }  
  </style>

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


 
<!--dynamic table initialization  -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>
	var type='';
	var upan='';
	var khattype='';
	function getkhattype(id){
		
		type = id;
		$('.khattypes').hide();
		$('#khattype_id').val('');
		$('#khtattypetype_id').val('');
		$('.katype2').hide(); 
		$('#khat_id').val('');
		$('.khattype'+id+'.upnag'+upan).show();
	}
	function getkhat(id){
		 
		//$('.khats').hide(); 
		//$('#khat_id').val('');
		//$('.khats.khat'+type+'.khattp'+id).show();
		khattype = id;
		 
		$('.katype2').hide(); 
		$('#khtattypetype_id').val('');
		$('.katype2.inout'+type+'.upa'+upan+'.khattp'+id).show();
		//katype2 inout{{$data->khat_id}} upa{{ $data->upangsho_id}} khattp{{ $data->khtattype_id }}
		 
	}

	function getIncomeKhat(id) {

       upan  = id;  
	   $('.inout').show();
	   $('#inout_id').val('');
	   $('#khattype_id').val('');
		$('#khtattypetype_id').val('');
		$('.katype2').hide(); 
		$('#khat_id').val('');
    }
	
	function getkhatfortypetype(id) {
		
		
		$('.khats').hide(); 		
		$('.katype2').hide(); 
		$('#khat_id').val('');
		$('.khats.khat'+type+'.khattp'+khattype+'.khattypetype'+id).show();
	}
	
	var khatid='';
	function khatchange(id) {

       khatid=id;
    }
    
    function yearchange(year) {

        
	   
	   $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "./budget/create",
            data: {'id': khatid, 'year':year},
            success: function (data) {
               
				//alert(data);
				if(data!=0){ $('#smbtn').attr("disabled","disabled"); }else{ $('#smbtn').removeAttr("disabled"); }
            }
        });
    }

</script>

@endsection