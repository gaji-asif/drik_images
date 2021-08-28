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
				<h5>Add New Contributer</h5>
			</div>
			<div class="card-block">
				@if(isset($editData)) 
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'contributor/'.$editData->id,'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
				@else 
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'contributor','method' => 'POST', 'enctype' => 'multipart/form-data']) }}
				@endif
				
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
				                <label for="cat_name" class="col-md-4 col-form-label text-md-right">Name</label>

				                <div class="col-md-6">
				                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="@if(isset($editData)){{$editData->name}} @else {{ old('first_name') }} @endif" autocomplete="off" required="required">

				                    @if ($errors->has('first_name'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('first_name') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

				           <!--  <div class="form-group row">
				                <label for="cat_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

				                <div class="col-md-6">
				                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="@if(isset($editData)){{$editData->last_name}} @else {{ old('first_name') }} @endif" autocomplete="off" >

				                    @if ($errors->has('last_name'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('last_name') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div> -->


				            <div class="form-group row">
				                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

				                <div class="col-md-6">
				                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="@if(isset($editData)){{$editData->email}} @else {{ old('email') }} @endif" autocomplete="off" required="required">

				                    @if ($errors->has('email'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('email') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

				             <div class="form-group row">
				                <label for="cat_name" class="col-md-4 col-form-label text-md-right">Company Name</label>

				                <div class="col-md-6">
				                    <input id="last_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="@if(isset($editData)){{$editData->company_name}} @else {{ old('company_name') }} @endif" autocomplete="off" >

				                    @if ($errors->has('company_name'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('company_name') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>
				            
				            <div class="form-group row">
				                <label for="cat_name" class="col-md-4 col-form-label text-md-right">Job Title</label>

				                <div class="col-md-6">
				                    <input id="job_title" type="text" class="form-control{{ $errors->has('job_title') ? ' is-invalid' : '' }}" name="job_title" value="@if(isset($editData)){{$editData->job_title}} @else {{ old('job_title') }} @endif" autocomplete="off" >

				                    @if ($errors->has('job_title'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('job_title') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>
							@if(isset($editData) )
								<div class="form-group row">
									<label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Confirm') }}</label>
									<div class="col-md-6">
										<select class="js-example-basic-single col-sm-12 {{ $errors->has('is_confirm') ? ' is-invalid' : '' }}" name="is_confirm" id="is_confirm">
										<option value="">Select a option</option>
										<option value="1" @if(isset($editData) && $editData->is_confirm == 1) selected @endif>Yes</option>
										<option value="0" @if(isset($editData) && $editData->is_confirm == 0) selected @endif>No</option>
										</select>
										@if ($errors->has('is_confirm'))
										<span class="invalid-feedback invalid-select" role="alert">
											<strong>{{ $errors->first('is_confirm') }}</strong>
										</span>
										@endif
									</div>
								</div>
				           @endif
						   @if(isset($editData) )
						   <div class="form-group row">
							   <label for="image_sell_percetages" class="col-md-4 col-form-label text-md-right">{{ __('Percentage Ratio') }}</label>
							   <div class="col-md-6">
								   <select class="js-example-basic-single col-sm-12 {{ $errors->has('image_sell_percetages') ? ' is-invalid' : '' }}" name="image_sell_percetages" id="image_sell_percetages">
								   <option value="">Select a option</option>
									@if(isset($image_sell_percetages))
										@foreach ($image_sell_percetages as $image_sell_percetage)
											<option value="{{$image_sell_percetage->id}}" @if($editData->contributor_percentage == $image_sell_percetage->id) selected @endif>{{$image_sell_percetage->name}}</option>
										@endforeach
									@endif
								   </select>
								   {{-- @if ($errors->has('is_confirm'))
								   <span class="invalid-feedback invalid-select" role="alert">
									   <strong>{{ $errors->first('is_confirm') }}</strong>
								   </span>
								   @endif --}}
							   </div>
						   </div>
					  @endif

						</div>
					</div>
					<div class="form-group row mt-4">
						<div class="col-sm-12 text-center">
							@if (isset($editData))
								<button type="submit" class="btn btn-primary m-b-0">Edit</button>
							@else
								<button type="submit" class="btn btn-primary m-b-0">Add</button>
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
				<h5>All Contributers</h5>
			</div>
			<div class="card-block">
				<div class="dt-responsive table-responsive">
				<table id="basic-btn" class="table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th>SL.</th>
							<th>First Name</th>
							<th>Company NAme</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($users))
							@php $i = 1 @endphp
							@foreach($users as $item)
							<tr>
								<td>{{$i++}}</td>
								<td>
									{{$item->name}}	
                                   </td>
								<td>
									{{$item->company_name}}	
                                   </td>
							
								<td>
									{{$item->email}}	
                                   </td>
								
								   <td>
									
									<a href="{{ url('contributor/'.$item->id.'/edit') }}" title="Edit">
										<button type="button" class="btn btn-info action-icon"><i class="fa fa-edit"></i></button>
									</a>
									
									
										<button type="button" class="btn btn-danger action-icon"  data-toggle="modal" data-target="#exampleModalss{{$item->id}}"><i class="fa fa-trash-o"></i></button>
										
										<div class="modal fade" id="exampleModalss{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<div>
															<h6>Do you want to Delete this item</h6>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<a href="{{url('contributor-delete', $item->id)}}">
															<button type="button" class="btn btn-success">Yes</button>
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