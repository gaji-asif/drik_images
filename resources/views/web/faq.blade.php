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
    }

    /* .about_wrapper {
        font-family: "Metropolis", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        margin-top: 30px;
        margin-bottom: 30px;
        padding-top: 30px;
        padding-bottom: 30px;
    } */

    .font_size_15 {
        font-size: 15px;
    }

    /* h2 {
        font-family: Arial, Verdana;
        font-weight: 800;
        font-size: 2.5rem;
        color: #091f2f;
        text-transform: uppercase;
    } */

    .accordion-section .panel-default>.panel-heading {
        border: 0;
        background: #f4f4f4;
        padding: 0;
    }

    .accordion-section .panel-default .panel-title a {
        display: block;
        font-style: italic;
        font-size: 1.5rem;
    }

    .accordion-section .panel-default .panel-title a:after {
        font-family: 'FontAwesome';
        font-style: normal;
        font-size: 3rem;
        content: "\f106";
        color: #080808;
        float: right;
        margin-top: -12px;
    }

    .accordion-section .panel-default .panel-title a.collapsed:after {
        content: "\f107";
    }

    .accordion-section .panel-default .panel-body {
        font-size: 1.2rem;
    }
</style>

<div class="container px-5" style="margin-top: 40px; margin-bottom: 40px;overflow-y: scroll">
    <div class="about_wrapper">
        <div class=" gx-5 justify-content-center">
            <section class="accordion-section clearfix mt-3" aria-label="Question Accordions">
                <div class="container">

                    <h2 class="pb-3">Frequently Asked Questions </h2>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading0">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0">
                                        Why can't I find the images I'm searching for? 
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse0" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading0">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans:  Try to search the image by typing appropriate keyword or the image id number in the search box. If you are not satisfied with online collection, you can also e-mail us at dpa@drik.net letting us know your requirement. We will come back to you soon. </p>   
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading1">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        Can I search without being registered? 
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans: You cannot search images without registration, which is free and simple.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading2">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                        How do I get detailed information about an image? 
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans: Usually the image caption and keywords provide enough information of the image. Besides photographers name and the image id number are also given along with the image. </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading4">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                        How can I search the images using Image ID? 
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans: Just put the image id number in the search box and click ‘go’. </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading5">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                        Can I pay or place an order online?  
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans. You can click on the ‘add to the light box’ button under the image and forward it to us via e-mail (dpa@drik.net) for pricing.  </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading6">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                        How do I download images once I have purchased them?  
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans: After you have made payments for an image, you will receive a link from where you can download the hi-res version of the image.  </p>
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading7">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                        What is image licensing?
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans: Stock images are sold by purchasing a right to use an image under terms set out in a license, a legally binding agreement between the buyer and the seller. </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading8">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                        What is meant by Exclusive Rights of Usage? 
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans: The Exclusive Rights of Usage or Rights Managed-Exclusive (RM-E) is a license that is more or less similar to Rights Managed (RM) license, but includes terms restricting the photographer from making sales for a specified period in a specified location or locations. According to the severity of the restrictions there is a premium paid over and above the cost of a traditional RM license. This will give a buyer exclusive use of an image. </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading9">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                        Can I cancel an image license after I have purchased it?  
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans: At the sole discretion of Drik, a request for a cancellation of a license to reproduce an image may be accepted if made within thirty (30) days of the invoice date, and in such a case Drik may make a cancellation charge of half of the invoiced price(subject to a minimum cancellation charge of US$10 per picture). </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading10">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                        How do I determine image prices? 
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading10">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans. After selecting an image you can click on the ‘add to the light box’ button under the image and forward it to us via e-mail (dpa@drik.net) for pricing. </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading11">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                        How can I reuse a purchased image? What are the terms & conditions for multiple usage? 
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading11">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans. Terms and conditions for re-use of a purchased image vary with the type of usage. The best way is to consult us by e-mail at dpa@drik.net. </p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading p-3 mb-3" role="tab" id="heading12">
                                <h3 class="panel-title">
                                    <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse12" aria-expanded="true" aria-controls="collapse12">
                                        What is the penalty for unauthorized use of an image? 
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading12">
                                <div class="panel-body px-3 mb-4">
                                    <p>Ans.  Any use of images without authorization from Drik will constitute unauthorized use and will be subject to a penalty of triple the current market rate that the particular use of image was put to. </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>
@endsection