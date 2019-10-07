@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3> Damage Product </h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/damageproduct" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Category name * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="cat_id" id="cat_id" onchange="getsupcategory(this.value)" required>
                                        <option value="">Select category </option>
                                        @foreach($inventorycat as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->catgeory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Sub Category name * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  id="sub_cat" name="sub_cat" onchange="getproduct(this.value)" required>
                                        <option value="">Select  Sub Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Products* </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  id="products" name="prodct_id"  required>
                                        <option value="">Select  Product</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Remark* </strong></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder=" Write the  remark " id="remark" name="remark" required >

                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Quantity* </strong></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder=" Write Quantity  " id="qty" name="qty" required >
                                </div>
                            </div>


                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>

    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    </div>
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


        function getsupcategory(category) {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            $.ajax({
                type: "post",
                url: "{{url('/')}}/getsubcategory",
                data: {'category': category},
                success: function (data) {
                    $("#sub_cat").html(data);
                }
            });

        }
        function getproduct(prod) {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
            });

            $.ajax({
                type: "post",
                url: "{{url('/')}}/product",
                data: {'prod': prod},
                success: function (data) {
                    $("#products").html(data);
                }
            });

        }




    </script>

@endsection


