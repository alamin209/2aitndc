@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Monthly Salary Sheet</h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{ url('/')}}/employesalaryshet">
                            <div class="form-group">
                                @csrf

                                <div class="col-lg-4">
                                    <select name="dep_id" id="dep_id" class="form-control" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $roll)
                                            <option @if($dep_id==$roll->id ) {{ ' selected ' }} @endif value="{{ $roll->id }}">{{ $roll->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-lg-4">
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
                                    <button type="submit" name="action"   value="SaveSalery"  class="btn btn-primary pull-right col-lg-offset-1">SalarySheet</button>
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

                                    @foreach($departments as $roll)
                                        <strong>@if($dep_id==$roll->id )   {{ $roll->department_name }}</strong>
                                        @endif
                                    @endforeach 	Salary Sheet for, {{ $date_str.' / '.$dat[0] }}

                                    <table class="display table table-bordered" id="myTable" style="margin-bottom: 70px;">
                                    <thead>
                                    <tr>

                                        <th>SI.No</th>
                                        <th>Employee Id</th>
                                        <th>Employee Name</th>
                                        <th>Designation</th>


                                        <th>Account No</th>
                                        <th>Net Payable Salary</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $netpaytotal=0;
                                    $sl=1; $checknumber="";

                                    @endphp
                                    @foreach($allsalary as $dep)

                                        @php

                                            $total          = (int) $dep->gross_salary+(int) $dep->hrent+(int) $dep->medcal+ (int)$dep->convence+$dep->allownce + (int)$dep->bsce_contri;
                                            $totaldeduction = (int)$dep->bsce_contri + (int)$dep->empl_contri + (int)$dep->lninstall + (int)$dep->incometax + (int)$dep->abs_duduct_amount;


                                            $netpay         =  $total - $totaldeduction;
                                            $netpaytotal    += $netpay;
                                        @endphp
                                        <tr class="gradeX">
                                            <td>{{ $sl }}</td>
                                            <td>{{ $dep->emp_id }}</td>
                                            <td> {{ $dep->add_full_name }}</td>
                                            <td> {{ $dep->degin_name }}</td>

                                            @php
                                                $checknumber=$dep->echeck_number;
                                            @endphp
                                            <td> {{ $dep->account_no }}</td>
                                            <td> {{ $netpay }}</td>

                                        </tr>

                                        @php

                                            $sl++;

                                        @endphp
                                    @endforeach



                                    <tr class="gradeX">


                                        <td colspan="4"><strong>Cheque-     {{  $checknumber }}  ; Date:{{ (date('Y-m-d')) }}  </strong></td>
                                        <td><strong>Total Tk=</strong></td>
                                        <td>  <strong> {{ $netpaytotal }} </strong></td>

                                    </tr>

                                    </tbody>
                                </table>
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


    <script>

        var APP_URL = {!! json_encode(url('/')) !!}

        var detailhead = '<div class="col-sm-12"><h4 style="text-align: center;">ঢাকা স্কুল অব ইকনোমিকস</h4><h5 style="text-align: center;"> ( ঢাকা বিশ্ববিদ্যালয়ের  অঙ্গীভূত প্রতিষ্ঠান )</h5> <h5 style="text-align: center;">অর্থনীতি সমিতি ভবন ৪/সি ইস্কাটন গার্ডেন রোড, ঢাকা-১০০০,<h5 style="text-align: center;"> dsce.bd.@gmail.com;ওয়েব : www.dscebd.org</h5>' +
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


            $('body').html('<div style="padding:20px">'+detailhead+html+footer+'</div>');

            window.print();
            //window.location.replace(APP_URL+"/monthly-salary-bill");
        }
    </script>

@endsection


