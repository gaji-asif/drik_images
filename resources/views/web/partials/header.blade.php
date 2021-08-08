<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drikimages | Home</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <script src="{{asset('public/js/drik_js/jquery.min.js')}}"></script>
    <script src="{{asset('public/js/drik_js/masonry.pkgd.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('public/bower_components/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('public/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>


    <link rel="stylesheet" type="text/css" href="{{asset('public/bower_components/select2/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/bower_components/multiselect/css/multi-select.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-tagsinput.css')}}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/icofont.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/sidebar.css')}}">
    <script src="{{asset('public/js/imagesLoaded.js')}}"></script>
    <script src="{{asset('public/js/common.js')}}"></script>
</head>

<body>
<!-- Preloader -->
<div class="preloader-wrap">
    <div class="preloader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
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
                            </td>--}}

                            <td class="v-align-middle">
                                <div class="product d-flex align-items-center">
                                    <div class="product-image">
                                        <img class="w-100" src="{{$details["thumbnail_url"]}}" alt="">
                                    </div>
                                    <div class="product-info">
                                        <table class="table table-bordered m-0">
                                            <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>{{$details["title"]}}&nbsp;&nbsp;|&nbsp;&nbsp;1205797237</td>
                                            </tr>

                                            <tr>
                                                <td>Size</td>
                                                <td>4445 x 6668 px (14.82 x 22.23 in.) - 300 dpi - RGB File size on download 15 MB</td>
                                            </tr>

                                            <tr>
                                                <td>License type:</td>
                                                <td>Royalty-free|View license summaries</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>

                            <td class="v-align-middle w-10 text-right">৳ @if(isset($details["price"])) {{$details["price"]}} @endif</td>
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
                <h5 class="mb-0 text-total">Subtotal : ৳<span id="cart-total">{{$total}}</span> BDT</h5>
            </div>
            <div class="text-right">
                <a href="{{route('checkout')}}" class="btn btn-sm theme-btn">Checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- Cart sidebar End-->



<div class="page">
    <!-- Header Part Start -->
    @include('layouts.menu')
    <!-- Header Part End -->
