@if(isset($images))
<div class="row col-lg-12">

    @foreach($images as $image)
        <div class="card-block col-lg-3">
            <div class="card">
                <p style="margin-top: 15px; margin-left: 8px;">
                    <input type="checkbox" name="id" value="{{$image->id}}">

                </p>
                <img class="card-img-top" src="{{asset($image->thumbnail_url)}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">id#{{$image->id}}</h5>
                    <p class="card-text">{{$image->title}}</p>
                    <button  type="button" class="btn btn-success action-icon"><i class="fa fa-check"></i></button>
                    {{-- <button onclick="editImage(<?php echo $image->id?>)" type="button" class="btn btn-success action-icon"><i class="fa fa-edit"></i></button> --}}
                    <button onclick="deleteAnImage({{$image->id}})" type="button" class="btn btn-danger action-icon"><i class="fa fa-trash-o"></i></button>
                    <!--   <button onclick="deleteAnImage(5)" type="button" class="btn btn-warning action-icon"><i class=" fa fa-certificate"></i></button> -->

                </div>
            </div>
        </div>

    @endforeach


</div>
<div class="row" style="margin: 0 auto; margin-bottom: 15px;">
    <div style="    display: inline-block;">
        {!! $images->render("pagination::bootstrap-4") !!}
    </div>
</div>
@endif