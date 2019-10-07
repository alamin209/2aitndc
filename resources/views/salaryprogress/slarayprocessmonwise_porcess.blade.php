@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Monthly Salary Order Bank</h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{ url('/')}}/SalaryOrderbank">                            <div class="form-group">
                                @csrf


                                <div class="col-lg-9">
                                        <select name="dateto" id="dateto" class="form-control" required>
                                            <option value="">Select Month</option>
                                            <?php


                                            foreach($dates as $dt){
                                            $dat = explode('-', $dt);
                                            $date_str = date("F", mktime(0, 0, 0, (int)$dat[1], 10));  ?>
                                            <option @isset($dateto) @if($dateto == $dt){{ ' selected ' }} @endif @endisset value="{{ $dt }}">{{ $date_str.'/'.$dat[0] }}</option>
                                            <?php }
                                            ?>
                                        </select>
                                </div>



                                <div class="col-lg-3">
                                    <button type="submit" name="action"   value="SaveSalery"  class="btn btn-primary pull-right col-lg-offset-1">Salary Order</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </section>
            </div>
        </div>

		@isset($allsalary)
		   @if($allsalary->count() > 0)
			<div class="row">
				<div class="col-sm-12">
					<section class="panel">
						<header class="panel-heading">
{{--							@php--}}
{{--							--}}
{{--								$dat = explode('-', $dateto);--}}
{{--								$date_str = date("F", mktime(0, 0, 0, (int)$dat[1], 10));   --}}
{{--							@endphp--}}

{{--                            @foreach($departments as $roll)--}}
{{--                                <strong>@if($dep_id==$roll->id )   {{ $roll->department_name }}</strong>--}}
{{--                                @endif--}}
{{--                            @endforeach 	Salary Sheet for, {{ $date_str.' / '.$dat[0] }}--}}
							<span class="tools pull-right">
							<a href="javascript:;" class="fa fa-chevron-down"></a>
							<a href="javascript:;" class="fa fa-times"></a>
						</span>
						</header>
						<div class="panel-body" style="width: 1000px">
                            <button class="btn pull-right" onclick="getprint('printarea')">Print</button>
							<div class="adv-table">


                                <div id="printarea">
                                    @php

                                        $dat = explode('-', $dateto);
                                        $date_str = date("F", mktime(0, 0, 0, (int)$dat[1], 10));
                                    @endphp

