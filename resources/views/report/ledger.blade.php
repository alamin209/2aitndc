@extends('layouts.admin') 

@section('content')
  <section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3 style="">Ledger</h3>
                </header>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @isset($data)@foreach($data as $k => $v) @php $$k = $v; @endphp @endforeach @endisset
                @php $fy = 2019; $yr = date('Y')+1; @endphp
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="ledger">
                        
							{{csrf_field()}}           
                            
                            <div class="col-lg-2">
                                 <label>Year</label>
								<select name="year" id="" class="form-control" required>
								   
								   <option value="">Select Year</option>
								   @for($i = 2019; $i <= $yr; $i++)
										<option value="{{ $i }}" @isset($year) @if($year == $i){{ ' selected' }} @endif @endisset>{{ $i.'-'.($i+1) }}</option>
								   @endfor 
								</select>
                            </div> 

							<div class="col-lg-3">
                                <label>Account</label>
                                <select name="acctype" id="" class="form-control" required onchange="getTypes(this.value)">
                                    <option value="">Select Account Type</option>
                                    <option value="1" @isset($acctype) @if($acctype == 1){{ ' selected' }} @endif @endisset>Income</option>
                                    <option value="2" @isset($acctype) @if($acctype == 2){{ ' selected' }} @endif @endisset>Expense</option>
                                </select>
                            </div> 
                            
                            <div class="col-lg-5">
                                <label>Account</label>
                                <select name="acc" id="" class="form-control" required>
                                    <option value="">Select Account</option>
                                    <option class="types type1" value="all" @isset($acc) @if($acc == 'all1') {{ ' selected' }} @endif @endisset>All</option>
                                    <option class="types type2" value="all" @isset($acc) @if($acc == 'all2') {{ ' selected' }} @endif @endisset>All</option>
                                    @foreach($in_types as $in)
                                        <option class="types type1" value="{{$in->id}}" @isset($acc) @if($acc == $in->id.'1'){{ ' selected' }} @endif @endisset>{{$in->type}}</option>
                                    @endforeach
                                    @foreach($ex_types as $ex)
                                        <option class="types type2" value="{{$ex->id}}" @isset($acc) @if($acc == $ex->id.'2'){{ ' selected' }} @endif @endisset>{{$ex->type}}</option>
                                    @endforeach
                                </select>
                            </div> 	
                            
                            <div class="col-lg-2"><br />
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                         
                    </form>
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
                    </div>
                </div>
            </section>
        
            <style>
                .types{ display:none; }
                .type{{$acctype}}{ display:block; }
            </style>
        @else
            <style>
                .types{ display:none; }
            </style>
        @endisset  
        </div>
    </div>
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
         
    </style>
    
  </section>  
<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>

    function getTypes(id) {
        
		$('.types').hide();
		$('.types.type'+id).show();
	}

    var APP_URL = {!! json_encode(url('/')) !!};
    function getprint(bankid) {
		
		$('body').html($('#'+bankid).html());
		window.print();
		window.location.replace(APP_URL+"/ledger")
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