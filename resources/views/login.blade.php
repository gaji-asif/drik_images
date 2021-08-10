<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Drikimages | Home</title>
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
                            <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
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
                        <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                            <div class="">
                                <h3>Sign In</h3>
                                <p class="">Welcome to Drikimages!</p>
                            </div>
                            <form action="{{route('make-login')}}" method="post">
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="email" class="form-control" name="email" id="username" required="required" />
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required="required" />
                                </div>

                                {{-- <div class="d-flex mb-5 align-items-center">
                                    <div class="form-check text-left">
                                        <input type="checkbox" class="form-check-input" id="remember_me" />
                                        <label class="form-check-label" for="remember_me">Remember Me</label>
                                    </div>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                                </div> --}}

                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <button type="submit" class="btn btn-block btn-primary text-white">Log In</button>


                               <!--  <span class="d-block text-center my-4 text-muted">&mdash;&mdash;&mdash;&mdash;&mdash; OR SIGN IN WITH &mdash;&mdash;&mdash;&mdash;&mdash;</span>

                                <div class="social-login">
                                    <a href="#" class="facebook btn d-flex justify-content-center align-items-center"> <span class="icon-facebook mr-3"></span> Login with Facebook </a>
                                    <a href="#" class="google btn d-flex justify-content-center align-items-center"> <span class="icon-google mr-3"></span> Login with Google </a>
                                </div> -->
                            </form>
                        </div>




                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <div class="">
                                <h3>Register</h3>
                                <p>New to Drikimages Images?</p>
                            </div>
                            <form action="{{route('user-registration')}}" method="post">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group first">
                                            <label for="user_first_name">First Name</label>
                                            <input name="first_name" type="text" class="form-control" id="user_first_name" required="required" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group first">
                                            <label for="user_last_name">Last Name</label>
                                            <input name="last_name" type="text" class="form-control" id="user_last_name" />
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group last">
                                    <label for="user_type">Register as - Buyer, Contributer</label>
                                    <select name="user_type" class="form-control" id="user_type" required="required">
                                        <option></option>
                                        <option value="2">Buyer</option>
                                        <option value="1">Contributor</option>
                                    </select>

                                </div>
                               
                                <div class="form-group last mb-3">
                                    <label for="company_name">Company name (optional)</label>
                                    <input name="company_name" type="text" class="form-control" id="company_name" required="required" />
                                </div>

                                <div class="form-group last mb-3">
                                    <label for="job_title">Job title <span>(optional)</span></label>
                                    <input name="job_title" class="form-control" id="job_title" />
                                </div>
                                <div class="form-group last mb-3">
                                    <label for="user_email">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="user_email" />
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

<script src="{{asset('public/js/drik_js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/drik_js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/js/drik_js/main.js')}}"></script>
</body>
</html>