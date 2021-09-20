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

                {{-- drik images --}}
                <h4 class="mb-4" id="drik_images">Drik Images</h4>
                <div class="col-lg-10">
                   
                    <p class="font_size_15 pb-2">
                        Drik Images is the leading photo agency in South Asia. It has a unique and growing collection of images from all over the world, spanning over 200,000 images in total. Ranging from historical photographs of the 1971 war of liberation in Bangladesh to early 20th century glass plates, to large format architectural photographs and high-resolution digital images, the library is as much an archive, as a source of stock images that is updated with new work on a daily basis.
                    </p>
    
                    <p class="font_size_15 pb-2">
                        Established in response to the stereotyped portrayals of our world by the western media, the agency was set up as a platform for media practitioners in the global south. It attracts all levels of visual storytellers, from the professional award winning veteran to the enthusiastic beginner in the world of photography, united by a passion to deliver high quality, impactful images. 
                    </p>
    
                 
                    <p class="font_size_15 pt-4 pb-2 font-weight-bold" >
                        Our aims are to:
                    </p>
                    <p class="font_size_15 pb-2">
                        - Expose and excite image buyers and those commissioning photographers, to the wealth of fresh imagery and photographic talent that exists in this part of the world 
                    </p>
                    <p class="font_size_15 pb-2">
                        - Ensure that our image stock and assignment services fulfill the needs of potential and existing customers (photo editors, advertising agencies, interested individuals, NGO’s)inboth local and international markets 
                    </p>
                    <p class="font_size_15 pb-2">
                        - Provide a platform for photographers, photo agencies and image collections from across the majority world to gain fair access to global image markets 
                    </p>
                    <p class="font_size_15 pb-2">
                        Our major clients include,but are not limited to,Bitopi, Time magazine, BRAC, Catalyst, CARE, Citycell, Ogilvy & Mather, Powertech, UNDP,WHO, WaterAid…etc. who regularly avail of our services. 
                    </p>
                    
            
                  
                   
                </div>

                {{-- team --}}

                <h4 class="mb-4 mt-4" id="team">Team</h4>
                <div class="col-lg-10">
                   
                    <p class="font_size_15">
                        Drik Images is made up of a team of experts who are dedicated to the collection and delivery of exceptional photographic work from South Asia. From archival work to distribution, the team is passionate about the needs of the photo industry and is committed to maintaining Drik’s hard earned reputation as one of the best in this business. 
                    </p>
                    <p class="font_size_15 pt-4 pb-2 font-weight-bold" >
                        Md. Main Uddin 
                    </p>
                    <p class="font_size_15">
                        Photo Editor 
                    </p>

                    <p class="font_size_15 pt-4 pb-2 font-weight-bold" >
                        Shabnam Siddique  
                    </p>
                    <p class="font_size_15">
                        Executive - Text and Image Development 

                    </p>
    
                </div>


                {{-- Usages Policy --}}

                <h4 class="mb-4 mt-4" id="usages_policy">Usages Policy</h4>
                <div class="col-lg-10">
                   
                    <p class="font_size_15 font-weight-bold">
                        Reservation of Rights: 
                    </p>
                    <p class="font_size_15">
                        All rights are reserved to the Photographer/Drik.No advertising or promotional usage whatsoever may be made of any image unless such advertising or promotional usage is expressly permitted by Drik. No usage may be made of any image in relation to socially sensitive topics without prior written permission from Drik. 
                    </p>
                    <p class="font_size_15 font-weight-bold pt-2 pb-2">
                        Credits:  
                    </p>
                    <p class="font_size_15">
                        A credit in the following format The Photographer/Drik is to be published adjacent to any image reproduced unless otherwise agreed to by both parties. 
                    </p>
                    <p class="font_size_15 font-weight-bold pt-2 pb-2">
                        Unauthorised Use: 
                    </p>
                    <p class="font_size_15">
                        Any use made of images other than those permitted by Drik will constitute unauthorised use and will be subject to a penalty of triple the current market rate for the particular use the images were put to. 
                    </p>
                    <p class="font_size_15 font-weight-bold pt-2 pb-2">
                        Alteration, Proper and Improper Use: 
                    </p>
                    <p class="font_size_15">
                        No image or part of an image may be used for any defamatory, unlawful, obscene or pornographic use. If an image containing a person is used in a derogatory, unflattering or controversial manner, or is used to imply endorsement, use of, or connection to a service or product, the image buyer must print a statement that the model is used for illustrative use only. 
                    </p>
                    <p class="font_size_15">
                        Clients shall not make any alterations, additions or deletions to the images including, but not limited to, the making of derivative or composite images by the use of computers or any other means, without the express, written consent of DRIK or the Photographer is strictly prohibited. This prohibition shall include processes not presently in existence but which may come into being in the future. Copyright for such altered Photograph remains the sole property of the Author. 
                    </p> 
                    <p class="font_size_15 font-weight-bold pt-2 pb-2">
                        Model Releases: 
                    </p>
                    <p class="font_size_15">
                        Clients agree to indemnify and hold harmless The Photographer/Agency/Drik against any and all claims, costs and expenses including legal fees, arising when no model or property release has been provided to the client by The Photographer/Agency/Drik or when the uses exceed the uses pursuant to such a release. 
                    </p>
                    <p class="font_size_15 font-weight-bold pt-2 pb-2">
                        Arbitration: 
                    </p>
                    <p class="font_size_15">
                        Clients and The PhotographerIDrik agree to submit all disputes hereunder in excess of US$100 to arbitration. Both Clients and The Photographer/IDrik agree to abide by the resultant ruling. 
                    </p>
                    <p class="font_size_15 font-weight-bold pt-2 pb-2">
                        Unauthorised Use:  
                    </p>
                    <p class="font_size_15">
                        Any use made of images without authorisation of Drik will constitute Unauthorised Use and will be subject to a penalty of triple the current market rate for the particular use the image was put to. 
                    </p>
    
                </div>

              </div>
           
       </div>
    </div>
</div>
@endsection

