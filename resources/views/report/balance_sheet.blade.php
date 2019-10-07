@extends('layouts.admin') 

@section('content')

<!--main content start-->
<section class="wrapper site-min-height">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <b style="color:blue;">  Bank Balance </b>
                    <a class="link pull-right" href="{{url('/')}}/balanceSheet">Refresh</a>
                </header>
                <div class="panel-body" style="background:#E4F8EA;color:black; ">
                    <b style="color:blue;">Bank Deatils</b>
                    <div class="adv-table">
                        <table class="display table table-bordered" >
                            <thead>

                                <tr>
                                    <th>Sl No</th>
                                    <th>Bank Name</th>
                                    <th>Branch Name</th>
                                    <th> Account No</th>
                                    <th> Balance </th>
                                </tr>

                            </thead>
                            <tbody>

                                <?php
                                $bankTotal = 0;
                                $sodbankTotal = 0;
                                $cashTotal = 0;
                                $s = 1;
                                $sl = 1;
                                ?>


                                @foreach($banks as $bank)
                                    @if($bank->bank_details_id!=0)
    
                                    <?php $bankTotal += $bank->update_balance ?>
    
                                    <tr class="gradeX">
                                        <td><?php echo $s++; ?></td>
                                        <td>{{ $bank->bank_name }}</td>
                                        <td>{{ $bank->branch_name }}</td>
                                        <td>{{ $bank->acc_no }}</td>
                                        <td align="right">
                                            <a href="javascript:void(0)" onclick="getopening({{$bank->bank_details_id}}, {{$bank->open_balance}})">
                                                {{ $bank->update_balance }}
                                            </a>
                                        </td>
                                    </tr>
    
                                    @endif
                                @endforeach
                                <tr class="gradeX">
                                    <td colspan="3"></td>
                                    <td >Total</td>
                                    <td align="right"><strong>{{$bankTotal}}</strong></td>
                                </tr>
                                <tr class="gradeX">
                                    <td colspan="5"><strong>SOD Details</strong></td>
                                </tr>
                                @php($s=1)
                                @foreach($sodbanks as $bank)
                                    @if($bank->bank_details_id!=0)
    
                                    <?php $sodbankTotal += $bank->update_balance ?>
    
                                    <tr class="gradeX">
                                        <td><?php echo $s++; ?></td>
                                        <td>{{ $bank->bank_name }}</td>
                                        <td>{{ $bank->branch_name }}</td>
                                        <td>{{ $bank->acc_no }}</td>
                                        <td align="right">
                                            <a href="javascript:void(0)" onclick="getopening({{$bank->bank_details_id}}, {{$bank->open_balance}})">
                                                {{ $bank->update_balance }}
                                            </a>
                                        </td>
                                    </tr>
    
                                    @endif
                                @endforeach
                                <tr class="gradeX">
                                    <td colspan="3"></td>
                                    <td >Total</td>
                                    <td align="right"><strong>{{$sodbankTotal}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>		

                    <b style="color:blue;">Cash  Deatils</b>
                    <div class="adv-table">
                        <table class="display table table-bordered" >
                            <thead>

                                <tr>
                                    <th>Sl No</th>
                                    <th>Bank Name</th>
                                    <th>Branch Name</th>
                                    <th >Amount Type</th>
                                    <th>Balance</th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach($cashes as $cash)
                                @if($cash->bank_details_id!=0)

                                <?php $cashTotal += $cash->update_balance ?>

                                <tr class="gradeX">
                                    <td><?php echo $sl++; ?></td>
                                    <td>{{ $cash->bank_name }}</td>
                                    <td>{{ $cash->branch_name }}</td>
                                    <td>{{ $cash->acc_no }}</td>
                                    <td align="right">{{ $cash->update_balance }}</td>
                                </tr>

                                @endif
                                @endforeach

                            </tbody>
                            <tfoot>

                                <tr class="gradeX">
                                    <td colspan="3"></td>
                                    <td >Total</td>
                                    <td align="right"><strong>{{$cashTotal}}</strong></td>
                                </tr>

                            </tfoot> 
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Opening Balance</h4>
      </div>
      <div class="modal-body">
            <form class="form-horizontal" action="" onsubmit="openingbalaceupdate(); return false;">
                  
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="email">Opening Balance:</label>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" id="bankid">
                        <input type="text" class="form-control" id="opblce">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default pull-right">Update</button>
                    </div>
                  </div>
            </form> 
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>
<!--main content end-->

<script>
     
    function getopening(id, opening){
        
        $('#bankid').val(id);
        $('#opblce').val(opening);
        $('#myModal').modal();
    }
    
    function openingbalaceupdate(){
        
        let bid = $('#bankid').val();
        let bopning = $('#opblce').val();
        
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $.ajax({
            
            type: "post",
            url: "{{url('updateopeningbalance')}}",
            data: {'bid' : bid, 'amount' : bopning},
            success: function (data) {
                
                if(data=='ok'){
                    location.reload();
                }else{
                    
                     alert(data);
                }
            }
        });
    }
</script>

@endsection