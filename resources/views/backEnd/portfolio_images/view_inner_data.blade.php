<div class="card ">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-3" style="font-size: 21px; font-weight: bold;" id="total_image_count">All Images ({{count($total_images)}})</div>
            <div class="col-lg-9" style="float: right;">
            </div>
        </div>
    </div>
    <div class="row col-lg-12" >
        @if(isset($images))
            @foreach($images as $image)
                <div class="card-block col-lg-3">
                    <div class="card">
                        {{-- <p style="margin-top: 15px; margin-left: 8px;">
                            <input type="checkbox" name="id" value="{{$image->id}}">
                        </p> --}}
                        <img class="card-img-top" src="{{asset($image->thumbnail_url)}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">id#{{$image->id}}</h5>
                            <p class="card-text">{{$image->title}}</p>
                            {{-- <button  type="button" onclick="approveAnImage({{$image->id}})" class="btn btn-success action-icon"><i class="fa fa-check"></i></button>
                            <button onclick="pendinDeleteAnImage({{$image->id}})" type="button" class="btn btn-danger action-icon"><i class="fa fa-trash-o"></i></button> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div id="" class="col-lg-12 text-center" style="margin: 0 auto; margin-bottom: 15px;">
            <div style="display: inline-block;">
                {!! $images->render("pagination::bootstrap-4") !!}
            </div>
        </div>
    </div>
</div>