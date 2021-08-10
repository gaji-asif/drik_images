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
                @include('web.customers.sidemenu')
            </div>
        </div>
    </div>
    <input type="hidden" id="id" name="id" value="@if(isset($id)){{$id}}@else {{0}} @endif">
    <div class="col-sm-9">
        <div class="card">
            <div class="col-lg-12">
                <div class="container">
                    <h5 class="mt-4 mb-4">All Purchased Images @if(isset($purchaseDetail) && count($purchaseDetail)>0)({{count($purchaseDetail)}})@else(0) @endif</h5>

                    <div class="table-responsive">
                        <table class="table">

                    <div class="table-responsive">          
                        <table id="example" class="table table-bordered yajra-datatable">

                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Purcharse Id</th>
                                    <th width="20%">Image</th>
                                    <th>Title</th>
                                    <th>Rrice</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('web.partials.footer')

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<!--<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>-->

<script type="text/javascript">
$(document).ready(function() {
  
    let id = $("#id").val();
    id = Number(id);
     let url = "{{ url('all-purchased-list/')}}";
     url = `${url}/${id}`
    

    var table = $('.yajra-datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        ajax: url,
        columnDefs: [
        {
            "targets": 2, // your case first column
            "className": "text-center",
            "width": "20%"
        }],
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'purchase_id'},
            {data: 'image'},
            {data: "title"},
            {data: "price"},
            {data: 'action', orderable: false, searchable: false}
        ]//,order: [[1, 'desc']]
    });
  });
</script>

