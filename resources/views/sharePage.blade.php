@extends('layouts.master')

@section('main-content')

<style>
    .grid-item img {
        width: 100%;
    }

    .grid {
        margin: 50px 10px;
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

    .accordion .card-header:after {
    font-family: 'FontAwesome';  
    content: "\f068";
    float: right; 
    }
    .accordion .card-header.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f067"; 
    }
    @media (min-width: 1200px){
    .container {
        max-width: 1300px;
    }
    .purchase .form-control {
        padding: .4rem .4rem;
        font-size: 12px;
        height: 34px;
    }
    .card-bodys{
        padding: 5px 10px 10px 5px;
    }
}
</style>



<div class="container">
    <div class="row m-5">
        <div class="form-row "id={{"image_details-".$image->id}}>
            <div class="col-md-9">
                <div class="full-img">
                    <img class="w-100" src="{{$image->image_main_url}}" alt="">
                </div>
                <div class="pt-2">
                    <p><font style=""><strong>Title: </strong></font>{{$image->title}}</p>
                    <p><font style=""><strong>Caption: </strong></font>{{$image->caption}}</p>
                    <p><font style=""><strong>Category: </strong></font>@if(isset($image->categories->cat_name)){{$image->categories->cat_name}}@endif</p>
                    <p><font style=""><strong>Sub Category: </strong></font>@if(isset($image->subCategories->cat_name)){{$image->subCategories->cat_name}}@endif</p>
                    <p><font style=""><strong>Author: </strong></font>{{$image->author}}</p>
                    <p><font style=""><strong>Height: </strong></font>{{$image->height}}</p>
                    <p><font style=""><strong>Width: </strong></font>{{$image->width}} </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="author">
                    <div class="author-img">
                        <img class="w-100" src="{{$image->thumbnail_url}}" alt="">
                    </div>
                    <div class="author-info">
                        <span class="author-name">{{$image->imageAuthor->name}}</span>
                    </div>
                </div>

                <div class="actions text-center">
                    {{-- <button class="btn author-action-button" style="width: 80px"><i
                            class="icofont-share"></i>&nbsp;Share</button> --}}
                </div>

                <div class="purchase">
                    <h6>PURCHASE A LICENSE</h6>

                    {{-- <div class="list-group">
                        <div
                            class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="image-sizes"
                                    id="smallRadio" value="small_price">
                                <label class="form-check-label" for="smallRadio">Small</label>
                            </div>

                            <span class="badge badge-pill">৳{{$image->small_price}}</span>
                        </div>

                        <div
                            class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="image-sizes"
                                    id="mediumRadios" value="medium_price">
                                <label class="form-check-label" for="mediumRadios">Medium</label>
                            </div>

                            <span class="badge badge-pill">৳{{$image->medium_price}}</span>
                        </div>

                        <div
                            class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="image-sizes"
                                    id="largeRadio" value="large_price">
                                <label class="form-check-label" for="largeRadio">Large</label>
                            </div>

                            <span class="badge badge-pill">৳{{$image->large_price}}</span>
                        </div>
                    </div> --}}
                    @if(!empty($image->usage_names_price))
                    <div class="list-group">
                        @foreach ($image->usage_names_price as $item)
                            <div
                                class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="image-sizes"
                                        id="smallRadio-{{$image->id}}-{{$item->id}}" value="{{$item->price}}">
                                    <label class="form-check-label text-left" for="smallRadio-{{$image->id}}-{{$item->id}}">{{$imageUsageNameMap[$item->usage_purpose]}}</label>
                                </div>

                                <span class="badge badge-pill">{{Config::get('app.curreny')}}{{$item->price}}</span>
                            </div>
                        @endforeach
                

                    </div>
                @endif

                <div id="accordion" class="accordion mt-2 mb-2">
                    <div class="card mb-0">
                        <div class="card-header collapsed " data-toggle="collapse" href="#collapseOne" onclick="openOther({{$image->id}})">
                            <a class="card-title">
                                Choose another rights-managed license
                            </a>
                        </div>
                        <div id="collapseOne" class="card-body card-bodys collapse" data-parent="#accordion" >
                 
                            <div class="form-group">
                                 <select class="form-control form-control-lg mt-3" id="image_use" onchange="imageUsage(this,{{$image->id}});" >
                                    <option  data-price="0">Image Use</option>
                                    @foreach ($imageUsageCategory as $item)
                                        <option value="{{$item->id}}">{{$item->cat_name}}</option>
                                    @endforeach
                                  </select>
                                  <select class="form-control form-control-lg" id="image_usage_sub_cat-{{$image->id}}"  onchange="detailsOfUse(this,{{$image->id}});" >
                                    <option  data-price="0">Details of use</option>
                                  </select>
                                  <select class="form-control form-control-lg" id="inputPassword"  onchange="imageSize(this,{{$image->id}});" >
                                    <option  data-price="0">Image Size</option>
                                    <option data-price="10" value="1">1/8 page</option>
                                    <option data-price="12" value="2">1/4 page</option>
                                    <option data-price="16" value="3">1/2 page</option>
                                    <option data-price="20" value="4">3/4 page</option>
                                    <option data-price="22.5" value="5">1 page</option>
                                    <option data-price="25" value="6">2 page spread</option>
                                    
                                  </select>
                                 
                                  <select class="form-control form-control-lg" id="inputPassword"  onchange="printRun(this,{{$image->id}});" >
                                    <option  data-price="0">Print run</option>
                                    <option data-price="5" value="103">up to 25,000</option>
                                    <option data-price="10" value="38">up to 50,000</option>
                                    <option data-price="15" value="39">up to 100,000</option>
                                    <option data-price="20" value="102">up to 250,000</option>
                                    <option data-price="25" value="40">up to 500,000</option>
                                    <option data-price="30" value="132">up to 750,000</option>
                                    <option data-price="40" value="41">up to 1 million</option>
                                    <option data-price="50" value="42">up to 2 million</option>
                                    <option data-price="60" value="43">up to 5 million</option>
                                  </select>
                                  <select class="form-control form-control-lg" id="inputPassword"  onchange="insertss(this,{{$image->id}});" >
                                    <option  data-price="0">Inserts</option>
                                    <option data-price="5" value="7">1</option>
                                    <option data-price="7.5" value="2">2</option>
                                    <option data-price="10" value="6">3</option>
                                    <option data-price="12.5" value="1">4</option>
                                    <option data-price="15" value="8">5</option>
                                    <option data-price="17.5" value="9">6</option>
                                    <option data-price="20" value="10">7</option>
                                    <option data-price="22.5" value="11">8</option>
                                    <option data-price="25" value="12">9</option>
                                    <option data-price="27.5" value="13">10</option>
                                    <option data-price="30" value="3">less than 15</option>
                                    <option data-price="35" value="4">less than 20</option>
                                    <option data-price="40" value="5">less than 25</option>
                                    <option data-price="50" value="14">more than 25</option>
                                  </select>
                                  <select class="form-control form-control-lg" id="inputPassword"  onchange="placement(this,{{$image->id}});" >
                                    <option  data-price="0">Placement</option>
                                    <option data-price="50" value="1">Front cover</option>
                                    <option data-price="30" value="2">Back cover</option>
                                    <option data-price="20" value="3">Inside cover</option>
                                    <option data-price="10" value="4">Inside</option></select>
                                  </select>

                                  <div class="form-group text-left mt-3">
                                    <label for="formGroupExampleInput">Start date</label>
                                    <input type="date" class="form-control" id="formGroupExampleInput" placeholder="Example input" >
                                  </div>
                                  <select class="form-control form-control-lg" id="inputPassword"  onchange="duration(this,{{$image->id}});" >
                                    <option  data-price="0">Duration</option>
                                    <option data-price="10" value="77">up to 1 day</option>
                                    <option data-price="20" value="11">up to 1 month</option>
                                    <option data-price="30" value="12">up to 3 months</option>
                                    <option data-price="40" value="13">up to 6 months</option>
                                    <option data-price="60" value="14">up to 1 year</option>
                                    <option data-price="100" value="16">up to 2 years</option>
                                    <option data-price="200" value="17">up to 3 years</option>
                                  </select>
                                  <select class="form-control form-control-lg" id="inputPassword"  onchange="country(this,{{$image->id}});" >
                                    <option  data-price="0">Country</option>
                                    @include('countryNames')
                                  </select>
                                  <select class="form-control form-control-lg" id="inputPassword"  onchange="industrySectors(this,{{$image->id}});" >
                                    <option data-price="0" >Industry sector</option>
                                    <option data-price="10" value="D34">Agriculture &amp; fisheries</option>
                                    <option data-price="10" value="D35">Banking &amp; Finance &amp; Insurance</option>
                                    <option data-price="10" value="D36">Construction &amp; Property</option>
                                    <option data-price="10" value="D37">Consumer and household goods</option>
                                    <option data-price="15" value="D38">Education</option>
                                    <option data-price="15" value="D50">Entertainment &amp; Leisure</option>
                                    <option data-price="15" value="D39">General business services</option>
                                    <option data-price="15" value="D40">Government (local, regional, national)</option>
                                    <option data-price="20" value="D41">Health, Medical and Pharmaceutical</option>
                                    <option data-price="20" value="D42">Industrial goods</option>
                                    <option data-price="20" value="D43">IT Manufacturing and services</option>
                                    <option data-price="20" value="D44">Legal</option>
                                    <option data-price="20" value="D45">Media, design &amp; publishing</option>
                                    <option data-price="25" value="D46">Non Profit - other</option>
                                    <option data-price="25" value="D47">Telecoms</option>
                                    <option data-price="25" value="D48">Transport &amp; logistics</option>
                                    <option data-price="25" value="D49">Travel &amp; tourism</option>
                                    <option data-price="25" value="D51">Utility companies</option>
                                    <option data-price="30"value="D52">OTHER</option>
                                  </select>
                                  <div class="text-right">
                                    <h6><font><strong>Price:{{Config::get('app.curreny')}}<span id="final_price-{{$image->id}}">0.0</span></strong></font></h6>
                                  </div>
                                  
                              </div>
                        
                        </div>
                      
                    </div>
                </div>
                    <div class="download mt-2">
                        <button onclick="addToCart('{{$image->id}}')" class="btn btn-block download-btn"
                            data-dismiss="modal"><i class="icofont-download"></i> Add to cart</button>
                    </div>
                </div>
            </div>
         
        </div>
    </div>
</div>

     
                  
 








<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>


<script>
    var elem = document.querySelector('.grid');
    var msnry = new Masonry(elem, {
        // options
        itemSelector: '.grid-item',
    });

    var elem2 = document.querySelector('.grid');
    var infScroll = new InfiniteScroll('.grid', {

        path: '?page=@{{#}}',
        append: '.grid-item',
        outlayer: msnry,
        history: false,
        status: '.page-load-status'
    });

</script>
{{-- <script src="{{asset('public/js/image_usage_calculator.js')}}"></script> --}}



@endsection
