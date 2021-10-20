@extends('layouts.master')

@section('main-content')

    <style>
        body {
            margin: 0;
            overflow-x: hidden;
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
        }

        .grid::after {
            content: '';
            flex-grow: 999999999;
        }

        .grid>figure {
            margin: 4px;
            background-color: white;
            position: relative;
        }

        .grid>figure>i {
            display: block;
        }

        .grid>figure>img {
            position: absolute;
            top: 0;
            width: 100%;
            vertical-align: bottom;
        }

        .loader-ellips {
            font-size: 20px;
            /* change size here */
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
            background: #555;
            /* change color here */
            position: absolute;
            animation-duration: 0.5s;
            animation-timing-function: ease;
            animation-iteration-count: infinite;
        }

        .loader-ellips__dot:nth-child(1),
        .loader-ellips__dot:nth-child(2) {
            left: 0;
        }

        .loader-ellips__dot:nth-child(3) {
            left: 1.5em;
        }

        .loader-ellips__dot:nth-child(4) {
            left: 3em;
        }

        @keyframes reveal {
            from {
                transform: scale(0.001);
            }

            to {
                transform: scale(1);
            }
        }

        @keyframes slide {
            to {
                transform: translateX(1.5em)
            }
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

        figure img {
            width: 100%;
        }

        /* copy share url */
        .copy-text {
            position: relative;
            padding: 10px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;

        }


        .copy-text .share_link {
            /* padding: 10px; */
            font-size: 10px;
            color: #0d4444;
            ;
            border: none;
            outline: none;
        }



        .copy-text .author-action-button:before {
            content: "Copied";
            position: absolute;
            top: -20px;
            right: 54px;
            background: #0d4444;
            padding: 8px 10px;
            border-radius: 20px;
            font-size: 8px;
            display: none;
        }

        .copy-text .author-action-button:after {
            content: "";
            position: absolute;
            transform: rotate(45deg);
            display: none;
        }

        .copy-text.active .author-action-button:before,
        .copy-text.active .author-action-button:after {
            display: block;
        }

        @media (min-width: 1200px) {
            .modal-xl {
                max-width: 1200px;
            }
        }

        .accordion .card-header:after {
            font-family: 'FontAwesome';
            content: "\f068";
            float: right;
        }

        .accordion .card-header.collapsed:after {
            /* symbol for "collapsed" panels */
            content: "\f067";
        }

        .purchase .form-control {
            padding: .4rem .4rem;
            font-size: 12px;
            height: 34px;
        }

        .card-bodys {
            padding: 5px 10px 10px 5px;
        }
        #loadMore{
        font-weight: bold;
    }

    </style>
@php
function makeANewUrl()
{
   
    $search_key =  Request::get('search_key');
    $find_key = ""; 
    if(!is_null($search_key)){
        $find_key = $key = str_replace(' ', '+', $search_key);
       
    }
        // $find_key = 'search?search_key='.$find_key . '&';
        // $url = str_replace('search?',$find_key, $url);
       return $find_key;

}


@endphp
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
                                <li data-value="no_time">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;No Time</a>
                                </li>
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
                                <li data-value="no_orientation">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;No Orientation</a>
                                </li>
                                <li data-value="Vertical">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Vertical</a>
                                </li>
                                <li data-value="Horizontal">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Horizontal</a>
                                </li>
                                <li data-value="Square">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Square</a>
                                </li>
                                <li data-value="Panaromic">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Panoramic Horizontal</a>
                                </li>
                            </ul>
                        </li>



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
                                <li data-value="1">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;People-1</a>
                                </li>
                                <li data-value="2">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;People-2</a>
                                </li>
                                <li data-value="3">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;People-3</a>
                                </li>
                                <li data-value="0">
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
                                <li data-value="no_compostion">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;No COMPOSITION</a>
                                </li>
                                <li data-value="Head Shot">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Head shot</a>
                                </li>
                                <li data-value="Waist Up">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Waist up</a>
                                </li>
                                <li data-value="Full Length">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;Full length</a>
                                </li>
                                <li data-value="Three Quarter">
                                    <a href="#"><i class="fas fa-circle-notch"></i>&nbsp;&nbsp;3 quarter</a>
                                </li>
                            </ul>
                        </li>



                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-camera-retro"></i> <span>PHOTOGRAPHERS</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu" id="photographer-menu">

                                <form action="" id="photographer-form">
                                    <div class="form-group">
                                        <input autocomplete="off" type="text" id="photographer_name" class="form-control"
                                            placeholder="Photographer">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">Search</button>
                                </form>
                            </ul>
                        </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="gallery-2 ">
                    <div >
                        <div class="grid " id="filter_inner_div">
                            @include('filter-inner-div')
                            
                        </div>
                    </div>
                </div>
                <div id="" class="col-lg-12 text-center" style="margin: 0 auto; margin-bottom: 15px;margin-top: 15px;">
                    <div style="display: inline-block;">
                        <a href="javascript:void(0)" id="loadMore">Load more images . . . . .</a> 
                    </div>
                </div>
            </div>
            <input type="hidden" id="baseUrl" value="{{url('/')}}">


            <input type="hidden" id="appUrl" value="{{url('/')}}">
            <input type="hidden" id="searchKey" value="{{makeANewUrl()}}">

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
            <script>
                function onClickCopy(id) {

                    let copyText = document.querySelector(`.copy-text-${id}`);
                    let input = copyText.querySelector(`.share_link-${id}`);
                    console.log(input);
                    input.select();
                    document.execCommand("copy");
                    copyText.classList.add("active");
                    window.getSelection().removeAllRanges();
                    setTimeout(function() {
                        copyText.classList.remove("active");
                    }, 500);
                }

                $(document).on('click','#loadMore' , function()
                {
                    let searchKey = $('#searchKey').val() ? $('#searchKey').val() :'' ;

                    
                    let currentPage = $('#currentPage').val() ? parseInt($('#currentPage').val()) : 1;
                    currentPage += 1;
                
                    let nextPage = $('#lastPage').val();

                    let url = $('#appUrl').val();
                    
                    if (currentPage <= nextPage)
                    {
                        nextPageUrl = `${url}/search?page=${currentPage}`;
                    
                        $('#currentPage').val(currentPage);

                        if(currentPage == nextPage)
                        {
                            $(this).text('');
                            // $(this).text('No image available');
                        }
                      let getValues = $('.getValues').val();
                       $.each( getValues, function( key, value ) {
                            console.log(value);
                            $(value).html('');
                        });
                        $.ajax({
                            type: "GET",
                            url: nextPageUrl,
                            success: function(data) {
                                $(`#filter_inner_div`).append(data);
                            }
                        });

                       
                    }
                    
                });

                $(document).ready(function()
                {
                    let currentPage = $('#currentPage').val() ? parseInt($('#currentPage').val()) : 1;
                    let nextPage = parseInt($('#lastPage').val());
                    if(currentPage == nextPage)
                        {
                            $('#loadMore' ).text('');
                            // $(this).text('No image available');
                        }

                });
            </script>


            <script src="{{ asset('public/js/filter.js') }}"></script>
        @endsection
