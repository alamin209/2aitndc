@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Monthly Salary Sheet </h3>
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
                                            <option value="{{ $roll->id }}">{{ $roll->department_name }}</option>
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
        {{--<div class="row">--}}
            {{--<div class="col-sm-12">--}}
                {{--<section class="panel">--}}
                    {{--<header class="panel-heading">--}}
                        {{--All Employees--}}
                        {{--<span class="tools pull-right">--}}
                        {{--<a href="javascript:;" class="fa fa-chevron-down"></a>--}}
                        {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                    {{--</span>--}}
                    {{--</header>--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="adv-table">--}}
                            {{--<table class="display table table-bordered" id="myTable">--}}
                                {{--<thead>--}}
                                {{--<tr>--}}

                                    {{--<th>Employee Id</th>--}}
                                    {{--<th>Employee Name</th>--}}
{{--                                    <th>Salary Add</th>--}}
{{--                                    <th>Salary deduct</th>--}}
{{--                                    <th>Salary Loan</th>--}}
                                    {{--<th>Basic Salary</th>--}}

                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tbody>--}}

                                {{--@foreach($designations as $dep)--}}
                                    {{--@if($dep->id!=0)--}}

                                        {{--<tr class="gradeX">--}}
                                            {{--<td>{{ $dep->degin_name }}</td>--}}
                                            {{--<td> {{ $dep->department_name }}--}}
                                            {{--</td>--}}
                                            {{--<td>--}}

                                                {{--<button class="btn btn-primary btn-xs" onclick="editMenu();"><i class="fa fa-pencil"></i></button>--}}
                                                {{--<button class="btn btn-danger btn-xs" onclick="deleteMenu();"><i class="fa fa-trash-o "></i></button>--}}

                                            {{--</td>--}}
                                        {{--</tr>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}

                                {{--</tbody>--}}
                            {{--</table>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</section>--}}
            {{--</div>--}}
        {{--</div>--}}
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


