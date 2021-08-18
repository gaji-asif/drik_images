<div class="card">
    <div class="card-header">
        <h5>All Withdraw Request(@if(isset($withdrawRequest)){{count($withdrawRequest)}}@endif)</h5>
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
        <div class="table-responsive  mt-4 mb-4">          
            <table id="basic-btn" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th >Request Id</th>
                        <th >Name</th>
                        <th >Amount</th>
                        <th >Payment Type</th>
                        <th >Request Status</th>
                        <th width="5%">Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdrawRequest as $key=>$item)
                        <tr>
                           
                            <td>{{$item->id}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>{{Config::get('app.curreny')}} {{$item->amount}}</td>
                            <td><span class="badge badge-success p-2">{{$item->paymentMethod->method_name}}</span></td>
                            <td>
                                @if ($item->status == 1) 
                                    <span class="badge badge-success p-2">Approve</span>
                                @elseif($item->status == 0) 
                                    <span class="badge badge-warning p-2">Pending</span>
                                @endif
                            </td>
                           <td>
                            <button type="button" class="btn btn-success action-icon" onclick="approveRequest({{$item->id}})"><i class="fa fa-pencil"></i></button>
                           </td>
                            
                          
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>