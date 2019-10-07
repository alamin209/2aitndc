@extends('layouts.admin') 

@section('content')
  <section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
					<h3>বাজেট  ব্যবস্থাপন</h3>
                </header>
                 @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                 @endif
                <div class="panel-body">
					<div class="adv-table">
                        <table class="display table table-bordered" id="myTable">
                            <thead>
                                <tr>									 
                                    <th>খাত </th>                                        
                                    <th>অর্থ বছর</th>                       
                                    
									<th>টাকা</th> 
									
                                    <th>প্রক্রিয়া</th>                                      
                                </tr>
                            </thead>
                            <tbody>
                            {!! $badget!!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
   

    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Menu Confirmation</h4>
                </div>

                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" action="{{url('/')}}/budget_approve">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label" for="name">Khat Name</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="" id="khatername" name="" class="form-control" disabled>
    							
    							<input type="hidden" name="apprvid" value="{{ Auth::user()->id }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label" for="name">Year</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="" id="year" name="" class="form-control" disabled>
                                <input type="hidden" id="bdgid" name="bdgid">
                                <input type="hidden" id="bdglgid" name="bdglgid">
							</div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label" for="name">Amount</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="Enter Amount" id="amount" name="amount" class="form-control">
    							 
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
    </div>  


 
<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init_menu.js"></script>
<script src="public/js/form-validation-script_add_menu.js"></script>

<script>


    
    

  function getupdatebudget(id, idd, valu) {
      
      
      $('#khatername').val( $('#khatname'+id).text());
      $('#year').val( $('#budgetyr'+id).text());
      $('#bdgid').val(idd);
      $('#bdglgid').val(id);
      $('#amount').val(valu);
      $('#myModalEdit').modal();
   }


</script>

@endsection