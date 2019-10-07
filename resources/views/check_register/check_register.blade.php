@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3 style="">চেক রেজিস্টার</h3> 
                    
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                
                        
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/check_register">
                        {{csrf_field()}}
                        <div class="form-group">
                             <input type="hidden" name="type" value="1">   
                             <input type="hidden" name="url" value="">   
                            <div class="col-lg-3">
                                <label>উপাংশ</label>
                                <select class="form-control m-bot15" id="upangsho_id" name="upangsho_id" required>
                                    <option value="">উপাংশ নির্ধারণ</option>
                                    @foreach($upangshos as $data)
                                        @if($data->upangsho_id!=0)
                                            <option
                                            @isset($upangso)
                                                @if($upangso==$data->upangsho_id)
                                                   {{ ' selected' }} 
                                                @endif
                                            @endisset
                                            value="{{$data->upangsho_id}}">{{$data->upangsho_name}}</option>
                                        @endif
                                    @endforeach                                     
                                </select>
                            </div>
                          
                            <div class="col-lg-3">
                                <label>অর্থ বছর</label>
                                <select class="form-control m-bot15" name="year" required>
                                    <option value="">অর্থ বছর নির্ধারণ</option>      
                                    @foreach($years as $data)                         
                                        <option
                                        @isset($year)
                                            @if($year==$data->year)
                                               {{ ' selected' }} 
                                            @endif
                                        @endisset
                                        value="{{$data->year}}">{{$data->year}}</option>
                                    @endforeach                                     
                                </select>
                            </div>
                            <!--<div class="col-lg-4">
                                 <label class="col-lg-4">তারিখ নির্ধারণ</label>
                                 <input class="col-lg-8" type="date" name="date" style="border: 1px solid #e2e2e4; border-radius:5px;" required>
                            </div>-->
                            
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
        
        @isset($date)
            <button class="btn pull-right" onclick="getprint('printarea')">Print</button>
        @endisset
       
        <div class="col-sm-12">
            
            <section class="panel">
                
                <header class="panel-heading">
                    <h4 style="text-align: center;"><strong>ফরিদপুর পৌরসভা,ফরিদপুর</strong></h4>
                    <h4 style="text-align: center;"><strong>চেক রেজিস্টার</strong></h4>
                    <h4 style="text-align: center;">
                        @isset($year)
                            আর্থিক বছর : {{ str_replace($en, $bn, $year) }}
                        @endisset
                    </h4>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <div id="printarea"> 
                        <span>
                            @isset($date)
                               তারিখ- {{ str_replace($en, $bn, date('d/m/Y', strtotime($date)))  }}
                            @endisset
                        </span>
                        <table class="display table table-bordered" id="">
                            <thead>
                                <tr> 

                                    <th>উপাংশ</th>
                                    <th>প্রাপক</th>
                                    <th>খাত</th>  
                                    
                                    <th>বিবরণ</th>
                                    <th>চেক নঃ</th>
                                    <th>ভাউচার নং</th>
                                    <th>হিসাব নঃ</th>  
                                    <th>ব্যাংক</th>
                                    <th>টাকা</th>                    
                                    <th>হিঃরঃকঃ </th>
                                    <th>প্রঃনিঃকঃ</th>
                                    <th>মেয়র</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @isset($checkregister)
                                    {!!$checkregister!!}
                                @endisset
                            </tbody>
                        </table>
                    </div>
                   </div>
                </div>
            </section>
        </div>
    </div>
    
    <style>
        .table th{ text-align:center }
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

    function getconfirm(upangsho_id) {

        if(confirm("Asre You sure ?")){

            return true;
        }else{ return false;}
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

    var APP_URL = {!! json_encode(url('/')) !!};
   function getprint(divid) {
       
       
       var html = $('#'+divid).html();
       $('body').html(html);
       window.print()
       window.location.replace(APP_URL+"/check_register")
   }

</script>

@endsection