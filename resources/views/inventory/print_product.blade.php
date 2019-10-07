@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Product Purchase management</h3>

                    </header>

                    <div class="panel-body">

                        <div class="adv-table">
                            <table class="display table table-bordered" id="myTable">
                                <thead>
                                <tr>
                                    <th>Serial No </th>
                                    <th>Product_name</th>
                                    <th>product price</th>
                                    <th>Quantity</th>
{{--                                    <th>Amount</th>--}}
                                    <th>Date</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $sl_no=1 @endphp
                                @foreach($all_product_prints as $p)
                                    <tr class="gradeX">
                                        <td>{{ $sl_no}}</td>
                                        <td>{{ $p->product_name}}</td>

                                        <td>{{ $p->quantity}}</td>
                                        <td>{{ $p->purchase_cost}}</td>
                                        <td>{{ $p->amount}}</td>
                                        <td>{{ $p->purchase_date }}</td>
{{--                                        <td> @if($p->amount_type == 1)--}}
{{--                                                <p style="color:#4006f0e8">Bank</p>--}}
{{--                                            @elseif($p->amount_type== 2)--}}
{{--                                                <p style="color:darkmagenta">Cash in Bank</p>--}}
{{--                                            @elseif($p->amount_type== 3)--}}
{{--                                                <p style="color:darkmagenta">Cash</p>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
                                        <td>



                                            <a class="btn btn-primary btn-xs" href="{{ URL::to('/print_product/'.$p->id ) }}" >print</a>
                                            <br>
                                            <br>
                                            <a class="btn btn-primary btn-xs" href="{{ URL::to('/printAmissionSlip/'.$p->id.'/2' ) }}" >Edit</a>
                                        </td>
                                    </tr>
                                    @php $sl_no++; @endphp
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

    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Admission Billing </h4>
                </div>

                <div class="modal-body">

                    <div id="details"></div>

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


        {{--function getexpenseid(getexpenseid, type) {--}}

        {{--    $('#myModalEdit').modal(); --}}

        {{--    $.ajaxSetup({ - - }}
        {{--        headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') } - - }}
        {{-- }); --}}

        {{--     $.ajax({--}}
        {{--           typ    e: "post", --}}
        {{--        url: "{{url('/')}}/gets    td_m    asterdetails", --}}
        {{--        data: {'getexpenseid': get    expe    nseid, type:type}, --}}
        {{--       succ    ess: function (data) {--}}

        {{--              $("#details").html(data); --}}
        {{--      }--}}
        {{--    }); --}}
        {{--}--}}

        function getBranch(bank_id) {

// alert(bank_id);

            $.ajaxSetup({
                headers: { 'X-CSR    F-To        ken'    : $('meta[name=_token]').attr('content') }
            });
            $.ajax({
                type: "post",
                url: "{{url('/')}}/get_branch",
                data: {'bank_id': bank_id},
                suc    cess: f    un    c       tion    (dat    a) {
                $("#branch_id").html(data);
            }
        });
        }



        function getAcc(account_id) {


            $.ajaxSetup({
                h        eade    rs: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            $.ajax({
                type: "post",
                url    : "{{url('/')}}/get_acounts_details",
                data: {'account_id': account_id},
                succ    ess: function (data) {
                $("#bankact").html(data);
            }
        });
        }







    </script>

@endsection