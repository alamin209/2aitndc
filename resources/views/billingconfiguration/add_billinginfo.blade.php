@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Add or Update New  Billing info </h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/billingconfigureupdate" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Degree *</strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" id="deg_id" name="deg_id" onchange="getdegree(this.value)" required>

                                        <option value="">Select Degree </option>
                                        @foreach($degrees as $data)
                                            <option value="{{ $data->id }}">{{ $data->subject_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div id="hidden_div" class="form-group" style="margin: 2px;">
                                <div class="form-group">
                                    <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select  Student Type*</strong></label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15"  id="student_type" name="student_type" onchange="" >

                                            <option value="">Select Student Type </option>
                                            <option value="1">Dhaka University </option>
                                            <option value="2">Non Dhaka University </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="semesterids" class="form-group" style="margin: 2px;">
                                <div class="form-group">
                                    <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Subject *</strong></label>
                                    <div class="col-lg-10">
                                        <select class="form-control m-bot15" id="degress"  name="sub_id"  >
                                            <option value="">Select Subject </option>
                                        </select>
                                    </div>
                                </div>

                           </div>
                            <div id="detsilsregistation" >

                            </div>
                            <br/>
                            <br/>


                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>

        <div id="bacholer">
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



    <!--dynamic table initialization -->
    <script src="public/js/dynamic_table_init_menu.js"></script>
    <script src="public/js/form-validation-script_add_menu.js"></script>

    <script>


        function getdegree(degree_id) {

            if (degree_id == 1) {

                document.getElementById('hidden_div').style.display = "block";
                $('#student_type').prop("required", true);

            }
            else {

                document.getElementById('hidden_div').style.display = "none";
                $('#student_type').prop("required", false);



            }
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            $.ajax({
                type: "post",
                url: "{{url('/')}}/getSubjecbillingt",
                data: {'degree_id': degree_id},
                success: function (data) {
                    $("#semesterids").html(data);
                }
            });

        }

        function subjectid(degree_id) {


            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            var student_type;
            var subjectid=$('#degress').val();
            var deg_id=$('#deg_id').val();
            var student_type=$('#student_type').val();

            if(deg_id =="3"){

                student_type=3
            }
            else if(deg_id =="4"){

                student_type=4
            }


            $.ajax({
                type: "post",
                url: "{{url('/')}}/get_student_session",
                data: {'subjectid': subjectid,'student_type':student_type,'deg_id':deg_id},
                success: function (data) {

                    $("#detsilsregistation").html(data);

                }
            });

        }
    </script>

@endsection


