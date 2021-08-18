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
                <a href="{{url('withdraw')}}"><button class="btn btn-info mb-2">Withdraw</button></a>
                <h5>Withdraw Request(@if(isset($withdrawRequest)){{count($withdrawRequest)}}@endif)</h5>
                <div class="table-responsive  mt-4 mb-4">          
                    <table id="example" class="table table-bordered " style="width:100%">
                        <thead>
                            <tr>
                     
                                <th >Request Id</th>
                                <th >Amount</th>
                                <th >Payment Type</th>
                                <th >Request Status</th>
                              
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
            "columnDefs": [ {
            "targets": 0,
            "orderable": false
            } ]
        );
    });

</script>