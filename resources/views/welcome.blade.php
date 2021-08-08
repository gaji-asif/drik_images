@extends('layouts.master')

@section('main-content')
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.10/clipboard.min.js"></script>
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
        color: #0d4444;;
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
}

</style>

<div class="gallery-2">


    <div class="grid">

        @foreach($images as $image)
        <div class="grid-item">
            <div class="grid-image">
                <div class="img">
                    <img src="{{$image->image_main_url}}" alt="picture">

                    <div class="img-details">
                        <p class="category-name">{{$image->image_name}}</p>
                        <h4 class="image-name">{{$image->author}}</h4>
                    </div>
                    <div class="corner-top"></div>
                    <div class="corner-bottom"></div>
                    <a href="#" class="image-popup" data-toggle="modal"
                        data-target={{"#image_details-".$image->id}}></a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id={{"image_details-".$image->id}} tabindex="-1" role="dialog"
            aria-labelledby="image_detailsTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-row align-items-center">
                            <div class="col-md-9">
                                <div class="full-img">
                                    <img class="w-100" src="{{$image->image_main_url}}" alt="">
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
                                    {{-- <button class="btn author-action-button"><i
                                            class="icofont-like"></i>&nbsp;50</button>
                                    <button class="btn author-action-button"><i
                                            class="icofont-star"></i>&nbsp;50</button> --}}
                                    {{-- <div class="copy-text row">
                                        <div class="col-lg-12">
                                            <input type="text" class="share_link text" value="{{url('share-image/',$image->id)}}" />
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="btn author-action-button" style="width: 80px">
                                                <i class="icofont-share"></i>&nbsp;Share
                                            </button>
                                        </div>
                                       
                                    </div> --}}
                                    <div class="copy-text ">
                                        <div class="col-lg-12  text-center " >
                                            <input type="text" class="share_link text" style="width:100%" value="{{url('share-image',$image->id)}}" />
                                        </div>
                                        <div class="col-lg-12  ">
                                            <div class="text-center">
                                                <button class="btn author-action-button" style="width: 80px">
                                                    <i class="icofont-share"></i>&nbsp;Share
                                                </button>
                                            </div>
                                            
                                        </div>
                                       
                                    </div>
                                    {{-- <button class="btn author-action-button" style="width: 80px"><i
                                            class="icofont-share"></i>&nbsp;Share</button> --}}
                                </div>

                                <div class="purchase">
                                    <h6>PURCHASE A LICENSE</h6>

                                    <div class="list-group">
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
                                    </div>

                                    {{-- <div class="enter-promo_code">
                                        <div class="form-group form-row align-items-center">
                                            <label for="promo_code" class="col-sm-7 col-form-label">Discount/Promo
                                                Code&nbsp;&nbsp;:</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="promo_code"
                                                    placeholder="Promo Code">
                                            </div>
                                        </div>
                                        <div class="form-group form-row align-items-center">
                                            <label for="price" class="col-sm-7 col-form-label">Price (After
                                                discount)&nbsp;&nbsp;:</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="price" placeholder="0.00">
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="download mt-2">
                                        <button onclick="addToCart('{{$image->id}}')" class="btn btn-block download-btn"
                                            data-dismiss="modal"><i class="icofont-download"></i> Add to cart</button>
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
<script>
    let copyText = document.querySelector(".copy-text");
    copyText.querySelector(".author-action-button").addEventListener("click", function () {
        let input = copyText.querySelector("input.text");
        input.select();
        // input.value = $(".share_link").val();
        document.execCommand("copy");
        // alert(document.execCommand("copy"))
        copyText.classList.add("active");
        window.getSelection().removeAllRanges();
        setTimeout(function () {
            copyText.classList.remove("active");
        }, 500);
    });
    
</script>


@endsection

{{-- 
<div class="gallery-2">
            <div class="container-fluid">
                <div class="form-row">
                
                    @foreach($images as $image)
                        <div class="col-xs-6 col-sm-6 col-md-3 col-xl-3 p-0 grid-image">
                            <div class="img">
                                <img class="w-100" src="{{$image->thumbnail_url}}" alt="">

<div class="img-details">
    <p class="category-name">Mountains</p>
    <h4 class="image-name">Mountains with Cloud and Lake</h4>
</div>
<div class="corner-top"></div>
<div class="corner-bottom"></div>
<a href="#" class="image-popup" data-toggle="modal" data-target={{"#image_details-".$image->id}}></a>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id={{"image_details-".$image->id}} tabindex="-1" role="dialog"
    aria-labelledby="image_detailsTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-row align-items-center">
                    <div class="col-md-9">
                        <div class="full-img">
                            <img class="w-100" src="{{$image->image_main_url}}" alt="">
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
                            <button class="btn author-action-button"><i class="icofont-like"></i>&nbsp;50</button>
                            <button class="btn author-action-button"><i class="icofont-star"></i>&nbsp;50</button>
                            <button class="btn author-action-button"><i class="icofont-share"></i>&nbsp;50</button>
                        </div>

                        <div class="purchase">
                            <h6>PURCHASE A LICENSE</h6>

                            <div class="list-group">
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="image-sizes" id="smallRadio"
                                            value="small_price">
                                        <label class="form-check-label" for="smallRadio">Small</label>
                                    </div>

                                    <span class="badge badge-pill">${{$image->small_price}}</span>
                                </div>

                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="image-sizes"
                                            id="mediumRadios" value="medium_price">
                                        <label class="form-check-label" for="mediumRadios">Medium</label>
                                    </div>

                                    <span class="badge badge-pill">${{$image->medium_price}}</span>
                                </div>

                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="image-sizes" id="largeRadio"
                                            value="large_price">
                                        <label class="form-check-label" for="largeRadio">Large</label>
                                    </div>

                                    <span class="badge badge-pill">${{$image->large_price}}</span>
                                </div>
                            </div>

                            <div class="enter-promo_code">
                                <div class="form-group form-row align-items-center">
                                    <label for="promo_code" class="col-sm-7 col-form-label">Discount/Promo
                                        Code&nbsp;&nbsp;:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="promo_code"
                                            placeholder="Promo Code">
                                    </div>
                                </div>
                                <div class="form-group form-row align-items-center">
                                    <label for="price" class="col-sm-7 col-form-label">Price (After
                                        discount)&nbsp;&nbsp;:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="price" placeholder="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="download">
                                <button onclick="addToCart('{{$image->id}}')" class="btn btn-block download-btn"
                                    data-dismiss="modal"><i class="icofont-download"></i> Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




</div>
</div>
</div> --}}
