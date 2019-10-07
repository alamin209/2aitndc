@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3 style="">ব্যাংক বিবরণ রিপোর্ট</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                
                        
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/bank_report">
                        {{csrf_field()}}
                        <div class="form-group">
                             <input type="hidden" name="type" value="1">   
                             <input type="hidden" name="url" value="">   
                           <!--  <div class="col-lg-3">
                                <select class="form-control m-bot15" name="bank_id" required>
                                 <option value="">ব্যাংক নির্ধারণ</option>
                                        <option value=""></option>                       
                                </select>
                            </div> -->
                            <div class="col-lg-5">
                            
                                <select class="form-control m-bot15" name="year" required>
                                    <option value="">অর্থ বছর নির্ধারণ</option>                                         
                                    @foreach($years as $yr)
                                        <option value="{{$yr->year}}" 
                                        @isset($year)
                                            @if($year == $yr->year)
                                             {{'selected'}}
                                            @endif
                                        @endisset>{{ str_replace($en, $bn, $yr->year) }}
                                        </option>
                                    @endforeach                                     
                                </select>
                            </div>
                           
                           <!--  <div class="col-lg-5">
                                <select class="form-control m-bot15" name="year" required>
                                    <option value="">অর্থ বছর নির্ধারণ</option>                               
                                        <option value=""></option>                                   
                                </select>
                            </div> -->
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                        </div>
                    </form>


                 
                </div>
            </section>
        </div>
    </div>
    
    
    
    
    
    
    
         
    <button class="btn pull-right" onclick="getprint('printarea')">Print</button>
         
    

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                       
                        <h4 style="text-align: center;"><strong>ফরিদপুর পৌরসভা,ফরিদপুর</strong></h4>
        
                        <h4 style="text-align: center;"><strong>ব্যাংক বিবরণ</strong></h4>
                        
                    <span class="tools pull-right">
                        
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <div id="printarea">
                            <table class="display table table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th>ক্রঃ নং</th>
                                        <th>ব্যাংকের নাম </th>  
                                        <th>হিসাব নং</th>
                                        <th>বিবরণ</th>
                                        <th>প্রারম্ভিক স্থিতি</th>                    
                                        <th>স্থিতি</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {!! $bank_datas !!}
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
      
       $('body').html($('#'+divid).html())
       window.print()
       window.location.replace(APP_URL+"/bank_report")
    }


</script>

@endsection