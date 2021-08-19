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
            <div class="container mt-4 ">
                <div class="row mb-2">
                    <div class="col-lg-4">
                        <button class="btn btn-info" id="all_items">All Items</button>
                        <button class="btn btn-info" id="sold_items" >Sold Items</button>
                    </div>
                    <div class="col-lg-8 row">
                        <div class="row ">
                            <label class="" for="date_from">From Date:</label>
                            <div class="col-sm-8">          
                                <input type="date" class="form-control" id="date_from">
                            </div>
                           
                        </div>
                        <div class="row ">
                            <label class="" for="date_to">To Date:</label>
                            <div class="col-sm-8">          
                                <input type="date" class="form-control" id="date_to">
                            </div>
                         
                        </div>
                        <button class="btn btn-sm btn-secondary" id="submit_date" style="margin-left: -25px;margin-bottom:10px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                          </svg>
                        </button>
                    </div>
                </div>
            
                <div id="inner_data_div">
                    @include('web.contributors.all_image_inner_div')
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
        // $('#example').DataTable(
        //     {
        //         order: [[ 0, "desc" ]],
        //         columnDefs: [{
        //             targets: [0],
        //             orderable: false
        //         }]
        //     }
        // );
    });
</script>

<script>
    $(document).ready(function(){
     
       $('#sold_items').click(function(){
        let contributor_id = {{Auth::user()->id}};
        let formData = new FormData();
        formData.append('contributor_id', contributor_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `${baseUrl}/get_sold_images` ,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                datatype: "html",
                success: function( data ) {
                    $("#inner_data_div").empty().html(data);
                 
                }
            });
        });
       
        $('#submit_date').click(function(){
        let contributor_id = {{Auth::user()->id}};
        let date_from = $('#date_from').val();
        let date_to = $('#date_to').val();
        let formData = new FormData();
        formData.append('contributor_id', contributor_id);
        formData.append('date_to', date_to);
        formData.append('date_from', date_from);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `${baseUrl}/get_sold_images_by_date` ,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                datatype: "html",
                success: function( data ) {
                    $("#inner_data_div").empty().html(data);
                 
                }
            });
        });
        $('#all_items').click(function(){

            $.ajax({
                url: `${baseUrl}/contributor-uploaded-images` ,
                type: "get",
                contentType: false,
                processData: false,
                datatype: "html",
                success: function( data ) {
                    $("#inner_data_div").empty().html(data);
                  
                }
            });
        });
    });
</script>