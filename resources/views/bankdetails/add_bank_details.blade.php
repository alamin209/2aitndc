@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3>Bank Details</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/bankdetails">
                        {{csrf_field()}}
                        <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Bank</strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" id="bank_id" name="bank_id" onchange="getBranch(this.value)" required>

                                        <option value="">Bank</option>
                                            @foreach($bank as $data)
                                                <option value="{{$data->bank_id}}">{{$data->bank_name}}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Branch</strong></label>
                            <div class="col-lg-10">
                                <select class="form-control m-bot15" id="branch_id" name="branch_id" required>
                                    <option value="">Branch</option>
                                </select>
                            </div>
                        </div>
                       <!--  <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>শাখা</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="শাখা" id="branch" name="branch" minlength="2" required>
                            </div>
                        </div> -->
                        
{{--                        <div class="form-group">--}}
{{--							<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>উপাংশ</strong></label>--}}
{{--							<div class="col-lg-10">--}}
{{--								<select class="form-control m-bot15" name="upangsho_id" onchange="" required>--}}

{{--								<option value="1">demo</option>--}}
{{--									@foreach($upangshos as $data)--}}
{{--										<option value="{{$data->upangsho_id}}">{{$data->upangsho_name}}--}}
{{--										</option>--}}
{{--									@endforeach--}}
{{--								</select>--}}
{{--							</div>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Bank Account Number</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Bank account Number" id="acc_no" name="acc_no" minlength="2" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Bank Account Code</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Bank Acount Code" id="acc_code" name="acc_code" minlength="2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Bank Account Description</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Bank Account Details" id="acc_details" name="acc_details" minlength="2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><strong>Startup status</strong></label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Startup status" id="open_balance" name="open_balance" minlength="2" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </form>

                </div>
            </section>
        </div>
    </div>

 

  <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                        All Bank Details
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
                                    <th>Bank</th>
                                    <th>Branch</th>
                                    <th>Code</th>
                                    <th>Account Number</th>
                                    <th>Description</th>
                                    <th>Startup status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($bankdetails as $data)
                                <tr class="gradeX">
                                    <td>{{$data->bank_name}}</td>
                                    <td>{{$data->branch_name}}</td>
                                    <td>{{$data->acc_code }}</td>
                                    <td>{{$data->acc_no }}</td>
                                    <td>{{$data->acc_details}}</td>
                                    <td>{{ $data->open_balance}}</td>
                                   
                                     
                                    <td width="7%">
                                    
                                        <button class="btn btn-primary btn-xs" onclick="editMenu();"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" onclick="deleteMenu();"><i class="fa fa-trash-o "></i></button>     

                                    </td>
                                 
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>
 </section> 
 
<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>
<script>

    //function deleteMenu(menu_id) {
    //     $("#delete_menu_id").val(menu_id);
    //     $("#myModalDelete").modal();
    // }
    
 var upang = '';
  function getKhattype(id){
    upang=id;   
    $('.inout').hide();
    $('.inout').show();
    $('#inout_id').val(''); 
  }
  function getKhat(id) {
    
    $('.khats').hide();
    $('.inout'+id+'.khat'+upang).show();
  }
  function getBranch(bank_id) {

    // alert(bank_id);

        $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: url{{ ('getbranches') }},

            url: url{{ ('getbranches') }},
            data: {'bank_id': bank_id},
            success: function (data) {
                $("#branch_id").html(data);  
            }
        });
   }


</script>
@endsection