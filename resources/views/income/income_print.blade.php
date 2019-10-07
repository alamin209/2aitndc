@extends('layouts.admin')

@section('content')

<!--main content start-->
<section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <a href="{{url('/')}}/income">Return To Income</a>
                    <a href="javascript:void(0)" onclick="getprint('print-area')" class="pull-right">Print</a>
                </header>              

                <div class="panel-body" id="print-area">
					<div class="col-md-12">
						<div class="" style="width:15%; float:left"><br><br><br>
							<span style="border:1px solid; padding:10px;">SL # {{ $expence_row->vcher }}</span>
							
						</div>
						<div class="text-center"  style="width:65%; float:left">
						<img src="{{url('/')}}/public/img/index.jpg" width="60" class="pull-left">
							<h4>DHAKA SCHOOL OF ECONOMICS</h4>
							<span>4/C, Eskaton Garden Road, Dhaka-1000, Bangladesh</span><br>
							<span><strong>Income Voucher</strong></span>
						</div>
						<div class="" style="width:20%; float:left">
						<br><br>
						
							@php	
								$mth = explode('-', $expence_row->paydate);							
							@endphp
							<table class="table table-bordered pull-right">
								<tr>
									<td colspan="3">Day     Month    Year</td>									
								</tr>
								<tr>
									<td>{{ $mth[2] }}</td>									
									<td>{{ $mth[1] }}</td>									
									<td>{{ $mth[0] }}</td>			
								</tr>								
							</table>							
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-12">
							<div style="padding:5px 2px; border:1px solid; width:100%; float:left">
								
								<strong>Credit :-</strong> {{$expence_row->type}}
							</div>
							<div style="padding:5px 2px; border:1px solid; width:100%; float:left">
								@if($expence_row->pay_type == 2)
									
									Recieved in Cash / Cheque / PO
								@else
									
									Recieved with Cheque / PO / Cash
								@endif
							</div>
							<div style="padding:5px 2px; border:1px solid; width:100%; float:left">
								
								<strong>Deposited Bank and Branch :</strong> {{ $expence_row->bank_name}}, {{$expence_row->branch_name}}
							</div>
							
							<table class="table table-bordered">
								<tr>
									<th colspan="2">Particular</th>
									<th colspan="">Taka</th>
									<th colspan="">Ps</th>
								</tr>	
								<tr>
									<td colspan="2">{{ $expence_row->note }} </td>
									<td align="right">{{ $expence_row->amount }} </td>
									<td></td>
								</tr>	
								<tr>
									<td>Taka(in words) : {{ convertNumberToWord($expence_row->amount) }} only.</td>
									<td>Total </td>
									<td align="right">{{ $expence_row->amount }} </td>
									<td></td>
								</tr>								
							</table><br><br><br><br>
							<div style="width:100%; text-align:center">
								<span style="border-top:1px solid; width:300px; display:inline-block">Sr. Accounts Officer</span>
							</div>
						</div>
					</div>
					

                </div>
            </section>
        </div>
    </div>
	
	<?php
	
		function convertNumberToWord($num = false){
			
			$num = str_replace(array(',', ' '), '' , trim($num));
			if(! $num) {
				return false;
			}
			$num = (int) $num;
			$words = array();
			$list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
				'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
			);
			$list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
			$list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
				'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
				'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
			);
			$num_length = strlen($num);
			$levels = (int) (($num_length + 2) / 3);
			$max_length = $levels * 3;
			$num = substr('00' . $num, -$max_length);
			$num_levels = str_split($num, 3);
			for ($i = 0; $i < count($num_levels); $i++) {
				$levels--;
				$hundreds = (int) ($num_levels[$i] / 100);
				$hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
				$tens = (int) ($num_levels[$i] % 100);
				$singles = '';
				if ( $tens < 20 ) {
					$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
				} else {
					$tens = (int)($tens / 10);
					$tens = ' ' . $list2[$tens] . ' ';
					$singles = (int) ($num_levels[$i] % 10);
					$singles = ' ' . $list1[$singles] . ' ';
				}
				$words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
			} //end for loop
			$commas = count($words);
			if ($commas > 1) {
				$commas = $commas - 1;
			}
			return implode(' ', $words);
		}
	
	?>
	
	
    <!-- modal -->

</section>
<!--main content end-->
<script>
	var APP_URL = {!! json_encode(url('/')) !!};
	function getprint(id){
		
		$('body').html($('#'+id).html())
		window.print()
		window.location.replace(APP_URL+"/income")
	}
</script>

@endsection


