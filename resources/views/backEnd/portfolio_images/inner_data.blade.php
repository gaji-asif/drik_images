<div class="card ">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-3" style="font-size: 21px; font-weight: bold;" id="total_image_count">All Contributors ({{count($total_images)}})</div>
            <div class="col-lg-9" style="float: right;">
            </div>
        </div>
    </div>
    <div class="row col-lg-12" >
        @if(isset($contributors))
            @foreach($contributors as $contributor)
                <div class="col-lg-3">
                        <div class="card">
                            <a href="{{url('view_portfolio_images',$contributor->id)}}">
                                <img class="card-img-top" src="@if(isset($contributor->protfolioImages)){{asset($contributor->protfolioImages->thumbnail_url)}} @else {{asset('public/no_image_avaliable.jpg')}} @endif" alt="Card image cap">
                            </a>      
                            <div class="card-body">
                                <p><strong>Name: </strong>{{$contributor->name}}</p>
                                <p><strong>Email: </strong>{{$contributor->email}}</p>
                                <p><strong>Country: </strong>{{$contributor->country}}</p>
                                <br>
                                <button data-id="{{$contributor->id}}" class="btn btn-sm btn-success mark_as_contributor">Mark as Contributor</button>
                                <button data-id="{{$contributor->id}}" class="btn btn-sm btn-danger cancel_as_contributor">cancel </button>
                            </div>
                        </div>
                    
                    
                </div>
            @endforeach
        @endif
        <div id="" class="col-lg-12 text-center" style="margin: 0 auto; margin-bottom: 15px;">
            <div style="display: inline-block;">
                {!! $contributors->render("pagination::bootstrap-4") !!}
            </div>
        </div>
    </div>
</div>


    










