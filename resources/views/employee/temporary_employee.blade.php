@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Adjunct Faculty Payment
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
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Employee Type</th>
                                    <th>Mobile  Number</th>
                                    
                                    <th>Email</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($employee as $empl)
                                    @if($empl->id!=0)

                                        <tr class="gradeX">
                                            <td>{{ $empl->emp_id }}</td>
                                            <td>{{ $empl->add_full_name }}</td>
                                            {{--<td>{{ $empl->add_full_name }}</td>--}}
                                            <td>{{ $empl->department_name }}</td>
                                            <td>{{ $empl->degin_name }}</td>
                                            <td> @if($empl->emp_type ==0 )
                                            Temporary
                                                     @else


                                                     Permanent
                                                @endif
                                            </td>
                                            <td>{{ $empl->add_mobile }}</td>
                                            <td>em{{ $empl->add_email }}</td>
                                            <td>

                                                <button class="btn btn-primary btn-xs" onclick="editMenu({{ $empl->id }})"><i class="fa fa-plus"></i></button>
{{--                                                <button class="btn btn-primary btn-xs" onclick="datails({{ $empl->id }})"><i class="fa fa-dollar"></i></button>--}}
{{--                                                <a  href="{{ url('/payment_adjunct_teacher') }}/{{ $empl->id }}"  class="btn btn-primary btn-xs"><i class="fa fa-dollar"></i></a>--}}
{{--                                                <button class="btn btn-danger btn-xs" onclick="deleteMenu();"><i class="fa fa-trash-o "></i></button>--}}

                                            </td>
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
        <div class="modal-dialog" style="width:70%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Temporary Employee Payment</h4>
                </div>
                <div class="modal-body" id="getemp">

                     
                </div>
                <div class="modal-footer">
                     
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    



    <!--dynamic table initialization -->
    <script src="public/js/dynamic_table_init_menu.js"></script>
    <script src="public/js/form-validation-script_add_menu.js"></script>

    <script>


        function editMenu(id) {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

        $.ajax({
            type: "get",
                url: "./assigned_teacher",
            data: {'id': id},
            success: function (data) {
                $('#getemp').html(data);
            }
        });


            $("#myModalDelete").modal();
        }

        // function payment(id) {
        //     $.ajaxSetup({
        //         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        //     });
        //
        //     $.ajax({
        //         type: "get",
        //         url: "./getemployeedetails",
        //         data: {'id': id},
        //         success: function (data) {
        //             $('#getemp').html(data);
        //         }
        //     });
        //
        //
        //     $("#myModalDelete").modal();
        // }
    </script>

@endsection


