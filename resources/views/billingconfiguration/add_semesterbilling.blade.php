@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Process Semester billing  </h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/semester-billing" enctype="multipart/form-data" >
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

                            <div id="semesterid">
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

                            </div>
                            <div id="semesterids" class="form-group" style="margin: 2px;">
{{--                                <div class="form-group">--}}
{{--                                    <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Select Semester *</strong></label>--}}
{{--                                    <div class="col-lg-10">--}}
{{--                                        <select class="form-control m-bot15" id="degress"  name="semester_id"  >--}}
{{--                                            <option value="">Select Semester </option>--}}
{{--                                            <?php $position=array('','st','nd','rd','th'); ?>--}}
{{--                                            @for($i=1;$i<5;$i++)--}}
{{--                                            <option value="{{ $i }}{{ $position[$i] }}">{{ $i }}{{  $position[$i]}}</option>--}}
{{--                                                @endfor--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>
                            <div id="semesterids" class="form-group" style="margin: 2px;">
                                <div class="form-group">
                                    <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Year *</strong></label>
                                    <div class="col-lg-10">
                                        <input type="date" class="form-control" placeholder=" Give the year " id="transcript" name="sem_year" value="" required>
                                    </div>
                                </div>

                            </div>

                            <div id="detsilsregistation" >

                            </div>
                            <br/>
                            <br/>


                            <button type="submit" class="btn btn-info pull-right">process</button>
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

            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            $.ajax({
                type: "post",
                url: "{{url('/')}}/getSubject",
                data: {'degree_id': degree_id},
                success: function (data) {
                    $("#semesterid").html(data);
                }
            });

        }



    </script>

@endsection


