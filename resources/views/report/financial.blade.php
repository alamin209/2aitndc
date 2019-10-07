@extends('layouts.admin') 

@section('content')
  <section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3 style="">Statement of Financial Position</h3>
                </header>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @isset($data)@foreach($data as $k => $v) @php $$k = $v; @endphp @endforeach @endisset
                @php $month = array('01'=>'January', '02'=>'February', '03'=>'March') @endphp
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="">
                        
							{{csrf_field()}}           
                            
                            <div class="col-lg-10">
                                 <label>Date</label>
                                <input class="form-control" type="date" name="sd" required>
                            </div>
                            
                           <!-- <div class="col-lg-5">
                                <label>End Date</label>
                                <input class="form-control" type="date" name="ed" value="@isset($ed){{ $ed }}@endisset">
                            </div> -->
                            
                            <div class="col-lg-2"><br />
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                        </div>  
                    </form>
                </div>
            </section>
        </div>
 
@isset($report)
<div class="row">
        <div class="col-sm-12">
		
            <section class="panel">
                
                <div class="panel-body">
				<button class="pull-right" onclick="getprint('prinarea')">Print</button>
                    <div class="adv-table">
                        
                            
                                 {!! $report !!}
                             
                            

                    </div>
                </div>
            </section>
        </div>
</div>
@endisset  
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
			padding: 2px;
		}
     
    </style>
    
  </section>  
<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>


    function getprint(bankid) {
		
		$('body').html($('#'+bankid).html());
		window.print();
		location.reload(true);
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