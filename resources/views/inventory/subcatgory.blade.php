@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Add New Sub Category </h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/createinventorysubcat">
                            {{csrf_field()}}


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>  Category* </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="cat_id" required>
                                        <option value="">Select Category </option>
                                        @foreach($inventorycat as $incategory)
                                        <option value="{{ $incategory->id }}">{{ $incategory->catgeory_name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Sub Category Name*</strong></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Inventory Sub Category Name " id="sub_cate_name" name="sub_cate_name" required >
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong>Note*</strong></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Note " id="note" name="note"  >
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
                        All Designations
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

                                    <th>Category</th>                                      
                                    <th>Sub Category</th>
                                    <th>NOte</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($sub_cat as $cat)
                                    @if($cat->id!=0)

                                        <tr class="gradeX">
                                            <td>{{ $cat->invcat->catgeory_name }}</td>
                                            <td>{{ $cat->sub_cate_name }}</td>
                                            <td align="right">{{ $cat->note }}</td>

                                            <td>

                                                <button class="btn btn-primary btn-xs" onclick="editMenu();"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btn-xs" onclick="deleteMenu();"><i class="fa fa-trash-o "></i></button>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>

                        </div>
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


        function getdegree(degree_id) {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

            $.ajax({
                type: "get",
                url: "{{url('/')}}/getSubject",
                data: {'degree_id': degree_id},
                success: function (data) {
                    $("#degress").html(data);
                }
            });


            // $("#myModalEdit").modal();
        }

    </script>

@endsection


