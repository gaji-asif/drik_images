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
					<h5>Edit Image use</h5>
				@else
					<h5>Add Image use</h5>
				@endif
				
			</div>
			<div class="card-block">
				@if(isset($editData))
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'image_use/'.$editData->id ,'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
				@else
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'image_use','method' => 'POST', 'enctype' => 'multipart/form-data']) }}
				@endif
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
				                <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Image Use') }}</label>
				                <div class="col-md-6">
					                <select class="js-example-basic-single col-sm-12 {{ $errors->has('cat_id') ? ' is-invalid' : '' }}" name="cat_id" id="cat_id" onchange="imageUsage(this)" required>
									<option value="">Image Use</option>
									@if(isset($image_usage_categories))
										@foreach($image_usage_categories as $item)
											<option value="{{ $item->id }}" @if(isset($editData)) {{ $editData->category_id == $item->id ? 'selected' : ''  }} @else{{ old('cat_id')== $item->id ? 'selected' : ''  }}@endif>{{$item->cat_name}}</option>
										@endforeach
									@endif
									</select>
						
								</div>
				            </div>
							<div class="form-group row">
				                <label for="sub_cat_id" class="col-md-4 col-form-label text-md-right">{{ __('Details of use') }}</label>
				                <div class="col-md-6">
					                <select class="js-example-basic-single col-sm-12 {{ $errors->has('sub_cat_id') ? ' is-invalid' : '' }}" name="sub_cat_id" id="sub_cat_id" required>
									<option value="">Details of use</option>
									@if(isset($sub_cat))
										@foreach($sub_cat as $item)
											<option value="{{ $item->id }}" @if(isset($editData)) {{ $editData->id == $item->id ? 'selected' : ''  }} @else{{ old('cat_id')== $item->id ? 'selected' : ''  }}@endif>{{$item->sub_cat_name}}</option>
										@endforeach
									@endif
									</select>
								</div>
				            </div>


							<div class="form-group row">
				                <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

				                <div class="col-md-6">
				                    <input id="price" type="number" step="0.1" min="0.1" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="@if(isset($editData)){{$editData->price}}@else {{ old('price')}}@endif" required autocomplete="off" required>
				                </div>
				            </div>

				
						

						</div>
					</div>
					<div class="form-group row mt-4">
						<div class="col-sm-12 text-center">
							@if(isset($editData))
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
				<h5>Image use (@if(isset($data) && count($data)>0 ){{count($data)}}@else{{0}}@endif)</h5>
			</div>
			<div class="card-block">
				<div class="dt-responsive table-responsive">
					<table id="basic-btn" class="table table-striped table-bordered nowrap">
						<thead>
						<tr>
							<th>Sl</th>
							<th>Category Name</th>
							<th>Sub Category Name</th>
							<th>Price</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						@if(isset($data))
							@php $i = 1 @endphp
							@foreach($data as $item)
								<tr>
									<td>{{$i++}}</td>
									<td>{{$item->categories->cat_name}}</td>
									<td>{{$item->sub_cat_name}}</td>
									<td>{{$item->price}}</td>
									<td>
										<a href="{{ url('image_use/'.$item->id.'/edit') }}" title="Edit">
											<button type="button" class="btn btn-info action-icon"><i class="fa fa-edit"></i></button>
										</a>
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

<script>
	imageUsage = function (obj){

		var cat_id = obj.value;
		$.ajax({
			url: `${baseUrl}/image_usages_sub_category`,
			type: "get",
			data: {
				cat_id: cat_id
			},
			cache: false,
			success: function(response){
				let res = JSON.parse(response);
				$(`#sub_cat_id`).html('');
				$(`#sub_cat_id`).html('`<option >Details of use</option>`');
				$.each(res,function(i, el) {
					let makeOption = `<option value="${el.id}">${el.sub_cat_name}</option>`;
					$(`#sub_cat_id`).append(makeOption)
				});
			}
		});
	};
</script>
@endSection