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
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Transfer Type *</label>
                            <div class="col-lg-10">

                                <select class="form-control" name="paymentType" id="payType" onchange="showDiv(this)" required> 
                                    <option value="">Select Transfer Type</option>
                                    <option value="3">Bank to Bank </option>
                                    <option value="4">Bank to Bank Cash</option>
                                    <option value="5">Bank to Cash</option>
                                    <option value="6">Cash to Bank</option>
                                    <option value="7">Cash to Bank Cash</option>
                                    <option value="8">Bank Cash to Bank</option>
                                    <option value="9">Bank Cash to Bank Cash</option>
                                </select>
                                
                            </div>
                        </div>
                        <div id="s_bank_div" style="display:none">
                            <div id="" class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Source Bank *</label>
                                <div class="col-lg-10">
                                    <select class="form-control sbank" name="s_bank" id="s_bank" onchange="getSourceBranch(this.value)"  required>  
                                        <option value="">Select Source Bank</option>
                                        @foreach($bank as $data)
                                            <option value="{{$data->bank_id}}">{{$data->bank_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Source Banch *</label>
                                <div class="col-lg-10">
                                    <select class="form-control sbank" name="s_bank_branch" id="s_bank_branch" onchange="getSourceBranchAccount(this.value)"  required>
                                        <option value="">Select Banch</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Source Bank Account *</label>
                                <div class="col-lg-10">
                                    <select class="form-control  m-bot15 sbank"  name="s_bank_act" id="s_bank_act" required>
                                        <option value="">Select Bank Account</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="s_bcash_div" style="display:none">
                            
                            <div id="" class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Source Bank *</label>
                                <div class="col-lg-10">
                                    <select class="form-control sbcash" name="s_bank" id="s_bank" onchange="getSourceCashBranch(this.value)"  required>  
                                        <option value="">Select Source Bank</option>
                                        @foreach($bank as $data)
                                            <option value="{{$data->bank_id}}">{{$data->bank_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Source Banch *</label>
                                <div class="col-lg-10">
                                    <select class="form-control sbcash" name="s_bank_branch" id="s_cash_branch" onchange="getSourceBranchCashAccount(this.value)"  required>
                                        <option value="">Select Banch</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Source Bank Cash Account*</label>
                                <div class="col-lg-10">
                                    <select class="form-control  m-bot15 sbcash"  name="s_bank_act" id="s_cash_act" required>
                                        <option value="">Select Source Bank Cash Account</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div id="t_bank_div" style="display:none">
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Target Bank *</label>
                                <div class="col-lg-10">
                                    <select class="form-control tbank" name="t_bank" id="t_bank" onchange="getTargetBranch(this.value)"  required>
                                        <option value="">Select Target Bank</option>
    
                                        @foreach($bank as $data)
                                        <option value="{{$data->bank_id}}">{{$data->bank_name}}</option>
                                        @endforeach
    
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Target Branch *</label>
                                <div class="col-lg-10">
                                    <select class="form-control tbank" name="t_bank_branch" id="t_bank_branch" onchange="getTargetBranchAccount(this.value)" required> 
                                        <option value="">Select Received Branch</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Target Bank Account *</label>
                                <div class="col-lg-10">
                                    <select class="form-control  m-bot15 tbank"  name="t_bank_act" id="t_bank_act" required>
                                        <option value="">Select Target Account</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="t_bcash_div" style="display:none">
                            
                            <div id="" class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Target Bank *</label>
                                <div class="col-lg-10">
                                    <select class="form-control tbcash" name="t_bank" id="t_cash_bank" onchange="getTargetCashBranch(this.value)"  required>  
                                        <option value="">Select Target Bank</option>
                                        @foreach($bank as $data)
                                            <option value="{{$data->bank_id}}">{{$data->bank_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Target Banch *</label>
                                <div class="col-lg-10">
                                    <select class="form-control tbcash" name="t_bank_branch" id="t_cash_branch" onchange="gettargetBranchCashAccount(this.value)"  required>
                                        <option value="">Select Target Banch</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Target Bank Cash *</label>
                                <div class="col-lg-10">
                                    <select class="form-control  m-bot15 tbcash"  name="t_bank_act" id="t_cash_act" required>
                                        <option value="">Select Target Bank Cash Account</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Amount *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Enter Amount" id="amount" name="amount"  required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Cheque Upload</label>
                            <div class="col-lg-10">
                                <input type="file" name="checkupload" id="signature" accept="image/*"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Note</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" placeholder="Enter Note" id="note" name="note"></textarea>
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
        
        if (select.value == 3) {
            $('#s_bcash_div').hide();
            $('#t_bcash_div').hide();
            $('#s_bank_div').show();
            $('#t_bank_div').show();
            
            $('.sbcash').removeAttr('required');
            $('.tbcash').removeAttr('required');
            $('.sbank').attr('required', 'required');
            $('.tbank').attr('required', 'required');
            $("#s_bcash_div select").attr('disabled','disabled');
            $("#t_bcash_div select").attr('disabled','disabled');
            
            $("#s_bank_div select").removeAttr('disabled');
            $("#t_bank_div select").removeAttr('disabled');
        } else if (select.value == 4) {
            
            $('#s_bank_div').show();
            $('#t_bank_div').hide();
            $('#s_bcash_div').hide();
            $('#t_bcash_div').show();
            
            $('.sbcash').removeAttr('required');
            $('.tbank').removeAttr('required');
            $('.sbank').attr('required', 'required');
            $('.tbcash').attr('required', 'required');
            $("#t_bank_div select").attr('disabled','disabled');
            $("#s_bcash_div select").attr('disabled','disabled');
            
            $("#s_bank_div select").removeAttr('disabled');
            $("#t_bcash_div select").removeAttr('disabled');
        } else if (select.value == 5) {
            
            $('#s_bcash_div').hide();
            $('#t_bcash_div').hide();
            $('#s_bank_div').show();
            $('#t_bank_div').hide();
            
            $('.sbcash').removeAttr('required');
            $('.tbank').removeAttr('required');
            $('.tbcash').removeAttr('required');
            
             
            $('.sbank').attr('required', 'required');
            
            $("#t_bank_div select").attr('disabled','disabled');
            $("#s_bcash_div select").attr('disabled','disabled');
            $("#t_bcash_div select").attr('disabled','disabled');
            
            $("#s_bank_div select").removeAttr('disabled');
            
        } else if (select.value == 6) {
            
            $('#s_bcash_div').hide();
            $('#t_bcash_div').hide();
            $('#s_bank_div').hide();
            $('#t_bank_div').show();
            
            $('.sbcash').removeAttr('required');
            $('.sbank').removeAttr('required');
            $('.tbcash').removeAttr('required');
            
             
            $('.tbank').attr('required', 'required');
            
            $("#s_bank_div select").attr('disabled','disabled');
            $("#s_bcash_div select").attr('disabled','disabled');
            $("#t_bcash_div select").attr('disabled','disabled');
            
            $("#t_bank_div select").removeAttr('disabled');
            
            
        } else if (select.value == 7) {
            
            $('#s_bcash_div').hide();
            $('#t_bcash_div').show();
            $('#s_bank_div').hide();
            $('#t_bank_div').hide();
            
            $('.sbcash').removeAttr('required');
            $('.sbank').removeAttr('required');
            $('.tbank').removeAttr('required');
            
             
            $('.tbcash').attr('required', 'required');
            
            $("#s_bank_div select").attr('disabled','disabled');
            $("#s_bcash_div select").attr('disabled','disabled');
            $("#s_bcash_div select").attr('disabled','disabled');
            
            $("#t_bcash_div select").removeAttr('disabled');
            
        } else if (select.value == 8) {
            
            $('#s_bcash_div').show();
            $('#t_bcash_div').hide();
            $('#s_bank_div').hide();
            $('#t_bank_div').show();
            
            $('.tbcash').removeAttr('required');
            $('.sbank').removeAttr('required');
            $('.sbcash').attr('required', 'required');
            $('.tbank').attr('required', 'required');
            
            $("#t_bcash_div select").attr('disabled','disabled');
            $("#s_bank_div select").attr('disabled','disabled');
            
            $("#s_bcash_div select").removeAttr('disabled');
            
            $("#t_bank_div select").removeAttr('disabled');
            
            
        } else if (select.value == 9) {
            
            $('#s_bcash_div').show();
            $('#t_bcash_div').show();
            $('#s_bank_div').hide();
            $('#t_bank_div').hide();
            
            $('.tbank').removeAttr('required');
            $('.sbank').removeAttr('required');
            $('.sbcash').attr('required', 'required');
            $('.tbcash').attr('required', 'required');
            
            $("#t_bank_div select").attr('disabled','disabled');
            $("#s_bank_div select").attr('disabled','disabled');
            
            $("#s_bcash_div select").removeAttr('disabled');
            
            $("#t_bcash_div select").removeAttr('disabled');
            
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
                
                $("#source_branch_field").show();
                $("#s_bank_branch").html(data);
                
            }
        });
    }
    
    function getTargetCashBranch(bank_id) {

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/getbranches",
            data: {'bank_id': bank_id},
            success: function (data) {
                
                
                $("#t_cash_branch").html(data);
                
            }
        });
    }
    
    function getSourceCashBranch(bank_id) {

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/getbranches",
            data: {'bank_id': bank_id},
            success: function (data) {
                
                
                $("#s_cash_branch").html(data);
                
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
                
                $("#source_account_field").show();
                $("#s_bank_act").html(data);
                
                if (($("#payType").val()) == '8'){
                    
                    $("#source_account_field").hide();
                }else if (($("#payType").val()) == '9'){
                    
                    $("#source_account_field").hide();
                }
            }
        });
    }
    
    function getSourceBranchCashAccount(account_id) {

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/get_cashacounts_details",
            data: {'account_id': account_id},
            success: function (data) {
                
                $("#s_cash_act").html(data);
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
                
                $("#target_branch_field").show();
                $("#t_bank_branch").html(data);
                

                if (($("#payType").val()) == '5') {
                    $('#t_bank_branch').prop('required', false);
                    $('#t_bank_act').prop('required', false);
                    $("#target_branch_field").hide();
                    $("#target_account_field").hide();
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
                 
                $("#target_account_field").show();
                $("#t_bank_act").html(data);
                
                if (($("#payType").val()) == '4') {
                    $('#t_bank_act').prop('required', true);
                    $("#target_account_field").show();
                } else if (($("#payType").val()) == '5') {
                    $('#t_bank_branch').prop('required', false);
                    $('#t_bank_act').prop('required', false);
                    $("#target_branch_field").hide();
                    $("#target_account_field").hide();
                } else if (($("#payType").val()) == '7') {
                    $("#target_account_field").hide();
                } else if (($("#payType").val()) == '9') {
                    $("#target_account_field").hide();
                }
            }
        });
    }
    
    function gettargetBranchCashAccount(account_id) {
    
         
        
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/get_cashacounts_details",
            data: { 'account_id': account_id },
            success: function (data) {
                 
                 
                $("#t_cash_act").html(data);
                
               
            }
        });
    }
</script>

@endsection
