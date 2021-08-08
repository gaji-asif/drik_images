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
				<h5>Add New Category</h5>
			</div>
			<div class="card-block">
				@if(isset($editData)) 
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'category/'.$editData->id,'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
				@else 
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'category','method' => 'POST', 'enctype' => 'multipart/form-data']) }}
				@endif
				
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
				                <label for="cat_name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

				                <div class="col-md-6">
				                    <input id="cat_name" type="text" class="form-control{{ $errors->has('cat_name') ? ' is-invalid' : '' }}" name="cat_name" value="@if(isset($editData)){{$editData->cat_name}} @else {{ old('cat_name') }} @endif" autocomplete="off" >

				                    @if ($errors->has('cat_name'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('cat_name') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>
				            <div class="form-group row">
				                <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Parent Category') }}</label>
				                <div class="col-md-6">
					                <select class="js-example-basic-single col-sm-12 {{ $errors->has('parent_category_id') ? ' is-invalid' : '' }}" name="parent_category_id" id="parent_category_id">
									<option value="">Select Parent Category</option>
									@if(isset($parent_cat))
										@foreach($parent_cat as $item)
											@if (isset($editData))
												<option value="{{ $item->id }}" {{ $editData->parent_category_id == $item->id ? 'selected' : ''  }} >{{$item->cat_name}}</option>
											@else
												<option value="{{ $item->id }}" {{ old('parent_category_id')== $item->id ? 'selected' : ''  }} >{{$item->cat_name}}</option>
											@endif
										@endforeach
									@endif
									</select>
									@if ($errors->has('parent_category_id'))
									<span class="invalid-feedback invalid-select" role="alert">
										<strong>{{ $errors->first('parent_category_id') }}</strong>
									</span>
									@endif
								</div>
				            </div>

				            <div class="form-group row">
				                <label for="ordering" class="col-md-4 col-form-label text-md-right">{{ __('Order') }}</label>

				                <div class="col-md-6">
				                    <input id="ordering" type="text" class="form-control{{ $errors->has('ordering') ? ' is-invalid' : '' }}" name="ordering" value="@if(isset($editData)){{$editData->ordering}} @else {{ old('ordering') }} @endif">

				                    @if ($errors->has('ordering'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('ordering') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

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
				<h5>Categories</h5>
			</div>
			<div class="card-block">
				<div class="dt-responsive table-responsive">
				<table id="basic-btn" class="table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th>SL.</th>
							<th>Category</th>
							<th>Parent Category</th>
							<th>ordering</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($data))
							@php $i = 1 @endphp
							@foreach($data as $item)
							<tr>
								<td>{{$i++}}</td>
								<td>
									{{$item->cat_name}}	
                                   </td>
								<td>
									@if (isset($item->children) && !empty($item->children))
										{{$item->children->cat_name}}
																	
									@endif
								</td>
							
								<td>
									{{$item->ordering}}	
                                   </td>
								
								   <td>
									@can('Edit User')
									<a href="{{ url('category/'.$item->id.'/edit') }}" title="Edit">
										<button type="button" class="btn btn-info action-icon"><i class="fa fa-edit"></i></button>
									</a>
									@endcan
									@can('Delete User')
										<button type="button" class="btn btn-danger action-icon"  data-toggle="modal" data-target="#exampleModalss{{$item->id}}"><i class="fa fa-trash-o"></i></button>
									@endcan		
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
														<a href="{{url('delete-category', $item->id)}}">
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