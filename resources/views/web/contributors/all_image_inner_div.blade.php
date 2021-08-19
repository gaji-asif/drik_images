<h5>All Images (@if(isset($images)){{count($images)}}@endif)</h5>

<div class="table-responsive  mt-4 mb-4">          
    <table id="example" class="table table-bordered " style="width:100%">
        <thead class="table-primary">
            <tr>
     
                <th width="5%">Image Id</th>
                <th width="30%" class="text-center">Image</th>
                <th width="55%">Details</th>
                <th width="55%">Total Sold</th>
                <th width="10%">Status</th>
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
                  <td>
                    @if(isset($total_sold_images)){{$total_sold_images[$image->id]}} @endif
                  </td>
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function() {
        $('#example').DataTable(
            {
                order: [[ 0, "desc" ]],
                columnDefs: [{
                    targets: [0],
                    orderable: false
                }]
            }
        );
    });
</script>