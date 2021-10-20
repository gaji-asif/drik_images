<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Drikimages | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/css/drik/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/icofont.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/responsive.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
<!-- Preloader -->


<div class="d-lg-flex half">

    <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('public/images/img-9.jpg') }}')"></div>

    <div class="contents order-2 order-md-1">
        <div class="row">
    <div class="top_layer text-center mb-2 mt-2">
        <img width="50%" src="{{asset('public/images/Drik images logo.png')}}">
    </div>
</div>
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <div class="col-md-10">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link "  href="{{url('user-login')}}"  >Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{url('user-register')}}" >Register</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
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
                 

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <div>
                            <div class="">
                                <h3>Register</h3>
                                <p>New to Drikimages Images?</p>
                            </div>
                            <form action="{{route('user-registration')}}" method="post">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group first">
                                            <label for="user_first_name">First Name</label>
                                            <input name="first_name" type="text" class="form-control" value="{{old('first_name')}}" id="user_first_name" required="required" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group first">
                                            <label for="user_last_name">Last Name</label>
                                            <input name="last_name" type="text" class="form-control" value="{{old('last_name')}}" id="user_last_name" required="required"  />
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group last p-0">
                                    <label for="user_type " class="pl-2">Register as - Buyer, Contributer</label>
                                    <select name="user_type" class="form-control " id="user_type" required="required">
                                        <option></option>
                                        <option @if(old('user_type') == 2) selected @endif value="2">Buyer</option>
                                        <option  @if(old('user_type') == 1) selected @endif value="1">Contributor</option>
                                    </select>

                                </div>
                              
                                {{-- <div class="form-group last mb-3">
                                    <label for="company_name">Company name (optional)</label>
                                    <input name="company_name" type="text" class="form-control" id="company_name" value="{{old('company_name')}}" required="required" />
                                </div> --}}

                                <div class="form-group last mb-3">
                                    <label for="job_title">Job title <span>(optional)</span></label>
                                    <input name="job_title" class="form-control" id="job_title" value="{{old('job_title')}}" />
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="phone">Phone Number<span></span></label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{old('phone')}}" />
                                </div>
                                <div class="form-group last p-0">
                                    <label for="country" class="pl-2">Country</label>
                                    <select name="country" class="form-control" id="country" >
                                        <option></option>
                                      
                                    </select>

                                </div>
                                <div class="form-group last mb-3">
                                    <label for="user_email">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="user_email" value="{{old('email')}}" />
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="password">Password</label>
                                    <input name="password" type="password" class="form-control" id="password" required="required" />
                                </div>

                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <button type="submit" class="btn btn-block btn-primary text-white">Register</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="baseUrl" value="{{url('/')}}">
<script src="{{asset('public/js/drik_js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/drik_js/bootstrap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{asset('public/js/drik_js/main.js')}}"></script>
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

</body>
</html>