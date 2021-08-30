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
                        <th width="5%">Request Id</th>
                        <th width="15%" >Name</th>
                        <th width="5%" >Amount</th>
                        <th  width="5%">Payment Type</th>
                        <th  width="5%" >Request Status</th>
                        <th  width="5%">Approve Amount</th>
                        <th >Message</th>
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
                            @if (!is_null($item->approve_amount)) 
                            
                            <td>{{Config::get('app.curreny')}} {{$item->approve_amount}}</td>
                                
                            @else
                            <td></td>
                                
                            @endif
                            <td>{{$item->message}}</td>
                            
                           <td>
                            {{-- <button type="button" class="btn btn-success action-icon" onclick="approveRequest({{$item->id}})"><i class="fa fa-pencil"></i></button> --}}
                            <button type="button" class="btn btn-success action-icon" data-toggle="modal" data-target="#showAppointmentModal{{$item->id}}"><i class="fa fa-pencil"></i></button>
                           
                        </td>
                        <div class="has-modal modal fade" id="showAppointmentModal{{ $item->id }}">
                          <div class="modal-dialog modal-dialog-centered" id="modalSize">
                              <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                      <h4 class="modal-title" id="showDetaildModalTile">Approve Withdraw Request</h4>
                                      </h4>
                                      <button type="button" class="close" data-dismiss="modal"
                                          aria-label="Close">
                                          <span aria-hidden="true"><i class="ti-close"></i></span>
                                      </button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body" id="showDetaildModalBody">
                                      {{ Form::open(['class' => '', 'files' => true, 'url' => 'admin-withdraw-approve', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}

                                      <input type="hidden" name="id" class="url" value="{{ $item->id }}">
                                      <div class="form-group">
                                        <label for="request" class="col-form-label">Request Amount:</label>
                                        <input type="text" class="form-control" id="request" value="{{$item->amount}}" disabled>
                                      </div>
                                      <div class="form-group">
                                        <label for="amount" class="col-form-label">Approve Amount:</label>
                                        <input type="number" min="0" class="form-control" id="amount" name="approve_amount">
                                      </div>
                                      <div class="form-group">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text" name="message"></textarea>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-sm-12 text-right">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button  type="submit" class="btn btn-success">Approve</button>
                                        </div>
                                    </div>
                                      {{ Form::close() }}

                                  </div>

                                  <!-- Modal footer -->

                              </div>
                          </div>
                      </div>
                          {{-- <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Approve Request</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" enctype="multipart/form-data" action="{{url('admin-withdraw-approve')}}">
                                    <div class="form-group">
                                      <label for="request" class="col-form-label">Request Amount:</label>
                                      <input type="text" class="form-control" id="request" value="{{$item->amount}}" disabled>
                                    </div>
                                    <div class="form-group">
                                      <label for="amount" class="col-form-label">Approve Amount:</label>
                                      <input type="number" min="0" class="form-control" id="amount">
                                    </div>
                                    <div class="form-group">
                                      <label for="message-text" class="col-form-label">Message:</label>
                                      <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                  </form>
                                  
                                  
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Approve</button>
                                </div>
                              </div>
                            </div>
                          </div> --}}
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

{{-- @if(isset($flag))
<script>
     $(document).ready(function() {
        $('#basic-btn').DataTable(
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

@endif --}}