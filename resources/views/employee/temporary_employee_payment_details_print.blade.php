@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Adjunct Faculty Print
                        <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="myTable">
                                <thead>
                                <tr>

                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Degree Name</th>
                                    <th>Subject name</th>
                                    <th>Course Name</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $i=1;
                                @endphp



                                        <tr class="gradeX">

                                            <td>{{ $empl->add_full_name }}</td>
                                            <td>{{ $empl->department_name }}</td>

                                            <td>{{ $empl->subject_names }}</td>
                                            <td>{{ $empl->subject_name }}</td>
                                            <td>{{ $empl->course_name }}</td>

                                        </tr>




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
        function datails(id) {
            alert(id)


                    $.ajaxSetup({
                        headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
                    });

                $.ajax({
                    type: "post",
                   url: "{{ url('/update_adject_details') }}",
                    data: {id: id},
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


