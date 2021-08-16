@include('web.partials.header')

<div class="row col-md-12" style="min-height: 450px; background-color: #eff0f4; padding-top: 10px; padding-bottom: 5px;">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <p>
                    <span>
                        <img width="40" class="rounded-circle" src="{{ asset($user->upload_img) }}" alt="">
                    </span>
                    <span>{{ Auth::user()->name }}</span>
                </p>
                <hr>
                @if( Auth::user()->active_status == 1)
                    @include('web.contributors.sidemenu_active')
                @elseif( Auth::user()->active_status == 0) 
                    @include('web.contributors.sidemenu_deactivate')
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="card">
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

                    <div class="card">
                        <div class="card-header">
                            <h5>View Profile</h5>
                        </div>
                        <div class="card-block">
                            {{ Form::open(['class' => '', 'files' => true, 'url' => 'customer-edit-profile', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ $user->company_name }}" autocomplete="off" >
                                            @if ($errors->has('company_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($user->user_type == 1)
                                    <div class="form-group row">
                                        <label for="job_title" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control{{ $errors->has('job_title') ? ' is-invalid' : '' }}" name="job_title" value="{{ $user->job_title }}" autocomplete="off" >
                                            @if ($errors->has('job_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('job_title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" autocomplete="off" >
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
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" autocomplete="off">
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right" >{{ __('Old Password') }}</label>
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="" disabled value="{{ $user->password }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
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
                                        <label for="upload_document" class="col-md-4 col-form-label text-md-right">Upload Image </label>
                                        <div class="col-md-3">
                                            <input data-preview="#preview" class="form-control" type="file" name="upload_img" id="upload_img">
                                            @if ($errors->has('upload_img'))
                                            <span class="invalid-feedback" role="alert" >
                                                <span class="messages"><strong>{{ $errors->first('upload_img') }}</strong></span>
                                            </span>
                                            @endif
                                        </div>
                                        <div>
                                            <img width="60" src="{{ asset($user->upload_img) }}" alt="No Image Found">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col-sm-4 offset-md-4 text-center">
                                    <button type="submit" class="btn btn-primary m-b-0">Update</button>
                                </div>
                            </div>
                            {{ Form::close()}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('web.partials.footer')
