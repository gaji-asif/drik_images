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


    <div class="container px-5" style="margin-top: 40px; margin-bottom: 40px;">
        <div class="about_wrapper"> 
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-10">
                <h4 class="mb-4">A quick guide to our company culture</h4>
                <p class="font_size_15">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor, eos quisquam expedita quo officiis porro provident laborum. Earum, consequatur provident, ipsam at excepturi rerum laborum aliquam facere molestias mollitia recusandae.</p>

                <p class="font_size_15">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor, eos quisquam expedita quo officiis porro provident laborum. Earum, consequatur provident, ipsam at excepturi rerum laborum aliquam facere molestias mollitia recusandae.</p>

                <p class="font_size_15">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor, eos quisquam expedita quo officiis porro provident laborum. Earum, consequatur provident, ipsam at excepturi rerum laborum aliquam facere molestias mollitia recusandae.</p>
               
                <hr class="my-5" />
                <h4 class="mb-4">
                    <div class="icon-stack bg-primary text-white me-2"><i data-feather="arrow-right"></i></div>
                    This is what we do
                </h4>
                <p class="font_size_15">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor, eos quisquam expedita quo officiis porro provident laborum. Earum, consequatur provident, ipsam at excepturi rerum laborum aliquam facere molestias mollitia recusandae.</p>
                
                <div class="card bg-light shadow-none" style="margin-top: 25px;">
                    <div class="card-body">
                        <h6>Questions you should ask yourself</h6>
                        <ul class="mb-0">
                            <li class="text-italic">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed soluta fugiat eveniet, dignissimos facere quisquam, odit suscipit aliquid magnam,?</li>
                        </ul>
                    </div>
                </div>
              
              
               
            </div>
       </div>
    </div>
</div>
@endsection

