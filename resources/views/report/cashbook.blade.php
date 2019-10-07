@extends('layouts.admin') 

@section('content')
  <section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3 style="">Cashbook</h3>
                </header>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @isset($data)@foreach($data as $k => $v) @php $$k = $v; @endphp @endforeach @endisset
                @php $months = array('01'=>'January', '02'=>'February', '03'=>'March') @endphp
                @php $fy = 2019; $yr = date('Y')+1; @endphp
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/cashbook_year">
                        
							{{csrf_field()}}           
                            
                            <div class="col-lg-6">
                                 <label>Financial Year *</label>
								<select name="fyear" id="" class="form-control" required>
                                       <option value="">Select Year</option>
    								   @for($i = $fy; $i <= $yr; $i++)
    										<option value="{{ $i }}" @isset($fyear) @if($fyear == $i){{ ' selected ' }} @endif @endisset>{{ $i.'-'.($i+1) }}</option>
    								   @endfor 
                                    </select>
								
                            </div> 
                            <div class="col-lg-4">
                                 <label>Banks Accounts</label>
								<select name="fbank" id="" class="form-control">
                                       <option value="">Select Bank Account</option>
    								   @foreach($banks as $bnk)
    										<option value="{{ $bnk->bank_details_id }}" @isset($fbank) @if($fbank == $bnk->bank_details_id){{ ' selected ' }} @endif @endisset>{{ $bnk->bank_name }}-{{ $bnk->acc_no }}</option>
    								   @endforeach 
                                </select>
                            </div> 
                            <div class="col-lg-2"><br />
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                          
                    </form>
                    <div class="clearfix"></div>
       <!--             <h5 class="col-md-12" style="border-bottom: 1px solid;padding: 3px;"><strong>or</strong></h5>
                    <hr>
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/cashbook">
                        
							{{csrf_field()}}           
                            
                            <div class="col-lg-3">
                                 <label>Year *</label>
								<select name="year" id="date_to" class="form-control" required>
                                       <option value="">Select Year</option>
                                       <option @isset($year) @if($year == date('Y', strtotime('-1 year'))){{ ' selected ' }} @endif @endisset value="{{ date('Y', strtotime('-1 year')) }}">{{ date('Y', strtotime('-1 year')) }}</option>
                                       <option @isset($year) @if($year == date('Y')){{ ' selected ' }} @endif @endisset value="{{ date('Y') }}">{{ date('Y') }}</option>
                                       <option @isset($year) @if($year == date('Y', strtotime('+1 year'))){{ ' selected ' }} @endif @endisset value="{{ date('Y', strtotime('+1 year')) }}">{{ date('Y', strtotime('+1 year')) }}</option>
                                         
                                    </select>
								
                            </div> 

							<div class="col-lg-3">
                                 <label>Month *</label>
                                <select name="month" id="date_to" class="form-control" required>
                                    <option value="">Select Month</option>
                                    <?php

                                    for ($i = 1; $i <= 12; $i++ ) { 
									
										$m = $i < 10 ? '0'.$i : $i;                                           

										$date_str = date("F", mktime(0, 0, 0, $m, 10));
										echo '<option value="'.$m.'"';
										if (isset($month) && $month == $m) {

											echo ' selected';
										}
										echo '>'.$date_str.'</option>';
                                         
                                    }
                                    ?>
                                </select>
                            </div> 	
                            
                            <div class="col-lg-4">
                                 <label>Banks</label>
								<select name="bank" id="" class="form-control">
                                       <option value="">Select Bank</option>
    								   @foreach($banks as $bnk)
    										<option value="{{ $bnk->bank_id }}" @isset($bank) @if($bank == $bnk->bank_id){{ ' selected ' }} @endif @endisset>{{ $bnk->bank_name }}</option>
    								   @endforeach 
                                </select>
                            </div> 
                            
                            <div class="col-lg-2"><br />
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                        </div>  
                    </form> -->
                </div>
            </section>
        </div>
 </div>

