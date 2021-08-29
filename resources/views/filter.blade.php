@extends('layouts.master')

@section('main-content')

<style>

.loader-ellips {
font-size: 20px; /* change size here */
position: relative;
width: 4em;
height: 1em;
margin: 10px auto;
}
.loader-ellips__dot {
display: block;
width: 1em;
height: 1em;
border-radius: 0.5em;
background: #555; /* change color here */
position: absolute;
animation-duration: 0.5s;
animation-timing-function: ease;
animation-iteration-count: infinite;
}
.loader-ellips__dot:nth-child(1),
.loader-ellips__dot:nth-child(2) {
left: 0;
}
.loader-ellips__dot:nth-child(3) { left: 1.5em; }
.loader-ellips__dot:nth-child(4) { left: 3em; }
@keyframes reveal {
from { transform: scale(0.001); }
to { transform: scale(1); }
}
@keyframes slide {
to { transform: translateX(1.5em) }
}
.loader-ellips__dot:nth-child(1) {
animation-name: reveal;
}
.loader-ellips__dot:nth-child(2),
.loader-ellips__dot:nth-child(3) {
animation-name: slide;
}
.loader-ellips__dot:nth-child(4) {
animation-name: reveal;
animation-direction: reverse;
}
</style>
<body class="hold-transition skin-blue sidebar-mini search_result">

<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index.html" class="logo">
            <span class="logo-mini"><i class="fas fa-filter"></i></span>
            <span class="logo-lg">Filter <i class="fas fa-filter"></i></span>
        </a>
        <nav class="navbar navbar-static-top p-0 pr-3">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <!-- <li class="header">MAIN NAVIGATION</li> -->
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-arrows-alt"></i> <span>SORT BY</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu" id="sort-menu">
                        <li class="active" data-value="asc">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Newest</a>
                        </li>
                        <li data-value="desc">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Oldest</a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Most Popular</a>--}}
{{--                        </li>--}}
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="far fa-clock"></i> <span>TIME</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu" id="time-menu">
                        <li data-value="1">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Last 24 Hours</a>
                        </li>
                        <li data-value="2">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Last 48 Hours</a>
                        </li>
                        <li data-value="3">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Last 72 Hours</a>
                        </li>
                        <li data-value="7">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Last 7 Days</a>
                        </li>
                        <li data-value="30">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Last 30 Days</a>
                        </li>
                        <li data-value="365">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Last 12 Months</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fas fa-expand"></i> <span>ORIENTATION</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu" id="orientation-menu">
                        <li data-value="vertical">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Vertical</a>
                        </li>
                        <li data-value="horizontal">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Horizontal</a>
                        </li>
                        <li data-value="square">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Square</a>
                        </li>
                        <li data-value="panoramic">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Panoramic Horizontal</a>
                        </li>
                    </ul>
                </li>

