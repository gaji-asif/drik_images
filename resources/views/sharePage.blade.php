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

</style>



<div class="container ">
    <div class="row m-5">
        <div class="form-row "id={{"image_details-".$image->id}}>
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



@endsection
