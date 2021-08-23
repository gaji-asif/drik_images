@extends('backEnd.master')
@section('mainContent')
    <div class="row">
        <div class="col-md-12">

            @if(session()->has('message-success'))
                <div class="alert alert-success mb-3 background-success" role="alert">
                    {{ session()->get('message-success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session()->has('message-danger'))
                <div class="alert alert-danger">
                    {{ session()->get('message-danger') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session()->has('message-success-delete'))
                <div class="alert alert-danger mb-3 background-danger" role="alert">
                    {{ session()->get('message-success-delete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session()->has('message-danger-delete'))
                <div class="alert alert-danger">
                    {{ session()->get('message-danger-delete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session()->has('message-success-assign-user'))
                <div class="alert alert-success mb-3 background-success" role="alert">
                    {{ session()->get('message-success-assign-user') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session()->has('message-danger'))
                <div class="alert alert-danger">
                    {{ session()->get('message-danger') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

           @canany(['View User List','Edit User','Delete User','Assign Permission by User'])
            <div class="card">
                <div class="card-header">
                    <h5>Image Id: <strong>@if(isset($image)){{$image->id}}@endif</strong></h5><br>
                    <h5>Title: <strong>@if(isset($image)){{$image->title}}@endif</strong></h5>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="basic-btn" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th width="5%">Sl</th>
                                <th>Transaction Id</th>
                                <th>Buyer Name</th>
                                <th>Purchase Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($purchaseDetails))
                                @php $i = 1 @endphp
                                @foreach($purchaseDetails as $item)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>@if(isset($item->purchase)){{$item->purchase->transaction_id}}@endif</td>
                                        <td>@if(isset($item->purchase->user)){{$item->purchase->user->name}}@endif</td>
                                        <td>@if(isset($item->created_at)){{date("Y-m-d",strtotime($item->created_at))}}@endif</td>
                                 
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endcanany
        </div>
    </div>

@endSection
