@extends('layouts.admin')

@section('content')

<!--main content start-->
<section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">

            <section class="panel">
                <header class="panel-heading">
                    <b style="color:blue;">Yearly  Expense</b>
                </header>

                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif

                <div class="panel-body" style="background:#008B8B;color:white; ">
                    <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  
                          action="{{url('/')}}/yearlyExpense" >

                        @csrf

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Yearly Expense Type *</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="expenseType" id="expense_type"  required> <!-- input-sm m-bot15  -->
                                    <option value="">Select Yearly Expense Type</option>
                                    @foreach($year_exp_type as $type)
                                    @if($type->id!=0)

                                    <option value="{{ $type->id }}">{{ $type->type }}</option>

                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Payment Type *</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="paymentType"  id="payType"  onchange="showDiv(this)"  required> <!-- input-sm m-bot15  -->
                                    <option value="">Select Payment Type</option>
                                    <option value="1">Cash </option>
                                    <option value="2">Bank</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Bank *</label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" id="bank_id" name="bank_id" onchange="getBranch(this.value)" required>
                                    <option value="">Select Bank</option>

                                    @foreach($bank as $data)
                                    <option value="{{$data->bank_id}}">{{$data->bank_name}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Branch *</label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" id="branch_id" name="branch_id" onchange="getAcc(this.value)" required>
                                    <option value="">Select Branch</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="getaccnofield" style="display: none">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Bank Account *</label>
                            <div class="col-lg-10">
                                <select class="form-control  m-bot15"  name="bankact" id="bankact" required="true"> <!-- input-sm m-bot15  -->
                                    <option value="">Select Bank Account</option>

                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Amount *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Enter Amount" id="amount" name="amount"  required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Note *</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" placeholder="Enter Note" id="note" name="note" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Date *</label>
                            <div class="col-lg-10">
                                <input type="date" class="default-date-picker form-control" placeholder="Enter Date" id="deduct_date"  name="deductDate" required>
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
            document.getElementById('getaccnofield').style.display = "none";
        } else {
            document.getElementById('getaccnofield').style.display = "block";
        }
    }

    function getBranch(bank_id) {

        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/getbranches",
            data: {'bank_id': bank_id},
            success: function (data) {
                $("#branch_id").html(data);
            }
        });
    }

    function getAcc(account_id) {

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
        });

        $.ajax({
            type: "post",
            url: "{{url('/')}}/get_acounts_details",
            data: {'account_id': account_id},
            success: function (data) {
                $("#bankact").html(data);

                if (($("#payType").val()) == '1') {
                    $('#bankact').prop('required', false);
                    $("#getaccnofield").hide();
                }
            }
        });
    }

    function getpaymenmtype(type) {
        if (type == 3) {
            document.getElementById('hidden_div').style.display = "block";
            $("#remark").attr("required");
        } else {
            document.getElementById('hidden_div').style.display = "none";
            $("#remark").removeAttr("required");
        }
    }

</script>

@endsection
