@extends('backEnd.master')
@section('mainContent')
<div class="row">
    <div class="col-md-12">
        @if(session()->has('message-success'))
        <div class="alert alert-success background-success" role="alert">
         {{ session()->get('message-success') }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  @elseif(session()->has('message-danger'))
  <div class="alert alert-danger background-danger">
     {{ session()->get('message-danger') }}
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="card">
    <div class="container" style="margin: 0 auto;">


      
            <div class="search_form row" style="padding: 20px 30px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 " style="margin-top:6px">
                
                        <select class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}"  id="contributor_id" >
                            <option value="">Select Contributor</option>
                            @if(isset($contributor))
                                @foreach($contributor as $item)
                                    <option value="{{ $item->id }}" >{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                </div>
                {{-- <input name="search_key" type="text" class="form-control col-lg-5" id="" placeholder="Search Images"> --}}
                <button type="submit" onclick="getImages()" class="btn col-lg-1" style="margin-left: 10px;">Search</i></button>
            </div>
     
    </div>
</div>
<div id="inner_div">
    @include('backEnd.pending_images.inner_data')   
</div>


<div class="modal fade" id="image-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="image-edit-modal">Update Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="shadow-sm">
                        <div class="card-body iptc_metadata">
                            {{-- <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabOne">Image Metadata
                                        Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabTwo">Image Price</a>
                                </li>
                            </ul> --}}
                            <div class="tab-content pt-3" id="myTabContent">
                                <div class="tab-pane fade active show" id="tabOne">
                                    <div class="form-row">
                                        <!-- <div class="col-md-12 text-left">
                                            <h6>IPTC Metadata</h6>
                                        </div> -->
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info1 mb-0">Height</label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-height"
                                                    placeholder="Info-1">
                                                <div class="invalid-feedback">
                                                    Height is required
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info2 mb-0">Width</label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-width"
                                                    placeholder="Info-2">
                                                <div class="invalid-feedback">
                                                    Width is required
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="artist mb-0">Author</label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-author"
                                                    placeholder="Author">
                                            </div>
                                        </div>

                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info4 mb-0">Country</label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-country"
                                                    placeholder="Country">
                                            </div>
                                        </div>

                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info5 mb-0">City</label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-city"
                                                    placeholder="City">
                                            </div>
                                        </div>

                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info7 mb-0">State</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-state"
                                                    placeholder="State">
                                            </div>
                                        </div>

                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info7 mb-0">Postal code</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-postal-code"
                                                    placeholder="Postal code">
                                            </div>
                                        </div>

                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info6 mb-0">Caption</label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-caption"
                                                    placeholder="Caption">
                                            </div>
                                        </div>

                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info7 mb-0">Copyright</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-copyright"
                                                    placeholder="Copyright">
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info7 mb-0">Email</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-email"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info7 mb-0">Phone</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-phone"
                                                    placeholder="Phone">
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info7 mb-0">Website</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-website"
                                                    placeholder="Website">
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info7 mb-0">Headline</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-headline"
                                                    placeholder="Headline">
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <label for="info7 mb-0">Title</label>
                                            </div>
                                            <div class="col-sm-12 col-md-9 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-title"
                                                    placeholder="Title">
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">
                                            <label>Keywords</label>
                                            <input type="text" class="form-control tags-input" id="tags" value="" />
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button id="update_image_btn" type="button" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabTwo">
                                    <div class="form-row2">

                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-4 text-right">
                                                <label for="info1 mb-0">Personal use: </label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-8 text-left">
                                                <input type="number" step="0.1" min="0.1"
                                                    class="form-control mb-0 price_0"
                                                    placeholder="Enter Personal use price">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-4 text-right">
                                                <label for="info1 mb-0">Presentation or newsletters: </label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-8 text-left">
                                                <input type="number" step="0.1" min="0.1"
                                                    class="form-control mb-0 price_1"
                                                    placeholder="Enter Presentation or newsletters price">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-4 text-right">
                                                <label for="info1 mb-0">Website: </label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-8 text-left">
                                                <input type="number" step="0.1" min="0.1"
                                                    class="form-control mb-0 price_2"
                                                    placeholder="Enter Website price">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-4 text-right">
                                                <label for="info1 mb-0">Magazines and books: </label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-8 text-left">
                                                <input type="number" step="0.1" min="0.1"
                                                    class="form-control mb-0 price_3"
                                                    placeholder="Enter Magazines and books price">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-4 text-right">
                                                <label for="info1 mb-0">Marketing package: Small business: </label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-8 text-left">
                                                <input type="number" step="0.1" min="0.1"
                                                    class="form-control mb-0 price_4"
                                                    placeholder="Enter Marketing package: Small business: price">
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">
                                            <div class="col-sm-3 col-md-2 col-lg-4 text-right">
                                                <label for="info1 mb-0">Marketing package: Large business: </label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-8 text-left">
                                                <input type="number" step="0.1" min="0.1"
                                                    class="form-control mb-0 price_5"
                                                    placeholder="Enter Marketing package: Large business: price">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="image_id">
                                        <input type="hidden" id="url" value={{ '/' }}>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button id="update_price_btn" onclick="ImagePrice()" type="button"
                                            class="btn btn-primary">Save changes</button>
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
<div class="modal fade" id="edit-image-info" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                   <!--  <div class="modal-header">
                                        <h5 class="modal-title" id="image-edit-modal">Bulk Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> -->
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div class="card shadow-sm">
                                                <div class="card-body iptc_metadata">
                                                    <div class="form-row">
                                                        <div class="form-group col-sm-12 ">

                                                                <label for="info2 mb-0">Contributor</label>


                                                                <select class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="contributor" id="info2">
                                                                    <option value="">Select Contributor</option>
                                                                    @if(isset($contributors))
                                                                        @foreach($contributors as $contributor)
                                                                            <option value="{{ $contributor->id }}">{{$contributor->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                    </select>

                                                        </div>
                                                        <div class="form-group col-sm-12 ">

                                                            <label for="info1 mb-0">Category</label>


                                                            <select class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="category" id="info1">
                                                                <option value="">Select Category</option>
                                                                @if(isset($categories))
                                                                    @foreach($categories as $category)
                                                                        <option value="{{ $category->id }}">{{$category->cat_name}}</option>
                                                                    @endforeach
                                                                @endif
                                                                </select>


                                                    </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button id="get_ids" type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>


<script src={{asset("public/js/imageList.js")}}></script>
</div>

<script>

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });

    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');

            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];

            getData(page);
        });

    });

    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
        
            $("#inner_div").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });
    }

</script>

@endSection
