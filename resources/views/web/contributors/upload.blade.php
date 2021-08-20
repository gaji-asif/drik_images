@include('web.partials.header')
<style>
   
        .tokenfield{
            height: auto !important;
        }
</style>
<div class="row col-md-12 " style="min-height: 450px; background-color: #eff0f4; padding-top: 10px; padding-bottom: 5px;">
    <input type="hidden" name="contributor_id" id="contributor-id" value="{{$user->id}}">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <p>
                    <span>
                        <img width="40" class="rounded-circle" src="{{ asset($user->upload_img) }}" class="img-radius" alt="">
                    </span>
                    <span>{{ Auth::user()->name }}</span>
                </p>
                <hr>
                @include('web.contributors.sidemenu')
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <input type="hidden" id="contributor" value="{{Auth::user()->id}}">
        <div class="card">
            <div class="col-lg-12">
               
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="step mb-3 shadow-sm">
                                <form id="msform">
                                    <!-- fieldsets -->
                                    <fieldset>
                                        <div class="step-box">
                                            <div class="form-row justify-content-center">
                                                <div class="col-md-12">
                                                    @if(Auth::user()->is_confirm == 1)
                                                    <div class="col-md-12 text-left">
                                                        <h5 >Upload Images</h5>
                                                    </div>
                                                    @elseif(Auth::user()->is_confirm == 0)
                                                    <div class="text-left">
                                                        <h5 >Upload Your Portfolio Images</h5></h6>
                                                    </div>
                                                    @endif
                                                    <div class="form-row">
                                                        <div class="col-sm-12">
                                                            <div class="imgUp">
                                                                <section class="form-rows">
                                                                    <div class="row individual-image-form">
                                                                        <div class="col-md-3" style="padding-top: 12%;">
                                                                            <div class="imagePreview"></div>
                                                                            <label class="btn btn-primary theme-btn">
                                                                                Upload Your Image<input type="file" required class="uploadFile img" value="Upload Photo" >
                                                                            </label>
                                                                        </div>

                                                                        <div class="col-md-9">

