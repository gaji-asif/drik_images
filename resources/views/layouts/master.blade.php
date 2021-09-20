<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drikimages | Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="currency" content="{{Config::get('app.curreny')}}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <script src="{{asset('public/js/drik_js/jquery.min.js')}}"></script>
    <script src="{{asset('public/js/imagesLoaded.js')}}"></script>
    <script src="{{asset('public/js/drik_js/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('public/js/common.js')}}"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/icofont.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/sidebar.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{asset('public/js/dev_moin.js')}}"></script>

</head>

<body>
<!-- Preloader -->
{{-- <div class="preloader-wrap">
    <div class="preloader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div> --}}
<?php $total=0 ?>

<!-- Cart sidebar start-->
<div class="cart_sidebar w3-bar-block w3-card w3-animate-left"id="mySidebar">
    <div class="cart">
        <div class="cart-header d-flex align-items-center justify-content-between">
            <button class="btn btn-sm border px-2" onclick="cart_close()">Close &times;</button>
            <h5 class="mb-0 text-total"><i class="icofont-prestashop"></i>
                <span id="cart-count">
                    @if(session('cart'))
                        {{ count(session('cart')) }}
                    @else
                        0
                    @endif
                </span>

                Items
            </h5>
        </div>
        <div class="product-list">
            <table class="table mb-0">
                <tbody id="drik-cart">
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
               
                        <?php $total += $details->price ?>
                        <tr>
                            {{--<td class="v-align-middle w-5">
                                
                                <button class="qty_plus_btn"><i class="icofont-simple-up"></i></button>
                                
                                <input type="text" class="qty" id="qty" name="" value="0" >
                                
                                <button class="qty_minus_btn"><i class="icofont-simple-down"></i></button>
                            
                                <button class="qty_minus_btn"><i class="icofont-simple-down"></i></button>
                            
                            </td>--}}

                            <td class="v-align-middle">
                                <div class="product d-flex align-items-center">
                                    <div class="product-image">
                                        <img class="w-100" src="{{$details["thumbnail_url"]}}" alt="">
                                    </div>
                                    <div class="product-info w-100">
                                        <table class="table table-bordered  m-0">
                                            <tbody>
                                            <tr>
                                                <td>Title: </td>
                                                <td>{{$details["title"]}}</td>
                                            </tr>

                                            <tr>
                                                <td>Image id: </td>
                                                <td>{{$details["id"]}}</td>
                                            </tr>

                                            <tr>
                                                <td>License type: </td>
                                                <td>{{$details["type"]}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>

                            <td class="v-align-middle w-10 text-right">{{Config::get('app.curreny')}}  @if(isset($details["price"])) {{number_format((float)$details["price"], 2, '.', '')}} @endif</td>
                            <td class="v-align-middle w-5 text-right">
                                <button class="product-minus" onclick="removeFromCart('{{ $id }}')"><i class="icofont-close"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>


        <div class="cart-footer d-flex align-items-center justify-content-between">
            <div class="">
                <!-- <h6 class="mb-0 text-secondary">Items selected for purchase: 2</h6> -->
                <h5 class="mb-0 text-total">Subtotal : {{Config::get('app.curreny')}} <span id="cart-total">{{number_format((float) $total, 2, '.', '')}}</span></h5>
            </div>
            <div class="text-right">
                {{-- @if(session()->has('cart') && count(session()->get('cart')) > 0) --}}
                    <a href="{{route('checkout')}}" class="btn btn-sm theme-btn">Checkout</a>
                {{-- @else
                    <button class="btn btn-sm theme-btn" disabled>Checkout</button>
                @endif --}}
                
            </div>
        </div>
    </div>
</div>
<!-- Cart sidebar End-->



<div class="page">
    <!-- Header Part Start -->
    @include('layouts.menu')
    <!-- Header Part End -->

@if(!isset($page))
    <!-- Hero section start -->
    <div class="hero  @if(isset($photographers)) height_custom @endif">
        <style type="text/css">
            .height_custom{
                height: 150px !important;
            }
        </style>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-12 col-md-9 col-lg-6 search">
                    @if(isset($home))
                    <div class="hero-text">
                        <h1>Bring the World’s Best Visual Content to Your Work</h1>
                        <h5>Over 1.9 million+ high quality stock images shared by our talented community.</h5>
                    </div>
                    @endif
                    <form method="GET" action="{{route('search-image')}}">
                        <div class="form-group search_form">
                            <input name="search_key" type="text" class="form-control" id="" placeholder="Search images, vectors and videos">
                            <button type="submit" class="btn search_submit_button"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    @if(isset($home))
                    <small id="" class="form-text text-muted">You can search whatever you want.</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
    <!-- Hero section end -->

@yield('main-content')

    <!-- Footer start -->
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_widget">
                        <div class="footer_widget_title">
                            <h2>SUPPORT</h2>
                        </div>
                        <ul class="footer_widget_content">
                            <li><span>Phone: &nbsp;&nbsp;&nbsp;&nbsp;</span>+000 333 879 788</li>
                            <li><span>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> support@gmail.com</li>
                            <li><span>Address: &nbsp;</span> king street,avenue</li>
                        </ul>

                        <div class="footer_social">
                            <ul class="footer_social_icons">
                                <li><a href="#"><i class="fab fa-skype"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_widget">
                        <div class="footer_widget_title">
                            <h2>PRODUCTS</h2>
                        </div>
                        <ul class="footer_widget_content">
                            <li><i class="icofont-double-right"></i><a href="#">Drik Images API</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Media Manager</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Drikimages.com</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">DrikGallery</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">200k Stock Images</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_widget">
                        <div class="footer_widget_title">
                            <h2>SOLUTIONS</h2>
                        </div>
                        <ul class="footer_widget_content">
                            <li><i class="icofont-double-right"></i><a href="#">Pricing and solutions</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Premium Access</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Rights and clearance</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Image collections</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Custom solutions</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_widget">
                        <div class="footer_widget_title">
                            <h2>COMPANY</h2>
                        </div>
                        <ul class="footer_widget_content">
                            <li><i class="icofont-double-right"></i><a href="#">Press room</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Careers</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Affiliates</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Grants and giving</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">200 + Photographers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="copyright">© 2021 All Rights Reserved <a target="_blank" href="#">Drik Gallery</a></p>
                </div>
                <div class="col-md-6">
                    {{-- <p class="design_by">Design & Developed by <a target="_blank" href="http://nextgenitltd.com/">NEXTGEN IT</a></p> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Footer end -->
</div>




<script src="{{asset('public/js/drik_js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/js/drik_js/sidebar.js')}}"></script>

<script src="{{asset('public/js/drik_js/main.js')}}"></script>

<script>
    function cart_open() {
        document.getElementById("mySidebar").style.marginRight = "0%";
        document.getElementById("mySidebar").style.transition = "all 0.3s";
        document.getElementById("openNav").style.display = "none";
    }
    function cart_close() {
        document.getElementById("mySidebar").style.marginRight = "-110%";
        document.getElementById("mySidebar").style.transition = "all 0.3s";
        document.getElementById("openNav").style.display = "inline-block";
    }
</script>

<script src="{{asset('public/js/image_usage_calculator.js')}}"></script>
<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</body>
</html>
