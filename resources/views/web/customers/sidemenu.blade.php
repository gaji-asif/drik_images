<ul class="navbar-nav mx-auto">
    <li class="nav-item">
        <a class="nav-link {{navActive('your-dashboard')}}"  href="{{ route('your-dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{navActive('user-profile')}}" href="{{ url('user-profile') }}">My Profile</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ ('wishlist') }}">My Wishlist</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link {{navActive('all-purchase')}}" href="{{ url('all-purchase') }}">All transactions</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{navActive('all-purchase-images/0')}}" href="{{ url('all-purchase-images/0') }}">All purchased images</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('promocodes') }}">Promo Code</a>
    </li> --}}
    <li class="nav-item">
       <a class="nav-link" href="{{ route('user-logout') }}">Log Out</a>
   </li>
</ul>