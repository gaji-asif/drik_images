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
                @include('web.customers.sidemenu')
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="card">
            <div class="col-lg-12 mt-4">
                <div class="container">
                    <div class="row" style="padding-top: 10px; padding-bottom: 10px;">
                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block" style="padding: 32px; text-align: center;">
                                    <a href="#">
                                        <div class="row align-items-center m-l-0">
                                            <div class="col-auto" style="text-align: center;">
                                            </div>
                                            <div class="col-auto">
                                                <h6 class="text-muted m-b-10">Total Pruchases</h6>
                                                <h2 class="m-b-0">@if(isset($purchase)){{count($purchase)}}@else 0 @endif</h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card">
                                <div class="card-block" style="padding: 32px; text-align: center;">
                                    <a href="#">
                                        <div class="row align-items-center m-l-0">
                                            <div class="col-auto" style="text-align: center;">
                                            </div>
                                            <div class="col-auto">
                                                <h6 class="text-muted m-b-10">Total Pruchase Items</h6>
                                                <h2 class="m-b-0">@if(isset($purchase)){{count($purchaseItem)}}@else 0 @endif</h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
        
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

