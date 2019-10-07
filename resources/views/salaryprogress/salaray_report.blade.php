@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Salary Progress Report</h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{ url('/')}}/salary_report/details">
                            <div class="form-group">
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
									<button type="submit" name="action" value="delete" class="btn btn-primary pull-right col-lg-offset-1">Delete</button>                                    
									<button type="submit"  name="action"   value="report"  class="btn btn-info pull-right ">Report</button>
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
							@php
							
								$dat = explode('-', $dateto);
								$date_str = date("F", mktime(0, 0, 0, (int)$dat[1], 10));   
							@endphp
						
							Salary Report, {{ $date_str.' / '.$dat[0] }}
							<span class="tools pull-right">
							<a href="javascript:;" class="fa fa-chevron-down"></a>
							<a href="javascript:;" class="fa fa-times"></a>
						</span>
						</header>
						<div class="panel-body" style="width: 1000px">
							<div class="adv-table" >


                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                    <tr>

                                        <th>Employee Id</th>
                                        <th>Employee Name</th>
                                        <th>Designation</th>
                                        <th>Total Basic Salary</th>
                                        <th>House Rent</th>
                                        <th>Medical</th>
                                        <th>Conveyannce</th>
                                        <th>Allowances</th>
                                        <th>DscE Contribute P/F</th>
                                        <th>Total Salary</th>

                                        <th>DscE Contribute P/F</th>
                                        <th>Employee Contribute P/F</th>
                                        <th>Employee Loan from P/F Adjusted</th>
                                        <th>Absent Deduct</th>
                                        <th>Income TAX</th>
                                        <th>Total Deduction</th>
                                        <th>Net Payable Salary</th>
                                        <th>Account No</th>
                                        <th>Signature</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $netpaytotal=0;

                                    @endphp
                                    @foreach($allsalary as $dep)

                                        @php

                                            $total = (int) $dep->gross_salary+(int) $dep->hrent+(int) $dep->medcal+ (int)$dep->convence+$dep->allownce + (int)$dep->bsce_contri;
                                            $totaldeduction = (int)$dep->bsce_contri + (int)$dep->empl_contri + (int)$dep->lninstall + (int)$dep->incometax + (int)$dep->abs_duduct_amount;


                                            $netpay = $total - $totaldeduction;
                                        $netpaytotal+=$netpay;
                                        @endphp
                                        <tr class="gradeX">
                                            <td>{{ $dep->emp_id }}</td>
                                            <td> {{ $dep->add_full_name }}</td>
                                            <td> {{ $dep->degin_name }}</td>
                                            <td> {{ $dep->gross_salary }}</td>
                                            <td> {{ $dep->hrent }}</td>
                                            <td> {{ $dep->medcal }}</td>
                                            <td> {{ $dep->convence }}</td>
                                            <td> {{ $dep->allownce }}</td>
                                            <td> {{ $dep->bsce_contri }}</td>
                                            <td> {{ $total }}</td>
                                            <td> {{ $dep->bsce_contri }}</td>
                                            <td> {{ $dep->empl_contri }}</td>
                                            <td> {{ (int) $dep->lninstall }}</td>
                                            <td> {{ (int) $dep->abs_duduct_amount }}</td>
                                            <td> {{ $dep->incometax }}</td>
                                            <td> {{ $totaldeduction }}</td>
                                            <td> {{ $netpay }}</td>
                                            <td> {{ $dep->accno }}</td>
                                            <td> </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script>

        $(document).ready(function() {
            $('#example').DataTable( {
                "scrollX": true,

            } );
        } );


        function getdegree(degree_id) {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

        $.ajax({
            type: "get",
            url: "{{url('/')}}/getSubject",
            data: {'degree_id': degree_id},
            success: function (data) {
                $("#degress").html(data);
            }
        });


        // $("#myModalEdit").modal();
        }

    </script>

@endsection


