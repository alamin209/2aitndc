@extends('layouts.admin')

@section('content')
<section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading heading">
                    Add Salary Progress
                </header>
                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>

                @endif
                <div class="panel-body addfrom">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="">
                        <div class="form-group">
                            @csrf


                            <div class="col-lg-5">
                                <select name="date_to" id="date_to" class="form-control" required>
                                    <option value="">Select Month</option>
                                    <?php

										for ($i = 1; $i <= 12; $i++ ) { $m = $i < 10 ? '0'.$i : $i;

	//                                             
											if(!in_array(date('Y').'-'.$m.'-'.'28', $dates)){

												$date_str = date("F", mktime(0, 0, 0, $m, 10));
												echo '<option value="'.date('Y').'-'.$m.'"';
												if (isset($date_to) && $date_to == date('Y').'-'.$m) {

													echo ' selected ';
												}
												echo '>'.$date_str.'/'.date('Y').'</option>';
											}
										}
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <input type="text" class="form-control"  id="echeck_number" placeholder="Enter Check Number" name="echeck_number"   value="{{ $echeck_number }}" required >

                            </div>

                            <div class="col-lg-3">
                                <button type="submit" name="action"   value="SaveSalery"  class="btn btn-primary pull-right col-lg-offset-1">Save</button>
                                <button type="submit"  name="action"   value="progress"  class="btn btn-info pull-right ">Process</button>
                            </div>
                        </div>
                    </form>

                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    All Employees
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="display table table-bordered" id="myTable">
                            <thead>
                            <tr>

                                <th>Employee Id</th>
                                <th>Employee Name</th>
                                {{--<th>Salary Add</th>--}}
                                {{--<th>Salary deduct</th>--}}
                                {{--<th>Salary Loan</th>--}}
                                <th>Basic  Salary</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($employee as $empl)
                            @if($empl->id!=0)

                            <tr class="gradeX">
                                <td>{{ $empl->emp_id }}</td>
                                <td> {{ $empl->add_full_name }}</td>
                                   <td align="right">{{ $empl->gross_salary }}</td>
                                   {{--<td></td>--}}
                                   {{--<td></td>--}}
                                </tr>
                            @endif
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>
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


