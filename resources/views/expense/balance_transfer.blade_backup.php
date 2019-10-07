@extends('layouts.admin')

@section('content')


<!--main content start-->
<section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">

            <section class="panel">
                <header class="panel-heading">
                    <b style="color:blue;">  Balance Transfer </b>
                </header>

                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif

                <div class="panel-body" style="background:#008B8B;color:white; ">
                    <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  
                          action="{{url('/')}}/balanceTransfer" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Transfer Type *</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="paymentType" id="payType" onchange="showDiv(this)" required> 
                                    <option value="">Select Transfer Type</option>
                                    <option value="1">Cash </option>
                                    <option value="2">Bank</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Source Bank *</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="s_bank" id="s_bank" onchange="getSourceBranch(this.value)"  required>  
                                    <option value="">Select Transfer Bank</option>

                                    @foreach($bank as $data)
                                    <option value="{{$data->bank_id}}">{{$data->bank_name}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="getbranchfields" style="display:none">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Source Banch *</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="s_bank_branch" id="s_bank_branch" onchange="getSourceBranchAccount(this.value)"  required> <!-- input-sm m-bot15  -->
                                    <option value="">Select Banch</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="getaccnofields" style="display:none">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Source Bank Account *</label>
                            <div class="col-lg-10">
                                <select class="form-control  m-bot15"  name="s_bank_act" id="s_bank_act" required="true"> <!-- input-sm m-bot15  -->
                                    <option value="">Select Bank Account</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Target Bank *</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="t_bank" id="t_bank" onchange="getTargetBranch(this.value)"  required>
                                    <option value="">Select Received Bank</option>

                                    @foreach($bank as $data)
                                    <option value="{{$data->bank_id}}">{{$data->bank_name}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="getbranchfieldster" style="display:none">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Target Branch *</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="t_bank_branch" id="t_bank_branch" onchange="getTargetBranchAccount(this.value)" required> 
                                    <option value="">Select Received Branch</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="getaccnofieldster" style="display:none">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Target Bank Account *</label>
                            <div class="col-lg-10">
                                <select class="form-control  m-bot15"  name="t_bank_act" id="t_bank_act" required="true"> <!-- input-sm m-bot15  -->
                                    <option value="">Select Target Account</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"> Amount *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Enter Amount" id="amount" name="amount"  required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Cheque Upload *</label>
                            <div class="col-lg-10">
                                <input required="true" type="file" name="checkupload" id="signature" accept="image/*"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Note *</label>
                            <div class="col-lg-10">
                                <textarea required="true" class="form-control" placeholder="Enter Note" id="note" name="note"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Date *</label>
                            <div class="col-lg-10">
                                <input required="true" type="date" class="default-date-picker form-control" placeholder="Enter Date" id="deduct_date"  name="trnsferdate">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </form>

                </div>
            </section>
        </div>
    </div>

</section>
<!--main content end-->

<script>

    function showDiv(select) {
        if (select.value == 1) {
            document.getElementById('getaccnofields').style.display = "none";
            document.getElementById('getaccnofieldster').style.display = "none";
        } else {
            document.getElementById('getaccnofields').style.display = "block";
            document.getElementById('getaccnofieldster').style.display = "block";
        }
    }

    function getSourceBranch(bank_id) {

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
        });

        $.ajax({
            type: "post",
             url: "{{url('/')}}/getbranches",
            data: {'bank_id': bank_id},
            success: function (data) {
                if (bank_id != 'cash' && bank_id != '') {
                    $("#getbranchfields").show();
                    $("#s_bank_branch").html(data);
                } else {
                    $("#getbranchfields").hide();
                    $("#getaccnofields").hide();
                }
            }
        });
    }

    function getSourceBranchAccount(account_id) {

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/get_acounts_details",
            data: {'account_id': account_id},
            success: function (data) {
                if (account_id != 'cash' && account_id != '') {
                    $("#getaccnofields").show();
                    $("#s_bank_act").html(data);
                } else {
                    $("#getaccnofields").hide();
                }
                if (($("#payType").val()) == '1') {
                    $('#s_bank_act').prop('required', false);
                    $("#getaccnofields").hide();
                }
            }
        });
    }

    function getTargetBranch(bank_id) {

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/getbranches",
            data: {'bank_id': bank_id},
            success: function (data) {
                if (bank_id != 'cash' && bank_id != '') {
                    $("#getbranchfieldster").show();
                    $("#t_bank_branch").html(data);
                } else {
                    $("#getbranchfieldster").hide();
                    $("#getaccnofieldster").hide();
                }
            }
        });
    }

    function getTargetBranchAccount(account_id) {

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/get_acounts_details",
            data: {'account_id': account_id},
            success: function (data) {
                if (account_id != 'cash' && account_id != '') {
                    $("#getaccnofieldster").show();
                    $("#t_bank_act").html(data);
                } else {
                    $("#getaccnofieldster").hide();
                }
                if (($("#payType").val()) == '1') {
                    $('#t_bank_act').prop('required', false);
                    $("#getaccnofieldster").hide();
                }
            }
        });
    }
</script>

@endsection
