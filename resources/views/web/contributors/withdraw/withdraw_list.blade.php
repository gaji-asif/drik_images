@include('web.partials.header')
<style>
    .theBox {
      overflow: hidden;
      /* width: 240px; */
      height: 100px;
   }

   .theBox img {
      /* display: block; */
      height: 100%;
   }
</style>
<div class="row col-md-12" style="min-height: 450px; background-color: #eff0f4; padding-top: 10px; padding-bottom: 5px;">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <p>
                    <span>
                        <img width="40" class="rounded-circle" src="{{ asset($user->upload_img) }}" class="img-radius" alt="">
                    </span>
                    <span>{{ Auth::user()->name }}</span>
                </p>
                <hr>
                @include('web.contributors.sidemenu')
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="card ">
            <div class="container mt-4">
                <a href="{{url('withdraw')}}"><button class="btn btn-info mb-2">Make New Request</button></a>
                <div class="row">
                    <div class="col-lg-4"> <h5>Withdraw Request(@if(isset($withdrawRequest)){{count($withdrawRequest)}}@endif)</h5></div>
                    <div class="col-lg-4"><h5>Total Amount - {{ Config::get('app.curreny') }}  @if(isset($contributorWithdrawInformation)){{number_format($contributorWithdrawInformation->total_amount, 2)}} @else 0.0 @endif</h5></div>
                    <div class="col-lg-4"><h5>Muture Amount - {{ Config::get('app.curreny') }}  @if(isset($contributorWithdrawInformation)){{number_format($contributorWithdrawInformation->muture_amount, 2)}} @else 0.0 @endif</h5></div>
                </div>
               
                <div class="table-responsive  mt-4 mb-4">          
                    <table id="example" class="table table-bordered " style="width:100%">
                        <thead class="table-primary">
                            <tr>
                     
                                <th width="%5">Request Id</th>
                                <th width="%5">Amount</th>
                                <th width="%5">Payment Type</th>
                                <th width="%5">Request Status</th>
                                <th width="%5">Approve amount</th>
                                <th >Message</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawRequest as $key=>$item)
                                <tr>
                                   
                                    <td>{{$item->id}}</td>
                                    <td>{{Config::get('app.curreny')}} {{$item->amount}}</td>
                                    <td><span class="badge badge-success p-2">{{$item->paymentMethod->method_name}}</span></td>
                                    <td>
                                        @if ($item->status == 1) 
                                            <span class="badge badge-success p-2">Approve</span>
                                        @elseif($item->status == 0) 
                                            <span class="badge badge-warning p-2">Pending</span>
                                        @endif
                                    </td>
                                    @if(!is_null($item->approve_amount))
                                    <td>{{Config::get('app.curreny')}} {{$item->approve_amount}}</td>
                                    @else
                                    <td></td>

                                    @endif


                                    <td>{{$item->message}}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('web.partials.footer')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function() {
 
        $('#example').DataTable(
            {
                order: [[ 0, "desc" ]],
                columnDefs: [{
                    targets: [0],
                    orderable: false
                }]
            }
        );
    });

</script>