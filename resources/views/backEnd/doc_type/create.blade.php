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
				<h5>Add New Type</h5>
			</div>
			<div class="card-block">
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'doc_type_code',
				'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
				                <label for="type_name" class="col-md-4 col-form-label text-md-right">Document Type</label>

				                <div class="col-md-6">
				                    <input id="type_name" type="text" class="form-control{{ $errors->has('type_name') ? ' is-invalid' : '' }}" name="type_name" value="{{ old('type_name') }}" autocomplete="off" >

				                    @if ($errors->has('type_name'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('type_name') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

				            <div class="form-group row">
				                <label for="type_code" class="col-md-4 col-form-label text-md-right">Document Type Code</label>

				                <div class="col-md-6">
				                    <input id="type_code" type="text" class="form-control{{ $errors->has('type_code') ? ' is-invalid' : '' }}" name="type_code" value="{{ old('type_code') }}" autocomplete="off" >

				                    @if ($errors->has('type_code'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('type_code') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

				            

				          

				           


				          
						</div>
					</div>
					<div class="form-group row mt-4">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary m-b-0">Add</button>
						</div>
					</div>
				{{ Form::close()}}
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="card">
			<div class="card-header">
				<h5>Doc Type & Code</h5>
			</div>
			<div class="card-block">
				<div class="dt-responsive table-responsive">
				<table id="basic-btn" class="table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th>SL.</th>
							<th>Doc Type</th>
							<th>Type Code</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($doc_types))
							@php $i = 1 @endphp
							@foreach($doc_types as $doc_type)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$doc_type->type_name}}</td>
								<td>{{$doc_type->type_code}}</td>
								<td></td>
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