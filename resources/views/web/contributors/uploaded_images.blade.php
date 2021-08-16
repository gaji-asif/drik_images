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
                @if( Auth::user()->active_status == 1)
                    @include('web.contributors.sidemenu_active')
                @elseif( Auth::user()->active_status == 0) 
                    @include('web.contributors.sidemenu_deactivate')
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="card ">
            <div class="container mt-4">
                <h5>All Uploaded Images</h5>
                <div class="table-responsive  mt-4 mb-4">          
                    <table id="example" class="table table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image Id</th>
                                <th width="30%" class="text-center">Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $key=>$image)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$image->id}}</td>
                                    <td><div class="theBox text-center"><img src="{{$image->thumbnail_url}}" alt=""></div></td>
                                    <td>{{$image->title}}</td>
                                    <td>{{$image->author}}</td>
                                    <td>
                                        @if ($image->status == 1) 
                                            <span class="badge badge-success p-2">Confirm</span>
                                        @elseif($image->status == 0) 
                                            <span class="badge badge-warning p-2">Pending</span>
                                        @endif
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