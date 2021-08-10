<ul class="navbar-nav mx-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('your-dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('customer-profile') }}">My Profile</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ ('wishlist') }}">My Wishlist</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('all-purchase') }}">All transactions</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('all-purchase-images/0') }}">All purchased images</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('promocodes') }}">Promo Code</a>
    </li>
    <li class="nav-item">
       <a class="nav-link" href="{{ ('user-logout') }}">Log Out</a>
   </li>
</ul>