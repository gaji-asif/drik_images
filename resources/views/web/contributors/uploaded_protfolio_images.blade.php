@include('web.partials.header')
<style>
    .theBox {
      overflow: hidden;
      /* width: 240px; */
      height: 100px;
   }

   .theBox img {
      /* display: block; */
      height: 100%;
   }
</style>
<div class="row col-md-12" style="min-height: 450px; background-color: #eff0f4; padding-top: 10px; padding-bottom: 5px;">
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
        <div class="card ">
            <div class="container mt-4">
                <h5>All Uploaded Protofolio Images (@if(isset($images)){{count($images)}}@else 0 @endif)</h5>
                <div class="table-responsive  mt-4 mb-4">          
                    <table id="example" class="table table-bordered " style="width:100%">
                        <thead>
                            <tr>
                         
                                <th>Image Id</th>
                                <th width="30%" class="text-center">Image</th>
                                <th >Details</th>
                               
                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $key=>$image)
                                <tr>
                                   
                                    <td>{{$image->id}}</td>
                                    <td><div class="theBox text-center"><img src="{{$image->thumbnail_url}}" alt=""></div></td>
                                    <td>
                                        <p><font style=""><strong>Title: </strong></font>{{$image->title}}</p>
                                        <p><font style=""><strong>Caption: </strong></font>{{$image->caption}}</p>
                                        <p><font style=""><strong>Category: </strong></font>@if(isset($image->categories->cat_name)){{$image->categories->cat_name}}@endif</p>
                                        <p><font style=""><strong>Sub Category: </strong></font>@if(isset($image->subCategories->cat_name)){{$image->subCategories->cat_name}}@endif</p>
                                        <p><font style=""><strong>Author: </strong></font>{{$image->author}}</p>
                                        <p><font style=""><strong>Height: </strong></font>{{$image->height}}</p>
                                        <p><font style=""><strong>Width: </strong></font>{{$image->width}} </p>
                                    </td>
                                   
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('web.partials.footer')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>