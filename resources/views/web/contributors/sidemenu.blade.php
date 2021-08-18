<ul class="navbar-nav mx-auto">
    <li class="nav-item">
       <a class="nav-link active" href="{{ ('your-dashboard') }}">Dashboard</a>
   </li>
    <li class="nav-item">
       <a class="nav-link" href="{{ url('profile') }}">My Profile</a>
   </li>



    <li class="nav-item">
        <a class="nav-link" href="{{ url('contributor-uploaded-protfolio-images') }}">Uploaded protfolio images</a>
    </li>

    @if (Auth::user()->user_type == 1 && Auth::user()->is_confirm == 1)
        <li class="nav-item">
            <a class="nav-link" href="{{ url('contributor-uploaded-images') }}">All images</a>
        </li>   
    @endif

    <li class="nav-item">
        <a class="nav-link" href="{{ ('contributor-upload') }}">Upload Image</a>
    </li>


   
    <li class="nav-item">
       <a class="nav-link" href="{{ url('user-logout') }}">Log Out</a>
   </li>
</ul>