{{--                                                                            <div class="row loader_global">--}}
{{--                                                                                <img style="margin: 0 auto; margin-bottom: 10px;" src="{{asset('public/images/loading.gif')}}" width="10%">--}}
{{--                                                                            </div>--}}
                                                                            <div class="">
                                                                                <div class="iptc_metadata">
                                                                                    <div class="form-row">
                                                                                        <div class="col-md-12 text-left">
                                                                                            <h6 style="font-size: 21px; font-weight: bold; margin-bottom: 20px; margin-top: 20px;">IPTC Metadata</h6>
                                                                                        </div>
                                                                                        <div class="col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center category-select-group">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label style="font-weight: bold;" for="info1 mb-0">Category</label>
                                                                                            </div>
                                                                                            <div class="form-group col-sm-9 col-md-10 col-lg-9">
                                                                                                <select style="border: 1px solid #3434" required class="col-sm-12 main-category form-control" name="category">
                                                                                                    @if(isset($categories))
                                                                                                        @foreach($categories as $category)
                                                                                                            <option value="{{ $category->id }}">{{$category->cat_name}}</option>
                                                                                                        @endforeach

                                                                                                    @endif
                                                                                                </select>
                                                                                                <div class="invalid-feedback">
                                                                                                    Category is required
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center sub-category-select-group">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info1 mb-0">Sub category</label>
                                                                                            </div>
                                                                                            <div class="form-group col-sm-9 col-md-10 col-lg-9">
                                                                                                <select style="border: 1px solid #3434" class="form-control col-sm-12 sub-category form-select sub-category" name="sub-category" id="sub-category">
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center height-input-group">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info1 mb-0">Height</label>
                                                                                            </div>
                                                                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-height" placeholder="Info-1">
                                                                                                <div class="invalid-feedback">
                                                                                                    Height is required
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info2 mb-0">Width</label>
                                                                                            </div>
                                                                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-width" placeholder="Info-2">
                                                                                                <div class="invalid-feedback">
                                                                                                    Width is required
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="artist mb-0">Author</label>
                                                                                            </div>
                                                                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-author" placeholder="Author">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info4 mb-0">Country</label>
                                                                                            </div>
                                                                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-country" placeholder="Country">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info5 mb-0">City</label>
                                                                                            </div>
                                                                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-city" placeholder="City">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info7 mb-0">State</label>
                                                                                            </div>
                                                                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-state" placeholder="State">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info7 mb-0">Postal code</label>
                                                                                            </div>
                                                                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-postal-code" placeholder="Postal code">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info6 mb-0">Caption</label>
                                                                                            </div>
                                                                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-caption" placeholder="Caption">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info7 mb-0">Copyright</label>
                                                                                            </div>
                                                                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-copyright" placeholder="Copyright">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info7 mb-0">Email</label>
                                                                                            </div>
                                                                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-email" placeholder="Email">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info7 mb-0">Phone</label>
                                                                                            </div>
                                                                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-phone" placeholder="Phone">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info7 mb-0">Website</label>
                                                                                            </div>
                                                                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-website" placeholder="Website">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info7 mb-0">Headline</label>
                                                                                            </div>
                                                                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-headline" placeholder="Headline">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info7 mb-0">Title</label>
                                                                                            </div>
                                                                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                                <input type="text" class="form-control mb-0 image-title" placeholder="Title">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                                                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                                                                <label for="info7 mb-0">Creation date</label>
                                                                                            </div>
                                                                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                                                                <input class="creation-date form-control" type="text" class="form-control">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center tags-input-container" >
                                                                                            <label>Keywords</label>
                                                                                            <input type="text" class="form-control tags-input" id="tags" value="" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="form-group col-lg-4">

                                                                                    <label style="float: left;" for="role_id" class=" col-form-label">Select Oreientation: </label>

                                                                                    <select class="js-example-basic-single col-sm-12 orientation {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="orientation">
                                                                                        <option value="">Select Oreientation</option>
                                                                                        <option value="Vertical">Vertical</option>
                                                                                        <option value="Horizontal">Horizontal</option>
                                                                                        <option value="Square">Square</option>
                                                                                        <option value="Panaromic">Panaromic</option>

                                                                                    </select>



                                                                                </div>





                                                                                <div class="form-group col-lg-4">

                                                                                    <label  style="float: left;" for="role_id" class=" col-form-label">No of people: </label>

                                                                                    <select class="js-example-basic-single col-sm-12 no_people {{ $errors->has('no_people') ? ' is-invalid' : '' }}" name="no_people">
                                                                                        <option value="">Select No</option>
                                                                                        <option value="1">1 person</option>
                                                                                        <option value="2">2 person</option>
                                                                                        <option value="3">3 person</option>
                                                                                        <option value="0">Group of people</option>
                                                                                    </select>



                                                                                </div>

                                                                                <div class="form-group col-lg-4">

                                                                                    <label  style="float: left;" for="role_id" class=" col-form-label">Select Composition: </label>

                                                                                    <select class="js-example-basic-single col-sm-12 people_composition {{ $errors->has('people_composition') ? ' is-invalid' : '' }}" name="people_composition">
                                                                                        <option value="">Select Composition</option>
                                                                                        <option value="Head Shot">Head Shot</option>
                                                                                        <option value="Waist Up">Waist Up</option>
                                                                                        <option value="Full Length">Full Length</option>
                                                                                        <option value="Three Quarter">Three Quarter</option>

                                                                                    </select>



                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-4">

                                                                                <div class="form-group col-lg-4">

                                                                                    <label>Specific People: </label>
                                                                                    <input type="text" class="form-control specific_people" name="specific_people" value="" />
                                                                                </div>

                                                                                <div class="form-group col-lg-4">

                                                                                    <label>Location: </label>
                                                                                    <input name="location" type="text" class="form-control location" value="" />
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </section>

                                                                <div class="col-lg-12 image-add-btn">
                                                                    <div class="row">
                                                                        <div class="col-lg-3 col-md-3"></div>
                                                                        <div class="col-lg-9 col-md-9">
                                                                            <span class="btn btn-sm theme-btn imgAdd">Add More</span>
                                                                            <br/>
                                                                            <input style="margin-top: 15px;" id="image_upload_btn" type="button" class="finish action-button" value="Upload" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- row -->
                                                </div>
                                            </div>
                                        </div>


                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src={{asset("public/js/imageForm.js")}}></script>
<script src={{asset("public/js/imageHandler.js")}}></script>

@include('web.partials.footer')
