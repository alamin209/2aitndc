@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3 style="">খরচ বিবরণ রিপোর্ট</h3> 
                    
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                @isset($data)@foreach($data as $k => $v) @php $$k = $v; @endphp @endforeach @endisset
                @php $month = array('01'=>'January', '02'=>'February', '03'=>'March') @endphp
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/expense_report">
                        {{csrf_field()}}
                        <div class="form-group">
                             <input type="hidden" name="type" value="1">   
                             <input type="hidden" name="url" value="">   
                            <div class="col-lg-2">
                                <label>ব্যাংক</label>
                                <select class="form-control m-bot15" name="bank" required onchange="getbranches(this.value)">
                                    <option value="">ব্যাংক নির্ধারণ</option>
                                    @foreach($bank as $dt)    
                                        <option 
                                        @isset($bnk)
                                            @if($bnk==$dt->bank_id)
                                                {{ ' selected ' }}
                                            @endif
                                        @endisset
                                        value="{{$dt->bank_id}}">{{$dt->bank_name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                        <div class="col-lg-2">
                            <label>শাখা</label>
                            <select class="form-control m-bot15" name="branch" id="selbranch" required onchange="getaccnts(this.value)">
                                <option value="">শাখা নির্ধারণ</option>
                                @foreach($branch as $dt)    
                                    <option
                                    @isset($brnch)
                                        @if($brnch==$dt->branch_id)
                                            {{ ' selected ' }}
                                        @endif
                                    @endisset
                                    class="brnch bank{{$dt->bank_id}}" value="{{$dt->branch_id}}">{{$dt->branch_name}}</option> 
                                @endforeach                              
                            </select>
                        </div>
                           
                            <div class="col-lg-2">
                                <label>একাউন্ট নং</label>
                                <select class="form-control m-bot15" name="accno" id="selacc" required>
                                    <option value="">একাউন্ট নম্বর নির্ধারণ</option>                               
                                    @foreach($bankdetails as $dt)    
                                        <option 
                                        @isset($acc)
                                            @if($acc==$dt->bank_details_id)
                                                {{ ' selected ' }}
                                            @endif
                                        @endisset
                                        class="accnt bank{{$dt->bank_id}} branch{{$dt->branch_id}}" value="{{$dt->bank_details_id}}">{{$dt->acc_no}}</option> 
                                    @endforeach                                   
                                </select>
                            </div>
                    <!--         <div class="col-lg-2">
                                <select class="form-control m-bot15" name="year" required>
                                    <option value="">অর্থ বছর নির্ধারণ</option>                               
                                    @for($y=2017; $y<= date('Y'); $y++)
                                        <option
                                        @isset($yr)
                                            @if($yr==$y)
                                                {{ ' selected ' }}
                                            @endif
                                        @endisset
                                        value="{{$y}}">{{$y}}</option>
                                    @endfor
                                    
                                </select>
                            </div>
                             <div class="col-lg-2">
                                <select class="form-control m-bot15" name="month" required>
                                    <option value="">Month</option>  
                                    @foreach($month as $k=>$v)
                                        <option
                                        @isset($mnth)
                                            @if($mnth==$k)
                                                {{ ' selected ' }}
                                            @endif
                                        @endisset
                                        value="{{ $k }}">{{ $v }}</option>   
                                    @endforeach
                                </select>
                            </div> -->
                            
                            
                            <div class="col-lg-2">
                                 <label>শুরু তারিখ</label>
                                <input class="form-control" type="date" name="sd" value="@isset($sd){{ $sd }}@endisset">
                            </div>
                            
                            <div class="col-lg-2">
                                <label>শেষ তারিখ</label>
                                <input class="form-control" type="date" name="ed" value="@isset($ed){{ $ed }}@endisset">
                            </div>
                            
                            
                            <div class="col-lg-2"><br />
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </section>
        </div>
    </div>

<div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                        <h4 style="text-align: center;"><strong>ফরিদপুর পৌরসভা,ফরিদপুর</strong></h4>
                        <h4 style="text-align: center;"><strong>ক্যাশ বহি</strong></h4>
                        <h4 style="text-align: center;"><strong>খরচ</strong></h4>
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

                                    <th>উপাংশ</th>
                                    <th>খাত টাইপ</th>
                                    <th>খাত টাইপ-২</th>
                                    <th>খাত</th>  
                                    <th>প্রদানের তারিখ</th>
                                    <th>ভাউচার নং</th>
                                    <th>বিবরণ</th>
                                    <th>প্রতি ভাউচারের পরিমান</th>  
                                    <th>চেক নঃ</th>
                                    <th>চেকের পরিমান</th>
                                    <th>মন্তব্য / খাত</th>                    
                                  <!--   <th>স্থিতি</th> -->
                                   
                                </tr>
                            </thead>
                            <tbody>
                            @isset($expencereport)
                                {!! $expencereport !!}
                            @endisset
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
</div>
    
    <style>
        .table th{ text-align:center }
        .brnch, .accnt{ display:none;}
    </style>
    
  </section>  
<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>


    //function deleteMenu(menu_id) {
    //     $("#delete_menu_id").val(menu_id);
    //     $("#myModalDelete").modal();
    // }
    var bank_id='';
    function getbranches(bankid) {
        bank_id=bankid;
        $('#selbranch').val('');
        $('.brnch').hide();
        $('#selacc').val('');
        $('.accnt').hide();
        $('.brnch.bank'+bankid).show();
    }
    
    function getaccnts(branchid) {
         
        $('#selacc').val('');
        $('.accnt').hide();
        $('.accnt.bank'+bank_id+'.branch'+branchid).show();
    }

    function getInKhat(upangsho_id) {
    
             $.ajaxSetup({ 
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
    
            $.ajax({
                type: "get",
                url: "../income/create",
                data: {'upangsho_id': upangsho_id},
                success: function (data) {
                     $("#option").html(data);  
                }
            });
       }


</script>

@endsection