@include('web.partials.header')

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
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                       <a class="nav-link active" href="{{ ('your-dashboard') }}">Dashboard</a>
                   </li>
                    <li class="nav-item">
                       <a class="nav-link" href="{{ ('customer-profile') }}">My Profile</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="{{ ('wishlist') }}">My Wishlist</a>
                   </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ ('promocode') }}">Promo Code</a>
                    </li>
                   <li class="nav-item">
                       <a class="nav-link" href="{{ ('user-logout') }}">Log Out</a>
                   </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="card">
            <div class="col-lg-12">
                <div class="container">
                    <h3 class="mt-4 mb-4">Total Purchased</h3>

                    <div class="table-responsive">
                        <table class="table">

                    <div class="table-responsive">          
<!--                        <table id="example" class="table table-striped table-bordered" style="width:100%">-->
                        <table id="example" class="table table-bordered yajra-datatable">

                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Item Name</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Payment Status</th>
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
  $(function () {
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
        ajax: "{{ route('purchased-list') }}",
        columns: [
            {data: 'DT_RowIndex'},
            {data: 'image_name'},
            {data: 'date'},
            {data: 'price'},
            {data: "status", name: 'status'},
            {data: 'action', orderable: false, searchable: false}
        ]//,order: [[1, 'desc']]
    });
  });
</script>

