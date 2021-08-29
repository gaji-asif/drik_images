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
                      
                            <div class="col-xl-12 col-md-12">
                                <div class="alert ">
                                  <strong>Please contact with admin via email for any kind of query. Admin email : info.admin@drik_Gallery.com</strong>
                                </div>
                            </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('web.partials.footer')