{{--                <li class="treeview">--}}
{{--                    <a href="#">--}}
{{--                        <i class="fas fa-compress"></i> <span>IMAGE RESOLUTION</span>--}}
{{--                        <span class="pull-right-container">--}}
{{--                                <i class="fa fa-angle-left pull-right"></i>--}}
{{--                            </span>--}}
{{--                    </a>--}}
{{--                    <ul class="treeview-menu">--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;All</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;12 MP and larger</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;16 MP and larger</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;21 MP and larger</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>PEOPLE</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu" id="people-menu">
                        <li data-value="no_people">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;No people</a>
                        </li>
                        <li data-value="1_person">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;People-1</a>
                        </li>
                        <li data-value="2_person">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;People-2</a>
                        </li>
                        <li data-value="3_person">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;People-3</a>
                        </li>
                        <li data-value="group">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Group</a>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>PEOPLE COMPOSITION</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu" id="people-composition">
                        <li data-value="head_shot">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Head shot</a>
                        </li>
                        <li data-value="waist_up">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Waist up</a>
                        </li>
                        <li data-value="full_length">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Full length</a>
                        </li>
                        <li data-value="3_quarter">
                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;3 quarter</a>
                        </li>
                    </ul>
                </li>

{{--                <li class="treeview">--}}
{{--                    <a href="#">--}}
{{--                        <i class="fas fa-file-image"></i> <span>IMAGE STYLE</span>--}}
{{--                        <span class="pull-right-container">--}}
{{--                                <i class="fa fa-angle-left pull-right"></i>--}}
{{--                            </span>--}}
{{--                    </a>--}}
{{--                    <ul class="treeview-menu">--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Image Style-1</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Image Style-2</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Image Style-3</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Image Style-4</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-camera-retro"></i> <span>PHOTOGRAPHERS</span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu" id="photographer-menu">
{{--                        @foreach($photographers as $photographer)--}}
{{--                            <li data-value="{{$photographer->id}}">--}}
{{--                                <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;{{$photographer->name}}</a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
                        <form action="" id="photographer-form">
                            <div class="form-group">
                                <input autocomplete="off" type="text" id="photographer_name" class="form-control" placeholder="Photographer">
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Search</button>
                        </form>
                    </ul>
                </li>

{{--                <li class="treeview">--}}
{{--                    <a href="#">--}}
{{--                        <i class="fas fa-map-marker-alt"></i> <span>LOCATION</span>--}}
{{--                        <span class="pull-right-container">--}}
{{--                                <i class="fa fa-angle-left pull-right"></i>--}}
{{--                            </span>--}}
{{--                    </a>--}}
{{--                    <ul class="treeview-menu">--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Location-1</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Location-2</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Location-3</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Location-4</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li class="treeview">--}}
{{--                    <a href="#">--}}
{{--                        <i class="fas fa-certificate"></i> <span>LICENSE TYPE </span>--}}
{{--                        <span class="pull-right-container">--}}
{{--                                <i class="fa fa-angle-left pull-right"></i>--}}
{{--                            </span>--}}
{{--                    </a>--}}
{{--                    <ul class="treeview-menu">--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;License-1</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;License-2</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="gallery-2 m-0 p-2">
            <div class="">
                <div class="grid">
                    @foreach($images as $image)
                        <div class="grid-item grid-image">
                            <div class="img">
                                <img class="w-100" src="{{$image->thumbnail_url}}" alt="" />

                                <div class="img-details">
                                    <p class="category-name">Mountains</p>
                                    <h4 class="image-name">Mountains with Cloud and Lake</h4>
                                </div>
                                <div class="corner-top"></div>
                                <div class="corner-bottom"></div>
                                <a href="#" class="image-popup" data-toggle="modal" data-target="#image_details-{{$image->id}}"></a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="image_details-{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="image_detailsTitle" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="modal-close" data-dismiss="modal">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <div class="form-row align-items-center">
                                                <div class="col-md-9">
                                                    <div class="full-img">
                                                        <img class="w-100" src="{{$image->thumbnail_url}}" alt="">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="author">
                                                        <div class="author-img">
                                                            <img class="w-100" src="{{$image->thumbnail_url}}" alt="">
                                                        </div>
                                                        <div class="author-info">
                                                            <span class="author-name">Author Name</span>
                                                        </div>
                                                    </div>

                                                    <div class="actions text-center">
                                                        <button class="btn author-action-button"><i class="icofont-like"></i>&nbsp;50</button>
                                                        <button class="btn author-action-button"><i class="icofont-star"></i>&nbsp;50</button>
                                                        <button class="btn author-action-button"><i class="icofont-share"></i>&nbsp;50</button>
                                                    </div>

                                                    <div class="purchase">
                                                        <h6>PURCHASE A LICENSE</h6>

                                                        <div class="list-group">
                                                            <div class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="image-sizes" id="smallRadio" value="small_price">
                                                                    <label class="form-check-label" for="smallRadio">Small</label>
                                                                </div>

                                                                <span class="badge badge-pill">${{$image->small_price}}</span>
                                                            </div>

                                                            <div class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="image-sizes" id="mediumRadios" value="medium_price">
                                                                    <label class="form-check-label" for="mediumRadios">Medium</label>
                                                                </div>

                                                                <span class="badge badge-pill">${{$image->medium_price}}</span>
                                                            </div>

                                                            <div class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="image-sizes" id="largeRadio" value="large_price">
                                                                    <label class="form-check-label" for="largeRadio">Large</label>
                                                                </div>

                                                                <span class="badge badge-pill">${{$image->large_price}}</span>
                                                            </div>
                                                        </div>

                                                        <div class="enter-promo_code">
                                                            <div class="form-group form-row align-items-center">
                                                                <label for="promo_code" class="col-sm-7 col-form-label">Discount/Promo Code&nbsp;&nbsp;:</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" class="form-control" id="promo_code" placeholder="Promo Code">
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-row align-items-center">
                                                                <label for="price" class="col-sm-7 col-form-label">Price (After discount)&nbsp;&nbsp;:</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" class="form-control" id="price" placeholder="0.00">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="download">
                                                            <button onclick="addToCart('{{$image->id}}')" class="btn btn-block download-btn" data-dismiss="modal"><i class="icofont-download"></i> Add to cart</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

               
                </div>
                     <div class="page-load-status">
                        <div class="loader-ellips infinite-scroll-request">
                          <span class="loader-ellips__dot"></span>
                          <span class="loader-ellips__dot"></span>
                          <span class="loader-ellips__dot"></span>
                          <span class="loader-ellips__dot"></span>
                        </div>
                        <p class="infinite-scroll-last">End of content</p>
                        <p class="infinite-scroll-error">No more pages to load</p>
                </div>
                {{-- {{ $images->links()  }} --}}
            </div>
        </div>
    </div>
</div>

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
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    let search = location.search
    var elem2 = document.querySelector('.grid');
    var infScroll = new InfiniteScroll( '.grid', {
      path: `${search}&page=@{{#}}`,
      append: 'figure',
      history: false,
      status: '.page-load-status',
    });
</script>
<script src="{{asset('public/js/filter.js')}}"></script>
@endsection
