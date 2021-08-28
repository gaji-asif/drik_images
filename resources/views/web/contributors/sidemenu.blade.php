<style>
    .nav-item .active{
        color: #0d4444;
        font-weight: bold;
    }
</style>


<ul class="navbar-nav mx-auto">

   
    <li class="nav-item">
       <a class="nav-link {{navActive('your-dashboard')}}" href="{{ ('your-dashboard') }}">Dashboard</a>
   </li>
    <li class="nav-item">
       <a class="nav-link {{navActive('profile')}}" href="{{ url('profile') }}">My Profile</a>
   </li>



    <li class="nav-item">
        <a class="nav-link  {{navActive('contributor-uploaded-protfolio-images')}}" href="{{ url('contributor-uploaded-protfolio-images') }}">Uploaded protfolio images</a>
    </li>


    @if (Auth::user()->user_type == 1 && Auth::user()->is_confirm == 1)
        <li class="nav-item">
            <a class="nav-link  {{navActive('contributor-uploaded-images')}}" href="{{ url('contributor-uploaded-images') }}">All images</a>
        </li>   
    @endif


    <li class="nav-item">
        <a class="nav-link  {{navActive('contributor-upload')}}" href="{{ ('contributor-upload') }}">Upload Image</a>
    </li>


    @if (Auth::user()->user_type == 1 && Auth::user()->is_confirm == 1)
        <li class="nav-item">
            <a class="nav-link {{navActive('withdraw-list')}}" href="{{ url('withdraw-list') }}">Withdraw</a>
        </li>   
    @endif
    @if (Auth::user()->user_type == 1 && Auth::user()->is_confirm == 0)
        <li class="nav-item">
            <a class="nav-link {{navActive('contributor-contact')}}" href="{{ url('contributor-contact') }}">Contact</a>
        </li>   
    @endif
    <li class="nav-item">
       <a class="nav-link {{navActive('user-logout')}}" href="{{ url('user-logout') }}">Log Out</a>
   </li>
</ul>

