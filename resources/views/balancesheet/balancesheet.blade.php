@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3 style="">হিসাব নিকাশ</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                
                        
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/balance_sheet">
                        {{csrf_field()}}
                        <div class="form-group">
                              
                    <!--   <div class="col-lg-3">
                                <label>উপাংশ</label>
                                <select class="form-control m-bot15" id="upangsho_id" name="upangsho_id" onchange="getIncomeKhat(this.value)">
                                    <option value="">উপাংশ নির্ধারণ</option>
                                    @foreach($upangshos as $data)
                                        @if($data->upangsho_id!=0)
                                            <option value="{{ $data->upangsho_id }}">{{$data->upangsho_name}}</option>
                                        @endif
                                    @endforeach                                     
                                </select>
                            </div> 

                            <div class="col-lg-3">
                                <label>খাত টাইপ</label>
                                <select class="form-control m-bot15" id="kkhat" name="khattype_id" onchange="getkhat(this.value)">
                                    
                                    <option value="">খাত টাইপ নির্ধারণ</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control m-bot15" name="year" required>
                                    <option value="">অর্থ বছর নির্ধারণ</option>                               
                                    @foreach($years as $yr)
										<option value="{{$yr->year}}">{{ str_replace($en, $bn, $yr->year) }}</option>
									@endforeach	                                   
                                </select>
                            </div>  -->
                             <div class="col-lg-6">
                                 <label>শুরু তারিখ</label>
                                <input class="form-control" type="date" name="sd" value="@isset($sd){{ $sd }}@endisset">
                            </div>
                            
                            <div class="col-lg-6">
                                <label>শেষ তারিখ</label>
                                <input class="form-control" type="date" name="ed" value="@isset($ed){{ $ed }}@endisset">
                            </div>
                            <div class="col-lg-12">
                                 
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                        </div>
                    </form>


                 
                </div>
            </section>
        </div>
    </div>
    @isset($badgetRegister)
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                        হিসাব নিকাশ
                    <span class="tools pull-right">
                        <button class="btn pull-right" onclick="getprint('printarea')">Print</div>
                    </span>
                </header>
                
                 <header class="panel-heading">
                       
                        <h4 style="text-align: center;"><strong>ফরিদপুর পৌরসভা,ফরিদপুর</strong></h4>
        
                        <h4 style="text-align: center;"><strong>হিসাব নিকাশ    </strong></h4>
                        
                        
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="display table table-bordered" id="my Table">
                            
                              {!! $badgetRegister !!}
                           
                        </table>

                    </div>
                </div>
            </section>
        </div>
        @endisset
    </div>
    
    <style>
        .table th{ text-align:center }
    </style>
    
  </section>  
<!--dynamic table initialization -->




 
<!--dynamic table initialization  -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>
    var type='';
    var upan='';
    var khattype='';
    function getkhattype(id){
        
        type = id;
        $('.khattypes').hide();
        $('#khattype_id').val('');
        $('#khtattypetype_id').val('');
        $('.katype2').hide(); 
        $('#khat_id').val('');
        $('.khattype'+id+'.upnag'+upan).show();
    }
    function getkhat(id){
         
        //$('.khats').hide(); 
        //$('#khat_id').val('');
        //$('.khats.khat'+type+'.khattp'+id).show();
        khattype = id;
         
        $('.katype2').hide(); 
        $('#khtattypetype_id').val('');
        $('.katype2.inout'+type+'.upa'+upan+'.khattp'+id).show();
        //katype2 inout{{$data->khat_id}} upa{{ $data->upangsho_id}} khattp{{ $data->khtattype_id }}
         
    }

    function getIncomeKhat(id){

       $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "./badget_register/create",
            data: {'id': id},
            success: function (data) {
               
                
                  $("#kkhat").html(data);  
                
            }
        });
    }
    
    function getkhatfortypetype(id) {
        
        
        $('.khats').hide();         
        $('.katype2').hide(); 
        $('#khat_id').val('');
        $('.khats.khat'+type+'.khattp'+khattype+'.khattypetype'+id).show();
    }
    
    var khatid='';
    function khatchange(id) {

       khatid=id;
    }
    
    function yearchange(year) {

        
       
       $.ajaxSetup({ 
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        $.ajax({
            type: "get",
            url: "./budget/create",
            data: {'id': khatid, 'year':year},
            success: function (data) {
               
                //alert(data);
                if(data!=0){ $('#smbtn').attr("disabled","disabled"); }else{ $('#smbtn').removeAttr("disabled"); }
            }
        });
    }

</script>


@endsection