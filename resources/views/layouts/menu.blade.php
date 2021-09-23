<style type="text/css">
    .nav-link{
        margin-right: 45px;
    }
    *.icon-blue {
  color: #0088cc;
}

*.icon-grey {
  color: grey;
}

.add_to_card_icon {
  /* width: 100px; */
  text-align: center;
  vertical-align: middle;
  position: relative;
}

.add_to_card_badge:after {
    content: attr(data-count);
    position: absolute;
    background: #ff6600;
    height: 25px;
    top: 0px;
    right: -7px;
    width: 25px;
    text-align: center;
    line-height: -4px;
    font-size: 20px;
    border-radius: 50%;
    color: white;
    border: 1px solid #ff6600;
    font-family: sans-serif;
    font-weight: bold;
}
.dropbtn {
  background-color: white;
  color: black;

  /* font-size: 16px; */
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 10;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;

}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
<div class="row">
    <div class="top_layer text-center mb-3">
        <img width="30%" src="{{asset('public/images/Drik images logo.png')}}">
    </div>
</div>
@php
 function navActive($url)
    {
        if(Request::path() == $url )
        {
            return 'active';
        }
        else {
            return " ";
        }
    }
@endphp
<div class="header">
        <nav class="navbar navbar-expand-lg bg-transparent bg-white" id="navbar-example2">
            <a class="navbar-brand" href="index-2.html">
                <img class="w-100" src="images/logo-ts.png" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <!-- @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('filter',['category' => $category->id])}}">{{$category->cat_name}}</a>
                        </li>
                    @endforeach -->
                    @if(!is_null(auth()->user()))
                        
                        <li class="nav-item">
                            <a class="nav-link {{navActive('your-dashboard')}}" href="{{route('your-dashboard')}}">Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item">
                       <a class="nav-link" href="{{url('/')}}">Home</a>
                   </li>
                   <li class="nav-item">
                
                        <div class="dropdown dropbtn">
                            <a class="nav-link" href="{{url('about')}}">About Us</a>
                            <div class="dropdown-content">
                              <a href="{{url('about')}}#drik_images">Drik Images</a>
                              <a href="{{url('about')}}#team">Team</a>
                              <a href="{{url('about')}}#usages_policy">Usages Policy</a>
                            </div>
                          </div>
                        
                   </li>
                   <li class="nav-item">
                    <div class="dropdown dropbtn">
                        <a class="nav-link" href="{{url('services')}}">Services</a>
                        <div class="dropdown-content" style="min-width:185px">
                          <a href="{{url('services')}}#stock">Stock</a>
                          <a href="{{url('services')}}#retouch_and_restoration">Retouch and Restoration</a>
                          <a href="{{url('services')}}#photo_library_setup">Photo Library Setup</a>
                          <a href="{{url('services')}}#photo_assignment">Photo Assignment</a>
                          <a href="{{url('services')}}#pricing">Pricing</a>
                        </div>
                      </div>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="#">Photoghapers</a>
                   </li>
                   <li class="nav-item">
                    <div class="dropdown dropbtn">
                        <a class="nav-link" href="{{url('stock')}}">Stock</a>
                        <div class="dropdown-content" style="min-width:185px">
                          <a href="{{url('stock')}}#fine_art_sales">Fine Art Sales</a>
                          <a href="{{url('stock')}}#categories">Categories</a>
                          <a href="{{url('stock')}}#special_collections">Special Collections</a>
                        </div>
                      </div>
                      
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="{{url('contact')}}">Contact</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="{{url('faq')}}">Faq</a>
                   </li>


                </ul>

                <div class="header_actions text-right navbar p-0">
                    <ul class="navbar-nav ml-auto align-items-center">

                        <li class="nav-item dropdown">
                           <!--  <a class="nav-link" href="sign-in.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icofont-user"></i>asdasd
                            </a> -->
                            @if(is_null(auth()->user()))
                                <a href="{{route('user-login')}}" class="btn btn-block theme-btn sign-up">Log In</a>
                            @else
                                <a href="{{route('your-dashboard')}}" class="btn theme-btn ">
                                    <img width="40" class="rounded-circle" src="{{ asset(auth()->user()->upload_img) }}" alt="">
                                    {{ Auth::user()->name }}
                                </a>
                            @endif
                            <div class="dropdown-menu user-custom" aria-labelledby="navbarDropdown">
                                @if(!is_null(auth()->user()))
                                <div class="author">
                                    <div class="author-img">
                                        <img class="w-100" src="images/img-21.jpg" alt="">
                                    </div>
                                    <div class="author-info">
                                        <span class="author-name">{{auth()->user()->name}}</span>
                                    </div>
                                </div>

                                <div class="actions text-center ">
                                    <button class="btn author-action-button"><i class="icofont-like"></i>&nbsp;50</button>
                                    <button class="btn author-action-button"><i class="icofont-star"></i>&nbsp;50</button>
                                    <button class="btn author-action-button"><i class="icofont-share"></i>&nbsp;50</button>

                                    <div class="form-row mt-3">
                                        <div class="col-md-6">
                                            <a href="sign-in.html" class="btn btn-block theme-btn sign-in">Profile</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{route('user-logout')}}" class="btn btn-block theme-btn sign-up">Log Out</a>
                                        </div>
                                    </div>
                                </div>
                                @else
                                   <!--  <div class="form-row mt-3">
                                        <div class="col-md-12">
                                            <a href="{{route('user-login')}}" class="btn btn-block theme-btn sign-up">Log In</a>
                                        </div>
                                    </div> -->
                                @endif

                            </div>
                        </li>
                        
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="openNav" onclick="cart_open()"><i data-count="@if(session()->has('cart')){{count(session()->get('cart'))}} @else 0 @endif" class="add_to_card_icon fa fa-shopping-cart fa-2x fa-border icon-grey add_to_card_badge"></i></a>
                                {{-- <a class="nav-link" href="#" id="openNav" onclick="cart_open()"><i class="icofont-cart"></i></a> --}}
                            </li>
            
                    </ul>
                </div>
            </div>
        </nav>
    </div>