{{--                                    @foreach($departments as $roll)--}}
{{--                                        <strong>@if($dep_id==$roll->id )   {{ $roll->department_name }}</strong>--}}
{{--                                        @endif--}}
{{--                                    @endforeach 	Salary Sheet for, {{ $date_str.' / '.$dat[0] }}--}}

                                    <table class="display table table-bordered" id="myTable" style="margin-bottom: 70px;">
                                    <thead>
                                    <tr>

                                        <th>বিষয়</th>
                                        <th>হিসাব নম্বর</th>
                                        <th>চেক নম্বর</th>
                                        <th>টাকার পরিমান</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $netpaytotal=0;
                                    $sl=1;

                                    @endphp
                                    @foreach($allsalary as $dep)

                                        @php

                                        @endphp
                                        <tr class="gradeX">
                                            <td> {{ $dep->department_name }}</td>
                                            <td> {{ $bankdetail->acc_no }}</td>
                                            <td> {{ $dep->echeck_number }}</td>
                                            <td style="text-align: right;"> {{ $dep->salary }}</td>

                                        </tr>
                                        @php
                                            $netpaytotal+=$dep->salary;



                                        @endphp
                                    @endforeach



                                    <tr class="gradeX">


                                        <td colspan="3"><strong>Total Tk=</strong></td>
                                         <td style="text-align: right;">  <strong> {{ $netpaytotal }} </strong></td>

                                    </tr>

                                    </tbody>
                                </table>
                                </div>
                                <div class="row">
                                    <?php
                                    $num=$netpaytotal;
                                    function numberTowords($num)
                                    {
                                        $ones = array(
                                            1 => "one",
                                            2 => "two",
                                            3 => "three",
                                            4 => "four",
                                            5 => "five",
                                            6 => "six",
                                            7 => "seven",
                                            8 => "eight",
                                            9 => "nine",
                                            10 => "ten",
                                            11 => "eleven",
                                            12 => "twelve",
                                            13 => "thirteen",
                                            14 => "fourteen",
                                            15 => "fifteen",
                                            16 => "sixteen",
                                            17 => "seventeen",
                                            18 => "eighteen",
                                            19 => "nineteen"
                                        );
                                        $tens = array(
                                            1 => "ten",
                                            2 => "twenty",
                                            3 => "thirty",
                                            4 => "forty",
                                            5 => "fifty",
                                            6 => "sixty",
                                            7 => "seventy",
                                            8 => "eighty",
                                            9 => "ninety"
                                        );
                                        $hundreds = array(
                                            "hundred",
                                            "thousand",
                                            "million",
                                            "billion",
                                            "trillion",
                                            "quadrillion"
                                        ); //limit t quadrillion
                                        $num = number_format($num,2,".",",");
                                        $num_arr = explode(".",$num);
                                        $wholenum = $num_arr[0];
                                        $decnum = $num_arr[1];
                                        $whole_arr = array_reverse(explode(",",$wholenum));
                                        krsort($whole_arr);
                                        $rettxt = "";
                                        foreach($whole_arr as $key => $i){
                                            if($i < 20){
                                                $rettxt .= $ones[$i];
                                            }elseif($i < 100){
                                                $rettxt .= $tens[substr($i,0,1)];
                                                $rettxt .= " ".$ones[substr($i,1,1)];
                                            }else{
                                                $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
                                                $rettxt .= " ".$tens[substr($i,1,1)];
                                                $rettxt .= " ".$ones[substr($i,2,1)];
                                            }
                                            if($key > 0){
                                                $rettxt .= " ".$hundreds[$key]." ";
                                            }
                                        }
                                        if($decnum > 0){
                                            $rettxt .= " and ";
                                            if($decnum < 20){
                                                $rettxt .= $ones[$decnum];
                                            }elseif($decnum < 100){
                                                $rettxt .= $tens[substr($decnum,0,1)];
                                                $rettxt .= " ".$ones[substr($decnum,1,1)];
                                            }
                                        }
                                        return $rettxt;
                                    }


                                    echo "<p   style='text-align: right'>Total(Amount in word) : <strong>".numberTowords("$num")."</strong></p>";
                                    ?>

                                </div>

							</div>
						</div>
					</section>
				</div>
			</div>
		  @endif
		@endisset
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    </div>
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

    <ol>
        <li>Coffee</li>
        <li>Tea</li>
        <li>Milk</li>
    </ol>
    <script>

        var APP_URL = {!! json_encode(url('/')) !!}

        var detailhead = '<div  class="col-sm-12"><h4 style="text-align: center;">ঢাকা স্কুল অব ইকনোমিকস</h4><h5 style="text-align: center;"> ( ঢাকা বিশ্ববিদ্যালয়ের  অঙ্গীভূত প্রতিষ্ঠান )</h5> <h5 style="text-align: center;">অর্থনীতি সমিতি ভবন ৪/সি ইস্কাটন গার্ডেন রোড, ঢাকা-১০০০,বাংলাদেশ<h5 style="text-align: center;"> dsce.bd.@gmail.com;ওয়েব : www.dscebd.org</h5>' +
                '</div>';

        var detailhead1 = '<div class="row" style="margin-top: 10px;margin-bottom: 30px">প্রাপক,<br/>ব্যাবস্থাপক</br>জনাতা ব্যাংক লিমিটেড<br/>বাংলামোটর শাখা,ঢাকা' +
            '</div>';
        var detailhead2 = '<div class="row" style="margin-top: 10px;margin-bottom: 30px">প্রেরক,<ol><li>পরিচালক <br/>ঢাকা স্কুল অব ইকনোমিকস </li><li>হেড অব এডমিন,ডেভেলপমেন্ট এন্ড একাডেমিক এ্যাফেয়াস<br/> ঢাকা স্কুল অব ইকোনোিকস</li></ol>'+
            '</div>';
        var detailhead3 = '<div class="row" style="margin-top: 10px;margin-bottom: 30px"><strong>বিষয়:-শিক্ষক কর্মকর্তা  ও কর্মচারীদের {{ $date_str.' '.$dat[0] }} মাসের বেতন-ভাতা স্ব স্ব হিসাব নম্বরে প্রদান প্রসঙ্গে  </strong>'+
            '</div>';
        var detailhead4 = '<div class="row" style="margin-top: 10px;margin-bottom: 30px">উপরোক্ত বিষয়ের প্রেক্ষিতে আপনার অবগতির জন্য জানানো যাচ্ছে যে,ঢাকা স্কুল অব ইকনোমিকস-এর শিক্ষক ,কর্মকর্তা   কর্মচারীদের<br/> {{ $date_str.''.$dat[0] }} মাসের বেতন-ভাতা স্ব স্ব হিসাব নম্বরে স্থানান্তরের জন্য নিন্নে ১টি চেক ইস্যু করা হল ।'+
            '</div>';

        var detailhead5 = '<div class="row" style="margin-top: 10px;margin-bottom: 30px"><br/> {{ $date_str.''.$dat[0] }} মাসের বেতন-ভাতা স্ব স্ব হিসাব নম্বরে স্থানান্তরের জন্য নিন্নে ১টি চেক ইস্যু করা হল ।'+
            '</div>';

        var footer =  '<div class="row">' +
            '<div class="col-sm-12">'
            +'<table width="100%"><tr>'
            +'<td width="50%"> মুহাম্মদ সেলিম' +
            '<br/>হেড অব এডমিন,ডেভেলপমেন্ট এন্ড একাডেমিক এ্যাফেয়ার্স </td>'
            +'<td>কাজী খালিকুজ্জাম আহমদ</br>'+
            'পরিচালক (অবৈতনিক)'
            +' ও ' +
            'চেয়ারম্যান,গভর্নিং কাউনসিল<br/>ঢাকা স্কুল অব ইকনোমিকস </td>' +
            '</tr>'+
            '</table>' +
            '</div>'
            + '</div>';


        function getprint(divid) {
            $('#myTable_length').remove();
            $('#myTable_filter').remove();
            $('#myTable_info').remove();
            $('#myTable_paginate').remove();
            $('.bankdetailsaction').remove();
            var html = $('#'+divid).html();
            // var html = $('#'+divid).html();
            ;


            $('body').html('<div style="padding:20px">'+detailhead+detailhead1+detailhead2+detailhead3+detailhead4+html+footer+'</div>');

            window.print();
            //window.location.replace(APP_URL+"/monthly-salary-bill");
        }
    </script>

@endsection


