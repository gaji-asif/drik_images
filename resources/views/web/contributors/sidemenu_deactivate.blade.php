<ul class="navbar-nav mx-auto">
    <li class="nav-item">
       <a class="nav-link active" href="{{ url('your-dashboard') }}">Dashboard</a>
   </li>
    <li class="nav-item">
       <a class="nav-link" href="{{ url('customer-profile') }}">My Profile</a>
   </li>
   <li class="nav-item">
       <a class="nav-link" href="{{ url('contributor-uploaded-images') }}"> Uploaded images</a>
   </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ ('contributor-upload') }}">Upload Image</a>
    </li>
   <li class="nav-item">
       <a class="nav-link" href="{{ ('user-logout') }}">Log Out</a>
   </li>
</ul>