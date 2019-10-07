@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
					<h3 style="">আয় বাজেট রিপোর্ট</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                
                        
                <div class="panel-body">
					<form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/budget_report/in">
                        {{csrf_field()}}
                        <div class="form-group">
                             <input type="hidden" name="type" value="1">   
                             <input type="hidden" name="url" value="{{ $url }}">   
							<div class="col-lg-3">
								<select class="form-control m-bot15" name="upangsho_id" required>
								
								 <option value="">উপাংশ নির্ধারণ</option>
									@foreach($upangshos as $data)
                                     @if($data->upangsho_id!=0)
										<option value="{{$data->upangsho_id}}" 
										@isset($upangshoname)
											@if($upangshoname == $data->upangsho_name)
												{{'selected'}}
											@endif
										@endisset>{{$data->upangsho_name}}
										</option>
                                      @endif  
									@endforeach								 
								</select>
							</div>
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
							<div class="col-lg-2">
							
								<button type="submit" class="btn btn-info pull-right">Submit</button>
							</div>
                        </div>
                    </form>
					
					<div class="adv-table">
					     @isset($year)
					    <button class="btn pull-right" onclick="getprint('printarea')">Print</div>
						<div id="printarea">
    						<div class="col-lg-12" style="text-align:center; margin-bottom:20px">
    							
    							<span> 
    							        @php
    							            $y = explode('-', $year);
    							            $next_year = ($y[0]+1).'-'.($y[1]+1);
    							            $prev_year = ($y[0]-1).'-'.($y[1]-1);
    							        @endphp
    								অর্থ বছর {{  str_replace($en, $bn, $year) }}
    							</span><br>
    							<span>@isset($upangshoname)
    								{{ $upangshoname }}
    							@endisset</span>
    							<h3 style="text-align: center;">আয়</h3>
    						</div>
                            <table class="display table table-bordered" id="myTable">
                                <thead>
                                    <tr>									 
                                        <th width="5%">ক্রঃ নং </th>                                        
                                        <th width="50%">আয়ের খাত</th>                                      
                                        <th width="15%">পুর্ববর্তী বছরের প্রকৃত
                                            <br>{{  str_replace($en, $bn, $prev_year) }}
                                        </th>                                      
                                        <th width="15%">চলতি বছরের বাজেট বা চলতি বছরের সংশোধিত বাজেট
                                            <br>{{  str_replace($en, $bn, $year) }}
                                        </th> 
										<th width="15%">পরবর্তী বছরের বাজেট
										    <br>{{  str_replace($en, $bn, $next_year) }}
										</th>                                                                             
                                    </tr>
									<tr>									 
                                        <th>১</th>                                        
                                        <th>২</th>                                      
                                        <th>৩</th>                                      
                                        <th>৪</th> 
										<th>৫</th>                                                                              
                                    </tr>
                                </thead>
                                <tbody>
								@isset($badget)
									@php($sl=1)									 
										<tr class="gradeX">
											 
											{!! $badget !!}											
										</tr>									 
								@endisset
                                </tbody>
                            </table>
                            </div>
                        </div>
                        @endisset
				</div>
            </section>
        </div>
    </div>
	
	<style>
		.table th{ text-align:center }
	</style>
	

   <!--  <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    View Menu
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="display table table-bordered" id="hidden-table-info">
                            <thead>
                                <tr>
                                    <th class="hide_coloum">Menu Id</th>
                                    <th>Menu Name</th>
                                    <th>Menu Icon</th>
                                    <th>Action</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                            
                            
                                <tr class="gradeX">
                                  

                                    <td class="hide_coloum"></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                    
                                        <button class="btn btn-primary btn-xs" onclick="editMenu();"><i class="fa fa-pencil"></i></button>
                                            
                                        <button class="btn btn-default btn-xs"><i class="fa fa-trash-o "></i></button>
                                           
                                        <button class="btn btn-danger btn-xs" onclick="deleteMenu();"><i class="fa fa-trash-o "></i></button>     

                                    </td>
                                 
                                </tr>
                
                            
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div> -->
  </section>  

    <!-- Modal -->
    <!--  <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Menu Confirmation</h4>
                </div>
                <div class="modal-body">

                    Do You Want To Delete This Menu?
                <input type="hidden" id="delete_menu_id" name="delete_menu_id" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button">Yes</button>
                    <button data-dismiss="modal" class="btn btn-default" type="button">No</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- modal -->

    <!-- Modal -->
    <!-- <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Menu Confirmation</h4>
                </div>

                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label" for="name">Menu Name</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="Enter Menu Name" id="edit_menu_name" name="edit_menu_name" class="form-control">
    							<input type="hidden" id="edit_menu_id" name="edit_menu_id" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>

            </div>
        </div>
    </div> -->
    <!-- modal -->


 
<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>
    var APP_URL = {!! json_encode(url('/')) !!}

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
   
   function getprint(divid) {
       
       var html = $('#'+divid).html();
       $('body').html(html);
       window.print();
       window.location.replace(APP_URL+"/budget_report/out");
   }


</script>

@endsection