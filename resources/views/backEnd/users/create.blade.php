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
				<h5>Add New User</h5>
			</div>
			<div class="card-block">
				{{ Form::open(['class' => '', 'files' => true, 'url' => 'user',
				'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
					<div class="row">
						<div class="col-md-12">
							<div class="form-group row">
				                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

				                <div class="col-md-6">
				                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autocomplete="off" >

				                    @if ($errors->has('name'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('name') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

				            <div class="form-group row">
				                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

				                <div class="col-md-6">
				                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete="off">

				                    @if ($errors->has('email'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('email') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>
				            <div class="form-group row">
				                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

				                <div class="col-md-6">
				                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" autocomplete="off">

				                    @if ($errors->has('phone'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('phone') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>

				            <div class="form-group row">
				                <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
				                <div class="col-md-6">
					                <select class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="role_id">
									<option value="">Select Role</option>
									@if(isset($roles))
										@foreach($roles as $role)
											@role('Adminstrator')
											<!-- @if( $role->name != 'Super Admin' ) -->
											<option value="{{ $role->id }}" {{ old('role_id')== $role->id ? 'selected' : ''  }} >{{$role->name}}</option>
											<!-- @endif -->
											@endrole
										@endforeach
									@endif
									</select>
									@if ($errors->has('role_id'))
									<span class="invalid-feedback invalid-select" role="alert">
										<strong>{{ $errors->first('role_id') }}</strong>
									</span>
									@endif
								</div>
				            </div>
				            <div class="form-group row">
				                <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('country') }}</label>
				                <div class="col-md-6">
					                <select class="js-example-basic-single col-sm-12 {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" id="country">
									{{-- <option value="">Select Role</option> --}}
									</select>
									@if ($errors->has('country'))
									<span class="invalid-feedback invalid-select" role="alert">
										<strong>{{ $errors->first('country') }}</strong>
									</span>
									@endif
								</div>
				            </div>

				            <div class="form-group row">
				                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

				                <div class="col-md-6">
				                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

				                    @if ($errors->has('password'))
				                        <span class="invalid-feedback" role="alert">
				                            <strong>{{ $errors->first('password') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>


				            <div class="form-group row">
				                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

				                <div class="col-md-6">
				                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
				                </div>
							</div>
							
							<div class="form-group row">
								<label for="upload_document" class="col-md-4 col-form-label text-md-right">Upload Image <font style="color: red;">*</font></label>
								
								<div class="col-md-6">
									<input data-preview="#preview" class="form-control" type="file" name="upload_img" id="upload_img" required="">
									@if ($errors->has('upload_img'))
										<span class="invalid-feedback" role="alert" >
											<span class="messages"><strong>{{ $errors->first('upload_img') }}</strong></span>
										</span>
									@endif
								</div>
							</div>

						</div>
					</div>
					<div class="form-group row mt-4">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary m-b-0">Add user</button>
						</div>
					</div>
				{{ Form::close()}}
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="card">
			<div class="card-header">
				<h5>Users</h5>
			</div>
			<div class="card-block">
				<div class="dt-responsive table-responsive">
				<table id="basic-btn" class="table table-striped table-bordered nowrap">
					<thead>
						<tr>
							<th>SL.</th>
							<th>User Name</th>
							<th>Email</th>
							<th>Role</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($users))
							@php $i = 1 @endphp
							@foreach($users as $user)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>
									@foreach($user->roles as $roles)
                                        @if($roles)
                                            {{$roles->name}}
                                        @endif
                                    @endforeach
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

<input type="hidden" id="baseUrl" value="{{url('/')}}">
<script>
    $(document).ready(function() {
        let baseUrl = $("#baseUrl").val();
        $.getJSON( `${baseUrl}/public/country.json`, function( data ) {
            var items = [];
            $.each( data, function( key, val ) {
                items.push( "<option value='" + val.name + "'>" + val.name + "</option>" );
            });
        
            $('#country').append(items);
        });
    });
</script>
@endSection