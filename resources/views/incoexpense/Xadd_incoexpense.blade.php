@extends('layouts.admin') 
@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>আয়/ব্যয় সংযুক্তি</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/incoexpense">
                        {{csrf_field()}}
                        
                        
                        
                        <!--start-->
                        
                        <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>উপাংশ</strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" id="upangsho_id" name="upangsho_id" onchange="getIncomeKhat(this.value)">
                                    
										<option value="">উপাংশ নির্ধারণ</option>
                                        @foreach($upangshos as $data)
                                           @if($data->upangsho_id!=0)
                                        <option value="{{$data->upangsho_id}}">{{$data->upangsho_name}}</option>
                                        @endif
                                        @endforeach                                     
                                    </select>
                                </div>
                        </div>
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

										<option class="khattypes khattype{{$data->khat_id}} upnag{{$data->upangsho_id}}" value="{{$data->tax_id}}">{{$data->tax_name}}
										</option>

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
								<select class="form-control m-bot15" id="khat_id" name="khat_id">

									<option value="">খাত  নির্ধারণ</option>
									@foreach($khat as $data)

										<option class="khats khat{{ $data->khattype }} khattp{{ $data->tax_type_id }} khattypetype{{ $data->tax_type_type_id }}" value="{{ $data->khat_id }}">{{$data->serilas}} {{$data->khat_name}}</option>
									@endforeach
									
								</select>
							</div>
						</div>
                        
                        <!--end-->
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                     
                        
                        
                       
                        
                        
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>খাতের বিবরণ</strong></label>
                            <div class="col-lg-10">
                                <input type="textarea" class="form-control" placeholder="খাতের বিবরণ" id="khat_des" name="khat_des" minlength="2" required>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>অর্থ বছর</strong></label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" name="year" required>

                                    <option value="">অর্থ বছর নির্ধারণ</option>
                                    <option value="2017-18">২০১৭-১৮</option>
                                    <option value="2018-19">২০১৮-১৯</option>
                                    <option value="2019-20">২০১৯-২০</option>                                     
                                </select>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                       
                          
                        <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                    <strong>ব্যাংক</strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" id="bank_id" name="bank_id" onchange="getBranch(this.value)" required>

                                        <option value="">ব্যাংক নির্ধারণ</option>
                                            @foreach($bank as $data)
                                                <option value="{{$data->bank_id}}">{{$data->bank_name}}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>শাখা</strong></label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" id="branch_id" name="branch_id" onchange="getAcc(this.value)" required>
                                    <option value="">শাখা নির্ধারণ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>ব্যাংক একাউন্ট নম্বর</strong></label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" id="acc_no" name="acc_no" required>
                                    <option value="">ব্যাংক একাউন্ট নম্বর নির্ধারণ</option>
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>ভাউচার নম্বর/চালান</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="ভাউচার নম্বর/চালান" id="vourcher_no" name="vourcher_no" minlength="2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>চেক নম্বর</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="চেক নম্বর" id="check_no" name="check_no" minlength="2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>টাকা</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="টাকার পরিমাণ লিখুন" id="amount" name="amount" minlength="2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>তারিখ</strong></label>
                            <div class="col-lg-10">
                                <input type="date" class="form-control" placeholder="প্রারম্ভিক স্থিতি" id="curr_date" name="curr_date" minlength="2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>প্রাপক</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="প্রাপকের নাম" id="receive_date"  name="receiver_name" minlength="2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>প্রাপ্তি তারিখ</strong></label>
                            <div class="col-lg-10">
                                <input type="date" class="form-control" placeholder="প্রারম্ভিক স্থিতি" id="receive_date" name="receive_date" minlength="2" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>মন্তব্য</strong></label>
                            <div class="col-lg-10">
                                <input type="textarea" class="form-control" placeholder="মন্তব্য" id="note" name="note" minlength="2" required>
                            </div>
                        </div>
                        <!-- end -->

                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
  </section>  
  <style>
  
    .khattypes, .khats, .inout{ display:none; }  
  </style>
<!--dynamic table initialization  -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>
    var type='';
    var upan='';
    function getkhattype(id){
        
        type = id;
        $('.khattypes').hide();
        $('#khattype_id').val('');
        $('.khattype'+id+'.upnag'+upan).show();
    }
    function getkhat(id){
         
        $('.khats').hide(); $('#khat_id').val('');
        $('.khats.khat'+type+'.khattp'+id).show();
         
    }

    function getIncomeKhat(id) {

       upan  = id;  
       $('.inout').show();
    }
    
    function getkhatfortypetype(id) {

       //alert(id);
       
       $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "./budget/create",
            data: {'id': id},
            success: function (data) {
                $("#khat_id").html(data);  
                
            }
        });
    }

 

</script>
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
  function getBranch(bank_id) {

    // alert(bank_id);

        $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "./bankdetails/create",
            data: {'bank_id': bank_id},
            success: function (data) {
                $("#branch_id").html(data);  
            }
        });
   }



   function getAcc(branch_id) {

       // alert(branch_id);
       
       $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "./incoexpense/create",
            data: {'branch_id': branch_id},
            success: function (data) {
                $("#acc_no").html(data);  

                console.log(data);
                
            }
        });
    }


</script>
<!--end-->


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
	
	function jhghj(id) {

       //alert(id);
	   
	   $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "./budget/create",
            data: {'id': id},
            success: function (data) {
                $("#khat_id").html(data);  
				
            }
        });
    }

</script>
@endsection