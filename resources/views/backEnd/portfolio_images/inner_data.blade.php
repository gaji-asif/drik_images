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
                    <a href="{{url('view_portfolio_images',$contributor->id)}}">
                        <div class="card">
                        <img class="card-img-top" src="@if(isset($contributor->protfolioImages)){{asset($contributor->protfolioImages->thumbnail_url)}} @else {{asset('public/no_image_avaliable.jpg')}} @endif" alt="Card image cap">
                            <div class="card-body">
                                <p><strong>Name: </strong>{{$contributor->name}}</p>
                                <p><strong>Email: </strong>{{$contributor->email}}</p>
                                <p><strong>Country: </strong>{{$contributor->country}}</p>

                            </div>
                        </div>
                    </a>
                    
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


    