<div class="row">
        <div class="col-sm-12" style="min-height:300px">
		@isset($report)
            <section class="panel">
                
                <div class="panel-body">
				<button class="pull-right" onclick="getprint('prinarea')">Print</button><br><hr>
				
                    <div class="adv-table" id="prinarea">
                        
                            
                                 {!! $report !!}
                             
                       
                        <style>
         
                            .table th{ text-align:center }
                            .brnch, .accnt{ display:none;}
                    		tr.noBorder td {
                    		  border: 0px none;
                    		}
                    		.border{
                    		  border: 1px solid;
                    		}
                    		.adv-table table tr td {
                    			padding: 10px;
                    		}
                    		.table td{ height:60px; }
                            .optionsfield{
                            	position: absolute;
                            	background: #fafafa;
                            	padding: 10px;
                            	width: 96px;
                            	text-align: center;
                            	display: none;
                            	border:1px solid #ccc;
                            }
                            
                            .optionsfieldcredit{
                            	position: absolute;
                            	background: #fafafa;
                            	padding: 10px;
                            	width: 96px;
                            	text-align: center;
                            	display: none;
                            	border:1px solid #ccc;
                            	right:96px;
                            }
                            
                            
                        </style>        

                    </div>
                </div>
            </section>
        @endisset  
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width:80%">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Account</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="return false" onsubmit="updateform(); return false;">
                    
                   
                    <div class="form-group">
                        <label class="control-label col-sm-2">Amount:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="amnt" name="amnt">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Note:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="note"></textarea>
                            
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="id">
                    <input type="hidden" class="form-control" id="type" name="type">
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default pull-right">Submit</button>
                        </div>
                    </div>
                    </form> 
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        
        </div>
    </div>
    
  </section>  
<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>

    function getdebitoptions(id){
        
        $('#debitoptionsfilds'+id).toggle(200);
    }
    function hidedebitoptions(id){
        
        $('#debitoptionsfilds'+id).toggle(100);
    }
    
    function getdebitupdateform(id){
        
        hidedebitoptions(id);
        $('#amnt').val($('#dabitamount'+id).html());
        $('#note').val($('#dabitnote'+id).html());
        $('#type').val('income');
        $('#id').val(id);
        $('#myModal').modal();
    }
    
    
   
    
    function updateform(){
        
        $('#myModal').modal('hide');
        var amount = $('#amnt').val();
        var note = $('#note').val();
        var type = $('#type').val();
        var id = $('#id').val();
       
        
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $.ajax({
            
            type: "post",
            url: "{{url('updateaccounts')}}",
            data: {'id' : id, 'amount' : amount, 'note' : note, 'type' : type},
            success: function (data) {
                
                if(data=='income'){
                    
                    $('#dabitamount'+id).html(amount);
                    $('#dabitnote'+id).html(note);
                }
                if(data=='expense'){
                    
                    $('#creditamount'+id).html(amount);
                    $('#creditnote'+id).html(note);
                }
                location.reload();
                
            }
        });
    }
    
    function getcreditoptions(id){
        
        $('#creditoptionsfilds'+id).toggle(400);
    }
    function hidecreditoptions(id){
        
        $('#creditoptionsfilds'+id).toggle(100);
    }
    
    function getcreditupdateform(id){
        
        hidecreditoptions(id);
        $('#amnt').val($('#creditamount'+id).html());
        $('#note').val($('#creditnote'+id).html());
        $('#type').val('expense');
        $('#id').val(id);
        $('#myModal').modal();
    }
    
    var APP_URL = {!! json_encode(url('/')) !!};
	function getprint(id){
		
		$('body').html($('#'+id).html())
		window.print()
		window.location.replace(APP_URL+"/cashbook")
    }
    var bank_id='';
    function getbranches(bankid) {
        bank_id=bankid;
        $('#selbranch').val('');
        $('.brnch').hide();
        $('#selacc').val('');
        $('.accnt').hide();
        $('.brnch.bank'+bankid).show();
    }
    
    function getaccnts(branchid) {
         
        $('#selacc').val('');
        $('.accnt').hide();
        $('.accnt.bank'+bank_id+'.branch'+branchid).show();
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