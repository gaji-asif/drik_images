<!-- Footer start -->
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_widget">
                        <div class="footer_widget_title">
                            <h2>SUPPORT</h2>
                        </div>
                        <ul class="footer_widget_content">
                            <li><span>Phone: &nbsp;&nbsp;&nbsp;&nbsp;</span>+000 333 879 788</li>
                            <li><span>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> support@gmail.com</li>
                            <li><span>Address: &nbsp;</span> king street,avenue</li>
                        </ul>

                        <div class="footer_social">
                            <ul class="footer_social_icons">
                                <li><a href="#"><i class="fab fa-skype"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_widget">
                        <div class="footer_widget_title">
                            <h2>PRODUCTS</h2>
                        </div>
                        <ul class="footer_widget_content">
                            <li><i class="icofont-double-right"></i><a href="#">Drik Images API</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Media Manager</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Drikimages.com</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">DrikGallery</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">200k Stock Images</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_widget">
                        <div class="footer_widget_title">
                            <h2>SOLUTIONS</h2>
                        </div>
                        <ul class="footer_widget_content">
                            <li><i class="icofont-double-right"></i><a href="#">Pricing and solutions</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Premium Access</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Rights and clearance</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Image collections</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Custom solutions</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_widget">
                        <div class="footer_widget_title">
                            <h2>COMPANY</h2>
                        </div>
                        <ul class="footer_widget_content">
                            <li><i class="icofont-double-right"></i><a href="#">Press room</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Careers</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Affiliates</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">Grants and giving</a></li>
                            <li><i class="icofont-double-right"></i><a href="#">200 + Photographers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="copyright">© 2021 All Rights Reserved <a target="_blank" href="#">Drik Gallery</a></p>
                </div>
                <div class="col-md-6">
                    {{-- <p class="design_by">Design & Developed by <a target="_blank" href="http://nextgenitltd.com/">NEXTGEN IT</a></p> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Footer end -->

<script type="text/javascript" src="{{asset('public/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>

<script src="{{asset('public/js/drik_js/sidebar.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/pages/advance-elements/select2-custom.js')}}">
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="{{asset('public/bower_components/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/assets/pages/advance-elements/select2-custom.js')}}"></script>
<script src="{{asset('public/js/common.js')}}"></script>

<script src="{{asset('public/js/drik_js/main.js')}}"></script>

<script>
    function cart_open() {
        document.getElementById("mySidebar").style.marginRight = "0%";
        document.getElementById("mySidebar").style.transition = "all 0.3s";
        document.getElementById("openNav").style.display = "none";
    }
    function cart_close() {
        document.getElementById("mySidebar").style.marginRight = "-110%";
        document.getElementById("mySidebar").style.transition = "all 0.3s";
        document.getElementById("openNav").style.display = "inline-block";
    }
</script>
</body>
</html>
