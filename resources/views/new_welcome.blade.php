@extends('layouts.master')

@section('main-content')
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.10/clipboard.min.js"></script>
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
.grid > figure {
margin: 4px;
background-color: white;
position: relative;
}
.grid > figure > i {
display: block;
}
.grid > figure > img {
position: absolute;
top: 0;
width: 100%;
vertical-align: bottom;
}
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
    
    @media (min-width: 1200px){
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
    .card-bodys{
        padding: 5px 10px 10px 5px;
    }
    #loadMore{
        font-weight: bold;
    }
</style>
<div class="gallery-2">
    <div class="grid are-images-unloaded" id="loadMoreimagesDiv">
        @include('image_gallary');

    </div>
    <div id="" class="col-lg-12 text-center" style="margin: 0 auto; margin-bottom: 15px;margin-top: 15px;">
        <div style="display: inline-block;">
            <a href="javascript:void(0)" id="loadMore">Load more images . . . . .</a> 
        </div>
    </div>
</div>
<input type="hidden" id="lastPage" value="{{$images->lastPage()}}">
<input type="hidden" id="currentPage" value="1">
<input type="hidden" id="nextPageUrl" value="{{$images->nextPageUrl()}}">
<input type="hidden" id="appUrl" value="{{url('/')}}">



  
{{-- <div class="modal fade" id="image_details" tabindex="-1" role="dialog" aria-labelledby="image_detailsTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-row ">
                    <div class="col-md-9">
                        <div class="full-img" id="image_main_image"></div>
                        <div class=" pt-2">
                            <p><font style=""><strong>Title: </strong></font><span id="image_title"></span></p>
                            <p><font style=""><strong>Caption: </strong></font><span  id="image_caption"></span></p>
                            <p><font style=""><strong>Category: </strong></font><span id="image_category"></span></p>
                            <p><font style=""><strong>Sub Category: </strong></font><span id="image_sub_category"></span></p>
                            <p><font style=""><strong>Author: </strong></font><span id="image_author"></span></p>
                            <p><font style=""><strong>Height: </strong></font><span id="image_height"></span></p>
                            <p><font style=""><strong>Width: </strong></font><span id="image_width"></span></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="author">
                            <div class="author-img" id="image_author_image"></div>
                            <div class="author-info" >
                                <span class="author-name" id="image_author_name "></span>
                            </div>
                        </div>

                        <div class="actions text-center">
                            <div class="copy-text ">
                                <div class="col-lg-12  text-center " >
                                    <input type="text" class="share_link  text" style="width:100%" value="" />
                                </div>
                                <div class="col-lg-12  ">
                                    <div class="text-center " id="image_share_buton">

                                    </div>
                                </div>
                             </div>
                        </div>

                        <div class="purchase">
                            <h6>PURCHASE A LICENSE</h6>

                            <div id="image_purchase_div"></div>
                            
                            <div id="accordion" class="accordion mt-2 mb-2">
                                <div class="card mb-0">
                                    <div class="card-header collapsed " data-toggle="collapse" href="#collapseOne" onclick="openOther({{$image->id}})">
                                        <a class="card-title">
                                            Choose another rights-managed license
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="card-body card-bodys collapse" data-parent="#accordion">
                                        <div class="form-group " id="image_rights-managed-license-div"></div>
                                    </div>    
                                </div>
                            </div>
                        
                             <div class="download mt-2 " id="image_add_to_cart">     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   --}}
<script src="{{asset('public/js/image_model.js')}}"></script>
  <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
  {{-- <script>
      var elem2 = document.querySelector('.grid');
      var infScroll = new InfiniteScroll('.grid', {
        path: '?page=@{{#}}',
        append: 'figure',
        history: false,
        status: '.page-load-status',
      });
  </script> --}}
  <script>
    function onClickCopy(id) {

        let copyText = document.querySelector(`.copy-text-${id}`);
            let input = copyText.querySelector(`.share_link-${id}`);
            console.log(input);
            input.select();
            document.execCommand("copy");
            copyText.classList.add("active");
            window.getSelection().removeAllRanges();
            setTimeout(function () {
                copyText.classList.remove("active");
            }, 500);
    }

    $(document).on('click','#loadMore' , function()
    {
        let currentPage = $('#currentPage').val() ? parseInt($('#currentPage').val()) : 1;
        currentPage += 1;
       
        let nextPage = $('#lastPage').val();

         let url = $('#appUrl').val();
        
        if (currentPage <= nextPage)
        {
            nextPageUrl = `${url}?page=${currentPage}`;
        
            $('#currentPage').val(currentPage);

            if(currentPage == nextPage)
            {
                $(this).text('');
                $(this).text('No image available');
            }

            $.ajax({
                type: "GET",
                url: nextPageUrl,
                success: function(data) {
                    $(`#loadMoreimagesDiv`).append(data);
                    makeWatermarks();
                }
            });
        }
        
    });
    
   $(document).ready(function() {
        makeWatermarks();
    });

    function makeWatermarks()
    {
        let allImages = $(".img");
        let logo = baseUrl + '/public/images/drik_images_logo.png';
        allImages.each(function(index, image) {
            let imageId = $(image).data('image_id');
            let isWatermarkDone = $(image).data('is_water_mark_done');
            let imageUrl = $(image).find('img').attr('src');
          
            $("#image_div_"+imageId).attr('data-is_water_mark_done', '1');

            if(isWatermarkDone == 0)
            {
                $(image).find('img').attr('src', imageUrl);
                
                watermark([imageUrl,logo])
                .image(watermark.image.lowerRight(0.5))
                .then(function (img) {
                    $('#image_main_div_' + imageId).html('');
                    $('#image_main_div_' + imageId).html(img);
                    $('#image_main_div_' + imageId).find('img').css('width','100%');

                });
            }
           
        });
    }
</script>
@endsection

