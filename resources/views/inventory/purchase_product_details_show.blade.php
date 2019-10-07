@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading">
                        <h3>Show  Product Details</h3>
                    </header>
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="panel-body addfrom">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="{{url('/')}}/addproduct" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Supplier name * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  name="sup_id" id="sup_id" required>
                                        <option value="">Select Supplier </option>
                                        @foreach($sup_lier as $sup)
                                            <option value="{{ $sup->id }}">{{ $sup->companey_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                                    <select class="form-control m-bot15"  id="sub_cat" name="sub_cat" onchange="product_id(this.value)" required>
                                        <option value="">Select  Sub Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2 lab"><strong> Product name * </strong></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15"  id="product_ids" name="prod_id" required>
                                        <option value="">Select  Product</option>
                                    </select>
                                </div>
                            </div>
                            {

                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading">

                                    <span class="tools pull-right">
							<a href="javascript:;" class="fa fa-chevron-down"></a>
							<a href="javascript:;" class="fa fa-times"></a>
						</span>
                                </header>
                                <div class="panel-body" style="width: 1000px">
                                    <button class="btn pull-right" onclick="getprint('printarea')">Print</button>
                                    <div class="adv-table">


                                        <div id="printarea">

                                            <table class="display table table-bordered" id="myTable" style="margin-bottom: 70px;">
                                                <thead>
                                                <tr>

                                                    <th>SI.No</th>
                                                    <th>Category Name</th>
                                                    <th>Subcategory Name</th>
                                                    <th>Product name</th>
                                                    <th>Product Price(Tk)</th>
                                                    <th>Product Document</th>
                                                    <th>Total Quantity</th>
                                                    <th>Stock</th>
                                                    <th>Distribute </th>
                                                    <th>Distribute Date </th>
                                                    <th>Product Left</th>
                                                    <th>Return</th>
                                                    <th>Out of Stock</th>
                                                    <th>Action </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $sl=1;
                                                @endphp
                                                @foreach($all_product as $dep)

                                                    @php

                                                    @endphp
                                                    <tr class="gradeX">
                                                        <td>{{ $sl }}</td>
                                                        <td>{{ $dep->catgeory_name }}</td>
                                                        <td> {{ $dep->sub_cate_name }}</td>
                                                        <td> {{ $dep->product_name }}</td>
                                                        <td> {{ $dep->purchase_cost }}</td>
                                                        <td>


                                                <?php  $path='public/admin/inventorydocument/'.$dep->doc_name ?>
                                                        @if ($dep->doc_name  != '')
                                                           @if (file_exists($path))
                                                                <a href="{{url('/')}}/public/admin/inventorydocument/{{ $dep->doc_name }}" target="_blank" class="btn btn-primary m-btn--pill m-btn--air btn-sm"><i class="flaticon-eye">Click To Show</i></a>
                                                            @else
                                                                       {{ 'No File Upload' }}
                                                             @endif
                                                           @else
                                                                   {{ 'No File Upload' }}

                                                            @endif

                                                        </td>
                                                        <td>
                                                           {{  $dep->total_qty }}
                                                        </td>
                                                        <td>
                                                           {{  $dep->quantity }}
                                                        </td>
                                                        <td>

                                                             @php
                                                                $production= product_distribution($dep->id);
                                                             $total_distribution=0;
                                                             $distribution_date="";

                                                             @endphp
                                                            @foreach($production as $production)
                                                                {{ $production->total_distribution }}

                                                                @php
                                                                    $total_distribution=$production->total_distribution @endphp
                                                             @endforeach

                                                        </td>
                                                        <td>
                                                            {{   (int)$dep->quantity - $total_distribution }}
                                                        </td>
                                                        <td>
                                                            {{   $dep->date_ofdistribution }}
                                                        </td>
                                                        <td>
                                                            {{  $dep->quantity }}
                                                        </td>
                                                        <td style="color: red">
                                                            @php  $total_damageproduct =total_damageproduct($dep->id);
                                                            @endphp
                                                            @foreach($total_damageproduct as $total_damageproduct)
                                                                {{ $total_damageproduct->total_damage }}
                                                                @endforeach

                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary btn-xs" onclick="editMenu({{ $dep->id }});"> Return</button>

                                                        </td>
                                                    </tr>
                                                    @php
                                                        $sl++;
                                                    @endphp
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </section>
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


        function getsupcategory(category) {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
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
        function product_id(subcategory_id) {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}
            });

            $.ajax({
                type: "post",
                url: "{{url('/')}}/subcategory_id",
                data: {'subcategory_id': subcategory_id},
                success: function (data) {
                    alert(data);
                    $("#product_ids").html(data);
                }
            });
        }




    </script>

@endsection


