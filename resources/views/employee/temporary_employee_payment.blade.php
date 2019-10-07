<form role="form" class="form-horizontal" method="post" action="{{url('/') }}/assigned_teacher" enctype="multipart/form-data">

@csrf
      <input type="hidden" value="{{   $employee->id }}"  name="emp_id">
    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Department </strong></label>
        <div class="col-lg-10">
            <select class="form-control m-bot15" id="upangsho_id" name="dept"  readonly=""  disabled  required>
                <option selected="selected">
                    {{ $employee->department_name }}
                </option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Designation </strong></label>
        <div class="col-lg-10">
            <select class="form-control m-bot15" id="upangsho_id" name="dept"  readonly=""  disabled  required>
                <option selected="selected">
                    {{ $employee->degin_name }}
                </option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
            <strong>Full Name</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control"  readonly disabled placeholder="" id="check_no" name="name" required value=" {{ $employee->add_full_name }}">
        </div>
    </div>

{{--    <div class="form-group">--}}
{{--        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Employee Type</strong></label>--}}
{{--        <div class="col-lg-10">--}}
{{--            <select class="form-control" id="" name="emp_type" readonly=" "  disabled required>--}}
{{--                <option value="">Employee Type</option>--}}

{{--                <option @if($employee->emp_type==1)  {{  'selected' }} @endif;  value="1">Permanent</option>--}}
{{--                <option @if($employee->emp_type==0) {{ 'selected' }}   @endif;value="0">Temporary</option>--}}

{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Degree * </strong></label>
        <div class="col-lg-10">
            <select class="form-control m-bot15" name="degree_id" onchange="getdegree(this.value)" required>
                <option value="">Select Degree</option>
                @foreach($degrees as $data)
                    <option value="{{ $data->id }}">{{ $data->subject_name }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>
    <div id="semesterids" class="form-group" style="margin: 2px;">
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Subject * </strong></label>
            <div class="col-lg-10">
                <select class="form-control m-bot15" id="sub_ids"  name="sub_id"   onchange="getcourse(this.value)">
                    <option value="">Select Subject </option>
                </select>
            </div>
        </div>

    </div>
    <div id="detsilsregistation" >

    </div>


     <div class="form-group" id="course_id">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Course </strong></label>
        <div class="col-lg-10">
            <select class="form-control m-bot15" id="course_id" name="course_id"   required>
                <option>Select Course </option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong> Current Position  Details </strong></label>
        <div class="col-lg-10">
            <textarea class="form-control"  placeholder="Details Or the faculty" id="current_position" name="current_position"> {{ old('current_position') }} </textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Lecture No </strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control"  placeholder="How many Lecture He will take ? " id="" name="lecture_no" required value="{{ old('lecture_no') }}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Lecture Duration </strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control"  placeholder="Lecture Duration " id="" name="lecture_duration" required value="{{ old('lecture_duration') }}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Total  Payment </strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control"  placeholder="Lecture No " id="" name="total_payment" required value="{{ old('total_payment') }}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-12">
            <button class="btn btn-success pull-right" type="submit">Submit</button>
        </div>
    </div>


</form>


  <style>
        strong {
            font-weight: 700;
            color: #797979;
        }
    </style>


<script>
    function getdegree(degree_id) {


    $.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
    });

    $.ajax({
        type: "post",
        url: "{{url('/')}}/getcoursewithseme",
        data: {'degree_id': degree_id},
        success: function (data) {

            $("#semesterids").html(data);

         }
        });
    }

    function get_courese(course_id) {


        sub_id  = $("select[name=sub_id]").val();



        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
        });


        $.ajax({
            type: "post",
            url: "{{url('/')}}/getcourses_id",
            data: {'course_id': course_id,sub_id:sub_id },
            success: function (data) {

                $("#course_id").html(data);

            }
        });

    }
    </script>