@extends('layouts.master')

@section('main-content')
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.10/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

<!--then bootstrap-->

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
.about_wrapper{
    font-family: "Metropolis", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    margin-top: 30px;
    margin-bottom: 30px;
    padding-top: 30px;
    padding-bottom: 30px;
}
.font_size_15{
    font-size: 15px;
}

</style>

    <div class="container px-5" style="margin-top: 40px; margin-bottom: 40px;overflow-y: scroll">
        <div class="about_wrapper"> 
        <div class="row gx-5 justify-content-center">
            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">

                {{-- Fine Art Sales --}}
                <h4 class="" id="fine_art_sales">Fine Art Sales</h4>
                <div class="col-lg-10">
                   
                    <p class="font_size_15 pb-3">
                        Drik images’s fine art images are printed on archival paper and come in limited edition prints. These rare images come with their own stories and are testament to the historical legacies that have come and gone. Our featured fine art photographers include GolamKasem Daddy, BijonSarker, Manzoor Alam Beg and AmanulHaque. 
                    </p>
                </div>

                  {{-- Categories --}}
                  <h4 class="" id="categories">Categories</h4>
                  <div class="col-lg-10">
                     
                      <p class="font_size_15 pb-3">
                        Our stock images range from nature to portraits to cultural events, highlighting both life in South Asia and around the world. Browse through our wide collection of images, dating from 1918 to present-day.Please contact us if you have anything specific in mind and if you don’t find it online.
                      </p>
                  </div>

                   {{-- Special Collections --}}
                   <h4 class="" id="special_collections">Special Collections</h4>
                   <div class="col-lg-10">
                      
                       <p class="font_size_15 pb-3">
                        Drik images is proud to contain the finest historical photographic archive in South Asia, containing photographs from the 1971 Liberation War, the work of Bangladesh’s pioneer photographers, and a collection of historically significant photo stories. 
                       </p>
                   </div>
                 

           

              </div>
           
       </div>
    </div>
</div>
@endsection

