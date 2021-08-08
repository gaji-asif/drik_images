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
                    <h5>User list</h5>
                </div>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
{{--                        {{ Form::open(['class' => 'new_form', 'files' => true, 'url' => 'edit_image_info','method' => 'POST', 'enctype' => 'multipart/form-data']) }}--}}

                        <table id="contributor-table" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Designation</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
{{--                        <div class="modal fade" id="edit-image-info" tabindex="-1" role="dialog" aria-hidden="true">--}}
{{--                            <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header">--}}
{{--                                         <h5 class="modal-title" id="image-edit-modal">Bulk Edit</h5>--}}
{{--                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                             <span aria-hidden="true">&times;</span>--}}
{{--                                         </button>--}}
{{--                                     </div>--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="card shadow-sm">--}}
{{--                                                <div class="card-body iptc_metadata">--}}
{{--                                                    <div class="form-row">--}}
{{--                                                        <div class="form-group col-sm-12 ">--}}

{{--                                                            <label for="info2 mb-0">Contributor</label>--}}


{{--                                                            <select class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="contributor" id="info2">--}}
{{--                                                                <option value="">Select Contributor</option>--}}
{{--                                                                @if(isset($contributors))--}}
{{--                                                                    @foreach($contributors as $contributor)--}}
{{--                                                                        <option value="{{ $contributor->id }}">{{$contributor->name}}</option>--}}
{{--                                                                    @endforeach--}}
{{--                                                                @endif--}}
{{--                                                            </select>--}}

{{--                                                        </div>--}}
{{--                                                        <div class="form-group col-sm-12 ">--}}

{{--                                                            <label for="info1 mb-0">Category</label>--}}


{{--                                                            <select class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="category" id="info1">--}}
{{--                                                                <option value="">Select Category</option>--}}
{{--                                                                @if(isset($categories))--}}
{{--                                                                    @foreach($categories as $category)--}}
{{--                                                                        <option value="{{ $category->id }}">{{$category->cat_name}}</option>--}}
{{--                                                                    @endforeach--}}
{{--                                                                @endif--}}
{{--                                                            </select>--}}


{{--                                                        </div>--}}


{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-footer">--}}
{{--                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                        <button id="get_ids" type="submit" class="btn btn-primary">Submit</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        {{ Form::close()}}--}}
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
                                                <label for="artist mb-0">Author</label>
                                            </div>
                                            <div class="col-sm-9 col-md-10 col-lg-9">
                                                <input type="text" class="form-control mb-0 image-author" placeholder="Author">
                                            </div>
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
        <script src={{asset("public/js/contributorList.js")}}></script>
    </div>

@endSection
