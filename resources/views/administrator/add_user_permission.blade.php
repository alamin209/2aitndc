@extends('layouts.admin') 
@section('content')
<!--main content start-->
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add User Permission
                    </header>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="post"  action="">
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Role</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="select_role">
                                    
                                    @foreach($user_roles as $user_role)  
                                       <!--  <option value="" onclick="getPermission()" selected></option> -->
                                           
                                        <option value="{{ $user_role->role_id }}" onclick="getPermission()">{{ $user_role->role_name }}</option>
                                    @endforeach       
                                    </select>
                                </div>
                            </div>
                            <div id="permission_data">
                               @foreach($menus as $menu)
                                <div class="form-group">
                                    <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">{{ $menu->menu_name}}</label>
                                    <div class="col-lg-10">

                                        @foreach($Sub_menus as $Sub_menu)
                                               
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="" id="sub_menu" name="sub_menu" checked>
                                                                   
                                                </label>
                                            </div>
                                                       
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="" id="sub_menu" name="sub_menu">
                                                      {{$Sub_menu->sub_menu_name}}             
                                                </label>
                                            </div>
                                            
                                        @endforeach   
                                                  
                                    </div>
                                </div>
                                   @endforeach
                            </div>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>

<!--main content end-->


<script type="text/javascript">
    function getPermission(role_id){
        // var role_id=role_id;

        // alert('Hi');
        // $.ajax({
        //     type: "Post",
        //     url: "",
        //     data: {'role_id':role_id,'action':'getPermission'} ,
        //     success: function(data) {
        //         //   alert(data);
        //         $('#permission_data').html(data);
        //     }
        // });
   }
</script>
@endsection