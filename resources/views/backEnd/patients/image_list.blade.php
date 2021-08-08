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
                <div class="card-header">
                    <h5>All Upload Images</h5>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        {{ Form::open(['class' => 'new_form', 'files' => true, 'url' => 'edit_image_info','method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" id="btn-bulk-delete"  data-toggle="modal">Bulk Delete</button>
                            <button type="button" class="btn btn-success get-all-selected"  data-toggle="modal" data-target="#edit-image-info">Bulk Edit</button>
                        </div>

                        <table id="image-table" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Height</th>
                                <th>Width</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
                        {{ Form::close()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="image-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="image-edit-modal">Update Image Metadata</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body iptc_metadata">
                                    <div class="form-row">
                                        <div class="col-md-12 text-left">
                                            <h6>IPTC Metadata</h6>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">
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
                                        {{--                                                                            <div class="form-group col-sm-12 col-md-12 col-lg-6 text-left form-row align-items-center">--}}
                                        {{--                                                                                <div class="col-sm-3 col-md-2 col-lg-3">--}}
                                        {{--                                                                                    <label for="info7 mb-0">Creation date</label>--}}
                                        {{--                                                                                </div>--}}
                                        {{--                                                                                <div class="col-sm-12 col-md-9 col-lg-9">--}}
                                        {{--                                                                                    <input type="text" class="form-control mb-0 image-creation-date" placeholder="Creation date">--}}
                                        {{--                                                                                </div>--}}
                                        {{--                                                                            </div>--}}
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12 text-left form-row align-items-center">
                                            <label>Keywords</label>
                                            <input type="text" class="form-control tags-input" id="tags" value="" />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label style="float: left;" for="role_id" class=" col-form-label">Select Oreientation: </label>
                                            <select class="form-control col-sm-12 orientation {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="orientation">
                                                <option value="">Select Oreientation</option>
                                                <option value="Vertical">Vertical</option>
                                                <option value="Horizontal">Horizontal</option>
                                                <option value="Square">Square</option>
                                                <option value="Panaromic">Panaromic</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label  style="float: left;" for="role_id" class=" col-form-label">No of people: </label>
                                            <select class="form-control col-sm-12 no_people {{ $errors->has('no_people') ? ' is-invalid' : '' }}" name="no_people">
                                                <option value="">Select No</option>
                                                <option value="1">1 person</option>
                                                <option value="2">2 person</option>
                                                <option value="3">3 person</option>
                                                <option value="0">Group of people</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label  style="float: left;" for="role_id" class=" col-form-label">Select Composition: </label>
                                            <select class="form-control col-sm-12 people_composition {{ $errors->has('people_composition') ? ' is-invalid' : '' }}" name="people_composition">
                                                <option value="">Select Composition</option>
                                                <option value="Head Shot">Head Shot</option>
                                                <option value="Waist Up">Waist Up</option>
                                                <option value="Full Length">Full Length</option>
                                                <option value="Three Quarter">Three Quarter</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label style="float: left">Specific People: </label>
                                            <input type="text" class="form-control specific_people" name="specific_people" value="" />
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label style="float: left">Location: </label>
                                            <input name="location" type="text" class="form-control location" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="update_image_btn" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <script src={{asset("public/js/imageList.js")}}></script>
    </div>

@endSection
