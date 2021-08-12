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
                    <p><font style=""><strong>Category: </strong></font>{{$image->category}}</p>
                    <p><font style=""><strong>Sub Category: </strong></font>{{$image->sub_category}}</p>
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
                                    <label class="form-check-label" for="smallRadio-{{$image->id}}-{{$item->id}}">{{$imageUsageNameMap[$item->usage_purpose]}}</label>
                                </div>

                                <span class="badge badge-pill">৳{{$item->price}}</span>
                            </div>
                        @endforeach
                

                    </div>
                    @endif
                    <div id="accordion" class="accordion">
                        <div class="card mb-0">
                            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                                <a class="card-title">
                                    Choose another rights-managed license
                                </a>
                            </div>
                            <div id="collapseOne" class="card-body card-bodys collapse" data-parent="#accordion" >
                                <div class="form-group">
                                     <select class="form-control form-control-lg" id="image_use-{{$image}}" onchange="imageUsage(this,{{$image->id}});">
                                        <option>Image Use</option>
                                        @foreach ($imageUsageCategory as $item)
                                            <option value="{{$item->id}}">{{$item->cat_name}}</option>
                                        @endforeach
                                      </select>
                                      <select class="form-control form-control-lg" id="image_usage_sub_cat-{{$image->id}}">
                                        <option>Details of use</option>
                                      </select>
                                      <select class="form-control form-control-lg" id="inputPassword">
                                        <option>Image Size</option>
                                        <option value="10">1/8 page</option>
                                        <option value="1">1/4 page</option>
                                        <option value="2">1/2 page</option>
                                        <option value="11">3/4 page</option>
                                        <option value="3">1 page</option>
                                        <option value="4">2 page spread</option>
                                        
                                      </select>
                                     
                                      <select class="form-control form-control-lg" id="inputPassword">
                                        <option>Print run</option>
                                        <option value="103">up to 25,000</option>
                                        <option value="38">up to 50,000</option>
                                        <option value="39">up to 100,000</option>
                                        <option value="102">up to 250,000</option>
                                        <option value="40">up to 500,000</option>
                                        <option value="132">up to 750,000</option>
                                        <option value="41">up to 1 million</option>
                                        <option value="42">up to 2 million</option>
                                        <option value="43">up to 5 million</option>
                                      </select>
                                      <select class="form-control form-control-lg" id="inputPassword">
                                        <option>Inserts</option>
                                        <option value="7">1</option>
                                        <option value="2">2</option>
                                        <option value="6">3</option>
                                        <option value="1">4</option>
                                        <option value="8">5</option>
                                        <option value="9">6</option>
                                        <option value="10">7</option>
                                        <option value="11">8</option>
                                        <option value="12">9</option>
                                        <option value="13">10</option>
                                        <option value="3">less than 15</option>
                                        <option value="4">less than 20</option>
                                        <option value="5">less than 25</option>
                                        <option value="14">more than 25</option>
                                      </select>
                                      <select class="form-control form-control-lg" id="inputPassword">
                                        <option>Placement</option>
                                        <option value="1">Front cover</option>
                                        <option value="2">Back cover</option>
                                        <option value="3">Inside cover</option>
                                        <option value="4">Inside</option></select>
                                      </select>

                                      <div class="form-group text-left">
                                        <label for="formGroupExampleInput">Start date</label>
                                        <input type="date" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                                      </div>
                                      <select class="form-control form-control-lg" id="inputPassword">
                                        <option>Duration</option>
                                        <option value="77">up to 1 day</option>
                                        <option value="11">up to 1 month</option>
                                        <option value="12">up to 3 months</option>
                                        <option value="13">up to 6 months</option>
                                        <option value="14">up to 1 year</option>
                                        <option value="16">up to 2 years</option>
                                        <option value="17">up to 3 years</option>
                                      </select>
                                      <select class="form-control form-control-lg" id="inputPassword">
                                        <option>Country</option>
                                        @include('countryNames')
                                      </select>
                                      <select class="form-control form-control-lg" id="inputPassword">
                                        <option>Industry sector</option>
                                        <option value="D34">Agriculture &amp; fisheries</option><option value="D35">Banking &amp; Finance &amp; Insurance</option><option value="D36">Construction &amp; Property</option><option value="D37">Consumer and household goods</option><option value="D38">Education</option><option value="D50">Entertainment &amp; Leisure</option><option value="D39">General business services</option><option value="D40">Government (local, regional, national)</option><option value="D41">Health, Medical and Pharmaceutical</option><option value="D42">Industrial goods</option><option value="D43">IT Manufacturing and services</option><option value="D44">Legal</option><option value="D45">Media, design &amp; publishing</option><option value="D46">Non Profit - other</option><option value="D47">Telecoms</option><option value="D48">Transport &amp; logistics</option><option value="D49">Travel &amp; tourism</option><option value="D51">Utility companies</option><option value="D52">OTHER</option>
                                      </select>
                                      <div class="text-right">
                                        <h6><font><strong>Price:<span>৳ 0.0</span></strong></font></h6>
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
