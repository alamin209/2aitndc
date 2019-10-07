@extends('layouts.admin') 

@section('content')
  <section class="wrapper">
    <section class="panel">
		<header class="panel-heading">
			<h3 style="">Details of Financial Position</h3>
		</header>         
	</section>
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

<script>


    function getprint(bankid) {
		
		$('body').html($('#'+bankid).html());
		window.print();
		location.reload(true);
	} 
</script>

@endsection