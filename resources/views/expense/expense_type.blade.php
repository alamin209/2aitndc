@extends('layouts.admin')

@section('content')

<!--main content start-->
<section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Expense Category
                </header>

                @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif

                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm"
                          action="{{url('/')}}/expenseType">

                        @csrf

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Category *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Enter Type Name" id="type" name="expenseType" minlength="2" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
	
	<br><hr>
		<div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Expense Type
                </header>                
				@if (session('typemessage'))
                <div class="alert alert-success">
                    {{ session('typemessage') }}
                </div>
                @endif
                <div class="panel-body">
                    <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm"
                          action="{{url('/')}}/expensesubtype">

                        @csrf
						
						<div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Expense Category *</label>
                            <div class="col-lg-10">
								<select class="form-control" name="expcat" required onchange="getdeprifield(this.value)">
									<option value="">Select Expense Category</option>
									@foreach($expense as $expens)
									<option value="{{ $expens->id }}">{{ $expens->type }}</option>
									@endforeach
									
								</select>
                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Type *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Enter Type Name" id="" name="typename" minlength="2" required>
                            </div>
                        </div>
                        
                        <div id="dpri"></div>

                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                    </form>

                </div>
            </section>
        </div>
    </div>
	<hr><br>

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Expense Type History
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
                                    <th>Expense Category</th>
                                    <th>Expense Type</th>                                     
                                 
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($expensetypes as $expens)                               

									<tr class="gradeX">
										<td>{{ $expens->expcat->type }}</td>
										<td>{{ $expens->type }}</td>
										 
									
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
<!--main content end-->


<script>

    let deprifield = '<div class="form-group">'+
        '<label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Depriciation *</label>'+
        '<div class="col-lg-10">'+
            '<input type="text" class="form-control" placeholder="Enter Depriciation Percentage value" id="" name="depriciation" required>'+
        '</div>'+
    '</div>';
    
    function getdeprifield(id){
        
        if(id==15){
            $('#dpri').html(deprifield);
        }else{
             $('#dpri').html('');
        }
    }
    
</script>

@endsection


