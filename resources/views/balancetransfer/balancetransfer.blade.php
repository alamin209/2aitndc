@extends('layouts.admin') 
@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>আর্থিক স্থানন্তর</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/balance_transfer">
                        {{csrf_field()}}
                        
                        
                    <div class="form-group">
						<label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
							<strong>অর্থ বছর</strong></label>
						<div class="col-lg-10">
							<select class="form-control m-bot15"  name="yar" required>
							    <option value="">অর্থ বছর নির্ধারণ</option>
                                {!! $economicalYears !!}
                            </select>
                        </div>
                    </div>
					
					<h4>From</h4>  	<hr>                          
                        <div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
								<strong>ব্যাংক</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" id="fbank_id" name="fbank_id" onchange="getBranch(this.id, this.value)" required>

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
                                <select class="form-control m-bot15" id="fbank_id_br" name="fbranch_id" onchange="getAcc(this.id, this.value)" required>
                                    <option value="">শাখা নির্ধারণ</option>
                                    
                                </select>
                            </div>
                        </div>
                        
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>উপাংশ</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" id="" name="" onchange="getbankdetailsaccourdingtoupangshoid('fbank_id_br', this.value)">
								
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
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>ব্যাংক একাউন্ট নম্বর</strong></label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" id="fbank_id_bracc" name="facc_no" required>
                                    <option value="">ব্যাংক একাউন্ট নম্বর নির্ধারণ</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                            <strong>চেক নম্বর</strong></label>
                            <div class="col-lg-10">
                                <input type="textarea" class="form-control" placeholder="Cheque no" id="" name="chqno">
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                            <strong>taka</strong></label>
                            <div class="col-lg-10">
                                <input type="textarea" class="form-control" placeholder="Amount" id="amount" name="amount" minlength="2" required>
                            </div>
                        </div>
                        
                        
                    <h4>To</h4>   	<hr>   
                        <div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
								<strong>ব্যাংক</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" id="tbank_id" name="tbank_id" onchange="getBranch(this.id, this.value)" required>

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
                                <select class="form-control m-bot15" id="tbank_id_br" name="tbranch_id" onchange="getAcc(this.id, this.value)" required>
                                    <option value="">শাখা নির্ধারণ</option>
                                    
                                </select>
                            </div>
                        </div>
                        
						<div class="form-group">
							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>উপাংশ</strong></label>
							<div class="col-lg-10">
								<select class="form-control m-bot15" id="" name="" onchange="getbankdetailsaccourdingtoupangshoid('tbank_id_br', this.value)">
								
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
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                                <strong>ব্যাংক একাউন্ট নম্বর</strong></label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" id="tbank_id_bracc" name="tacc_no" required>
                                    <option value="">ব্যাংক একাউন্ট নম্বর নির্ধারণ</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
                            <strong>ভাউচার নম্বর</strong></label>
                            <div class="col-lg-10">
                                <input type="textarea" class="form-control" placeholder="Voucher no" id="" name="vouno">
                            </div>
                        </div>
                        
                        

                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
  </section>  
  <style>
  
    .khattypes, .khats, .inout, .fbank_id_br, .tbank_id_br { display:none; }  
  </style>
<!--dynamic table initialization  -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>

	function getbankdetailsaccourdingtoupangshoid(div, id){
        
        
        $('.'+div).hide();
        $('#'+div+'acc').val('');
        $('.'+div+id).show();
    }
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
  function getBranch(div, bank_id) {

    // alert(bank_id);

        $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "./bankdetails/create",
            data: {'bank_id': bank_id},
            success: function (data) {
                $("#"+div+"_br").html(data);  
            }
        });
   }



   function getAcc(div, branch_id) {

       // alert(branch_id);
       
        $.ajaxSetup({ 
            
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "./balance_transfer/create",
            data: {'branch_id': branch_id, 'div':div},
            success: function (data) {
                
                $("#"+div+"acc").html(data);
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