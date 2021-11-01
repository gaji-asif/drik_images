@extends('backEnd.master')
@section('mainContent')
<style>
    .active{
        color: blue;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message-success'))
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


                    <form method="GET" action="{{ route('search_image_data') }}">
                        <div class="search_form row" style="padding: 20px 30px;">
                            <div class="col-lg-3"></div>
                            <input name="search_key" type="text" class="form-control col-lg-5" id=""
                                placeholder="Search Images">
                            <button type="submit" class="btn search_submit_button col-lg-1"
                                style="margin-left: 10px;">Search</i></button>
                        </div>
                    </form>
                </div>
            </div>
            <input type="hidden" id="is_select_all" value="0">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3" style="font-size: 21px; font-weight: bold;">All Upload Images
                            ({{ count($total_images) }})</div>
                        <div class="col-lg-9" style="float: right;">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-2">
                                    <a href="{{ url('upload_photo') }}">
                                        <font class="col-lg-2">
                                            <i class="fa fa-plus"></i><br>Add Image
                                        </font>
                                    </a>
                                </div>
                                <div class="col-lg-2">
                                    <a href="" id="select_all" >
                                        <font class="col-lg-2">
                                            <i class="fa fa-check"></i><br>Select ALL
                                        </font>
                                    </a>
                                </div>
                                <div class="col-lg-2">
                                    <a href="" id="select_none">
                                        <font class="col-lg-2">
                                            <i class="fa fa-minus-circle"></i><br>Select None
                                        </font>
                                    </a>
                                </div>
                                <div class="col-lg-2">
                                    <a class="col-lg-2">
                                        <a class="get-all-selected" data-toggle="modal" data-target="#edit-image-info">
                                            <i class="fa fa-edit"></i><br>Batch Edit
                                        </a>
                                    </a>

                                </div>

                                <div class="col-lg-2">
                                    <a style="cursor: pointer;" class="col-lg-2" onclick="bulkDelete();">
                                        <i class="fa fa-trash-o"></i><br>Delete
                                    </a>

                                    <!-- <button type="button" onclick="bulkDelete();">Bulk Delete</button> -->

                                    <!-- <button type="button" class="btn btn-danger" id="btn-bulk-delete"  data-toggle="modal">Bulk Delete</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (isset($images))
                    <div class="row col-lg-12">

                        @foreach ($images as $image)
                            <div class="card-block col-lg-3">
                                <div class="card">
                            
                                    <div style="position:absolute;margin-top:10px;margin-left:5px">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" value="{{$image->id}}" class="selected_image_id" name="selected_image_ids">
                                          </div>
                                    </div>
                                    <p style=" text-align:right;margin-right:5px;margin-top:10px">
                                        <a href="{{ url('sold-details/' . $image->id) }}"><strong>Sold :
                                                @if (isset($image->sold)){{ $image->sold }} @endif</strong></a>
                                    </p>
                                    <img class="card-img-top" src="{{ asset($image->thumbnail_url) }}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">id#{{ $image->id }}</h5>
                                        <p class="card-text">{{ $image->title }}</p>
                                        <button type="button" class="btn btn-success action-icon"><i
                                                class="fa fa-check"></i></button>
                                        <button onclick="editImage(<?php echo $image->id; ?>)" type="button"
                                            class="btn btn-success action-icon"><i class="fa fa-edit"></i></button>
                                        <button onclick="deleteAnImage({{ $image->id }})" type="button"
                                            class="btn btn-danger action-icon"><i class="fa fa-trash-o"></i></button>
                                        <!--   <button onclick="deleteAnImage(5)" type="button" class="btn btn-warning action-icon"><i class=" fa fa-certificate"></i></button> -->

                                    </div>
                                </div>
                            </div>

                        @endforeach


                    </div>
                    <div class="row" style="margin: 0 auto; margin-bottom: 15px;">
                        {!! $images->render('pagination::bootstrap-4') !!}
                    </div>
                @endif

            </div>

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
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabOne">Image Metadata
                                                Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabTwo">Image Price</a>
                                        </li>
                                    </ul>
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


                                            <select
                                                class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}"
                                                name="contributor" id="info2">
                                                <option value="">Select Contributor</option>
                                                @if (isset($contributors))
                                                    @foreach ($contributors as $contributor)
                                                        <option value="{{ $contributor->id }}">
                                                            {{ $contributor->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                        <div class="form-group col-sm-12 ">

                                            <label for="info1 mb-0">Category</label>


                                            <select
                                                class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}"
                                                name="category" id="info1">
                                                <option value="">Select Category</option>
                                                @if (isset($categories))
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->cat_name }}
                                                        </option>
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


        <script src={{ asset('public/js/imageList.js') }}></script>

        <script>
            $(document).ready(function () {
                $(document).on('click', '#select_all', function (event) {
                    event.preventDefault();
                    var is_select_all = $("#is_select_all").val();
                    if(is_select_all == 0) $("#is_select_all").val(1);
                    if(!$(this).hasClass('active'))
                    {
                        $(this).addClass('active');
                    }
                    if($('#select_none').hasClass('active'))
                    {
                        $('#select_none').removeClass('active');
                    }
                    updateAllCheckboxs('check');
                });
                $(document).on('click', '#select_none', function (event) {
                    event.preventDefault();
                    var is_select_all = $("#is_select_all").val();
                    if(is_select_all == 1) $("#is_select_all").val(0);
                    if(!$(this).hasClass('active'))
                    {
                        $(this).addClass('active');
                    }
                    if($('#select_all').hasClass('active'))
                    {
                        $('#select_all').removeClass('active');
                    }
                    updateAllCheckboxs('uncheck');
                });

                function updateAllCheckboxs(type)
                {
                    let allCheckboxes = $('input[type="checkbox"]');
                    allCheckboxes.each(function(index, element) {
                        if(type == 'check')
                        {
                            $(element).prop('checked',true);
                        }
                        else if(type == 'uncheck')
                        {
                            $(element).prop('checked', false);
                        }
                    });
                }

                $(document).on('change','input[type="checkbox"]',function(e){
                    
                    if($('#select_all').hasClass('active'))
                    {
                        $('#select_all').removeClass('active');
                    }
                    if($('#select_none').hasClass('active'))
                    {
                        $('#select_none').removeClass('active');
                    }
                });
            
            });
        </script>
    </div>

@endSection
