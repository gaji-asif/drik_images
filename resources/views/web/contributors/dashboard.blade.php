@include('web.partials.header')

<div class="row col-md-12" style="min-height: 450px; background-color: #eff0f4; padding-top: 20px; padding-bottom: 5px;">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <p>
                    <span>
                        <img width="40" class="rounded-circle" src="{{ asset($user->upload_img) }}" class="img-radius" alt="">
                    </span>
                    <span>{{ Auth::user()->name }}</span>
                </p>
                <hr>
        
                    @include('web.contributors.sidemenu')
        
            
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="card">
            <div class="col-lg-12 mt-4">
                <div class="container">
                    <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                        @if (auth()->user()->is_confirm == 0)
                            <div class="col-xl-12 col-md-12">
                                <div class="alert alert-danger">
                                  <strong>Admin are reviwing your account. Please wait for approval.And upload your portfolio Images.</strong>
                                </div>
                            </div>
                        @endif
                        

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block" style="padding: 32px; text-align: center;">
                                    <a href="{{url('contributor-uploaded-protfolio-images')}}">
                                        <div class="row align-items-center m-l-0">
                                            <div class="col-auto" style="text-align: center;">
                                            </div>
                                            <div class="col-auto">
                                                <h6 class="text-muted m-b-10">Total Uploads (Portfolio)</h6>
                                                <h2 class="m-b-0">@if(isset($allUploadProtofolios)){{count($allUploadProtofolios)}}@else 0 @endif</h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block" style="padding: 32px; text-align: center;">
                                    <a href="{{url('contributor-uploaded-images')}}">
                                        <div class="row align-items-center m-l-0">
                                            <div class="col-auto" style="text-align: center;"></div>
                                            <div class="col-auto">
                                                <h6 class="text-muted m-b-10">Total Uploads</h6>
                                                <h2 class="m-b-0">@if(isset($allUpload)){{count($allUpload)}}@else 0 @endif</h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block" style="padding: 32px; text-align: center;">
                                    <a href="#">
                                        <div class="row align-items-center m-l-0">
                                            <div class="col-auto" style="text-align: center;">
                                            </div>
                                            <div class="col-auto">
                                                <h6 class="text-muted m-b-10">Approved</h6>
                                                <h2 class="m-b-0">3</h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block" style="padding: 32px; text-align: center;">
                                    <a href="#">
                                        <div class="row align-items-center m-l-0">
                                            <div class="col-auto" style="text-align: center;">
                                            </div>
                                            <div class="col-auto">
                                                <h6 class="text-muted m-b-10">Total Cancel</h6>
                                                <h2 class="m-b-0">2</h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include('web.partials.footer')
