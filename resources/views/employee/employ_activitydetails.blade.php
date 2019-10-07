
<form role="form" class="form-horizontal" method="post" action="'.url('/').'/updatesalary">
    @csrf
    <input type="hidden" name="eid" value= " {{$employee->id }}">

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
            <strong>Department</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" value="{{$employee->department_name }}" disabled>
        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
            <strong>Designation</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="check_no" name="name" required value="{{$employee->degin_name }}" disabled>
        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
            <strong>Name</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="check_no" name="name" required value="{{ $employee->add_full_name }}" disabled>
        </div>
    </div>


    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
            <strong>Basic Salary</strong></label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="vourcher_no" name="salary" required value=" {{ $employee->gross_salary }}">
        </div>
    </div>

    <div class="form-group">
        <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Activity  Type</strong></label>
        <div class="col-lg-10">
            <select class="form-control" id="" name="emp_type"  onchange="getactivity_type(this.value)" required>
                <option value="">Activity  Type*</option>

                <option value="1"  @if($employee->emp_type==1) {{ 'selected'  }}   @endif>Active</option>
                <option value="3"  @if($employee->emp_type==3) {{ 'selected' }}   @endif>Resign </option>
                <option value="4"  @if($employee->emp_type==4) {{ 'selected' }}   @endif>Show Case</option>
                <option   value="5"  @if($employee->emp_type==5) {{ 'selected' }}  @endif>Suspend</option>
                <option  value="6" @if($employee->emp_type==6) {{ 'selected'  }}  @endif>Retire</option>

            </select>
        </div>
    </div>

    <div id="hidden_div" class="form-group" style="margin: 2px; display: none">
        <div class="form-group">
            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Resign Date*</strong></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="resign_date" name="resign_date" required value=" ">

            </div>
        </div>
    </div>



    <div class="form-group">
        <div class="col-lg-12">
            <button class="btn btn-success pull-right" type="submit">Submit</button>
        </div>
    </div>
</form>
<script>
    function getactivity_type(activity_type) {

        alert(activity_type);

        if (activity_type == 3) {

            document.getElementById('hidden_div').style.display = "block";
            $('#student_type').prop("required", true);

        } else {

            document.getElementById('hidden_div').style.display = "none";
            $('#student_type').prop("required", false);


        }
    }
</script>
