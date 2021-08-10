@extends('backEnd.master')
@section('mainContent')
<div class="row">
	<div class="col-md-5">
	

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

		<div class="card">
			<div class="card-header">
				@if(isset($editData))
					<h5>Edit Promocode</h5>
				@else
					<h5>Add New Promocode</h5>
				@endif
				
			</div>
			<div class="card-block">
				@if(isset($editData))
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'promocode/'.$editData->id ,'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
				@else
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'promocode','method' => 'POST', 'enctype' => 'multipart/form-data']) }}
				@endif
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
				                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

				                <div class="col-md-6">
				                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="@if(isset($editData)){{$editData->promocode}} @else {{ old('name') }} @endif" required autocomplete="off">
				                    @if ($errors->has('code'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('code') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

							<div class="form-group row">
				                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

				                <div class="col-md-6">
				                    <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="@if(isset($editData)){{$editData->amount}} @else {{ old('amount') }} @endif" required autocomplete="off" >

				                    @if ($errors->has('amount'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('amount') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

				
						

						</div>
					</div>
					<div class="form-group row mt-4">
						<div class="col-sm-12 text-center">
							@if(isset($editData))
								<button type="submit" class="btn btn-primary m-b-0">Edit Promocode</button>
							@else
								<button type="submit" class="btn btn-primary m-b-0">Add Promocode</button>
							@endif
							
						</div>
					</div>
				{{ Form::close()}}
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="card">
			<div class="card-header">
				<h5>Promocodes @if(isset($promocdes) && count($promocdes)>0 ) ({{count($promocdes)}}) @else {{(0)}}@endif</h5>
			</div>
			<div class="card-block">
				<div class="dt-responsive table-responsive">
					<table id="basic-btn" class="table table-striped table-bordered nowrap">
						<thead>
						<tr>
							<th>Sl</th>
							<th>Code</th>
							<th>Amount</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						@if(isset($promocdes))
							@php $i = 1 @endphp
							@foreach($promocdes as $promocde)
								<tr>
									<td>{{$i++}}</td>
									<td>{{$promocde->promocode}}</td>
									<td>{{$promocde->amount}}</td>
									<td>
										<a href="{{ url('promocode/'.$promocde->id.'/edit') }}" title="Edit">
											<button type="button" class="btn btn-info action-icon"><i class="fa fa-edit"></i></button>
										</a>
										<button type="button" class="btn btn-danger action-icon" data-toggle="modal" data-target="#exampleModal-{{$promocde->id}}"><i class="fa fa-trash-o"></i></button>
										
										<div class="modal fade" id="exampleModal-{{$promocde->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
											  <div class="modal-content">
												<div class="modal-header">
												  <h5 class="modal-title" id="exampleModalLabel">Delete Alert</h5>
												  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												  </button>
												</div>
												<div class="modal-body">
												 Do you want to delete this record ?
												</div>
												<div class="modal-footer">
												  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
												  	<a href="{{ url('delete-promocode/'.$promocde->id) }}" > 
														<button type="button" class="btn btn-danger">Yes</button>
													</a>
												</div>
											  </div>
											</div>
										  </div>
									</td>
								</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endSection