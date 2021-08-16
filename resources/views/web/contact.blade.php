@extends('layouts.master')

@section('main-content')
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.10/clipboard.min.js"></script>
<style>
    .grid-item img {
        width: 100%;
    }

    .grid {
        margin: 50px 10px;
    }

    .loader-ellips {
        font-size: 20px;
        /* change size here */
        position: relative;
        width: 4em;
        height: 1em;
        margin: 10px auto;
    }

    .loader-ellips__dot {
        display: block;
        width: 1em;
        height: 1em;
        border-radius: 0.5em;
        background: #555;
        /* change color here */
        position: absolute;
        animation-duration: 0.5s;
        animation-timing-function: ease;
        animation-iteration-count: infinite;
    }

    .loader-ellips__dot:nth-child(1),
    .loader-ellips__dot:nth-child(2) {
        left: 0;
    }

    .loader-ellips__dot:nth-child(3) {
        left: 1.5em;
    }

    .loader-ellips__dot:nth-child(4) {
        left: 3em;
    }

    @keyframes reveal {
        from {
            transform: scale(0.001);
        }

        to {
            transform: scale(1);
        }
    }

    @keyframes slide {
        to {
            transform: translateX(1.5em)
        }
    }

    .loader-ellips__dot:nth-child(1) {
        animation-name: reveal;
    }

    .loader-ellips__dot:nth-child(2),
    .loader-ellips__dot:nth-child(3) {
        animation-name: slide;
    }

    .loader-ellips__dot:nth-child(4) {
        animation-name: reveal;
        animation-direction: reverse;
    }
    /* copy share url */
    .copy-text {
	position: relative;
	padding: 10px;
	background: #fff;
	border: 1px solid #ddd;
	border-radius: 10px;

    }
 
    
    .copy-text .share_link {
        /* padding: 10px; */
        font-size: 10px;
        color: #0d4444;;
        border: none;
        outline: none;
    }
   


    .copy-text .author-action-button:before {
        content: "Copied";
        position: absolute;
        top: -20px;
        right: 54px;
        background: #0d4444;
        padding: 8px 10px;
        border-radius: 20px;
        font-size: 8px;
        display: none;
    }
    .copy-text .author-action-button:after {
        content: "";
        position: absolute;
        transform: rotate(45deg);
        display: none;
    }
    .copy-text.active .author-action-button:before,
    .copy-text.active .author-action-button:after {
        display: block;
    }
}

</style>
<div class="container">
    <div class="col-md-6 ml-md-auto mr-md-auto card mt-5 mb-5">
        
            
            <div class="card-body">
              <h5 class="card-title">Contact with us</h5>
              @if(session()->has('message-success'))
              <div class="alert alert-success mb-3 background-success" role="alert">
                  {{ session()->get('message-success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @elseif(session()->has('message-danger'))
              <div class="alert alert-danger">
                  {{ session()->get('message-danger') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
              <form action="{{url('submit-contact')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="exampleInputname1">Full name</label>
                  <input type="text" class="form-control" value="{{old('name')}}" name="name" id="exampleInputname1" aria-describedby="emailHelp" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Message</label>
                    <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" required>{{old('message')}}</textarea>
                </div>
                <button type="submit" class="btn  w-100 pt-1" style="background-color: #0d4444;color:white">send</button>
                
              </form>
            </div>
       
    </div>
</div>




<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>


<script>
    var elem = document.querySelector('.grid');
    var msnry = new Masonry(elem, {
        // options
        itemSelector: '.grid-item',
    });

    var elem2 = document.querySelector('.grid');
    var infScroll = new InfiniteScroll('.grid', {

        path: '?page=@{{#}}',
        append: '.grid-item',
        outlayer: msnry,
        history: false,
        status: '.page-load-status'
    });

</script>
<script>
    let copyText = document.querySelector(".copy-text");
    copyText.querySelector(".author-action-button").addEventListener("click", function () {
        let input = copyText.querySelector("input.text");
        input.select();
        // input.value = $(".share_link").val();
        document.execCommand("copy");
        // alert(document.execCommand("copy"))
        copyText.classList.add("active");
        window.getSelection().removeAllRanges();
        setTimeout(function () {
            copyText.classList.remove("active");
        }, 500);
    });
    
</script>


@endsection

