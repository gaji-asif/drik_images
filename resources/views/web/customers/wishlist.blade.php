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
                        <a class="nav-link" href="{{ ('your-dashboard') }}">Dashboard</a>
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
            <div class="container">
                <h3 class="mt-4 mb-4">My Wishlist</h3>
                <div class="table-responsive">          
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Add to Card</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($favorites as $value)
                            <tr>
                                <td>{{ $value->image_name }}</td>
                                <td><img width="60" src="{{ asset($value->small_url) }}" class="img-thumbnail" alt="No Image Found"></td>
                                <td>{{ $value->small_price }}</td>
                                <td><button type="button" class="btn btn-info btn-sm">+<i class="fa fa-shopping-cart"></i></button></td>
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