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
.faq_wrapper{
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
        <div class="faq_wrapper"> 
    
                        <div class="container px-5">
                            <div class="d-flex align-items-center mb-5">
                                <div class="icon-stack icon-stack-lg bg-primary text-white"><i data-feather="users"></i></div>
                                <div class="ms-3">
                                    <h2 class="mb-0">Account</h2>
                                    <p class="lead mb-0">Let's see if we can help.</p>
                                </div>
                            </div>
                            <div class="accordion shadow mb-5" id="accordionAuth">
                                <div class="accordion-item">
                                    <div class="d-flex align-items-center justify-content-between px-4 py-5">
                                        <div class="me-3">
                                            <h4 class="mb-0">Authentication issues</h4>
                                            <p class="card-text text-gray-500">Issues related to logging in, registering a new account, and setting your account password</p>
                                        </div>
                                        <div class="badge bg-success-soft rounded-pill text-success">3 Answers</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h5 class="accordion-header" id="headingOne"><button class="accordion-button p-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">I can't remember my account email address.</button></h5>
                                    <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionAuth"><div class="accordion-body p-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div></div>
                                </div>
                                <div class="accordion-item">
                                    <h5 class="accordion-header" id="headingTwo"><button class="accordion-button p-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Why doesn't my password work?</button></h5>
                                    <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionAuth"><div class="accordion-body p-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div></div>
                                </div>
                                <div class="accordion-item">
                                    <h5 class="accordion-header" id="headingThree"><button class="accordion-button p-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Why do I keep getting logged out of my account?</button></h5>
                                    <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionAuth"><div class="accordion-body p-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div></div>
                                </div>
                            </div>
                            <div class="accordion shadow mb-5" id="accordionBilling">
                                <div class="accordion-item">
                                    <div class="d-flex align-items-center justify-content-between px-4 py-5">
                                        <div class="me-3">
                                            <h4 class="mb-0">Billing</h4>
                                            <p class="card-text text-gray-500">Issues related to logging in, registering a new account, and setting your account password</p>
                                        </div>
                                        <div class="badge bg-success-soft rounded-pill text-success">3 Answers</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h5 class="accordion-header" id="headingOne"><button class="accordion-button p-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">I can't remember my account email address.</button></h5>
                                    <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionBilling"><div class="accordion-body p-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div></div>
                                </div>
                                <div class="accordion-item">
                                    <h5 class="accordion-header" id="headingTwo"><button class="accordion-button p-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Why doesn't my password work?</button></h5>
                                    <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionBilling"><div class="accordion-body p-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div></div>
                                </div>
                                <div class="accordion-item">
                                    <h5 class="accordion-header" id="headingThree"><button class="accordion-button p-4 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Why do I keep getting logged out of my account?</button></h5>
                                    <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionBilling"><div class="accordion-body p-4">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div></div>
                                </div>
                            </div>
                            <hr class="my-5" />
                            <div class="row gx-5 text-center">
                                <div class="col-lg-4 mb-5 mb-lg-0">
                                    <a class="card card-link border-bottom-0 border-start-0 border-end-0 border-top-lg border-primary h-100 lift" href="#!">
                                        <div class="card-body p-5">
                                            <div class="icon-stack icon-stack-lg bg-primary-soft text-primary mb-4"><i data-feather="user"></i></div>
                                            <h6>Account</h6>
                                            <p class="card-text">Issues related to logging in, out, or about multiple devices.</p>
                                        </div>
                                        <div class="card-footer border-0 bg-transparent pt-0 pb-5"><div class="badge rounded-pill bg-light text-dark fw-normal px-3 py-2">21 Entries</div></div>
                                    </a>
                                </div>
                                <div class="col-lg-4 mb-5 mb-lg-0">
                                    <a class="card card-link border-bottom-0 border-start-0 border-end-0 border-top-lg border-green h-100 lift" href="#!">
                                        <div class="card-body p-5">
                                            <div class="icon-stack icon-stack-lg bg-green-soft text-green mb-4"><i data-feather="clock"></i></div>
                                            <h6>Integrations</h6>
                                            <p class="card-text">Connecting with 3rd party apps to exchange data.</p>
                                        </div>
                                        <div class="card-footer border-0 bg-transparent pt-0 pb-5"><div class="badge rounded-pill bg-light text-dark fw-normal px-3 py-2">9 Entries</div></div>
                                    </a>
                                </div>
                                <div class="col-lg-4">
                                    <a class="card card-link border-bottom-0 border-start-0 border-end-0 border-top-lg border-yellow h-100 lift" href="#!">
                                        <div class="card-body p-5">
                                            <div class="icon-stack icon-stack-lg bg-yellow-soft text-yellow mb-4"><i data-feather="clock"></i></div>
                                            <h6>Billing</h6>
                                            <p class="card-text">Issues with payments or invoicing.</p>
                                        </div>
                                        <div class="card-footer border-0 bg-transparent pt-0 pb-5"><div class="badge rounded-pill bg-light text-dark fw-normal px-3 py-2">14 Entries</div></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-rounded text-dark">
                            <!-- Rounded SVG Border-->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
                        </div>
                    
        </div>
</div>
@endsection

